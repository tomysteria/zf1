<?php 

class Core_Service_Blog
{
	/**
	 * Fetches last articles (ordered by date)
	 * @param number $count number of fetched articles
	 */
	public function fetchLastArticles($count = 5)
	{
		$article1 = new Core_Model_Article;
		$article1->setId(1)
				->setTitle('titre1')
				->setContent('blablabla');
		
		$article2 = new Core_Model_Article;
		$article2->setId(2)
				->setTitle('titre2')
				->setContent('blablabla');
		
		return array($article1,$article2);

		
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
		
		$dbAdapter = Zend_Controller_Front::getInstance()
					->getParam('bootstrap')
					->getResource('multidb')
					->getDb('db1');
		
		$sql = "SELECT * FROM article WHERE article_id = ?";
		$result = $dbAdapter->fetchAll($sql, $articleId);
		
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