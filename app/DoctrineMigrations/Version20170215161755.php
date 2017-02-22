<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170215161755 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, profile_public TINYINT(1) DEFAULT NULL, profile_protected TINYINT(1) DEFAULT NULL, bday DATE DEFAULT NULL, gender VARCHAR(10) DEFAULT NULL, marital_status VARCHAR(50) DEFAULT NULL, occupation VARCHAR(200) DEFAULT NULL, employer VARCHAR(255) DEFAULT NULL, race VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, google VARCHAR(255) DEFAULT NULL, linked_in VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, about_me LONGTEXT DEFAULT NULL, job LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8157AA0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, skill VARCHAR(255) NOT NULL, competancy INT NOT NULL, INDEX IDX_D5311670CCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D5311670CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE photos ADD profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('CREATE INDEX IDX_876E0D9CCFA12B8 ON photos (profile_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9CCFA12B8');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D5311670CCFA12B8');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP INDEX IDX_876E0D9CCFA12B8 ON photos');
        $this->addSql('ALTER TABLE photos DROP profile_id');
    }
}
