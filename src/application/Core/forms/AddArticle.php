<?php 

class Core_Form_AddArticle extends Zend_Form
{
	public function init()
	{
		$this->addElement('text', 'title', array(
			'label' => 'Titre'
		));
		$this->getElement('title')
			 ->addValidator(new Zend_Validate_NotEmpty());
		
		$this->addElement('button', 'send', array(
			'label' => 'Enregistrer'
		));
	}
}