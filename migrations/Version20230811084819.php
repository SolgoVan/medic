<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230811084819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genders (id INT AUTO_INCREMENT NOT NULL, gender VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient_identities ADD genders_id INT DEFAULT NULL, DROP gender');
        $this->addSql('ALTER TABLE patient_identities ADD CONSTRAINT FK_4CF98A07477C57FD FOREIGN KEY (genders_id) REFERENCES genders (id)');
        $this->addSql('CREATE INDEX IDX_4CF98A07477C57FD ON patient_identities (genders_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient_identities DROP FOREIGN KEY FK_4CF98A07477C57FD');
        $this->addSql('DROP TABLE genders');
        $this->addSql('DROP INDEX IDX_4CF98A07477C57FD ON patient_identities');
        $this->addSql('ALTER TABLE patient_identities ADD gender VARCHAR(30) NOT NULL, DROP genders_id');
    }
}
