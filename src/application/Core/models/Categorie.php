<?php 

class Core_Model_Categorie
{
	/**
	 * @var number
	 */
	private $id;
	/**
	 * @var string
	 */
	private $nom;
	
	/**
	 * @var array
	 */
	private $articles = array();
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return the $nom
	 */
	public function getNom() {
		return $this->nom;
	}

	/**
	 * @param string $nom
	 */
	public function setNom($nom) {
		$this->nom = $nom;
		return $this;
	}
	/**
	 * @return the $articles
	 */
	public function getArticles() {
		return $this->articles;
	}

	/**
	 * @param multitype: $articles
	 */
	public function setArticles(Array $articles) {
		$this->articles = $articles;
		return $this;
	}

	public function addArticle(Core_Model_Article $article) {
		$this->articles[] = $article;
		return $this;
	}
	
	

}