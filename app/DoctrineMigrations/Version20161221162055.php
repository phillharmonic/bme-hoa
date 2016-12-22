<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161221162055 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE permit (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, submit_date DATE NOT NULL, type VARCHAR(250) NOT NULL, description LONGTEXT NOT NULL, location VARCHAR(500) NOT NULL, drawings VARCHAR(500) DEFAULT NULL, assoc_name VARCHAR(255) NOT NULL, is_approved TINYINT(1) DEFAULT NULL, is_denied TINYINT(1) DEFAULT NULL, decision_date DATE DEFAULT NULL, decided_by VARCHAR(500) DEFAULT NULL, INDEX IDX_895C01F0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permit_action (permit_id INT NOT NULL, action_id INT NOT NULL, INDEX IDX_7C6F5916A8439AF7 (permit_id), INDEX IDX_7C6F59169D32F035 (action_id), PRIMARY KEY(permit_id, action_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE permit ADD CONSTRAINT FK_895C01F0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE permit_action ADD CONSTRAINT FK_7C6F5916A8439AF7 FOREIGN KEY (permit_id) REFERENCES permit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permit_action ADD CONSTRAINT FK_7C6F59169D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE permit_action DROP FOREIGN KEY FK_7C6F5916A8439AF7');
        $this->addSql('DROP TABLE permit');
        $this->addSql('DROP TABLE permit_action');
    }
}
