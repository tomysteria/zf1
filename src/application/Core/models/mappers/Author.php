<?php
class Core_Model_Mapper_Author
{
    
    const COL_ID = 'author_id';
    const COL_NAME = 'author_name';
    const COL_EMAIL = 'author_email';
    
    public function rowToObject(Zend_Db_Table_Row $row)
    {
        $author = new Core_Model_Author;
        $author->setId($row[self::COL_ID])
               ->setName($row[self::COL_NAME])
               ->setEmail($row[self::COL_EMAIL]);
        
        return $author;
    }
    
    public function objectToRow(Core_Model_Interface $author)
    {
    	$data = array(
    		self::COL_ID => $author->getId(),
    		self::COL_NAME => $author->getName(),
    		self::COL_EMAIL => $author->getEmail(),
    	);
    	return $data;
    }
    
    public function getAnonymeEntity($name = "Anonyme"){
        $author = new Core_Model_Author;
        $author->setName($name)
               ->setEmail(NULL);
        return $author;
    }
}