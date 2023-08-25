<?php

namespace App\Controller;

use App\Entity\Addictions;
use App\Entity\Bills;
use App\Entity\BloodGroups;
use App\Entity\Consultations;
use App\Entity\EmergencyPeople;
use App\Entity\Measurements;
use App\Entity\Pathologies;
use App\Entity\PatientIdentities;
use App\Entity\Patients;
use App\Entity\Users;
use App\Form\AddictionsType;
use App\Form\BloodGroupsType;
use App\Form\ConsultationType;
use App\Form\EmergencyPeopleType;
use App\Form\MeasurementsType;
use App\Form\PathologiesType;
use App\Form\PatientIdentitiesType;
use App\Repository\ConsultationsRepository;
use App\Repository\PatientsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/patients', name: 'patients_')]
class PatientsController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('patients/index.html.twig');
    }

    #[Route('/nouveauPatient', name: 'newPatient')]
    public function newPatient()
    {
        return $this-> render('patients/new/patient.html.twig');
    }

    // TRAITEMENT IDENTITE DU PATIENT ET MISE EN SESSION DE ID
    #[Route('/nouveauPatientIdentite', name:'newPatientIdentity')]
    public function newPatientIdentity(Request $request, ManagerRegistry $managerRegistry, SessionInterface $session):Response
    {
        $patientIdentities = new PatientIdentities;
        
        $form = $this->createForm(PatientIdentitiesType::class, $patientIdentities);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $managerRegistry->getManager();
            
            $em->persist($patientIdentities);
            $em->flush();
        
            $idIdentity = $patientIdentities->getId();
        
            $session->set('identity', $idIdentity);
        
            return $this->redirectToRoute("patients_newPatientEmergency");
            
        }
        
        return $this->render('patients/new/patient_identity.html.twig',[
            "form" => $form->createView()
        ]);
    }

    // TRAITEMENT DES PERSONNES A CONTACTER EN CAS D URGENCE ET MISE EN SESSION ID

    #[Route('/nouveauPatientPersonneUrgence', name:'newPatientEmergency')]
    public function newPatientEmergency(Request $request,ManagerRegistry $managerRegistry ,SessionInterface $session)
    {
        //Je récupère $idIdentity via la session malgrés le changement de page
        $idIdentity = $session->get('identity', []);

        $emergency = new EmergencyPeople;
        $form = $this->createForm(EmergencyPeopleType::class, $emergency);

        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $em = $managerRegistry->getManager();
            $em->persist($emergency);
            $em->flush();

            $idEmergency = $emergency->getId();

            $session->set('emergency', $idEmergency);

            return $this->redirectToRoute('patients_newPatientMeasurement');
        }



        return $this->render('patients/new/patient_emergency.html.twig',[
            "form" => $form->createView()
        ]);
    }


    // TRAITEMENT MENSURATION ET MISE EN SESSION ID

    #[Route('/nouveauPatientMensuration', name:'newPatientMeasurement')]
    public function newPatientMeasurement(Request $request, ManagerRegistry $managerRegistry, SessionInterface $session)
    {
        $measurement = new Measurements;
        $form = $this->createForm(MeasurementsType::class, $measurement);

        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em = $managerRegistry->getManager();
            $em->persist($measurement);
            $em->flush();

            $idMeasurement = $measurement->getId();

            $session->set('measurement', $idMeasurement);

            return $this->redirectToRoute('patients_newPatientBloodgroup');
        }

        return $this->render('patients/new/patient_measurement.html.twig',[
            "form" => $form->createView()
        ]);
    }

    // TRAITEMENT GROUPE SANGUIN ET MISE EN SESSION ID

    #[Route('/nouveauPatientGroupesanguin', name:'newPatientBloodgroup')]
    public function newPatientBloodgroup(Request $request, ManagerRegistry $managerRegistry, SessionInterface $session)
    {
        $repository = $managerRegistry->getRepository(BloodGroups::class);
        $bloodgroups = $repository->findAll();

        if ($request->isMethod('POST')){
            $idBloodgroup = $request->request->get('selected_bloodgroup');

            $session->set('blood_group', $idBloodgroup);

            return $this->redirectToRoute('patients_newPatientAddcition');
        }

        return $this->render('patients/new/patient_bloodgroup.html.twig',[
            'bloodgroups' => $bloodgroups,
        ]);
    }

    // TRAITEMENT ADDICTION ET MISE EN SESSION ID

    #[Route('/nouveauPatientAddiction', name: 'newPatientAddcition')]
    public function newPatientAddcition(Request $request, ManagerRegistry $managerRegistry, SessionInterface $session)
    {
        $addiction = new Addictions;
        $form = $this->createForm(AddictionsType::class, $addiction);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $managerRegistry->getManager();
            $em->persist($addiction);
            $em->flush();

            $idAddcition = $addiction->getId();
            
            $session->set('addiction', $idAddcition);

            return $this->redirectToRoute('patients_newPatientPathology');
        }

        return $this->render('patients/new/patient_addiction.html.twig',[
            "form" => $form->createView()
        ]);
    }

    // TRAITEMENT PATHOLOGY ET MISE EN SESSION ID

    #[Route('/nouveauPatientPathologie', name:'newPatientPathology')]
    public function newPatientPathology(Request $request, ManagerRegistry $managerRegistry, SessionInterface $session)
    {
        $pathology = new Pathologies;
        $form = $this->createForm(PathologiesType::class, $pathology);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $managerRegistry->getManager();
            $em->persist($pathology);
            $em->flush();

            $idPathology = $pathology->getId();

            $session->set('pathology', $idPathology);

            return $this->redirectToRoute('patients_newPatientConfirmation');
        }

        return $this->render('patients/new/patient_pathology.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/nouveauPatientConfirmation', name:'newPatientConfirmation')]
    public function newPatientConfirmation(SessionInterface $session, ManagerRegistry $managerRegistry)
    {
        $em = $managerRegistry->getManager();

        $identityID = $session->get('identity');
        $identity = $em->getRepository(PatientIdentities::class)->find($identityID);

        $emergencyID = $session->get('emergency');
        $emergency = $em->getRepository(EmergencyPeople::class)->find($emergencyID);

        $measurementID = $session->get('measurement');
        $measurement = $em->getRepository(Measurements::class)->find($measurementID);

        $blood_groupID = $session->get('blood_group');
        $blood_group = $em->getRepository(BloodGroups::class)->find($blood_groupID);

        $addictionID = $session->get('addiction');
        $addiction = $em->getRepository(Addictions::class)->find($addictionID);

        $pathologyID = $session->get('pathology');
        $pathology = $em->getRepository(Pathologies::class)->find($pathologyID);

        $docID = $this->getUser();

        

        $patient = new Patients();
        $patient->setPatientsIdentities($identity);
        $patient->setEmergencyPerson($emergency);
        $patient->setMeasurement($measurement);
        $patient->setBloodGroup($blood_group);
        $patient->setAddiction($addiction);
        $patient->setPathology($pathology);
        $patient->setCreatedBy($docID);

        
        $em->persist($patient);
        $em->flush();

        return $this->redirectToRoute('patients_list');
    }



    #[Route('/vuePatient', name: 'vuePatient')]
    public function createdPatient(Request $request): Response
    {
        
        
        
        
        $emergencyPeople = new EmergencyPeople;
        $pathologies = new Pathologies;
        $measurements = new Measurements;
        $bloodGroup = new BloodGroups;
        $addiction = new Addictions;
        
        $formEmergency = $this->createForm(EmergencyPeopleType::class, $emergencyPeople);
        $formPathologies = $this->createForm(PathologiesType::class, $pathologies);
        $formMeasurements = $this->createForm(MeasurementsType::class, $measurements);
        $formBloodgroup = $this->createForm(BloodGroupsType::class, $bloodGroup);
        $formAddiction = $this->createForm(AddictionsType::class, $addiction);

        return $this->render('patients/createdPatient.html.twig', [
            'form2' =>$formEmergency->createView(),
            'form3' =>$formPathologies->createView(),
            'form4' => $formMeasurements->createView(),
            'form5' => $formBloodgroup->createView(),
            'form6' => $formAddiction->createView()
        ]);

        
    }

    #[Route('/liste', name:'list')]
    public function list(PatientsRepository $patientsRepository): Response
    {
        $patients = $patientsRepository->findAllWithPatientIdenties();
        
        return $this->render('patients/list.html.twig', [
            "patients" => $patients,
        
        ]);
    }

    #[Route('/details/{id}', name: 'details')]
    public function details(int $id, PatientsRepository $patientsRepository, ManagerRegistry $managerRegistry): Response
    {
        $em = $managerRegistry->getManager();
        $patients = $em->getRepository(Patients::class)->find($id);

        return $this->render('patients/details.html.twig', [
            "patients" => $patients,
        
        ]);
    }

    #[Route('/nouvelle_intervention', name:'newIntervention')]
    public function newIntervention(Request $request, Users $user, ManagerRegistry $managerRegistry, Users $users, PatientIdentities $patientIdentities) : Response
    {
        $consultation = new Consultations;
        $form = $this->createForm(ConsultationType::class, $consultation);
        

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $managerRegistry->getManager();
            $em->persist($consultation);
            $em->flush();

            $coefExam = $consultation->getExamen()->getCoef();
            $coefLoc = $consultation->getLocalisation()->getCoef();
            $coefVeh = $consultation->getVehicle()->getCoef();
            $amount = $coefExam + $coefLoc + $coefVeh;

            //Je récupère l'id du medecin que j'inject dans la variable $credit pour la facturation
            $credit = $this->getUser();

            //Je récupère l'id du patient que j'injecte dans la variable $debit pour la facturation
            $debit = $consultation->getPatientsIdentities();

            if($consultation){
                $bills = new Bills;
                $bills->setCredit($credit);
                $bills->setDebit($debit);
                $bills->setAmount($amount);

                $em->persist($bills);
                $em->flush();
            }
            

            return $this->redirectToRoute('patients_list');
        }

        return $this->render('patients/newConsultation.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/dossier_medicaux', name:'medicFolder')]
    public function medicFolder(ConsultationsRepository $consultationsRepository) : Response
    {
        $consultations = $consultationsRepository->findAllWithName();

        return $this->render('patients/dossierMedicaux.html.twig',[
            'consultations' => $consultations
        ]);
    }
}
