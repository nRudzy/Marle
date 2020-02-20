<?php

namespace App\Controller;
//php -S localhost:8000 -t public


use App\Entity\ContientDoc;
use App\Entity\Docsat;
use App\Entity\Document;
use App\Entity\Reprographie;
use App\Entity\Satellite;
use App\Entity\Taxonomie;
use App\Entity\Utilisateur;
use App\Form\ContientDocCoteUtilisateurAPEType;
use App\Form\ContientDocCoteUtilisateurASTType;
use App\Form\ContientDocCoteUtilisateurBDSType;
use App\Form\ContientDocCoteUtilisateurDRTType;
use App\Form\ContientDocCoteUtilisateurDSEPlanType;
use App\Form\ContientDocCoteUtilisateurModifierType;
use App\Form\ContientDocCoteUtilisateurType;
use App\Form\ReprographieType;
use App\Form\UtilisateurType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('connexion');
    }

    /**
     * @Route("/accueil", name="page_accueil")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        /* Création des lignes dans la BDD dans la première connexion globale */
        $em = $this->getDoctrine()->getManager();
        $a_taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)->findAll();
        $a_satellite = $this->getDoctrine()->getRepository(Satellite::class)->findAll();
        if($a_satellite == null)
        {
            $s1 = new Satellite(); $s2 = new Satellite(); $s3 = new Satellite(); $s4 = new Satellite();
            $s5 = new Satellite(); $s6 = new Satellite(); $s7 = new Satellite(); $s8 = new Satellite();
            $s9 = new Satellite(); $s10 = new Satellite(); $s11 = new Satellite(); $s12 = new Satellite();
            $s13 = new Satellite(); $s14 = new Satellite(); $s15 = new Satellite(); $s16 = new Satellite();
            $s17 = new Satellite(); $s18 = new Satellite(); $s19 = new Satellite(); $s20 = new Satellite();

            $s21 = new Satellite(); $s22 = new Satellite(); $s23 = new Satellite(); $s24 = new Satellite();
            $s25 = new Satellite(); $s26 = new Satellite(); $s27 = new Satellite(); $s28 = new Satellite();
            $s29 = new Satellite(); $s30 = new Satellite(); $s31 = new Satellite(); $s32 = new Satellite();
            $s33 = new Satellite(); $s34 = new Satellite(); $s35 = new Satellite(); $s36 = new Satellite();
            $s37 = new Satellite(); $s38 = new Satellite(); $s39 = new Satellite(); $s40 = new Satellite();

            $s41 = new Satellite(); $s42 = new Satellite(); $s43 = new Satellite(); $s44 = new Satellite();
            $s45 = new Satellite(); $s46 = new Satellite();


            $s47 = new Satellite();$s48 = new Satellite();$s49 = new Satellite();$s50 = new Satellite();
            $s51 = new Satellite();$s52 = new Satellite();$s53 = new Satellite();$s54 = new Satellite();
            $s55 = new Satellite();$s56 = new Satellite();$s57 = new Satellite();$s58 = new Satellite();
            $s59 = new Satellite();

            $s1->setCodeSatellite('IDC');
            $s2->setCodeSatellite('IDD');
            $s3->setCodeSatellite('IDM');
            $s4->setCodeSatellite('SAA');
            $s5->setCodeSatellite('SAE');

            $s6->setCodeSatellite('SAF');
            $s7->setCodeSatellite('SAG');
            $s8->setCodeSatellite('SAH');
            $s9->setCodeSatellite('SAI');
            $s10->setCodeSatellite('SAJ');

            $s11->setCodeSatellite('SCA');
            $s12->setCodeSatellite('SCB');
            $s13->setCodeSatellite('SCC');
            $s14->setCodeSatellite('SCD');
            $s15->setCodeSatellite('SCE');

            $s16->setCodeSatellite('SCF');
            $s17->setCodeSatellite('SCG');
            $s18->setCodeSatellite('SCH');
            $s19->setCodeSatellite('SCI');
            $s20->setCodeSatellite('SCJ');

            $s21->setCodeSatellite('SCK');
            $s22->setCodeSatellite('SCL');
            $s23->setCodeSatellite('SCM');
            $s24->setCodeSatellite('SCN');
            $s25->setCodeSatellite('SCO');

            $s26->setCodeSatellite('SCP');
            $s27->setCodeSatellite('SDA');
            $s28->setCodeSatellite('SFA');
            $s29->setCodeSatellite('SFB');
            $s30->setCodeSatellite('SFC');

            $s31->setCodeSatellite('SFC_LTC');
            $s32->setCodeSatellite('SFC_PCL');
            $s33->setCodeSatellite('SFD');
            $s34->setCodeSatellite('SFE');
            $s35->setCodeSatellite('SFF');

            $s36->setCodeSatellite('SFG');
            $s37->setCodeSatellite('SMT');
            $s38->setCodeSatellite('SSA');
            $s39->setCodeSatellite('STA');
            $s40->setCodeSatellite('STP');

            $s41->setCodeSatellite('STQ');
            $s42->setCodeSatellite('STB');
            $s43->setCodeSatellite('STL');
            $s44->setCodeSatellite('STR');
            $s45->setCodeSatellite('STS');

            $s46->setCodeSatellite('SQA');

            $s47->setCodeSatellite('STC');
            $s48->setCodeSatellite('SAM');
            $s49->setCodeSatellite('SMA');
            $s50->setCodeSatellite('PCOM');
            $s51->setCodeSatellite('Infirmerie');
            $s52->setCodeSatellite('BOITIER');
            $s53->setCodeSatellite('IDD_PCD6');
            $s54->setCodeSatellite('LR1');
            $s55->setCodeSatellite('LR2');
            $s56->setCodeSatellite('LR3');
            $s57->setCodeSatellite('LR4');
            $s58->setCodeSatellite('LR5');
            $s59->setCodeSatellite('LR6');

            $em->persist($s1);$em->persist($s2);$em->persist($s3);$em->persist($s4);
            $em->persist($s5);$em->persist($s6);$em->persist($s7);$em->persist($s8);
            $em->persist($s9);$em->persist($s10);$em->persist($s11);$em->persist($s12);
            $em->persist($s13);$em->persist($s14);$em->persist($s15);$em->persist($s16);
            $em->persist($s17);$em->persist($s18);$em->persist($s19);$em->persist($s20);

            $em->persist($s21);$em->persist($s22);$em->persist($s23);$em->persist($s24);
            $em->persist($s25);$em->persist($s26);$em->persist($s27);$em->persist($s28);
            $em->persist($s29);$em->persist($s30);$em->persist($s31);$em->persist($s32);
            $em->persist($s33);$em->persist($s34);$em->persist($s35);$em->persist($s36);
            $em->persist($s37);$em->persist($s38);$em->persist($s39);$em->persist($s40);

            $em->persist($s41);$em->persist($s42);$em->persist($s43);$em->persist($s44);
            $em->persist($s45);$em->persist($s46);

            $em->persist($s47);$em->persist($s48);$em->persist($s49);$em->persist($s50);
            $em->persist($s51);$em->persist($s52);$em->persist($s53);$em->persist($s54);
            $em->persist($s55);$em->persist($s56);$em->persist($s57);$em->persist($s58);
            $em->persist($s59);

            $em->flush();


        }
        if($a_taxonomie == null)
        {
            $t1 = new Taxonomie(); $t2 = new Taxonomie(); $t3 = new Taxonomie(); $t4 = new Taxonomie(); $t5 = new Taxonomie();
            $t6 = new Taxonomie(); $t7 = new Taxonomie(); $t8 = new Taxonomie(); $t9 = new Taxonomie(); $t10 = new Taxonomie();
            $t11 = new Taxonomie(); $t12 = new Taxonomie(); $t13 = new Taxonomie(); $t14 = new Taxonomie(); $t15 = new Taxonomie(); $t16 = new Taxonomie();
            $t17 = new Taxonomie();

            $t1->setCodeTaxonomie('ETB')->setLibelle('Etat brouillon');
            $t2->setCodeTaxonomie('AVD')->setLibelle('Attente de validation');
            $t3->setCodeTaxonomie('ECDD')->setLibelle('Analyse par la DOC en cours');
            $t4->setCodeTaxonomie('ECDP')->setLibelle('Analyse par le prestataire en cours');
            $t5->setCodeTaxonomie('TAP')->setLibelle('Transmise au prestataire');

            $t6->setCodeTaxonomie('CPP')->setLibelle('Consultée par le prestataire');
            $t7->setCodeTaxonomie('ECP')->setLibelle('En cours de préparation');
            $t8->setCodeTaxonomie('POK')->setLibelle('Demande prête');
            $t9->setCodeTaxonomie('DRP')->setLibelle('Demande refusée par le prestataire');
            $t10->setCodeTaxonomie('DRD')->setLibelle('Demande refusée par la DOC');

            $t11->setCodeTaxonomie('APD')->setLibelle('Annulée par le demandeur');
            $t12->setCodeTaxonomie('RPD')->setLibelle('Reçue par la DOC');
            $t13->setCodeTaxonomie('RAM')->setLibelle('Retour Accueil DOC');
            $t14->setCodeTaxonomie('RAME')->setLibelle('Retour métier');
            $t15->setCodeTaxonomie('CSP')->setLibelle('Conservé chez le prestataire');
            $t16->setCodeTaxonomie('IDL')->setLibelle('Demande à faire sur IDOL');

            $t17->setCodeTaxonomie('JOUR')->setLibelle('10');

            $em->persist($t1);$em->persist($t2);$em->persist($t3);$em->persist($t4);$em->persist($t5);
            $em->persist($t6);$em->persist($t7);$em->persist($t8);$em->persist($t9);$em->persist($t10);
            $em->persist($t11);$em->persist($t12);$em->persist($t13);$em->persist($t14);$em->persist($t15);$em->persist($t16);
            $em->persist($t17);

            $em->flush();

        }

        /* Récupération des données d'une reprographie pour l'afficher en tableau */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $user = $this->getUser();

        $repros = $repo_repro->trouveToutEnTriantParDeadlineASCetPersonnelles($user);
        $utilisateur_connecte = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $user]);

        return $this->render('default/accueil.html.twig', [
            'repros' => $repros,
            'utilisateur_connecte' => $utilisateur_connecte,

        ]);
    }

    /*********************************************************************************************/

    /**
     * @Route("/consulter/date-demande-entre/{dateDebutFormatee}/{dateFinFormatee}", name="page_recherche_date_debut")
     * @param Request $request
     * @param $dateDebutFormatee
     * @param $dateFinFormatee
     * @return Response
     * @throws Exception
     */
    public function filtrerParDateDemande(Request $request, $dateDebutFormatee, $dateFinFormatee)
    {
        /* Récupération des données d'une reprographie pour l'afficher en tableau */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repros = $repo_repro->trouveEntreDeuxDatesPourDateDebut($dateDebutFormatee,$dateFinFormatee);

        return $this->render('default/accueil_triee.html.twig', [
            'repros' => $repros,
            'dateDebut' => new \Datetime($dateDebutFormatee),
            'dateFin' => new \Datetime($dateFinFormatee)

        ]);
    }

    /*********************************************************************************************/

    /**
     * @Route("/consulter/date-rendu-entre/{dateDebutFormatee}/{dateFinFormatee}", name="page_recherche_deadline")
     * @param Request $request
     * @param $dateDebutFormatee
     * @param $dateFinFormatee
     * @return Response
     * @throws Exception
     */
    public function filtrerParDeadline(Request $request, $dateDebutFormatee, $dateFinFormatee)
    {
        /* Récupération des données d'une reprographie pour l'afficher en tableau */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repros = $repo_repro->trouveEntreDeuxDatesPourDeadline($dateDebutFormatee,$dateFinFormatee);

        return $this->render('default/accueil_triee.html.twig', [
            'repros' => $repros,
            'dateDebut' => new \Datetime($dateDebutFormatee),
            'dateFin' => new \Datetime($dateFinFormatee)

        ]);
    }

    /*********************************************************************************************/

    /**
     * @Route("/consulter/reprographies/IDOL", name="page_recherche_idol")
     * @param Request $request
     * @return Response
     */
    public function filtrerParIDOL(Request $request)
    {
        /* Récupération des données d'une reprographie pour l'afficher en tableau */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repros = $repo_repro->trouveLesIDOL();
//        $repros = $repo_repro->

        return $this->render('default/accueil_triee.html.twig', [
            'repros' => $repros,

        ]);
    }

    /*********************************************************************************************/

    /**
     * @Route("/consulter/recherche-avancee", name="page_recherche_avancee")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function rechercheAvancee(Request $request)
    {
        /* Récupération des données d'une reprographie pour l'afficher en tableau */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);

        $dates = array();
        $dates = $this->createFormBuilder($dates)
            ->add('date_debut', DateType::class,[
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker',
                ],
            ])
            ->add('date_fin', DateType::class,[
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker',
                ],
            ])
            ->add('radio', ChoiceType::class, [
                'choices' => [
                    'par date de création' => 'dateInit',
                    'par date de rendu' => 'dateDeadline'
                ],
                'expanded' => true,  // => rendu en boutons radio
                'label' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn mon-bouton-edf btn-sm',
                ]
            ])
            ->getForm();

        $dates->handleRequest($request);
        $dateDebut = null;
        $dateFin = null;
        $repros = $repo_repro->trouveToutEnTriantParDeadlineASC();
        $doit_afficher_alerte_dates = false;

        if (($dates->getClickedButton() && 'submit' === $dates->getClickedButton()->getName()) && $dates->isValid()) {
            $dateDebut = $dates->get('date_debut')->getData();
            $dateFin = $dates->get('date_fin')->getData();
            $resRadio = $dates->get('radio')->getData();

            $dateDebutFormatee = $dateDebut->format('Y-m-d');
            $dateFinFormatee = $dateFin->format('Y-m-d');

            if($dateDebutFormatee > $dateFinFormatee){
                $doit_afficher_alerte_dates = true;
            } else {
                if($resRadio === 'dateInit'){
                    return $this->redirect($this->generateUrl('page_recherche_date_debut',
                        array('dateDebutFormatee' => $dateDebutFormatee,
                            'dateFinFormatee' => $dateFinFormatee,
                        )));
                } else{
                    return $this->redirect($this->generateUrl('page_recherche_deadline',
                        array('dateDebutFormatee' => $dateDebutFormatee,
                            'dateFinFormatee' => $dateFinFormatee,
                        )));
                }
            }


        }


        return $this->render('default/recherche-avancee.html.twig', [
            'repros' => $repros,
            'dates' => $dates->createView(),
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'doit_afficher_alerte_dates' => $doit_afficher_alerte_dates,

        ]);
    }

    /*********************************************************************************************/


    /**
     * @Route("/demander/reprographie/divers", name="page_reprographie_divers")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function creerReprographieDivers(Request $request)
    {
        $reprographie = new Reprographie();
        $theme = 'divers';

        $em = $this->getDoctrine()->getManager();

        $date_aujourdhui = new \DateTime('now');
        $date_aujourdhui->setTime(0,0,0,0);
        $annee_courante = date_format($date_aujourdhui, 'Y');
        $mois_courant = date_format($date_aujourdhui,'m');
        $compteur = '0001';
        $num_repro_pour_non_existant = $annee_courante.'-'.$mois_courant.'-'.$compteur;
        $num_repro_pour_existant = $annee_courante.'-'.$mois_courant;
        // Ressort la reference max qui respecte l'année et le mois du jour
        $si_existe_deja_repro_dans_le_mois = $this->getDoctrine()->getRepository(Reprographie::class)
            ->trouveSiReproDuMoisAnneeExiste($num_repro_pour_existant);

        if($si_existe_deja_repro_dans_le_mois){
            // On prend juste le compteur
            $compteur_max = substr($si_existe_deja_repro_dans_le_mois[0][1],8,12);
            // Mettre X 0 avant le compteur pour qu'il y ait quatre caractères (str_pad)
            $incrementation = str_pad($compteur_max+1,4,"0",STR_PAD_LEFT);
            // On concatène tout
            $incrementation_totale = $num_repro_pour_existant.'-'.$incrementation;
            $reprographie->setNumeroReprographie($incrementation_totale);
        }
        else {
            $reprographie->setNumeroReprographie($num_repro_pour_non_existant);
        }

        $date_aujourdhui_bis = new \DateTime('now');
        $date_aujourdhui_bis->setTime(0,0,0,0);

        $reprographie->setDateDemande($date_aujourdhui_bis);
        // Calcul pour les jours ouvrés avec paramètrage du délai modifiable
        $delai = '10';
        $dlai = $this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'JOUR']);
        if($dlai){
            $delai = $dlai->getLibelle();
        }
        $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        if(date_format($date_de_rendu,"N") == '6'){
            $delai = '2';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        if(date_format($date_de_rendu,"N") == '7'){
            $delai = '1';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        $reprographie->setDeadline($date_de_rendu);
        $reprographie->setDeadlineOld($reprographie->getDeadline());
        $reprographie->setTypeDocument('Divers');

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $this->getUser()]);
        $reprographie->setNni($user);

        $form = $this->createForm(ReprographieType::class, $reprographie)
            ->add('contientDocs', CollectionType::class, array(
                'entry_type'   => ContientDocCoteUtilisateurType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'mapped' => false,
                'prototype' => true,
                'by_reference' => false,
                'label' => false,
            ))
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Passer à la suite',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ]);

        $form->handleRequest($request);

        if ($form->getClickedButton() && 'save' === $form->getClickedButton()->getName()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }

                $em->persist($contientDoc);
            }

            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_accueil'));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }


            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_recap_repro_creee',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        return $this->render('default/creer-reprographie.html.twig',[
            'form' => $form->createView(),
            'theme' => $theme,
            'delai' => $reprographie->getDeadline(),

        ]);
    }


    /*********************************************************************************************/
    /**
     * @Route("/demander/reprographie/DRT", name="page_reprographie_drt")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function creerReprographieDRT(Request $request)
    {
        $reprographie = new Reprographie();
        $theme = 'DRT';

        $em = $this->getDoctrine()->getManager();

        $date_aujourdhui = new \DateTime('now');
        $date_aujourdhui->setTime(0,0,0,0);
        $annee_courante = date_format($date_aujourdhui, 'Y');
        $mois_courant = date_format($date_aujourdhui,'m');
        $compteur = '0001';
        $num_repro_pour_non_existant = $annee_courante.'-'.$mois_courant.'-'.$compteur;
        $num_repro_pour_existant = $annee_courante.'-'.$mois_courant;
        // Ressort la reference max qui respecte l'année et le mois du jour
        $si_existe_deja_repro_dans_le_mois = $this->getDoctrine()->getRepository(Reprographie::class)
            ->trouveSiReproDuMoisAnneeExiste($num_repro_pour_existant);

        if($si_existe_deja_repro_dans_le_mois){
            // On prend juste le compteur
            $compteur_max = substr($si_existe_deja_repro_dans_le_mois[0][1],8,12);
            // Mettre X 0 avant le compteur pour qu'il y ait quatre caractères (str_pad)
            $incrementation = str_pad($compteur_max+1,4,"0",STR_PAD_LEFT);
            // On concatène tout
            $incrementation_totale = $num_repro_pour_existant.'-'.$incrementation;
            $reprographie->setNumeroReprographie($incrementation_totale);
        }
        else {
            $reprographie->setNumeroReprographie($num_repro_pour_non_existant);
        }

        $date_aujourdhui_bis = new \DateTime('now');
        $date_aujourdhui_bis->setTime(0,0,0,0);

        $reprographie->setDateDemande($date_aujourdhui_bis);
        // Calcul pour les jours ouvrés avec paramètrage du délai modifiable
        $delai = '10';
        $dlai = $this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'JOUR']);
        if($dlai){
            $delai = $dlai->getLibelle();
        }
        $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        if(date_format($date_de_rendu,"N") == '6'){
            $delai = '2';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        if(date_format($date_de_rendu,"N") == '7'){
            $delai = '1';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        $reprographie->setDeadline($date_de_rendu);
        $reprographie->setDeadlineOld($reprographie->getDeadline());
        $reprographie->setTypeDocument('DRT');

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $this->getUser()]);
        $reprographie->setNni($user);

        $form = $this->createForm(ReprographieType::class, $reprographie)
            ->add('contientDocs', CollectionType::class, array(
                'entry_type'   => ContientDocCoteUtilisateurDRTType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'mapped' => false,
                'prototype' => true,
                'by_reference' => false,
                'label' => false,
            ))
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Passer à la suite',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ]);

        $form->handleRequest($request);

        if ($form->getClickedButton() && 'save' === $form->getClickedButton()->getName()) {


            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }

            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_accueil'));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }


            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_recap_repro_creee',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        return $this->render('default/creer-reprographie.html.twig',[
            'form' => $form->createView(),
            'theme' => $theme,
            'delai' => $reprographie->getDeadline(),

        ]);
    }


    /*********************************************************************************************/

    /**
     * @Route("/demander/reprographie/DSE-Plan", name="page_reprographie_dse_plan")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function creerReprographieDSEPlan(Request $request)
    {
        $reprographie = new Reprographie();
        $theme = 'DSE/Plan';

        $em = $this->getDoctrine()->getManager();

        $date_aujourdhui = new \DateTime('now');
        $date_aujourdhui->setTime(0,0,0,0);
        $annee_courante = date_format($date_aujourdhui, 'Y');
        $mois_courant = date_format($date_aujourdhui,'m');
        $compteur = '0001';
        $num_repro_pour_non_existant = $annee_courante.'-'.$mois_courant.'-'.$compteur;
        $num_repro_pour_existant = $annee_courante.'-'.$mois_courant;
        // Ressort la reference max qui respecte l'année et le mois du jour
        $si_existe_deja_repro_dans_le_mois = $this->getDoctrine()->getRepository(Reprographie::class)
            ->trouveSiReproDuMoisAnneeExiste($num_repro_pour_existant);

        if($si_existe_deja_repro_dans_le_mois){
            // On prend juste le compteur
            $compteur_max = substr($si_existe_deja_repro_dans_le_mois[0][1],8,12);
            // Mettre X 0 avant le compteur pour qu'il y ait quatre caractères (str_pad)
            $incrementation = str_pad($compteur_max+1,4,"0",STR_PAD_LEFT);
            // On concatène tout
            $incrementation_totale = $num_repro_pour_existant.'-'.$incrementation;
            $reprographie->setNumeroReprographie($incrementation_totale);
        }
        else {
            $reprographie->setNumeroReprographie($num_repro_pour_non_existant);
        }

        $date_aujourdhui_bis = new \DateTime('now');
        $date_aujourdhui_bis->setTime(0,0,0,0);

        $reprographie->setDateDemande($date_aujourdhui_bis);
        // Calcul pour les jours ouvrés avec paramètrage du délai modifiable
        $delai = '10';
        $dlai = $this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'JOUR']);
        if($dlai){
            $delai = $dlai->getLibelle();
        }
        $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        if(date_format($date_de_rendu,"N") == '6'){
            $delai = '2';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        if(date_format($date_de_rendu,"N") == '7'){
            $delai = '1';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        $reprographie->setDeadline($date_de_rendu);
        $reprographie->setDeadlineOld($reprographie->getDeadline());
        $reprographie->setTypeDocument('DSE/Plan');

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $this->getUser()]);
        $reprographie->setNni($user);

        $form = $this->createForm(ReprographieType::class, $reprographie)
            ->add('contientDocs', CollectionType::class, array(
                'entry_type'   => ContientDocCoteUtilisateurDSEPlanType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'mapped' => false,
                'prototype' => true,
                'by_reference' => false,
                'label' => false,
            ))
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Passer à la suite',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ]);

        $form->handleRequest($request);

        if ($form->getClickedButton() && 'save' === $form->getClickedButton()->getName()) {


            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }

            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_accueil'));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }


            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_recap_repro_creee',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        return $this->render('default/creer-reprographie.html.twig',[
            'form' => $form->createView(),
            'theme' => $theme,
            'delai' => $reprographie->getDeadline(),

        ]);
    }

    /*********************************************************************************************/

    /**
     * @Route("/demander/reprographie/Astreinte", name="page_reprographie_astreinte")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function creerReprographieAstreinte(Request $request)
    {
        $reprographie = new Reprographie();
        $theme = 'Astreinte';

        $em = $this->getDoctrine()->getManager();

        $date_aujourdhui = new \DateTime('now');
        $date_aujourdhui->setTime(0,0,0,0);
        $annee_courante = date_format($date_aujourdhui, 'Y');
        $mois_courant = date_format($date_aujourdhui,'m');
        $compteur = '0001';
        $num_repro_pour_non_existant = $annee_courante.'-'.$mois_courant.'-'.$compteur;
        $num_repro_pour_existant = $annee_courante.'-'.$mois_courant;
        // Ressort la reference max qui respecte l'année et le mois du jour
        $si_existe_deja_repro_dans_le_mois = $this->getDoctrine()->getRepository(Reprographie::class)
            ->trouveSiReproDuMoisAnneeExiste($num_repro_pour_existant);

        if($si_existe_deja_repro_dans_le_mois){
            // On prend juste le compteur
            $compteur_max = substr($si_existe_deja_repro_dans_le_mois[0][1],8,12);
            // Mettre X 0 avant le compteur pour qu'il y ait quatre caractères (str_pad)
            $incrementation = str_pad($compteur_max+1,4,"0",STR_PAD_LEFT);
            // On concatène tout
            $incrementation_totale = $num_repro_pour_existant.'-'.$incrementation;
            $reprographie->setNumeroReprographie($incrementation_totale);
        }
        else {
            $reprographie->setNumeroReprographie($num_repro_pour_non_existant);
        }

        $date_aujourdhui_bis = new \DateTime('now');
        $date_aujourdhui_bis->setTime(0,0,0,0);

        $reprographie->setDateDemande($date_aujourdhui_bis);
        // Calcul pour les jours ouvrés avec paramètrage du délai modifiable
        $delai = '10';
        $dlai = $this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'JOUR']);
        if($dlai){
            $delai = $dlai->getLibelle();
        }
        $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        if(date_format($date_de_rendu,"N") == '6'){
            $delai = '2';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        if(date_format($date_de_rendu,"N") == '7'){
            $delai = '1';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        $reprographie->setDeadline($date_de_rendu);
        $reprographie->setDeadlineOld($reprographie->getDeadline());
        $reprographie->setTypeDocument('Astreinte');

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $this->getUser()]);
        $reprographie->setNni($user);

        $form = $this->createForm(ReprographieType::class, $reprographie)
            ->add('contientDocs', CollectionType::class, array(
                'entry_type'   => ContientDocCoteUtilisateurASTType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'mapped' => false,
                'prototype' => true,
                'by_reference' => false,
                'label' => false,
            ))
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Passer à la suite',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ]);

        $form->handleRequest($request);

        if ($form->getClickedButton() && 'save' === $form->getClickedButton()->getName()) {


            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }

            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_accueil'));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }


            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_recap_repro_creee',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        return $this->render('default/creer-reprographie.html.twig',[
            'form' => $form->createView(),
            'theme' => $theme,
            'delai' => $reprographie->getDeadline(),

        ]);
    }


    /*********************************************************************************************/

    /**
     * @Route("/demander/reprographie/APE", name="page_reprographie_ape")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function creerReprographieAPE(Request $request)
    {
        $reprographie = new Reprographie();
        $theme = 'Réappro APE';

        $em = $this->getDoctrine()->getManager();

        $date_aujourdhui = new \DateTime('now');
        $date_aujourdhui->setTime(0,0,0,0);
        $annee_courante = date_format($date_aujourdhui, 'Y');
        $mois_courant = date_format($date_aujourdhui,'m');
        $compteur = '0001';
        $num_repro_pour_non_existant = $annee_courante.'-'.$mois_courant.'-'.$compteur;
        $num_repro_pour_existant = $annee_courante.'-'.$mois_courant;
        // Ressort la reference max qui respecte l'année et le mois du jour
        $si_existe_deja_repro_dans_le_mois = $this->getDoctrine()->getRepository(Reprographie::class)
            ->trouveSiReproDuMoisAnneeExiste($num_repro_pour_existant);

        if($si_existe_deja_repro_dans_le_mois){
            // On prend juste le compteur
            $compteur_max = substr($si_existe_deja_repro_dans_le_mois[0][1],8,12);
            // Mettre X 0 avant le compteur pour qu'il y ait quatre caractères (str_pad)
            $incrementation = str_pad($compteur_max+1,4,"0",STR_PAD_LEFT);
            // On concatène tout
            $incrementation_totale = $num_repro_pour_existant.'-'.$incrementation;
            $reprographie->setNumeroReprographie($incrementation_totale);
        }
        else {
            $reprographie->setNumeroReprographie($num_repro_pour_non_existant);
        }

        $date_aujourdhui_bis = new \DateTime('now');
        $date_aujourdhui_bis->setTime(0,0,0,0);

        $reprographie->setDateDemande($date_aujourdhui_bis);
        // Calcul pour les jours ouvrés avec paramètrage du délai modifiable
        $delai = '10';
        $dlai = $this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'JOUR']);
        if($dlai){
            $delai = $dlai->getLibelle();
        }
        $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        if(date_format($date_de_rendu,"N") == '6'){
            $delai = '2';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        if(date_format($date_de_rendu,"N") == '7'){
            $delai = '1';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        $reprographie->setDeadline($date_de_rendu);
        $reprographie->setDeadlineOld($reprographie->getDeadline());
        $reprographie->setTypeDocument('Réappro APE');

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $this->getUser()]);
        $reprographie->setNni($user);

        $form = $this->createForm(ReprographieType::class, $reprographie)
            ->add('contientDocs', CollectionType::class, array(
                'entry_type'   => ContientDocCoteUtilisateurAPEType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'mapped' => false,
                'prototype' => true,
                'by_reference' => false,
                'label' => false,
            ))
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Passer à la suite',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ]);

        $form->get('estUrgence')->setData(true);


        $form->handleRequest($request);

        if ($form->getClickedButton() && 'save' === $form->getClickedButton()->getName()) {

            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }

            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_accueil'));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }


            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_recap_repro_creee',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        return $this->render('default/creer-reprographie.html.twig',[
            'form' => $form->createView(),
            'theme' => $theme,
            'delai' => $reprographie->getDeadline(),

        ]);
    }


    /*********************************************************************************************/

    /**
     * @Route("/demander/reprographie/Besoin-du-service", name="page_reprographie_bds")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function creerReprographieBDS(Request $request)
    {
        $reprographie = new Reprographie();
        $theme = 'métier';

        $em = $this->getDoctrine()->getManager();

        $date_aujourdhui = new \DateTime('now');
        $date_aujourdhui->setTime(0,0,0,0);
        $annee_courante = date_format($date_aujourdhui, 'Y');
        $mois_courant = date_format($date_aujourdhui,'m');
        $compteur = '0001';
        $num_repro_pour_non_existant = $annee_courante.'-'.$mois_courant.'-'.$compteur;
        $num_repro_pour_existant = $annee_courante.'-'.$mois_courant;
        // Ressort la reference max qui respecte l'année et le mois du jour
        $si_existe_deja_repro_dans_le_mois = $this->getDoctrine()->getRepository(Reprographie::class)
            ->trouveSiReproDuMoisAnneeExiste($num_repro_pour_existant);

        if($si_existe_deja_repro_dans_le_mois){
            // On prend juste le compteur
            $compteur_max = substr($si_existe_deja_repro_dans_le_mois[0][1],8,12);
            // Mettre X 0 avant le compteur pour qu'il y ait quatre caractères (str_pad)
            $incrementation = str_pad($compteur_max+1,4,"0",STR_PAD_LEFT);
            // On concatène tout
            $incrementation_totale = $num_repro_pour_existant.'-'.$incrementation;
            $reprographie->setNumeroReprographie($incrementation_totale);
        }
        else {
            $reprographie->setNumeroReprographie($num_repro_pour_non_existant);
        }

        $date_aujourdhui_bis = new \DateTime('now');
        $date_aujourdhui_bis->setTime(0,0,0,0);

        $reprographie->setDateDemande($date_aujourdhui_bis);
        // Calcul pour les jours ouvrés avec paramètrage du délai modifiable
        $delai = '10';
        $dlai = $this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'JOUR']);
        if($dlai){
            $delai = $dlai->getLibelle();
        }
        $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        if(date_format($date_de_rendu,"N") == '6'){
            $delai = '2';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        if(date_format($date_de_rendu,"N") == '7'){
            $delai = '1';
            $date_de_rendu = $date_aujourdhui->modify('+'.$delai.' days');
        }
        $reprographie->setDeadline($date_de_rendu);
        $reprographie->setDeadlineOld($reprographie->getDeadline());
        $reprographie->setTypeDocument('Besoin du service');

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $this->getUser()]);
        $reprographie->setNni($user);

        $form = $this->createForm(ReprographieType::class, $reprographie)
            ->add('contientDocs', CollectionType::class, array(
                'entry_type'   => ContientDocCoteUtilisateurBDSType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'mapped' => false,
                'prototype' => true,
                'by_reference' => false,
                'label' => false,
            ))
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Passer à la suite',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ]);

        $form->handleRequest($request);

        if ($form->getClickedButton() && 'save' === $form->getClickedButton()->getName()) {


            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }

            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_accueil'));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                if($uploadFichier){
                    $vraiNomDocument = pathinfo($uploadFichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $vraiNomDocument = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $vraiNomDocument);
                    $vraiNomDocument = $vraiNomDocument.'.'.$uploadFichier->guessExtension();
                    $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                    $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                    $cDocs->setNomDocument($vraiNomDocument);
                }
                else
                {
                    $contientDoc->addDocuments($document,null,$cDocs->getRefDocument(),$cDocs->getTypeDocument());
                    $cDocs->setNomDocument(null);
                }
                $em->persist($contientDoc);
            }


            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_recap_repro_creee',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        return $this->render('default/creer-reprographie.html.twig',[
            'form' => $form->createView(),
            'theme' => $theme,
            'delai' => $reprographie->getDeadline(),

        ]);
    }


    /*********************************************************************************************/


    /**
     * @Route("/consulter/utilisateurs", name="page_utilisateurs")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function consulterUtilisateurs(Request $request)
    {
        /* Récupération des utilisateurs pour les afficher en tableau */
        $em = $this->getDoctrine()->getManager();

        $repo_utilisateurs = $this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateurs = $repo_utilisateurs->findAll();

        $agent = new Utilisateur();
        $form = $this->createFormBuilder($agent)
            ->add('nni', TextType::class,[
                'attr' => [
                    'placeholder' => 'NNI'
                ],
            ])
            ->add('nom', TextType::class,[
                'attr' => [
                    'placeholder' => 'Nom'
                ],
            ])
            ->add('prenom', TextType::class,[
                'attr' => [
                    'placeholder' => 'Prénom'
                ],
            ])
            ->add('ajouter', SubmitType::class,[
                'label' => 'Ajouter',
                'attr' => [
                    'class' => 'btn btn-sm mon-bouton-edf',
                ],
            ])
            ->getForm();

        $form->handleRequest($request);
        $doit_afficher_agent_null = false;
        $doit_afficher_agent_cree = false;


        if ($form->getClickedButton() && 'ajouter' === $form->getClickedButton()->getName())
        {
            $nni = $form->get('nni')->getData();
            $nom = $form->get('nom')->getData();
            $prenom = $form->get('prenom')->getData();
            $role = $form->get('role')->getData();

            $user = $repo_utilisateurs->findBy(['nni' => $nni]);
            if($user){
                $doit_afficher_agent_null = true;
                return $this->redirectToRoute('page_utilisateurs');
            } else {
                $utilisateur = new Utilisateur();
                $utilisateur->setNni($nni);
                $utilisateur->setNom($nom);
                $utilisateur->setPrenom($prenom);
                $utilisateur->setRole($role);
                $em->persist($utilisateur);
                $em->flush();

                $doit_afficher_agent_cree = true;
                return $this->redirectToRoute('page_utilisateurs');
            }
        }


        return $this->render('default/Utilisateur/utilisateurs.html.twig',[
            'utilisateurs' => $utilisateurs,
            'form' => $form->createView(),
            'doit_afficher_agent_null' => $doit_afficher_agent_null,
            'doit_afficher_agent_cree' => $doit_afficher_agent_cree
        ]);
    }

    /*********************************************************************************************/


    /**
     * @param $reprographie
     * @param $request
     *
     * @Route("/consulter/demande/{numeroReprographie}", name="page_une_demande")
     *
     * @return Response
     */
    public function consulterUneDemande(Reprographie $reprographie, Request $request)
    {

        /* Récupération des données d'une reprographie pour l'afficher seule */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);

        $repo_contientdocs = $this->getDoctrine()->getRepository(ContientDoc::class);
        $contientDocs = $repo_contientdocs->findBy(['id_reprographie' => $reprographie->getIdReprographie()]);

        return $this->render('default/consulter-une-demande.html.twig', [
            'contientDocs' => $contientDocs,
            'repro' => $repro,
        ]);
    }

    /*********************************************************************************************/


    /**
     * @param Reprographie $reprographie
     *
     * @param Request $request
     * @return Response
     * @Route("/consulter/demande_creee/{numeroReprographie}", name="page_recap_repro_creee")
     *
     */
    public function consulterRecapReproCreee(Reprographie $reprographie, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /* Récupération des données d'une reprographie pour l'afficher seule */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);

        $form = $this->createFormBuilder($reprographie)
            ->add('modify', SubmitType::class,[
                'label' => 'Modifier',
                'attr' => [
                    'class' => 'btn btn-warning btn-sm',
                ],

            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Transmettre la demande',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                    'onclick' => 'return confirm("Êtes-vous sur de vouloir transmettre votre demande ?")',
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        $repo_contientdocs = $this->getDoctrine()->getRepository(ContientDoc::class);
        $contientDocs = $repo_contientdocs->findBy(['id_reprographie' => $reprographie->getIdReprographie()]);


        if ($form->getClickedButton() && 'modify' === $form->getClickedButton()->getName()) {

            return $this->redirect($this->generateUrl('page_editer_demande',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'AVD']);
            $reprographie->setIdTaxonomie($taxonomie);

            $em->persist($reprographie);
            $em->flush();

            return $this->redirectToRoute('page_accueil');

        }

        return $this->render('default/consulter-recap-repro-creee.html.twig', [
            'repro' => $repro,
            'contientDocs' => $contientDocs,
            'form' => $form->createView(),
        ]);
    }

    /*********************************************************************************************/
    /**
     * @param Reprographie $reprographie
     *
     * @param Request $request
     * @param ContientDoc $contientDoc
     * @param Document $document
     * @return Response
     * @Route("/editer/documentations-satellites/{numeroReprographie}/{refDocument}", name="page_editer_docsats_presta")
     *
     */
    public function editerDocsatPourRepro(Reprographie $reprographie, Request $request, ContientDoc $contientDoc, Document $document)
    {
        $data = array();
        $data_presta = array();
        $repo_docsat = $this->getDoctrine()->getRepository(Docsat::class);
        $docsats = $repo_docsat->findBy(['id_document' => $document->getIdDocument()]);


        $repo_sat = $this->getDoctrine()->getRepository(Satellite::class);

        /* Précochage des cases */
        foreach($docsats as $d){
            if($d->getOrigine() == 'DOC')
            {
                $satellites_doc = $repo_sat->findBy(['id_satellite' => $d->getIdSatellite()]);
                foreach ($satellites_doc as $c)
                {
                    $s = $c->getCodeSatellite();
                    array_push($data,$s);
                }
            }
            elseif($d->getOrigine() == 'PRESTA'){
                $satellites_presta = $repo_sat->findBy(['id_satellite' => $d->getIdSatellite()]);
                foreach ($satellites_presta as $p)
                {
                    $f = $p->getCodeSatellite();
                    array_push($data_presta,$f);
                }
            }

        }

        $form = $this->createFormBuilder($data)
            ->add('IDC', CheckboxType::class,[
                'label' => 'IDC',
                'required' => false,
            ])
            ->add('IDD', CheckboxType::class,[
                'label' => 'IDD',
                'required' => false,
            ])
            ->add('IDM', CheckboxType::class,[
                'label' => 'IDM',
                'required' => false,
            ])
            ->add('SAA', CheckboxType::class,[
                'label' => 'SAA',
                'required' => false,
            ])
            ->add('SAE', CheckboxType::class,[
                'label' => 'SAE',
                'required' => false,
            ])
            ->add('SAF', CheckboxType::class,[
                'label' => 'SAF',
                'required' => false,
            ])
            ->add('SAG', CheckboxType::class,[
                'label' => 'SAG',
                'required' => false,
            ])
            ->add('SAH', CheckboxType::class,[
                'label' => 'SAH',
                'required' => false,
            ])
            ->add('SAI', CheckboxType::class,[
                'label' => 'SAI',
                'required' => false,
            ])
            ->add('SAJ', CheckboxType::class,[
                'label' => 'SAJ',
                'required' => false,
            ])

            ->add('SCA', CheckboxType::class,[
                'label' => 'SCA',
                'required' => false,
            ])
            ->add('SCB', CheckboxType::class,[
                'label' => 'SCB',
                'required' => false,
            ])
            ->add('SCC', CheckboxType::class,[
                'label' => 'SCC',
                'required' => false,
            ])
            ->add('SCD', CheckboxType::class,[
                'label' => 'SCD',
                'required' => false,
            ])
            ->add('SCE', CheckboxType::class,[
                'label' => 'SCE',
                'required' => false,
            ])
            ->add('SCF', CheckboxType::class,[
                'label' => 'SCF',
                'required' => false,
            ])
            ->add('SCG', CheckboxType::class,[
                'label' => 'SCG',
                'required' => false,
            ])
            ->add('SCH', CheckboxType::class,[
                'label' => 'SCH',
                'required' => false,
            ])
            ->add('SCI', CheckboxType::class,[
                'label' => 'SCI',
                'required' => false,
            ])
            ->add('SCJ', CheckboxType::class,[
                'label' => 'SCJ',
                'required' => false,
            ])

            ->add('SCK', CheckboxType::class,[
                'label' => 'SCK',
                'required' => false,
            ])
            ->add('SCL', CheckboxType::class,[
                'label' => 'SCL',
                'required' => false,
            ])
            ->add('SCM', CheckboxType::class,[
                'label' => 'SCM',
                'required' => false,
            ])
            ->add('SCN', CheckboxType::class,[
                'label' => 'SCN',
                'required' => false,
            ])
            ->add('SCO', CheckboxType::class,[
                'label' => 'SCO',
                'required' => false,
            ])
            ->add('SCP', CheckboxType::class,[
                'label' => 'SCP',
                'required' => false,
            ])
            ->add('SDA', CheckboxType::class,[
                'label' => 'SDA',
                'required' => false,
            ])
            ->add('SFA', CheckboxType::class,[
                'label' => 'SFA',
                'required' => false,
            ])
            ->add('SFB', CheckboxType::class,[
                'label' => 'SFB',
                'required' => false,
            ])
            ->add('SFC', CheckboxType::class,[
                'label' => 'SFC',
                'required' => false,
            ])

            ->add('SFC_LTC', CheckboxType::class,[
                'label' => 'SFC LTC',
                'required' => false,
            ])
            ->add('SFC_PCL', CheckboxType::class,[
                'label' => 'SFC PCL',
                'required' => false,
            ])
            ->add('SFD', CheckboxType::class,[
                'label' => 'SFD',
                'required' => false,
            ])
            ->add('SFE', CheckboxType::class,[
                'label' => 'SFE',
                'required' => false,
            ])
            ->add('SFF', CheckboxType::class,[
                'label' => 'SFF',
                'required' => false,
            ])
            ->add('SFG', CheckboxType::class,[
                'label' => 'SFG',
                'required' => false,
            ])
            ->add('SMT', CheckboxType::class,[
                'label' => 'SMT',
                'required' => false,
            ])
            ->add('SSA', CheckboxType::class,[
                'label' => 'SSA',
                'required' => false,
            ])
            ->add('STA', CheckboxType::class,[
                'label' => 'STA',
                'required' => false,
            ])
            ->add('STP', CheckboxType::class,[
                'label' => 'STP',
                'required' => false,
            ])

            ->add('STQ', CheckboxType::class,[
                'label' => 'STQ',
                'required' => false,
            ])
            ->add('STB', CheckboxType::class,[
                'label' => 'STB',
                'required' => false,
            ])
            ->add('STL', CheckboxType::class,[
                'label' => 'STL',
                'required' => false,
            ])
            ->add('STR', CheckboxType::class,[
                'label' => 'STR',
                'required' => false,
            ])
            ->add('STS', CheckboxType::class,[
                'label' => 'STS',
                'required' => false,
            ])
            ->add('SQA', CheckboxType::class,[
                'label' => 'SQA',
                'required' => false,
            ])
            ->add('LR1', CheckboxType::class,[
                'label' => 'LR1',
                'required' => false,
            ])
            ->add('LR2', CheckboxType::class,[
                'label' => 'LR2',
                'required' => false,
            ])
            ->add('LR3', CheckboxType::class,[
                'label' => 'LR3',
                'required' => false,
            ])
            ->add('LR4', CheckboxType::class,[
                'label' => 'LR4',
                'required' => false,
            ])
            ->add('LR5', CheckboxType::class,[
                'label' => 'LR5',
                'required' => false,
            ])
            ->add('LR6', CheckboxType::class,[
                'label' => 'LR6',
                'required' => false,
            ])
            ->add('PCOM', CheckboxType::class,[
                'label' => 'PCOM',
                'required' => false,
            ])

            ->add('BOITIER', CheckboxType::class,[
                'label' => 'BOITIER',
                'required' => false,
            ])
            ->add('IDD_PCD6', CheckboxType::class,[
                'label' => 'IDD_PCD6',
                'required' => false,
            ])
            ->add('Infirmerie', CheckboxType::class,[
                'label' => 'Infirmerie',
                'required' => false,
            ])
            ->add('STC', CheckboxType::class,[
                'label' => 'STC',
                'required' => false,
            ])
            ->add('SMA', CheckboxType::class,[
                'label' => 'SMA',
                'required' => false,
            ])
            ->add('SAM', CheckboxType::class,[
                'label' => 'SAM',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer les changements',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ])
            ->getForm();

        $form_presta = $this->createFormBuilder($data_presta)
            ->add('IDC', CheckboxType::class,[
                'label' => 'IDC',
                'required' => false,
            ])
            ->add('IDD', CheckboxType::class,[
                'label' => 'IDD',
                'required' => false,
            ])
            ->add('IDM', CheckboxType::class,[
                'label' => 'IDM',
                'required' => false,
            ])
            ->add('SAA', CheckboxType::class,[
                'label' => 'SAA',
                'required' => false,
            ])
            ->add('SAI', CheckboxType::class,[
                'label' => 'SAI',
                'required' => false,
            ])
            ->add('SCG', CheckboxType::class,[
                'label' => 'SCG',
                'required' => false,
            ])
            ->add('SCL', CheckboxType::class,[
                'label' => 'SCL',
                'required' => false,
            ])
            ->add('SCM', CheckboxType::class,[
                'label' => 'SCM',
                'required' => false,
            ])
            ->add('SCP', CheckboxType::class,[
                'label' => 'SCP',
                'required' => false,
            ])
            ->add('SFA', CheckboxType::class,[
                'label' => 'SFA',
                'required' => false,
            ])
            ->add('SFB', CheckboxType::class,[
                'label' => 'SFB',
                'required' => false,
            ])
            ->add('SFC', CheckboxType::class,[
                'label' => 'SFC',
                'required' => false,
            ])
            ->add('SFC_LTC', CheckboxType::class,[
                'label' => 'SFC LTC',
                'required' => false,
            ])
            ->add('SFC_PCL', CheckboxType::class,[
                'label' => 'SFC PCL',
                'required' => false,
            ])
            ->add('SFD', CheckboxType::class,[
                'label' => 'SFD',
                'required' => false,
            ])
            ->add('SFE', CheckboxType::class,[
                'label' => 'SFE',
                'required' => false,
            ])
            ->add('SFF', CheckboxType::class,[
                'label' => 'SFF',
                'required' => false,
            ])
            ->add('SFG', CheckboxType::class,[
                'label' => 'SFG',
                'required' => false,
            ])
            ->add('SMT', CheckboxType::class,[
                'label' => 'SMT',
                'required' => false,
            ])
            ->add('SSA', CheckboxType::class,[
                'label' => 'SSA',
                'required' => false,
            ])
            ->add('STA', CheckboxType::class,[
                'label' => 'STA',
                'required' => false,
            ])
            ->add('STB', CheckboxType::class,[
                'label' => 'STB',
                'required' => false,
            ])
            ->add('STC', CheckboxType::class,[
                'label' => 'STC',
                'required' => false,
            ])
            ->add('SQA', CheckboxType::class,[
                'label' => 'SQA',
                'required' => false,
            ])
            ->add('LR1', CheckboxType::class,[
                'label' => 'LR1',
                'required' => false,
            ])
            ->add('LR2', CheckboxType::class,[
                'label' => 'LR2',
                'required' => false,
            ])
            ->add('LR3', CheckboxType::class,[
                'label' => 'LR3',
                'required' => false,
            ])
            ->add('LR4', CheckboxType::class,[
                'label' => 'LR4',
                'required' => false,
            ])
            ->add('LR5', CheckboxType::class,[
                'label' => 'LR5',
                'required' => false,
            ])
            ->add('LR6', CheckboxType::class,[
                'label' => 'LR6',
                'required' => false,
            ])
            ->add('PCOM', CheckboxType::class,[
                'label' => 'PCOM',
                'required' => false,
            ])
            ->add('sauver', SubmitType::class, [
                'label' => 'Enregistrer les changements',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ])
            ->getForm();

        // Pour pré-remplir les valeurs des checkboxes avec un array sans Entité reliée
        foreach($data as $nom_docsat){
            $form->get($nom_docsat)->setData(true);
        }

        foreach($data_presta as $nd){
            $form_presta->get($nd)->setData(true);
        }

        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $form_presta->handleRequest($request);

            $data = $form->getData();
            $data_presta = $form_presta->getData();



            if ($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) {

                $docsat_selectionnees = array_filter($data);
                // Bien préciser le strictement true en troisème paramètre (===) car sinon il reprend les anciennes valeurs déjà existantes -> 500 error
                $nom_de_ces_docsats = array_keys($docsat_selectionnees,true, true);
                $docsat_decochees = array_keys($data,false, true);


                foreach($docsat_decochees as $noms_non){
                    $repo_satellite = $this->getDoctrine()->getRepository(Satellite::class);
                    $satellites = $repo_satellite->findBy(['codeSatellite' => $noms_non]);
                    $id_satellite = $satellites[0]->getIdSatellite();
                    $docsat = new Docsat();
                    $docsat->setIdSatellite($id_satellite);
                    $docsat->setIdDocument($document->getIdDocument());
                    $docsat->setOrigine('DOC');

                    $exist_non_docsat = $repo_docsat->findOneBy(['id_satellite' => $docsat->getIdSatellite(), 'id_document' => $docsat->getIdDocument(), 'origine' => $docsat->getOrigine()]);
                    if($exist_non_docsat != null){
                        $em->remove($exist_non_docsat);
                        $em->flush();

                    }

                }


                foreach($nom_de_ces_docsats as $noms){
                    $repo_satellite = $this->getDoctrine()->getRepository(Satellite::class);
                    $satellites = $repo_satellite->findBy(['codeSatellite' => $noms]);
                    $id_satellite = $satellites[0]->getIdSatellite();
                    $docsat = new Docsat();
                    $docsat->setIdSatellite($id_satellite);
                    $docsat->setIdDocument($document->getIdDocument());
                    $docsat->setOrigine('DOC');


                    $repo_docsat = $this->getDoctrine()->getRepository(Docsat::class);
                    $exist_docsat = $repo_docsat->findOneBy(['id_satellite' => $docsat->getIdSatellite(), 'id_document' => $docsat->getIdDocument(), 'origine' => $docsat->getOrigine()]);


                    if(!$exist_docsat){
                        $document->addDocsats($docsat);
                        foreach($satellites as $satellite){
                            $satellite->addDocsats($docsat);
                        }

                        $em->persist($docsat);
                        $em->flush();
                    }
                }

                return $this->redirect($this->generateUrl('page_editer_docsats_presta',
                    array('numeroReprographie' => $reprographie->getNumeroReprographie(),'refDocument' => $document->getRefDocument())));


            }

            if ($form_presta->getClickedButton() && 'sauver' === $form_presta->getClickedButton()->getName()) {

                $docsat_selectionnees = array_filter($data_presta);
                // Bien préciser le strictement true en troisème paramètre (===) car sinon il reprend les anciennes valeurs déjà existantes -> 500 error
                $nom_de_ces_docsats = array_keys($docsat_selectionnees,true, true);
                $docsat_decochees = array_keys($data_presta,false, true);


                foreach($docsat_decochees as $noms_non){
                    $repo_satellite = $this->getDoctrine()->getRepository(Satellite::class);
                    $satellites = $repo_satellite->findBy(['codeSatellite' => $noms_non]);
                    $id_satellite = $satellites[0]->getIdSatellite();
                    $docsat = new Docsat();
                    $docsat->setIdSatellite($id_satellite);
                    $docsat->setIdDocument($document->getIdDocument());
                    $docsat->setOrigine('PRESTA');

                    $exist_non_docsat = $repo_docsat->findOneBy(['id_satellite' => $docsat->getIdSatellite(), 'id_document' => $docsat->getIdDocument(), 'origine' => $docsat->getOrigine()]);
                    if($exist_non_docsat != null){
                        $em->remove($exist_non_docsat);
                        $em->flush();

                    }

                }


                foreach($nom_de_ces_docsats as $noms){
                    $repo_satellite = $this->getDoctrine()->getRepository(Satellite::class);
                    $satellites = $repo_satellite->findBy(['codeSatellite' => $noms]);
                    $id_satellite = $satellites[0]->getIdSatellite();
                    $docsat = new Docsat();
                    $docsat->setIdSatellite($id_satellite);
                    $docsat->setIdDocument($document->getIdDocument());
                    $docsat->setOrigine('PRESTA');


                    $repo_docsat = $this->getDoctrine()->getRepository(Docsat::class);
                    $exist_docsat = $repo_docsat->findOneBy(['id_satellite' => $docsat->getIdSatellite(), 'id_document' => $docsat->getIdDocument(), 'origine' => $docsat->getOrigine()]);


                    if(!$exist_docsat){
                        $document->addDocsats($docsat);
                        foreach($satellites as $satellite){
                            $satellite->addDocsats($docsat);
                        }

                        $em->persist($docsat);
                        $em->flush();
                    }
                }

                return $this->redirect($this->generateUrl('page_editer_docsats_presta',
                    array('numeroReprographie' => $reprographie->getNumeroReprographie(),'refDocument' => $document->getRefDocument())));

            }

        }

        return $this->render('default/modifier-docsats.html.twig', [
            'form' => $form->createView(),
            'form_presta' => $form_presta->createView(),
            'refDocument' => $document->getRefDocument(),
            'repro' => $reprographie,
        ]);
    }


    /*********************************************************************************************/


    /**
     * @param Reprographie $reprographie
     *
     * @param Request $request
     * @return Response
     * @Route("/editer/demande/{numeroReprographie}", name="page_editer_demande")
     *
     */
    public function editerUneDemande(Reprographie $reprographie, Request $request)
    {
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);

        $repo_contientdocs = $this->getDoctrine()->getRepository(ContientDoc::class);
        $contientDocs = $repo_contientdocs->findBy(['id_reprographie' => $reprographie->getIdReprographie()]);

        $count_cd = count($contientDocs);
        $count_cd_restants = 5 - $count_cd;

        $typeDoc = $reprographie->getTypeDocument();
        $contienDocType = ContientDocCoteUtilisateurType::class;
        if($typeDoc == 'DSE/Plan'){
            $contienDocType = ContientDocCoteUtilisateurDSEPlanType::class;
        }
        elseif($typeDoc == 'DRT'){
            $contienDocType = ContientDocCoteUtilisateurDRTType::class;
        }
        elseif($typeDoc == 'Astreinte'){
            $contienDocType = ContientDocCoteUtilisateurASTType::class;
        }
        elseif($typeDoc == 'APE'){
            $contienDocType = ContientDocCoteUtilisateurAPEType::class;
        }
        elseif($typeDoc == 'Besoin du service'){
            $contienDocType = ContientDocCoteUtilisateurBDSType::class;
        }

        $form = $this->createForm(ReprographieType::class, $reprographie)
            ->add('contientDocs', CollectionType::class, array(
                'entry_type'   => $contienDocType,
                'allow_add'    => true,
                'allow_delete' => true,
                'mapped' => false,
                'prototype' => true,
                'by_reference' => false,
                'label' => false,

            ))
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Passer à la suite',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ]);

        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->getClickedButton() && 'save' === $form->getClickedButton()->getName()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                $vraiNomDocument = $uploadFichier->getClientOriginalName();
                $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                $cDocs->setNomDocument($vraiNomDocument);

                $em->persist($contientDoc);
            }

            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_editer_demande',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ETB']);
            $reprographie->setIdTaxonomie($taxonomie);
            $reprographie->setMotifAnnulation(null);

            foreach($form->get('contientDocs')->getData() as $cDocs){
                $contientDoc = $cDocs;
                $reprographie->addContientDocs($cDocs);

                $document = new Document();
                $uploadFichier = $cDocs->getNomDocument();
                $vraiNomDocument = $uploadFichier->getClientOriginalName();
                $contientDoc->addDocuments($document,$vraiNomDocument,$cDocs->getRefDocument(),$cDocs->getTypeDocument());

                $uploadFichier->move($this->getParameter('brochures_directory'),$vraiNomDocument);

                $cDocs->setNomDocument($vraiNomDocument);

                $em->persist($contientDoc);
            }

            $em->persist($reprographie);
            $em->flush();


            return $this->redirect($this->generateUrl('page_recap_repro_creee',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }



        return $this->render('default/editer-demande.html.twig', [
            'nb_doc' => $count_cd_restants,
            'form' => $form->createView(),
            'contientDocs' => $contientDocs,
            'repro' => $repro,
        ]);
    }


    /**
     * @param Reprographie $reprographie
     * @param ContientDoc $contientDoc
     *
     * @param Request $request
     * @return Response
     * @Route("/editer/demande/documents/{numeroReprographie}/{refDocument}", name="page_editer_demande_un_document")
     *
     */
    public function editerUneDemandeContientDoc(Reprographie $reprographie, ContientDoc $contientDoc, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);

        $repo_document = $this->getDoctrine()->getRepository(Document::class);
        $document = $repo_document->findOneBy(['nomDocument' => $contientDoc->getNomDocument()]);

        $repo_docsat = $this->getDoctrine()->getRepository(Docsat::class);
        $docsats = $repo_docsat->findBy(['id_document' => $document->getIdDocument()]);


        $form = $this->createForm(ContientDocCoteUtilisateurModifierType::class ,$contientDoc)
            ->add('retour', SubmitType::class, [
                'label' => 'Retour',
                'attr' => [
                    'class' => 'btn btn-secondary btn-sm',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer les changements',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                ],
            ]);

        $nom_du_doc = $contientDoc->getNomDocument();

        $form->handleRequest($request);


        if ($form->getClickedButton() && 'retour' === $form->getClickedButton()->getName()) {

            return $this->redirect($this->generateUrl('page_editer_demande',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        if ($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) {

            $em->persist($contientDoc);
            $em->flush();

            return $this->redirect($this->generateUrl('page_editer_demande',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }


        return $this->render('default/editer-demande-contientdocs.html.twig', [
            'docsats' => $docsats,
            'form' => $form->createView(),
            'repro' => $repro,
            'nom_du_doc' => $nom_du_doc,
            'refDocument' => $document->getRefDocument(),
        ]);
    }


    /*********************************************************************************************/


    /**
     * @param Reprographie $reprographie
     *
     * @param Request $request
     * @return Response
     * @Route("/supprimer/reprographie/{numeroReprographie}", name="page_supprimer_repro")
     *
     */
    public function supprimerRepro(Reprographie $reprographie, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /* Récupération des données d'une reprographie pour l'afficher seule */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);

        $repo_contientDoc = $this->getDoctrine()->getRepository(ContientDoc::class);
        $contientDocdelaRepro = $repo_contientDoc->findBy(['id_reprographie' => $reprographie->getIdReprographie()]);



        $repo_contientdocs = $this->getDoctrine()->getRepository(ContientDoc::class);
        $contientDocs = $repo_contientdocs->findBy(['id_reprographie' => $reprographie->getIdReprographie()]);





        $form = $this->createFormBuilder($reprographie)
            ->add('delete', SubmitType::class,[
                'label' => 'Supprimer',
                'attr' => [
                    'class' => 'btn btn-danger btn-sm',
                    'onclick' => 'return confirm("Êtes-vous sur de vouloir supprimer cette demande ?")',
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        if (($form->getClickedButton() && 'delete' === $form->getClickedButton()->getName()) && $form->isValid()) {

            foreach($contientDocdelaRepro as $contientDoc){
                $repo_document = $this->getDoctrine()->getRepository(Document::class);
                $documents = $repo_document->findBy(['id_contientDocs' => $contientDoc->getIdContientDocs()]);

                if($contientDoc->getNomDocument()) {
                    foreach ($documents as $docs) {
                        $em->remove($docs);
                        if (file_exists('uploads/brochures/' . $docs->getNomDocument())) {
                            unlink('uploads/brochures/' . $docs->getNomDocument());
                        }
                    }
                }
                $em->remove($contientDoc);
            }

            $em->remove($reprographie);
            $em->flush();

            return $this->redirectToRoute('page_accueil');

        }

        return $this->render('default/supprimer-repro.html.twig', [
            'contientDocs' => $contientDocs,
            'repro' => $repro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Reprographie $reprographie
     * @param ContientDoc $contientDoc
     * @param Request $request
     *
     *
     * @Route("/supprimer/reprographie/{numeroReprographie}/{refDocument}", name="page_supprimer_contientdoc")
     *
     * @return Response
     */
    public function supprimerContientDoc(Reprographie $reprographie, ContientDoc $contientDoc, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repo_document = $this->getDoctrine()->getRepository(Document::class);
        $documents = $repo_document->findOneBy(['id_contientDocs' => $contientDoc->getIdContientDocs()]);
        $em->remove($documents);
        if($contientDoc->getNomDocument()) {
            if (file_exists('uploads/brochures/' . $documents->getNomDocument())) {
                unlink('uploads/brochures/' . $documents->getNomDocument());
            }
        }
        $em->remove($contientDoc);

        $em->flush();

        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

}
