<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170221180934 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, user_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, occupation_status VARCHAR(255) DEFAULT NULL, relation_to_property VARCHAR(255) DEFAULT NULL, honorific VARCHAR(5) DEFAULT NULL, firstname VARCHAR(25) DEFAULT NULL, lastname VARCHAR(25) DEFAULT NULL, mi VARCHAR(1) DEFAULT NULL, is_current_lienholder TINYINT(1) DEFAULT NULL, is_primary_contact TINYINT(1) DEFAULT NULL, date_possessed DATE DEFAULT NULL, date_transferred DATE DEFAULT NULL, gender VARCHAR(10) DEFAULT NULL, race VARCHAR(255) DEFAULT NULL, marital_status VARCHAR(50) DEFAULT NULL, cellphone VARCHAR(20) DEFAULT NULL, homephone VARCHAR(20) DEFAULT NULL, businessphone VARCHAR(20) DEFAULT NULL, fax VARCHAR(20) DEFAULT NULL, primary_email VARCHAR(255) DEFAULT NULL, secondary_email VARCHAR(255) DEFAULT NULL, business_email VARCHAR(255) DEFAULT NULL, contact_address VARCHAR(255) DEFAULT NULL, contact_city VARCHAR(255) DEFAULT NULL, contact_state VARCHAR(255) DEFAULT NULL, contact_zip VARCHAR(255) DEFAULT NULL, contact_business_name VARCHAR(255) DEFAULT NULL, point_of_contact VARCHAR(255) DEFAULT NULL, dba TINYINT(1) DEFAULT NULL, INDEX IDX_4C62E638549213EC (property_id), UNIQUE INDEX UNIQ_4C62E638A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE lien_holder');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493C5EBAE8');
        $this->addSql('DROP INDEX UNIQ_8D93D6493C5EBAE8 ON user');
        $this->addSql('ALTER TABLE user CHANGE lien_holder_id contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7A1254A ON user (contact_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E7A1254A');
        $this->addSql('CREATE TABLE lien_holder (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, user_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, honorific VARCHAR(5) DEFAULT NULL COLLATE utf8mb4_unicode_ci, firstname VARCHAR(25) DEFAULT NULL COLLATE utf8mb4_unicode_ci, lastname VARCHAR(25) DEFAULT NULL COLLATE utf8mb4_unicode_ci, mi VARCHAR(1) DEFAULT NULL COLLATE utf8mb4_unicode_ci, is_current_lienholder TINYINT(1) DEFAULT NULL, is_primary_contact TINYINT(1) DEFAULT NULL, date_possessed DATE DEFAULT NULL, date_transferred DATE DEFAULT NULL, gender VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, race VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, marital_status VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, cellphone VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, homephone VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, businessphone VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, primary_email VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, contact_address VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, contact_city VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, contact_state VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, contact_zip VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, contact_business_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, point_of_contact VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, fax VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, secondary_email VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, business_email VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, dba TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_7DD9BC8BA76ED395 (user_id), INDEX IDX_7DD9BC8B549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lien_holder ADD CONSTRAINT FK_7DD9BC8B549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE lien_holder ADD CONSTRAINT FK_7DD9BC8BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7A1254A ON user');
        $this->addSql('ALTER TABLE user CHANGE contact_id lien_holder_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493C5EBAE8 FOREIGN KEY (lien_holder_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493C5EBAE8 ON user (lien_holder_id)');
    }
}
