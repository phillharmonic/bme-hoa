<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170220155333 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE improvements (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, improvement VARCHAR(255) NOT NULL, improvement_date DATE NOT NULL, INDEX IDX_E74227E549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school_district (id INT AUTO_INCREMENT NOT NULL, school_district VARCHAR(255) NOT NULL, school_district_link VARCHAR(255) NOT NULL, stats_year INT NOT NULL, achievement_score NUMERIC(5, 2) NOT NULL, achievement_grade VARCHAR(255) NOT NULL, gap_score NUMERIC(5, 2) NOT NULL, gap_grade VARCHAR(255) NOT NULL, literacy_score NUMERIC(5, 2) NOT NULL, literacy_grade VARCHAR(255) NOT NULL, progress_score NUMERIC(5, 2) NOT NULL, progress_grade VARCHAR(255) NOT NULL, grad_rate_score NUMERIC(5, 2) NOT NULL, grad_rate_grade VARCHAR(255) NOT NULL, success_score NUMERIC(5, 2) NOT NULL, success_grade VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, state_abrv VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, city_blurb LONGTEXT NOT NULL, school_district VARCHAR(255) NOT NULL, school_district_link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE improvements ADD CONSTRAINT FK_E74227E549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property ADD lot_size VARCHAR(255) DEFAULT NULL, ADD sq_feet VARCHAR(255) DEFAULT NULL, ADD num_bedrooms INT DEFAULT NULL, ADD num_bathrooms INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE improvements');
        $this->addSql('DROP TABLE school_district');
        $this->addSql('DROP TABLE settings');
        $this->addSql('ALTER TABLE property DROP lot_size, DROP sq_feet, DROP num_bedrooms, DROP num_bathrooms');
    }
}
