<?php

class Core_Assert_CleanIp implements Zend_Acl_Assert_Interface
{
	
	public function assert(Zend_Acl $acl, 
			Zend_Acl_Role_Interface $role = null, 
			Zend_Acl_Resource_Interface $resource = null, 
			$privilege = null) 
	{
		return $this->_isCleanIP($_SERVER['REMOTE_ADDR']);
	}
	
	protected function _isCleanIP($ip){
		if($ip == '192.168.56.1'){
			return TRUE;
		}
		return FALSE;
	}
}