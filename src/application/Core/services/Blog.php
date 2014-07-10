<?php 

class Core_Service_Blog
{
	private $dbAdapter;
	
	public function __construct()
	{
		$this->dbAdapter = Zend_Controller_Front::getInstance()
			 ->getParam('bootstrap')
			 ->getResource('multidb')
			 ->getDb('db1');
	}
	/**
	 * Fetches last articles (ordered by date)
	 * @param number $count number of fetched articles
	 */
	public function fetchLastArticles($count = 5)
	{
		$count = (int) $count;
		
		if (0 === $count) {
			throw new InvalidArgumentException('count doit être un entier supérieur à 1');
		}

		//$sql = "SELECT * FROM article ORDER BY article_id DESC  LIMIT $count";
		
		$sql = $this->dbAdapter
					->select()
					->from('article')
					->order('article_id DESC')
					->limit($count);
		
		$result = $this->dbAdapter->fetchAll($sql);

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
	
	/**
	 * @param number $articleId
	 * @throws InvalidArgumentException
	 * @return Core_Model_Article
	 */
	public function fetchArticleById($articleId)
	{
		if (0 === (int) $articleId) {
			throw new InvalidArgumentException('articleId doit être un entier supérieur à 1');
		}
		
		$sql = "SELECT * FROM article AS a,categorie AS c 
				WHERE a.article_id = ? 
				AND a.categorie_id = c.categorie_id";
		
		$result = $this->dbAdapter->fetchAll($sql, $articleId);
		print_r($result); exit;
		if (0 === count($result)) {
			return false;
		}
		
		$article = new Core_Model_Article;
		$article->setId($articleId)
				->setTitle($result[0]['article_title'])
				->setContent($result[0]['article_content']);
		return $article;
	}
}