<?php 

class Core_Model_Mapper_Categorie extends Core_Model_Mapper_MapperAbstract
{

	const COL_ID = 'categorie_id';
	const COL_NAME = 'categorie_name';
	const COL_PARENT_ID = 'categorie_parent_id';
	
// 	protected $dbTableClassname = 'Core_Model_DbTable_Categorie';
	
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
	
	public function objectToRow(Core_Model_Interface $categorie)
	{
		$data = array(
				self::COL_ID => $categorie->getId(),
				self::COL_NAME => $categorie->getNom(),
				self::COL_PARENT_ID => $categorie->getParent()->getId(),
		);
	
		return $data;
	}
}