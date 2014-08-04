<?php 

class Core_Model_DbTable_Article extends Zend_Db_Table_Abstract
{
	protected $_name = 'article';
	
	protected $_primary = 'article_id';
	
	protected $_referenceMap = array(
			'FK_categorie' => array(
				'columns' => array('categorie_id'),
				'refTableClass' => 'Core_Model_DbTable_Categorie',
				'refColumns' => array('categorie_id'),
				'onUpdate' => self::CASCADE,
				'onDelete' => self::RESTRICT
			),
	        'FK_author' => array(
				'columns' => array('author_id'),
	            'refTableClass' => 'Core_Model_DbTable_Author',
	            'refColumns' => array('author_id'),
	            'onUpdate' => self::RESTRICT,
	            'onDelete' => self::SET_NULL
			)
	);
}