<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170220212316 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE settings ADD mgt_co_name VARCHAR(255) NOT NULL, ADD mgt_co_address VARCHAR(255) NOT NULL, ADD mgt_co_state VARCHAR(255) NOT NULL, ADD mgt_co_city VARCHAR(255) NOT NULL, ADD mgt_co_zip VARCHAR(255) NOT NULL, ADD mgt_co_point_of_contact VARCHAR(255) NOT NULL, ADD mgt_co_point_of_contact_phone VARCHAR(255) NOT NULL, ADD mgt_co_point_of_contact_email VARCHAR(255) NOT NULL, ADD mgt_co_point_of_contact_website VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE settings DROP mgt_co_name, DROP mgt_co_address, DROP mgt_co_state, DROP mgt_co_city, DROP mgt_co_zip, DROP mgt_co_point_of_contact, DROP mgt_co_point_of_contact_phone, DROP mgt_co_point_of_contact_email, DROP mgt_co_point_of_contact_website');
    }
}
