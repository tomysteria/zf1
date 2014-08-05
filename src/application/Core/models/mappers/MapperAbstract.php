<?php 

abstract class Core_Model_Mapper_MapperAbstract
{
	public function fetchAll($where=null, $order=null, $count=null, $offset=null)
	{
		$rowset = $this->dbTable->fetchAll($where,$order, $count, $offset);
		$objects = array();
		foreach ($rowset as $row) {
			$objects[] = $this->rowToObject($row);
		}
		return $objects;
	}
	
	abstract public function rowToObject($row);
}
