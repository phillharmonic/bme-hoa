<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161229191610 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vehicles_photos (vehicles_id INT NOT NULL, photos_id INT NOT NULL, INDEX IDX_40EF2D2C16F10C70 (vehicles_id), INDEX IDX_40EF2D2C301EC62 (photos_id), PRIMARY KEY(vehicles_id, photos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicles_photos ADD CONSTRAINT FK_40EF2D2C16F10C70 FOREIGN KEY (vehicles_id) REFERENCES vehicles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicles_photos ADD CONSTRAINT FK_40EF2D2C301EC62 FOREIGN KEY (photos_id) REFERENCES photos (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE vehicles_photos');
    }
}
