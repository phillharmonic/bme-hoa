<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170222001028 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_dependents');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_dependents (user_id INT NOT NULL, dependents_id INT NOT NULL, INDEX IDX_6D69FE61A76ED395 (user_id), INDEX IDX_6D69FE617F8BDCD5 (dependents_id), PRIMARY KEY(user_id, dependents_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_dependents ADD CONSTRAINT FK_6D69FE617F8BDCD5 FOREIGN KEY (dependents_id) REFERENCES dependents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_dependents ADD CONSTRAINT FK_6D69FE61A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
