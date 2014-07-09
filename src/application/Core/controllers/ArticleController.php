<?php 

/**
 * @author Formateur
 * @desc Controlleur par défaut 
 *
 */
class Core_ArticleController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$articles = array(
			array('article_id' => 1, 'article_title' => 'titre1', 'article_content' => 'blablabla'),
			array('article_id' => 2, 'article_title' => 'titre2', 'article_content' => 'blablabla2'),
		);
		
		$this->view->articles = $articles;
	}
	
	public function viewAction()
	{
	
	}
}