<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150721160118 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("DROP TABLE sandstorm_gedmotest_domain_model_eventimage");
		$this->addSql("DROP TABLE sandstorm_gedmotest_domain_model_eventimagetranslation");
		$this->addSql("ALTER TABLE sandstorm_gedmotest_domain_model_event ADD assetidentifier VARCHAR(255) NOT NULL");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE sandstorm_gedmotest_domain_model_eventimage (persistence_object_identifier VARCHAR(40) NOT NULL COLLATE utf8_unicode_ci, asset VARCHAR(40) DEFAULT NULL COLLATE utf8_unicode_ci, INDEX IDX_BA5B92342AF5A5C (asset), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("CREATE TABLE sandstorm_gedmotest_domain_model_eventimagetranslation (id INT AUTO_INCREMENT NOT NULL, asset VARCHAR(40) DEFAULT NULL COLLATE utf8_unicode_ci, locale VARCHAR(8) NOT NULL COLLATE utf8_unicode_ci, field VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci, content LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, INDEX IDX_5EB530E12AF5A5C (asset), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("ALTER TABLE sandstorm_gedmotest_domain_model_eventimage ADD CONSTRAINT FK_BA5B92342AF5A5C FOREIGN KEY (asset) REFERENCES typo3_media_domain_model_asset (persistence_object_identifier)");
		$this->addSql("ALTER TABLE sandstorm_gedmotest_domain_model_eventimagetranslation ADD CONSTRAINT FK_5EB530E12AF5A5C FOREIGN KEY (asset) REFERENCES typo3_media_domain_model_asset (persistence_object_identifier)");
		$this->addSql("ALTER TABLE sandstorm_gedmotest_domain_model_event DROP assetidentifier");
	}
}