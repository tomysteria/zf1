<?php 

class Core_SoapController extends Zend_Controller_Action
{
	private $cache;
	
	public function init()
	{
		$this->cache = Zend_Controller_Front::getInstance()
			->getParam('bootstrap')
			->getResource('cachemanager')
			->getCache('data1');
	}
	
	public function indexAction()
	{
		// Désactive la vue et le layout
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		
		if (!is_null($this->getRequest()->getParam('wsdl')))
		{
			// génération du WSDL
			$wsdl = new Zend_Soap_AutoDiscover();
			$wsdl->setClass('Core_Service_Demo');
			$wsdl->handle();
		} else {
			// Traitement de la requête
			$soap = new Zend_Soap_Server('http://www.project.dev/ws?wsdl');
			$soap->setClass('Core_Service_Demo');
			$soap->handle();
		}
	}
	
	public function clientAction()
	{
		$demoSvc = new Zend_Soap_Client('http://wsf.cdyne.com/WeatherWS/Weather.asmx?WSDL');
// 		$demoSvc = new Zend_Soap_Client('http://www.project.dev/ws?wsdl');
// 		$demoSvc = new Core_Service_Demo();
		$array = $demoSvc->GetWeatherInformation()
						->GetWeatherInformationResult
						->WeatherDescription;
		$this->view->result = $array[0];
	}
	
}