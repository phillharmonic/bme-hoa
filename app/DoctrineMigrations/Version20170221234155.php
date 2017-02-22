<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170221234155 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE property_account');
        $this->addSql('ALTER TABLE property ADD accounts_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDECC5E8CE8 FOREIGN KEY (accounts_id) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8BF21CDECC5E8CE8 ON property (accounts_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE property_account (property_id INT NOT NULL, account_id INT NOT NULL, INDEX IDX_24FB1CDC549213EC (property_id), INDEX IDX_24FB1CDC9B6B5FBA (account_id), PRIMARY KEY(property_id, account_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property_account ADD CONSTRAINT FK_24FB1CDC549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_account ADD CONSTRAINT FK_24FB1CDC9B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDECC5E8CE8');
        $this->addSql('DROP INDEX IDX_8BF21CDECC5E8CE8 ON property');
        $this->addSql('ALTER TABLE property DROP accounts_id');
    }
}
