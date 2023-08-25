<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801182038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD job_grades_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9F832604F FOREIGN KEY (job_grades_id) REFERENCES job_grades (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9F832604F ON users (job_grades_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9F832604F');
        $this->addSql('DROP INDEX IDX_1483A5E9F832604F ON users');
        $this->addSql('ALTER TABLE users DROP job_grades_id');
    }
}
