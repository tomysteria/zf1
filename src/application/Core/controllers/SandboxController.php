<?php

class Core_SandboxController extends Zend_Controller_Action
{
	public function init()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
	}
	
	public function indexAction()
	{
		echo 'Sandbox de Test ACL<br>';
		
		//$acl = new Zend_Acl();
		$acl = Zend_Registry::get('Zend_Acl');
		
		//isAllowed($role = null, $resource = null, $privilege = null)
		if($acl->isAllowed('nourrice', 'bebe', 'bouteille_lait')){
			echo 'autorise';
		} else {
			echo 'refuse';
		}
		
		
	}
}