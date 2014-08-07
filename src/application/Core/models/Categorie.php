<?php 

class Core_Model_Categorie implements Zend_Acl_Resource_Interface, Core_Model_Interface
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
	 * Objet Categorie du parent
	 * @var Core_Model_Categorie
	 */
    private $parent;
	
    public function getResourceId() {
    	switch ($this->nom){
    		case 'pokemon':
    			return 'categorie8ans';
    			break;
    		case 'sexe':
    		case 'xxx':
    			return 'categorie18ans';
    			break;
    		default:
    			return 'categorie';
    			break;
    	}
    }
    
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
	
	/**
     * @return the $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

	/**
     * @param Core_Model_Categorie $parent
     */
    public function setParent(Core_Model_Categorie $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }


}