<?php 

class Core_Model_Article
{
	/**
	 * @var number
	 */
	private $id;
	/**
	 * @var string
	 */
	private $title;
	/**
	 * @var string
	 */
	private $content;
	
	/**
	 * @var Core_Model_Categorie
	 */
	private $categorie;
	
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
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	/**
	 * @return the $categorie
	 */
	public function getCategorie() {
		return $this->categorie;
	}

	/**
	 * @param Core_Model_Categorie $categorie
	 */
	public function setCategorie(Core_Model_Categorie $categorie) {
		$this->categorie = $categorie;
		return $this;
	}


}