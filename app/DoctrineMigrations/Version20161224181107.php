<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161224181107 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE complaint_photos (complaint_id INT NOT NULL, photos_id INT NOT NULL, INDEX IDX_2A352D1BEDAE188E (complaint_id), INDEX IDX_2A352D1B301EC62 (photos_id), PRIMARY KEY(complaint_id, photos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE complaint_photos ADD CONSTRAINT FK_2A352D1BEDAE188E FOREIGN KEY (complaint_id) REFERENCES complaint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE complaint_photos ADD CONSTRAINT FK_2A352D1B301EC62 FOREIGN KEY (photos_id) REFERENCES photos (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE complaint_photos');
    }
}
