<?php
class Core_Model_Mapper_User extends Core_Model_Mapper_MapperAbstract
{
    
    const COL_ID = 'user_id';
    const COL_LOGIN = 'user_login';
    const COL_PASSWORD = 'user_password';
    
    public function rowToObject(Zend_Db_Table_Row $row)
    {
        $user = new Core_Model_User;
        $user->setId($row[self::COL_ID])
               ->setLogin($row[self::COL_LOGIN])
               ->setPassword($row[self::COL_PASSWORD]);
        
        return $user;
    }
    
    public function authenticate($obj){
    	$user = new Core_Model_User;
    	
    	$user->setId($obj->user_id)
    		 ->setLogin($obj->user_login);
    	
    	return $user;
    }
    
    public function objectToRow(Core_Model_Interface $user)
    {
    	$data = array(
    		self::COL_ID => $user->getId(),
    		self::COL_LOGIN => $user->getLogin(),
    		self::COL_PASSWORD => $user->getPassword(),
    	);
    	return $data;
    }
    
    public function getGuest(){
        $user = new Core_Model_User;
        $user->setLogin('invite');
        
        return $user;
    }
}