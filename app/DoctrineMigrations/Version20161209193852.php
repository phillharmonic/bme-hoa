<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161209193852 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE term_user');
        $this->addSql('ALTER TABLE term ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A50FE78DA76ED395 ON term (user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE term_user (term_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A44A461E2C35FC (term_id), INDEX IDX_A44A461A76ED395 (user_id), PRIMARY KEY(term_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE term_user ADD CONSTRAINT FK_A44A461A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE term_user ADD CONSTRAINT FK_A44A461E2C35FC FOREIGN KEY (term_id) REFERENCES term (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78DA76ED395');
        $this->addSql('DROP INDEX IDX_A50FE78DA76ED395 ON term');
        $this->addSql('ALTER TABLE term DROP user_id');
    }
}
