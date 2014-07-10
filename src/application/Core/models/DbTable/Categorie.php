<?php 

class Core_Model_DbTable_Categorie extends Zend_Db_Table_Abstract
{
	protected $_name = 'categorie';
	
	protected $_primary = 'categorie_id';
	
	protected $_dependentTables = array(
		'Core_Model_DbTable_Article'
	);
}