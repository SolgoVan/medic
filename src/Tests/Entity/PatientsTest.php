<?php 

namespace App\Tests\Entity;

use App\Entity\Patients;
use App\Entity\PatientIdentities;
use App\Entity\BloodGroups;
use App\Entity\Measurements;
use App\Entity\Addictions;
use App\Entity\Pathologies;
use App\Entity\EmergencyPeople;
use App\Entity\Users;
use PHPUnit\Framework\TestCase;

class PatientsTest extends TestCase
{
    public function testCreatedAt()
    {
        $patient = new Patients();
        $createdAt = new \DateTimeImmutable();
        $patient->setCreatedAt($createdAt);
        
        $this->assertSame($createdAt, $patient->getCreatedAt());
    }

    public function testPatientsIdentities()
    {
        $patient = new Patients();
        $identities = new PatientIdentities();
        $patient->setPatientsIdentities($identities);

        $this->assertSame($identities, $patient->getPatientsIdentities());
    }


    public function testCreatedBy()
    {
        $patient = new Patients();
        $user = new Users();
        $patient->setCreatedBy($user);

        $this->assertSame($user, $patient->getCreatedBy());
    }

    public function testRelations()
    {
        $patient = new Patients();
        $identities = new PatientIdentities();
        $bloodGroup = new BloodGroups();
        $measurement = new Measurements();
        $addiction = new Addictions();
        $pathology = new Pathologies();
        $emergencyPerson = new EmergencyPeople();
        $user = new Users();

        $patient->setPatientsIdentities($identities);
        $patient->setBloodGroup($bloodGroup);
        $patient->setMeasurement($measurement);
        $patient->setAddiction($addiction);
        $patient->setPathology($pathology);
        $patient->setEmergencyPerson($emergencyPerson);
        $patient->setCreatedBy($user);

        $this->assertSame($identities, $patient->getPatientsIdentities());
        $this->assertSame($bloodGroup, $patient->getBloodGroup());
        $this->assertSame($measurement, $patient->getMeasurement());
        $this->assertSame($addiction, $patient->getAddiction());
        $this->assertSame($pathology, $patient->getPathology());
        $this->assertSame($emergencyPerson, $patient->getEmergencyPerson());
        $this->assertSame($user, $patient->getCreatedBy());
    }
}
