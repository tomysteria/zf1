<?php 

class Core_Model_Mapper_Article 
{
	
	public function find($id) 
	{
		// ARTICLE
		$dbTableArticle = new Core_Model_DbTable_Article();
		$resultArticle = $dbTableArticle->find($id)->current();
		$resultCategorie= $resultArticle->findParentRow('Core_Model_DbTable_Categorie');
		
		$article = new Core_Model_Article;
		$article->setId($id)
		->setTitle($resultArticle['article_title'])
		->setContent($resultArticle['article_content']);
		
		// CATEGORIE
		$categorie = new Core_Model_Categorie;
		$categorie->setId($resultCategorie['categorie_id'])
		->setNom($resultCategorie['categorie_nom']);
		
		$categorie->addArticle($article);
		$article->setCategorie($categorie);
		
		return $article;
	}
	
	public function fetchAll($where=null, $order=null, $count=null, $offset=null) 
	{
		$dbTable = new Core_Model_DbTable_Article();
		$result = $dbTable->fetchAll($where,$order, $count, $offset);
		
		$articles = array();
		foreach ($result as $row) {
			$article = new Core_Model_Article;
			$article->setId($row['article_id'])
			->setTitle($row['article_title'])
			->setContent($row['article_content']);
			$articles[] = $article;
		}
		
		return $articles;
	}
}