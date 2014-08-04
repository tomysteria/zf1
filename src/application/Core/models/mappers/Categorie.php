<?php 

class Core_Model_Mapper_Categorie
{
	private $dbTable;
	
	const COL_ID = 'categorie_id';
	const COL_NAME = 'categorie_name';
	const COL_PARENT_ID = 'categorie_parent_id';
	
	public function __construct()
	{
		$this->dbTable = new Core_Model_DbTable_Categorie();
	}
	
	public function rowToObject(Zend_Db_Table_Row $row)
	{
		$categorie = new Core_Model_Categorie;
		$categorie->setId($row[self::COL_ID])
				  ->setNom($row[self::COL_NAME]);
		
		$parentCategorieRow = $row->findParentRow('Core_Model_DbTable_Categorie');
		if($parentCategorieRow !== null){
		    $categorie->setParent($this->rowToObject($parentCategorieRow));
		}
		
		return $categorie;
	}
}