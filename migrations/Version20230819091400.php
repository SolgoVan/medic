<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230819091400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultations (id INT AUTO_INCREMENT NOT NULL, practitioner_id INT NOT NULL, patient_id INT NOT NULL, examen_id INT NOT NULL, localisation_id INT NOT NULL, vehicle_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', care LONGTEXT NOT NULL, INDEX IDX_242D8F531121EA2C (practitioner_id), INDEX IDX_242D8F536B899279 (patient_id), INDEX IDX_242D8F535C8659A (examen_id), INDEX IDX_242D8F53C68BE09C (localisation_id), INDEX IDX_242D8F53545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emergency_vehicles (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, coef INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examens (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, coef INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localisations (id INT AUTO_INCREMENT NOT NULL, localisation VARCHAR(255) NOT NULL, coef INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultations ADD CONSTRAINT FK_242D8F531121EA2C FOREIGN KEY (practitioner_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE consultations ADD CONSTRAINT FK_242D8F536B899279 FOREIGN KEY (patient_id) REFERENCES patients (id)');
        $this->addSql('ALTER TABLE consultations ADD CONSTRAINT FK_242D8F535C8659A FOREIGN KEY (examen_id) REFERENCES examens (id)');
        $this->addSql('ALTER TABLE consultations ADD CONSTRAINT FK_242D8F53C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisations (id)');
        $this->addSql('ALTER TABLE consultations ADD CONSTRAINT FK_242D8F53545317D1 FOREIGN KEY (vehicle_id) REFERENCES emergency_vehicles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F531121EA2C');
        $this->addSql('ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F536B899279');
        $this->addSql('ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F535C8659A');
        $this->addSql('ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F53C68BE09C');
        $this->addSql('ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F53545317D1');
        $this->addSql('DROP TABLE consultations');
        $this->addSql('DROP TABLE emergency_vehicles');
        $this->addSql('DROP TABLE examens');
        $this->addSql('DROP TABLE localisations');
    }
}
