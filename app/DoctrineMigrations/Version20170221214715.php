<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170221214715 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE term_user (term_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A44A461E2C35FC (term_id), INDEX IDX_A44A461A76ED395 (user_id), PRIMARY KEY(term_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_property (user_id INT NOT NULL, property_id INT NOT NULL, INDEX IDX_6B7FF8DEA76ED395 (user_id), INDEX IDX_6B7FF8DE549213EC (property_id), PRIMARY KEY(user_id, property_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE term_user ADD CONSTRAINT FK_A44A461E2C35FC FOREIGN KEY (term_id) REFERENCES term (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE term_user ADD CONSTRAINT FK_A44A461A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_property ADD CONSTRAINT FK_6B7FF8DEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_property ADD CONSTRAINT FK_6B7FF8DE549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE property_user');
        $this->addSql('DROP TABLE user_term');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE property_user (property_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_928B6973549213EC (property_id), INDEX IDX_928B6973A76ED395 (user_id), PRIMARY KEY(property_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_term (user_id INT NOT NULL, term_id INT NOT NULL, INDEX IDX_DF8EAB44A76ED395 (user_id), INDEX IDX_DF8EAB44E2C35FC (term_id), PRIMARY KEY(user_id, term_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property_user ADD CONSTRAINT FK_928B6973549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_user ADD CONSTRAINT FK_928B6973A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_term ADD CONSTRAINT FK_DF8EAB44A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_term ADD CONSTRAINT FK_DF8EAB44E2C35FC FOREIGN KEY (term_id) REFERENCES term (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE term_user');
        $this->addSql('DROP TABLE user_property');
    }
}
