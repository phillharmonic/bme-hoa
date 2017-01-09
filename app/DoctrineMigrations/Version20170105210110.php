<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170105210110 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD employer VARCHAR(255) DEFAULT NULL, ADD race VARCHAR(255) DEFAULT NULL, ADD facebook VARCHAR(255) DEFAULT NULL, ADD twitter VARCHAR(255) DEFAULT NULL, ADD google VARCHAR(255) DEFAULT NULL, ADD linked_in VARCHAR(255) DEFAULT NULL, ADD bio LONGTEXT DEFAULT NULL, ADD bio_public TINYINT(1) DEFAULT NULL, ADD bio_protected TINYINT(1) DEFAULT NULL, ADD bday_public TINYINT(1) DEFAULT NULL, ADD bday_protected TINYINT(1) DEFAULT NULL, ADD maritalstatus_public TINYINT(1) DEFAULT NULL, ADD maritalstatus_protected TINYINT(1) DEFAULT NULL, ADD homephone_public TINYINT(1) DEFAULT NULL, ADD homephone_protected TINYINT(1) DEFAULT NULL, ADD cellphone_public TINYINT(1) DEFAULT NULL, ADD cellphone_protected TINYINT(1) DEFAULT NULL, ADD occupation_public TINYINT(1) DEFAULT NULL, ADD occupation_protected TINYINT(1) DEFAULT NULL, ADD age_public TINYINT(1) DEFAULT NULL, ADD age_protected TINYINT(1) DEFAULT NULL, ADD email_public TINYINT(1) DEFAULT NULL, ADD email_protected TINYINT(1) DEFAULT NULL, ADD facebook_public TINYINT(1) DEFAULT NULL, ADD facebook_protected TINYINT(1) DEFAULT NULL, ADD twitter_public TINYINT(1) DEFAULT NULL, ADD twitter_protected TINYINT(1) DEFAULT NULL, ADD google_public TINYINT(1) DEFAULT NULL, ADD google_protected TINYINT(1) DEFAULT NULL, ADD linked_in_public TINYINT(1) DEFAULT NULL, ADD linked_in_protected TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP employer, DROP race, DROP facebook, DROP twitter, DROP google, DROP linked_in, DROP bio, DROP bio_public, DROP bio_protected, DROP bday_public, DROP bday_protected, DROP maritalstatus_public, DROP maritalstatus_protected, DROP homephone_public, DROP homephone_protected, DROP cellphone_public, DROP cellphone_protected, DROP occupation_public, DROP occupation_protected, DROP age_public, DROP age_protected, DROP email_public, DROP email_protected, DROP facebook_public, DROP facebook_protected, DROP twitter_public, DROP twitter_protected, DROP google_public, DROP google_protected, DROP linked_in_public, DROP linked_in_protected');
    }
}
