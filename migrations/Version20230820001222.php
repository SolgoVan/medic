<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820001222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bills (id INT AUTO_INCREMENT NOT NULL, credit_id INT NOT NULL, debit_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', amount INT NOT NULL, INDEX IDX_22775DD0CE062FF9 (credit_id), INDEX IDX_22775DD0444E82EE (debit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bills ADD CONSTRAINT FK_22775DD0CE062FF9 FOREIGN KEY (credit_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE bills ADD CONSTRAINT FK_22775DD0444E82EE FOREIGN KEY (debit_id) REFERENCES patient_identities (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bills DROP FOREIGN KEY FK_22775DD0CE062FF9');
        $this->addSql('ALTER TABLE bills DROP FOREIGN KEY FK_22775DD0444E82EE');
        $this->addSql('DROP TABLE bills');
    }
}
