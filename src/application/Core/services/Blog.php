<?php 

class Core_Service_Blog
{
	
	public function fetchCategories()
	{
		$mapper = new Core_Model_Mapper_Categorie();
		return $mapper->fetchAll();
	}
	
	public function findCategorie($id)
	{
		if (0 === (int) $id) {
			throw new InvalidArgumentException('id doit être un entier supérieur à 1');
		}
		
		$mapper = new Core_Model_Mapper_Categorie();
		return $mapper->find($id);
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

		$mapper = new Core_Model_Mapper_Article;
		$articles = $mapper->fetchAll(null,'article_id DESC', $count);

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
		
		$mapper = new Core_Model_Mapper_Article;
		$article = $mapper->find($articleId);
		
		return $article;
		
	}
	
	public function fetchArticlesByCategory($id)
	{
		if (0 === (int) $id) {
			throw new InvalidArgumentException('id doit être un entier supérieur à 1');
		}
		
		$mapper = new Core_Model_Mapper_Article;
		$where = array(Core_Model_Mapper_Article::COL_CATEGORIE_ID . ' = ?' => $id);
		$articles = $mapper->fetchAll($where,'article_id DESC');
		
		return $articles;
		
		
	}
	
	public function saveArticle(Core_Model_Article $article)
	{
		$mapper = new Core_Model_Mapper_Article;
		$mapper->save($article);
	}
}