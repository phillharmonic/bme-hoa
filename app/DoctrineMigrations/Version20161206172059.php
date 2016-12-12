<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161206172059 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE term (id INT AUTO_INCREMENT NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, trustee_position VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE term_user (term_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A44A461E2C35FC (term_id), INDEX IDX_A44A461A76ED395 (user_id), PRIMARY KEY(term_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE term_roles (term_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_830C514FE2C35FC (term_id), UNIQUE INDEX UNIQ_830C514FD60322AC (role_id), PRIMARY KEY(term_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE term_user ADD CONSTRAINT FK_A44A461E2C35FC FOREIGN KEY (term_id) REFERENCES term (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE term_user ADD CONSTRAINT FK_A44A461A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE term_roles ADD CONSTRAINT FK_830C514FE2C35FC FOREIGN KEY (term_id) REFERENCES term (id)');
        $this->addSql('ALTER TABLE term_roles ADD CONSTRAINT FK_830C514FD60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE term_roles DROP FOREIGN KEY FK_830C514FD60322AC');
        $this->addSql('ALTER TABLE term_user DROP FOREIGN KEY FK_A44A461E2C35FC');
        $this->addSql('ALTER TABLE term_roles DROP FOREIGN KEY FK_830C514FE2C35FC');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE term');
        $this->addSql('DROP TABLE term_user');
        $this->addSql('DROP TABLE term_roles');
    }
}
