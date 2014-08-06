<?php 

class Core_Form_AddArticle extends Zend_Form
{
	public function init()
	{
		$this->addElement('select', 'categorie');
		$blogSvc = new Core_Service_Blog();
		$data = $blogSvc->fetchCategories(true);
		$this->getElement('categorie')
			 ->setLabel('Catégorie')
			 ->addMultiOptions($data);
		
		$this->addElement('select', 'auteur');
		$data = $blogSvc->fetchAuthors(true);
		$this->getElement('auteur')
		->setLabel('Auteur')
		->addMultiOptions($data);
		
		$this->addElement('text', 'title', array(
			'label' => 'Titre'
		));
		$this->getElement('title')
		     ->setRequired(true)
			 ->addValidator(new Zend_Validate_NotEmpty());
		
		$this->addElement('textarea', 'desc', array(
			'label' => 'Description',
			'rows' => '6'
		));
		
		$this->addElement('submit', 'send', array(
			'label' => 'Enregistrer'
		));
	}
}