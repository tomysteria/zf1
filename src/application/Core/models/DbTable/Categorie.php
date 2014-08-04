<?php 

class Core_Model_DbTable_Categorie extends Zend_Db_Table_Abstract
{
	protected $_name = 'categorie';
	
	protected $_primary = Core_Model_Mapper_Categorie::COL_ID;
	
	protected $_referenceMap = array(
		 'FK_parent' => array(
		       self::COLUMNS => Core_Model_Mapper_Categorie::COL_PARENT_ID,
		       self::REF_TABLE_CLASS => 'Core_Model_DbTable_Categorie',
		       self::REF_COLUMNS => Core_Model_Mapper_Categorie::COL_ID,
		       self::ON_UPDATE => self::RESTRICT,
		       self::ON_DELETE => self::RESTRICT
	   )
	);
	
	protected $_dependentTables = array(
		'Core_Model_DbTable_Article'
	);
}