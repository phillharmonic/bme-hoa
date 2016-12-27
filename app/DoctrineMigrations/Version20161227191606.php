<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161227191606 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE complaint_user (complaint_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_529200E2EDAE188E (complaint_id), INDEX IDX_529200E2A76ED395 (user_id), PRIMARY KEY(complaint_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_complaint (user_id INT NOT NULL, complaint_id INT NOT NULL, INDEX IDX_5FC7BF51A76ED395 (user_id), INDEX IDX_5FC7BF51EDAE188E (complaint_id), PRIMARY KEY(user_id, complaint_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE complaint_user ADD CONSTRAINT FK_529200E2EDAE188E FOREIGN KEY (complaint_id) REFERENCES complaint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE complaint_user ADD CONSTRAINT FK_529200E2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_complaint ADD CONSTRAINT FK_5FC7BF51A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_complaint ADD CONSTRAINT FK_5FC7BF51EDAE188E FOREIGN KEY (complaint_id) REFERENCES complaint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE complaint DROP FOREIGN KEY FK_5F2732B5A76ED395');
        $this->addSql('DROP INDEX IDX_5F2732B5A76ED395 ON complaint');
        $this->addSql('ALTER TABLE complaint DROP user_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE complaint_user');
        $this->addSql('DROP TABLE user_complaint');
        $this->addSql('ALTER TABLE complaint ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE complaint ADD CONSTRAINT FK_5F2732B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5F2732B5A76ED395 ON complaint (user_id)');
    }
}
