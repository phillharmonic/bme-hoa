<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170123165625 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE goal (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created DATE NOT NULL, updated DATE NOT NULL, completion_goal_date DATE NOT NULL, INDEX IDX_FCDCEB2EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progress_note (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, goal_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, completion_goal_date DATE NOT NULL, created DATE NOT NULL, updated DATE NOT NULL, completion_percentage INT NOT NULL, INDEX IDX_CF34D5DDA76ED395 (user_id), INDEX IDX_CF34D5DD667D1AFE (goal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE progress_note ADD CONSTRAINT FK_CF34D5DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE progress_note ADD CONSTRAINT FK_CF34D5DD667D1AFE FOREIGN KEY (goal_id) REFERENCES goal (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE progress_note DROP FOREIGN KEY FK_CF34D5DD667D1AFE');
        $this->addSql('DROP TABLE goal');
        $this->addSql('DROP TABLE progress_note');
    }
}
