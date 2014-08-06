<?php 

class Core_Form_Auth extends Zend_Form
{
	public function init()
	{
		
		$this->addElement('text', 'login', array(
			'label' => 'Identifiant'
		));
		$this->getElement('login')->setRequired(true);
		
		$this->addElement('password', 'password', array(
			'label' => 'Mot de passe'
		));
		$this->getElement('login')->setRequired(true);
		
		$this->addElement('submit', 'send', array(
			'label' => 'Connexion'
		));
	}
}