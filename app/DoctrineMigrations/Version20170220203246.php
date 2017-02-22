<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170220203246 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lien_holder (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, user_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, honorific VARCHAR(5) DEFAULT NULL, firstname VARCHAR(25) DEFAULT NULL, lastname VARCHAR(25) DEFAULT NULL, mi VARCHAR(1) DEFAULT NULL, is_current_lienholder TINYINT(1) DEFAULT NULL, is_primary_contact TINYINT(1) DEFAULT NULL, date_possessed DATE DEFAULT NULL, date_transferred DATE DEFAULT NULL, gender VARCHAR(10) DEFAULT NULL, race VARCHAR(255) DEFAULT NULL, marital_status VARCHAR(50) DEFAULT NULL, cellphone VARCHAR(20) DEFAULT NULL, homephone VARCHAR(20) DEFAULT NULL, businessphone VARCHAR(20) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, contact_address VARCHAR(255) DEFAULT NULL, contact_city VARCHAR(255) DEFAULT NULL, contact_state VARCHAR(255) DEFAULT NULL, contact_zip VARCHAR(255) DEFAULT NULL, contact_business_name VARCHAR(255) DEFAULT NULL, point_of_contact VARCHAR(255) DEFAULT NULL, INDEX IDX_7DD9BC8B549213EC (property_id), UNIQUE INDEX UNIQ_7DD9BC8BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lien_holder ADD CONSTRAINT FK_7DD9BC8B549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE lien_holder ADD CONSTRAINT FK_7DD9BC8BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD lien_holder_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493C5EBAE8 FOREIGN KEY (lien_holder_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493C5EBAE8 ON user (lien_holder_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE lien_holder');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493C5EBAE8');
        $this->addSql('DROP INDEX UNIQ_8D93D6493C5EBAE8 ON user');
        $this->addSql('ALTER TABLE user DROP lien_holder_id');
    }
}
