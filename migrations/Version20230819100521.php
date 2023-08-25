<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230819100521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F536B899279');
        $this->addSql('DROP INDEX IDX_242D8F536B899279 ON consultations');
        $this->addSql('ALTER TABLE consultations CHANGE patient_id patients_identities_id INT NOT NULL');
        $this->addSql('ALTER TABLE consultations ADD CONSTRAINT FK_242D8F537FF5C16B FOREIGN KEY (patients_identities_id) REFERENCES patient_identities (id)');
        $this->addSql('CREATE INDEX IDX_242D8F537FF5C16B ON consultations (patients_identities_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F537FF5C16B');
        $this->addSql('DROP INDEX IDX_242D8F537FF5C16B ON consultations');
        $this->addSql('ALTER TABLE consultations CHANGE patients_identities_id patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE consultations ADD CONSTRAINT FK_242D8F536B899279 FOREIGN KEY (patient_id) REFERENCES patients (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_242D8F536B899279 ON consultations (patient_id)');
    }
}
