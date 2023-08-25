<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230810102633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addictions (id INT AUTO_INCREMENT NOT NULL, tobacco VARCHAR(255) DEFAULT NULL, alcohol VARCHAR(255) DEFAULT NULL, drug VARCHAR(255) DEFAULT NULL, other VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blood_groups (id INT AUTO_INCREMENT NOT NULL, blood_group VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emergency_people (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, phone VARCHAR(30) NOT NULL, comment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measurements (id INT AUTO_INCREMENT NOT NULL, size INT NOT NULL, weight INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pathologies (id INT AUTO_INCREMENT NOT NULL, is_allergic TINYINT(1) NOT NULL, allergy VARCHAR(255) DEFAULT NULL, is_diabetic TINYINT(1) NOT NULL, diabetes VARCHAR(255) DEFAULT NULL, is_asmatic TINYINT(1) NOT NULL, asthma VARCHAR(255) DEFAULT NULL, is_cardiac TINYINT(1) NOT NULL, cardiac VARCHAR(255) DEFAULT NULL, is_epileptic TINYINT(1) NOT NULL, epilepsy VARCHAR(255) DEFAULT NULL, is_historic TINYINT(1) NOT NULL, antecedent VARCHAR(255) DEFAULT NULL, is_treatement TINYINT(1) NOT NULL, treatement VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_identities (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(100) DEFAULT NULL, phone VARCHAR(30) NOT NULL, birth_date DATE NOT NULL, gender VARCHAR(30) NOT NULL, occupation VARCHAR(255) DEFAULT NULL, employer VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patients (id INT AUTO_INCREMENT NOT NULL, patients_identities_id INT NOT NULL, blood_group_id INT DEFAULT NULL, measurement_id INT DEFAULT NULL, addiction_id INT DEFAULT NULL, pathology_id INT DEFAULT NULL, emergency_person_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2CCC2E2C7FF5C16B (patients_identities_id), INDEX IDX_2CCC2E2C5F3AECE2 (blood_group_id), INDEX IDX_2CCC2E2C924EA134 (measurement_id), INDEX IDX_2CCC2E2C30C0E13B (addiction_id), INDEX IDX_2CCC2E2CCE86795D (pathology_id), INDEX IDX_2CCC2E2C3479295B (emergency_person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C7FF5C16B FOREIGN KEY (patients_identities_id) REFERENCES patient_identities (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C5F3AECE2 FOREIGN KEY (blood_group_id) REFERENCES blood_groups (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C924EA134 FOREIGN KEY (measurement_id) REFERENCES measurements (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C30C0E13B FOREIGN KEY (addiction_id) REFERENCES addictions (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2CCE86795D FOREIGN KEY (pathology_id) REFERENCES pathologies (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C3479295B FOREIGN KEY (emergency_person_id) REFERENCES emergency_people (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C7FF5C16B');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C5F3AECE2');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C924EA134');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C30C0E13B');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2CCE86795D');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C3479295B');
        $this->addSql('DROP TABLE addictions');
        $this->addSql('DROP TABLE blood_groups');
        $this->addSql('DROP TABLE emergency_people');
        $this->addSql('DROP TABLE measurements');
        $this->addSql('DROP TABLE pathologies');
        $this->addSql('DROP TABLE patient_identities');
        $this->addSql('DROP TABLE patients');
    }
}
