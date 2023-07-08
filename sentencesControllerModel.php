<?php

require_once 'DbConnection.php';
require_once 'sentencesModel.php';

class sentencesControllerModel
{
	private $chapter;
	private $page;
	private $locale;
	private $aside;
	private $sentences;
	private $s_model;

	
	public function __construct() 
	{
		$this->chapter = $_POST['chapter_number'] ?? false;
		$this->page = $_POST['page_number'] ?? false;
		$this->locale = $_POST['locale'] ?? false;
		$this->aside = $_POST['aside'] ?? false;
		$this->sentences = ( !empty($_POST['sentences']) ) ? trim($_POST['sentences']) : false;

		$db = new DbConnection();
		$this->s_model = new sentencesModel($db->connect());
	}


	public function insertSentences() : void
	{
		$data = [];
		$sentences = explode(PHP_EOL, $this->sentences);
		
		foreach ($sentences as $key => $sentence) {
			$data[] = [
				'sentence_number' => $key,
				'sentence' => $sentence, 
				'locale' => $this->locale,
				'page_number' => $this->page,
				'chapter_number' => $this->chapter 
			];
		}

		$this->s_model->doInsertSentences($data);
	}


	public function updateSentences()
	{

	}


	/**
	 * Insert or update sentences
	 */
	public function processRequest() : void
	{	
		if ( $this->s_model->pageExists($this->locale, $this->page, $this->chapter) ) {
			$this->updateSentences();
		}
		else {
			$this->insertSentences();
		}
	}


	public function validateRequest() : void
	{
		if (
			empty($this->chapter) || 
			empty($this->page) || 
			empty($this->sentences) || 
			empty($this->locale)
			) {
			throw new Exception("Error Processing Request");
		}
	}

}
