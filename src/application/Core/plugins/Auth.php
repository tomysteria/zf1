<?php 

class Core_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
	
	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
	{
		// DMZ
		$exceptions = array(
			"Core::soap::index"
		);
		$resource = $request->getModuleName() . '::' .
					$request->getControllerName() . '::' . 
					$request->getActionName();
		if (in_array($resource, $exceptions)) {
			return true;
		}
		
		if (!Zend_Auth::getInstance()->hasIdentity()) {
			
			$request->setModuleName('Core')
					->setControllerName('index')
					->setActionName('signin')
					->setDispatched(true);
		}
	}
}