
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- ask_question
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ask_question`;


CREATE TABLE `ask_question`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`title` TEXT,
	`body` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `ask_question_FI_1` (`user_id`),
	CONSTRAINT `ask_question_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `ask_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- ask_answer
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ask_answer`;


CREATE TABLE `ask_answer`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`question_id` INTEGER,
	`user_id` INTEGER,
	`body` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `ask_answer_FI_1` (`question_id`),
	CONSTRAINT `ask_answer_FK_1`
		FOREIGN KEY (`question_id`)
		REFERENCES `ask_question` (`id`),
	INDEX `ask_answer_FI_2` (`user_id`),
	CONSTRAINT `ask_answer_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `ask_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- ask_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ask_user`;


CREATE TABLE `ask_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`nickname` VARCHAR(50),
	`first_name` VARCHAR(100),
	`last_name` VARCHAR(100),
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- ask_interest
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ask_interest`;


CREATE TABLE `ask_interest`
(
	`question_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`question_id`,`user_id`),
	CONSTRAINT `ask_interest_FK_1`
		FOREIGN KEY (`question_id`)
		REFERENCES `ask_question` (`id`),
	INDEX `ask_interest_FI_2` (`user_id`),
	CONSTRAINT `ask_interest_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `ask_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- ask_relevancy
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ask_relevancy`;


CREATE TABLE `ask_relevancy`
(
	`answer_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`score` INTEGER,
	`created_at` DATETIME,
	PRIMARY KEY (`answer_id`,`user_id`),
	CONSTRAINT `ask_relevancy_FK_1`
		FOREIGN KEY (`answer_id`)
		REFERENCES `ask_answer` (`id`),
	INDEX `ask_relevancy_FI_2` (`user_id`),
	CONSTRAINT `ask_relevancy_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `ask_user` (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
