<?php 

class Core_Bootstrap extends Zend_Application_Module_Bootstrap
{
	protected function _initPlugins()
	{
		$fc = Zend_Controller_Front::getInstance();
		$fc->registerPlugin(new Core_Plugin_Navigation);
		$fc->registerPlugin(new Core_Plugin_Auth);
	}
}