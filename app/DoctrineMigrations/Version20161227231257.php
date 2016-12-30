<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161227231257 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, blog LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, tags LONGTEXT NOT NULL, created DATE NOT NULL, updated DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_blog (user_id INT NOT NULL, blog_id INT NOT NULL, INDEX IDX_BA941D8AA76ED395 (user_id), INDEX IDX_BA941D8ADAE07E97 (blog_id), PRIMARY KEY(user_id, blog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_blog ADD CONSTRAINT FK_BA941D8AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_blog ADD CONSTRAINT FK_BA941D8ADAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE complaint_user');
        $this->addSql('DROP TABLE vehicles_photos');
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78DA76ED395');
        $this->addSql('DROP INDEX IDX_A50FE78DA76ED395 ON term');
        $this->addSql('ALTER TABLE term DROP user_id');
        $this->addSql('ALTER TABLE vehicles DROP FOREIGN KEY FK_1FCE69FAA76ED395');
        $this->addSql('DROP INDEX IDX_1FCE69FAA76ED395 ON vehicles');
        $this->addSql('ALTER TABLE vehicles DROP user_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_blog DROP FOREIGN KEY FK_BA941D8ADAE07E97');
        $this->addSql('CREATE TABLE complaint_user (complaint_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_529200E2EDAE188E (complaint_id), INDEX IDX_529200E2A76ED395 (user_id), PRIMARY KEY(complaint_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicles_photos (vehicles_id INT NOT NULL, photos_id INT NOT NULL, INDEX IDX_40EF2D2C16F10C70 (vehicles_id), INDEX IDX_40EF2D2C301EC62 (photos_id), PRIMARY KEY(vehicles_id, photos_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE complaint_user ADD CONSTRAINT FK_529200E2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE complaint_user ADD CONSTRAINT FK_529200E2EDAE188E FOREIGN KEY (complaint_id) REFERENCES complaint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicles_photos ADD CONSTRAINT FK_40EF2D2C16F10C70 FOREIGN KEY (vehicles_id) REFERENCES vehicles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicles_photos ADD CONSTRAINT FK_40EF2D2C301EC62 FOREIGN KEY (photos_id) REFERENCES photos (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE user_blog');
        $this->addSql('ALTER TABLE term ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A50FE78DA76ED395 ON term (user_id)');
        $this->addSql('ALTER TABLE vehicles ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicles ADD CONSTRAINT FK_1FCE69FAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1FCE69FAA76ED395 ON vehicles (user_id)');
    }
}
