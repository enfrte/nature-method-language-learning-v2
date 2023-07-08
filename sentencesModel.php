<?php


class sentencesModel 
{
	private $db;

	
	public function __construct($connection)
	{
		$this->db = $connection;
	}


	/**
	 * See if entry ( chapter->page ) exists 
	 */
	public function pageExists(string $locale, int $page, int $chapter) : bool
	{
		$sql = 'SELECT COUNT(*) AS total
				FROM sentences 
				WHERE chapter_number = :chapter_number
				AND page_number = :page_number
				AND locale = :locale';

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam('chapter_number', $chapter, PDO::PARAM_INT);
		$stmt->bindParam('page_number', $page, PDO::PARAM_INT);
		$stmt->bindParam('locale', $locale, PDO::PARAM_STR);
		$stmt->execute();
		$existing_page_entries = $stmt->fetch(PDO::FETCH_ASSOC);

		if ( !empty($existing_page_entries['total']) ) {
			return true;
		}

		return false;
	}


	public function doInsertSentences(array $data) : void
	{
		$sql = 'INSERT INTO sentences (
					sentence_number,
					sentence, 
					locale,
					page_number,
					chapter_number
				)  
				VALUES (
					:sentence_number,
					:sentence,
					:locale,
					:page_number, 
					:chapter_number
				)';

		try {
			$this->db->beginTransaction();
			$stmt = $this->db->prepare($sql);

			foreach ($data as $r)
			{
				$stmt->bindParam('sentence_number', $r['sentence_number'], PDO::PARAM_INT);				
				$stmt->bindParam('sentence', $r['sentence'], PDO::PARAM_STR);
				$stmt->bindParam('locale', $r['locale'], PDO::PARAM_STR);
				$stmt->bindParam('page_number', $r['page_number'], PDO::PARAM_INT);
				$stmt->bindParam('chapter_number', $r['chapter_number'], PDO::PARAM_INT);

				$stmt->execute();
			}

			$this->db->commit();
		}
		catch (Exception $e){
			$this->db->rollback();
			throw new Exception('Failed to insert sentences: '.$e->getMessage());
		}
	}
		

	public function doUpdateSentences(array $data) : array 
	{

	}


}
