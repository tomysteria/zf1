<?php 

class Core_Navigation_PageArticle extends Zend_Navigation_Page_Mvc
{
	public function getHref()
	{
		return '';
	}
	
	public function __construct()
	{
		$articleId = $this->getRoute();
		print_r($this); exit;
	}
}