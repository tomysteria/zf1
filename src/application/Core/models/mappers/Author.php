<?php
class Core_Model_Mapper_Author{
    
    private $dbTable;
    
    const COL_ID = 'author_id';
    const COL_NAME = 'author_name';
    const COL_EMAIL = 'author_email';
    
    public function __construct()
    {
        $this->dbTable = new Core_Model_DbTable_Author();
    }
    
    public function rowToObject(Zend_Db_Table_Row $row)
    {
        $author = new Core_Model_Author;
        $author->setId($row[self::COL_ID])
               ->setName($row[self::COL_NAME])
               ->setEmail($row[self::COL_EMAIL]);
        
        return $author;
    }
}