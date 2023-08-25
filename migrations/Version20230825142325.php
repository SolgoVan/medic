<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230825142325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C30C0E13B');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C3479295B');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C5F3AECE2');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C7FF5C16B');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C924EA134');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2CCE86795D');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C30C0E13B FOREIGN KEY (addiction_id) REFERENCES addictions (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C3479295B FOREIGN KEY (emergency_person_id) REFERENCES emergency_people (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C5F3AECE2 FOREIGN KEY (blood_group_id) REFERENCES blood_groups (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C7FF5C16B FOREIGN KEY (patients_identities_id) REFERENCES patient_identities (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C924EA134 FOREIGN KEY (measurement_id) REFERENCES measurements (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2CCE86795D FOREIGN KEY (pathology_id) REFERENCES pathologies (id)');
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
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C7FF5C16B FOREIGN KEY (patients_identities_id) REFERENCES patient_identities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C5F3AECE2 FOREIGN KEY (blood_group_id) REFERENCES blood_groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C924EA134 FOREIGN KEY (measurement_id) REFERENCES measurements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C30C0E13B FOREIGN KEY (addiction_id) REFERENCES addictions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2CCE86795D FOREIGN KEY (pathology_id) REFERENCES pathologies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C3479295B FOREIGN KEY (emergency_person_id) REFERENCES emergency_people (id) ON DELETE CASCADE');
    }
}
