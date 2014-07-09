<?php 

/**
 * @author Formateur
 * @desc Controlleur par défaut 
 *
 */
class Core_ArticleController extends Zend_Controller_Action
{
	private $blogSvc;
	
	public function init()
	{
		$this->blogSvc = new Core_Service_Blog();
	}
	
	public function indexAction()
	{
		$this->view->articles = $this->blogSvc->fetchLastArticles(2);
	}
	
	public function viewAction()
	{
		$this->view->article = $this->blogSvc->fetchArticleById(1);
	}
}