<?php 

abstract class Core_Model_Mapper_MapperAbstract
{
	
	protected $dbTable;
	protected $dbTableClassname;
	const COL_ID = null;
	
	public function __construct()
	{
		if (null === $this->dbTableClassname) {
			$this->dbTableClassname = str_replace('Mapper', 'DbTable', get_called_class());
		}
		$this->dbTable = new $this->dbTableClassname();
		$this->init();
	}
	
	/**
	 * Pseudo constructeur
	 */
	public function init(){}
	
	public function find($id)
	{
		$row = $this->dbTable->find($id)->current();
		$object = $this->rowToObject($row);
		return $object;
	}
	
	public function delete($id)
	{
		$row = $this->dbTable->find($id)->current();
		if (!$row instanceof Zend_Db_Table_Row_Abstract) {
			throw new Zend_Db_Table_Row_Exception('Impossible de supprimer l\'élément #' . $id);
		}
		return (bool) $row->delete();
	}
	
	public function save(Core_Model_Interface $object)
	{
		if (null == static::COL_ID) { 
			throw new BadMethodCallException('La méthode save() générique
					ne peut fonctionner qu\'avec les mappers pourvu d\'une 
					constante COL_ID. Vous devez implémenter votre propre méthode 
					save() pour le mapper actuel');
		}
		$origin = $this->dbTable->find($object->getId())->current();
		$row = $this->objectToRow($object);
		if ($origin instanceof Zend_Db_Table_Row_Abstract) {
			// Update
			$where = array(static::COL_ID . ' = ?' => $object->getId());
			$this->dbTable->update($row, $where);
		} else {
			// Insert
			unset($row[static::COL_ID]);
			$this->dbTable->insert($row);
		}
	}
	
	public function fetchAll($where=null, $order=null, $count=null, $offset=null)
	{
		$rowset = $this->dbTable->fetchAll($where,$order, $count, $offset);
		$objects = array();
		foreach ($rowset as $row) {
			$objects[] = $this->rowToObject($row);
		}
		return $objects;
	}
	
	abstract public function rowToObject(Zend_Db_Table_Row $row);
	
	abstract public function objectToRow(Core_Model_Interface $object);
}
