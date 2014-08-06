<?php 

class Core_Model_Mapper_Article extends Core_Model_Mapper_MapperAbstract 
{
	const TABLE = 'article';
	const COL_ID = 'article_id';
	const COL_TITLE = 'article_title';
	const COL_CONTENT = 'article_content';
	const COL_CATEGORIE_ID = 'categorie_id';
	const COL_AUTHOR_ID = 'author_id';
	
// 	protected $dbTableClassname = 'Core_Model_DbTable_Article';
	
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
	
	public function arrayToObjet(array $data)
	{
		$article = new Core_Model_Article;
		if (array_key_exists('id', $data)) {
			$article->setId($data['id']);
		}
		$article->setTitle($data['title']);
		$article->setContent($data['desc']);
		
		$mapperCategorie = new Core_Model_Mapper_Categorie();
		$categorie = $mapperCategorie->find($data['categorie']);
		
		$mapperAuthor = new Core_Model_Mapper_Author();
		if($data['auteur'] !== null){
			$author = $mapperAuthor->find($data['auteur']);
		} else {
			$author = $mapperAuthor->getAnonymeEntity('Inconnu');
		}
		
		$categorie->addArticle($article);
		$author->addArticle($article);
		
		$article->setCategorie($categorie);
		$article->setAuthor($author);
		
		return $article;
	}
	
	
	public function objectToRow(Core_Model_Interface $article)
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