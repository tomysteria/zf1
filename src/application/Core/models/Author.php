<?php

class Core_Model_Author
{
    /**
     * Identifiant de l'auteur
     * @var int
     */
    protected $id;
    
    /**
     * Nom de l'auteur
     * @var string
     */
    protected $name;
    
    /**
     * Email de l'auteur
     * @var string
     */
    protected $email;
    
    
    /**
     * Liste des articles de l'auteur
     * @var array
     */
    protected $articles = array();
    
    
	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

	/**
     * @return the $articles
     */
    public function getArticles()
    {
        return $this->articles;
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

	/**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

	/**
     * @param multitype: $articles
     */
    public function setArticles(array $articles)
    {
        $this->articles = $articles;
        return $this;
    }
    
    public function addArticle(Core_Model_Article $article)
    {
        $this->articles[] = $article;
        return $this;
    }

}