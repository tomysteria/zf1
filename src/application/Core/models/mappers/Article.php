<?php 

class Core_Model_Mapper_Article 
{
	private $dbTable;
	
	const TABLE = 'article';
	const COL_ID = 'article_id';
	const COL_TITLE = 'article_title';
	const COL_CONTENT = 'article_content';
	const COL_CATEGORIE_ID = 'categorie_id';
	const COL_AUTHOR_ID = 'author_id';
	
	public function __construct()
	{
		$this->dbTable = new Core_Model_DbTable_Article();
	}
	
	public function find($id) 
	{
		$rowArticle = $this->dbTable->find($id)->current();
		$article = $this->rowToObject($rowArticle);
		return $article;
	}
	
	public function fetchAll($where=null, $order=null, $count=null, $offset=null) 
	{
		$rowset = $this->dbTable->fetchAll($where,$order, $count, $offset);
		$articles = array(); 
		foreach ($rowset as $row) {
			$articles[] = $this->rowToObject($row);
		}
		return $articles;
	}
	
	public function delete($id)
	{
		$row = $this->dbTable->find($id)->current();
		if (!$row instanceof Zend_Db_Table_Row_Abstract) {
			throw new Zend_Db_Table_Row_Exception('Impossible de supprimer l\'élément #' . $id);
		}
		return (bool) $row->delete();
	}
	
	public function save(Core_Model_Article $article)
	{
		$origin = $this->dbTable->find($article->getId())->current();
		$row = $this->objectToRow($article);
		if ($origin instanceof Zend_Db_Table_Row_Abstract) {
			// Update
			$where = array(self::COL_ID . ' = ?' => $article->getId());
			$this->dbTable->update($row, $where);
		} else {
			// Insert
			unset($row[self::COL_ID]);
			$this->dbTable->insert($row);
		}
	}
	
	public function rowToObject(Zend_Db_Table_Row $row)
	{
	
		$article = new Core_Model_Article;
		$article->setId($row[self::COL_ID])
				->setTitle($row[self::COL_TITLE])
				->setContent($row[self::COL_CONTENT]);
		
		$rowCategorie= $row->findParentRow('Core_Model_DbTable_Categorie');
		$mapperCategorie = new Core_Model_Mapper_Categorie();
		$categorie = $mapperCategorie->rowToObject($rowCategorie);
		
		$rowAuthor = $row->findParentRow('Core_Model_DbTable_Author');
	    $mapperAuthor = new Core_Model_Mapper_Author();
		if($rowAuthor !== null){
		  $author = $mapperAuthor->rowToObject($rowAuthor);
		} else {
		  $author = $mapperAuthor->getAnonymeEntity('Inconnu');
		}
		
		$categorie->addArticle($article);
		$author->addArticle($article);
		
		$article->setCategorie($categorie);
		$article->setAuthor($author);
		
		return $article;
	}
	
	public function objectToRow(Core_Model_Article $article)
	{
		$data = array(
			self::COL_ID => $article->getId(),
			self::COL_TITLE => $article->getTitle(),
			self::COL_CONTENT => $article->getContent(),
			self::COL_CATEGORIE_ID => $article->getCategorie()->getId()
		);
		
		if ($article->getAuthor() !== null) {
		    $data[self::COL_AUTHOR_ID] = $article->getAuthor()->getId();
		} else {
		    $data[self::COL_AUTHOR_ID] = Zend_Db::NULL_TO_STRING;
		}
		
		return $data;
	}
}