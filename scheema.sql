CREATE TABLE duo_text_v2.sentences (
	id_sentences INT UNSIGNED auto_increment NOT NULL,
	sentence_number SMALLINT UNSIGNED NOT NULL,
	sentence VARCHAR(65535) NULL,
	locale varchar(4) NOT NULL,
	page_number SMALLINT UNSIGNED NOT NULL,
	chapter_number TINYINT UNSIGNED NOT NULL,
	CONSTRAINT sentences_PK PRIMARY KEY (id_sentences)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

