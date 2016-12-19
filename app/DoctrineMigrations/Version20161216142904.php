<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161216142904 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE action ADD action VARCHAR(255) NOT NULL, ADD taken_by VARCHAR(255) NOT NULL, ADD is_resolved TINYINT(1) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE complaint ADD defendent_name VARCHAR(255) DEFAULT NULL, ADD defendent_address VARCHAR(255) DEFAULT NULL, ADD reg_violated VARCHAR(255) NOT NULL, CHANGE date_resolved date_resolved DATE DEFAULT NULL, CHANGE date_updated date_updated DATE DEFAULT NULL, CHANGE date_issued timestamp DATE NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE action DROP action, DROP taken_by, DROP is_resolved, CHANGE type type VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE complaint DROP defendent_name, DROP defendent_address, DROP reg_violated, CHANGE date_resolved date_resolved DATE NOT NULL, CHANGE date_updated date_updated DATE NOT NULL, CHANGE timestamp date_issued DATE NOT NULL');
    }
}
