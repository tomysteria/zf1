<?php

class Core_Model_User
{
    /**
     * Identifiant de l'utilisateur
     * @var int
     */
    protected $id;
    
    /**
     * 
     * @var string
     */
    protected $login;
    
    /**
     * 
     * @var string
     */
    protected $password;
    
    
	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return the $login
     */
    public function getLogin()
    {
        return $this->login;
    }

	/**
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

	/**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

	/**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

	/**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}