<?php 

/**
 * @author Formateur
 * @desc Controlleur par défaut 
 *
 */
class Core_ArticleController extends Zend_Controller_Action
{
	private $blogSvc;
	private $cache;
	
	public function init()
	{
		$this->blogSvc = new Core_Service_Blog();
		$this->cache = Zend_Controller_Front::getInstance()
			->getParam('bootstrap')
			->getResource('cachemanager')
			->getCache('data1');
	}
	
	public function indexAction()
	{
		$this->view->articles = $this->blogSvc->fetchLastArticles(2);
	}
	
	public function viewAction()
	{
		$articleId = (int) $this->getRequest()->getParam('id');
		if (0 === $articleId) {
			throw new Zend_Controller_Action_Exception('Article inconnu', 404);
		}
		
		$article = $this->blogSvc->fetchArticleById($articleId);
		if (!$article) {
			throw new Zend_Controller_Action_Exception('Article inconnu', 404);
		}
		
		// Cible le conteneur Zend_Navigation principal
		$nav = Zend_Registry::get('Zend_Navigation');
		// Cible le sous conteneur Article (page)
		$articleNav = $nav->findById('coreArticleIndex');
		// Créée la nouvelle page correspondant à l'article en cours
		$articlePage = Zend_Navigation_Page::factory(
			array(
				'type' => 'mvc',
				'module' => 'Core',
				'controller' => 'article',
				'action' => 'view',
				'params' => array('id' => $articleId),
				'route' => 'coreArticleView',
				'visible' => false,
				'label' => $article->getTitle()
 			)
		);
		// Injecte la nouvelle page dans le sous conteneur Articles 
		$articleNav->addPage($articlePage);
		
		
		$this->view->article = $article;
	}
	
	public function categoriesAction()
	{
		$categories = $this->cache->load('categories_data');
		
		if ( $categories === false) {
			$categories = $this->blogSvc->fetchCategories();
			$this->cache->save($categories);
		}
		
		$this->view->categories = $categories;
	}
	
	public function categorieviewAction()
	{

		$categorieId = $this->getRequest()->getParam('id');
		
		$articles = $this->cache->load('articles_data'.$categorieId);
		if ($articles === false) {
			$articles = $this->blogSvc->fetchArticlesByCategory($categorieId);
			$this->cache->save($articles);
		}
		$this->view->articles = $articles;
		$this->view->categorie = $this->blogSvc->findCategorie($categorieId);
	}	
	
	public function addarticleAction()
	{
		
		$this->view->message = "";
		$form = new Core_Form_AddArticle();
		$form->setAction('')
			 ->setMethod(Zend_Form::METHOD_POST);
		
		// SI HTTP POST, réception du formulaire
		if ($this->getRequest()->isPost()) {
			// Si tous les validateurs attachés au formulaire
			// renvoient TRUE
			if ($form->isValid($this->getRequest()->getPost())) {
				$mapper = new Core_Model_Mapper_Article();
				$article = $mapper->arrayToObjet($form->getValues());
				try {
					$this->blogSvc->saveArticle($article);
					$this->cache->remove('articles_data'.$article->getCategorie()->getId());
					$this->view->message = "Article ajouté";
				} catch(Exception $e) {
					$this->view->message = $e->getMessage();
				}
			}
			
		}
		
		$this->view->form = $form;
		
	}
	
	public function archiverAction(){
		
		$auth = Zend_Auth::getInstance();
		$userAuth = $auth->getIdentity();
		
		$acl = Zend_Registry::get('Zend_Acl');
		
		$articleId = (int) $this->getRequest()->getParam('id');
		$article = $this->blogSvc->fetchArticleById($articleId);
		
		if ($acl->isAllowed($userAuth, $article, 'archiver')) {
			var_dump('OK pour larchive');
		} else {
			var_dump('NON');
		}
		
		exit;
	}
	
}