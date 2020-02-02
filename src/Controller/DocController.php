<?php

namespace App\Controller;

use App\Entity\ContientDoc;
use App\Entity\Docsat;
use App\Entity\Document;
use App\Entity\Reprographie;
use App\Entity\Satellite;
use App\Entity\Taxonomie;
use App\Entity\Utilisateur;
use App\Form\ContientDocCoteUtilisateurModifierType;
use App\Form\ReprographieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocController extends AbstractController
{
    /**
     * @Route("/consulter/demandes", name="page_demandes_doc")
     */
    public function consulterDemandesPourLaDoc()
    {
        /* Récupération des données d'une reprographie pour l'afficher en tableau */

        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repros = $repo_repro->trouverParIdTaxonomiePourDoc();


        return $this->render('default/Doc/consulter-demandes-doc.html.twig',[
            'repros' => $repros,
        ]);
    }


    /*********************************************************************************************/



    /**
     * @param $reprographie
     * @param $request
     *
     * @Route("/consulter/demande/doc/{numeroReprographie}", name="page_une_demande_par_la_doc")
     *
     * @return Response
     */
    public function consulterUneDemandeParLaDoc(Reprographie $reprographie, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /* Récupération des données d'une reprographie pour l'afficher seule */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);

        if($reprographie->getIdTaxonomie()->getCodeTaxonomie() == 'AVD'){
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ECDD']);
            $reprographie->setIdTaxonomie($taxonomie);

            $em->persist($reprographie);
            $em->flush();
        }

        $form = $this->createFormBuilder($reprographie)
            ->add('motif_annulation', TextareaType::class,[
                'label' => ' ',
                'attr' => [
                    'placeholder' => 'Motif de refus',
                    'rows' => '4',
                    'cols' => '4',
                    'style' => 'width:10%',
                ],
                'required' => false,
            ])
            ->add('refuse', SubmitType::class,[
                'label' => 'Refuser',
                'attr' => [
                    'class' => 'btn btn-danger btn-sm',
                    'onclick' => 'return confirm("Confirmer la suppression de la demande ?")',
                ],

            ])
            ->add('modify', SubmitType::class,[
                'label' => 'Modifier',
                'attr' => [
                    'class' => 'btn btn-warning btn-sm',
                ],

            ])
            ->add('lieu_traitement', ChoiceType::class,[
                'label' => ' ',
                'choices' => [
                    'Prestataire du site' => 'Prestataire du site',
                    'IDOL' => 'IDOL'
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                    'onclick' => 'return confirm("La demande sera transmise. Continuer ?")',
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        $repo_contientdocs = $this->getDoctrine()->getRepository(ContientDoc::class);
        $contientDocs = $repo_contientdocs->findBy(['id_reprographie' => $reprographie->getIdReprographie()]);


        $doit_afficher_alerte_mail = false;
        $doit_afficher_alerte_contenu = false;
        $user_doc = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $this->getUser()]);

        if ($form->getClickedButton() && 'refuse' === $form->getClickedButton()->getName()) {
                    $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                        ->findOneBy(['codeTaxonomie' => 'DRD']);
                    $reprographie->setIdTaxonomie($taxonomie);

                    $em->persist($reprographie);
                    $em->flush();

                    return $this->redirectToRoute('page_demandes_doc');
        }


        if ($form->getClickedButton() && 'modify' === $form->getClickedButton()->getName()) {

            return $this->redirect($this->generateUrl('page_editer_demande_par_la_doc',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {

            $destination = $form->get('lieu_traitement')->getData();

            if($destination == 'Prestataire du site'){
                $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                    ->findOneBy(['codeTaxonomie' => 'TAP']);
                $reprographie->setIdTaxonomie($taxonomie);
                $reprographie->setMotifAnnulation(null);

                $reprographie->setNniValideurDoc($user_doc);
                $em->persist($reprographie);
                $em->flush();

                return $this->redirectToRoute('page_demandes_doc');
            }
            elseif($destination == 'IDOL'){
                    $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                        ->findOneBy(['codeTaxonomie' => 'IDL']);
                    $reprographie->setIdTaxonomie($taxonomie);
                    $reprographie->setMotifAnnulation(null);


                    $reprographie->setNniValideurDoc($user_doc);
                    $em->persist($reprographie);
                    $em->flush();

                return $this->redirectToRoute('page_demandes_doc');

            }

        }


        return $this->render('default/Doc/consulter-une-demande-par-la-doc', [
            'contientDocs' => $contientDocs,
            'repro' => $repro,
            'form' => $form->createView(),
            'doit_afficher_alerte_mail' => $doit_afficher_alerte_mail,
            'doit_afficher_alerte_contenu' => $doit_afficher_alerte_contenu,
        ]);
    }


    /*********************************************************************************************/


    /**
     * @param $reprographie
     * @param $request
     *
     * @Route("/editer/demande/doc/{numeroReprographie}", name="page_editer_demande_par_la_doc")
     *
     * @return Response
     */
    public function editerUneDemandeParLaDoc(Reprographie $reprographie, Request $request)
    {

        $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
            ->findOneBy(['codeTaxonomie' => 'ECDD']);
        $reprographie->setIdTaxonomie($taxonomie);

        $dl = $reprographie->getDeadline();

        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);

        $repo_contientdocs = $this->getDoctrine()->getRepository(ContientDoc::class);
        $contientDocs = $repo_contientdocs->findBy(['id_reprographie' => $reprographie->getIdReprographie()]);


        $form = $this->createForm(ReprographieType::class, $reprographie)
            ->add('deadline', DateType::class,[
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker',
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


        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ECDD']);
            $reprographie->setIdTaxonomie($taxonomie);

            $reprographie->setDeadlineOld($dl);

            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_une_demande_par_la_doc',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));
        }

        return $this->render('default/Doc/editer-demande-par-la-doc.html.twig', [
            'form' => $form->createView(),
            'contientDocs' => $contientDocs,
            'repro' => $repro
        ]);
    }


    /*********************************************************************************************/

    /**
     * @param Reprographie $reprographie
     * @param ContientDoc $contientDoc
     *
     * @param Request $request
     * @return Response
     * @Route("/editer/demande/documents/doc/{numeroReprographie}/{refDocument}", name="page_editer_demande_un_document_doc")
     *
     */
    public function editerUneDemandeContientDocParDoc(Reprographie $reprographie, ContientDoc $contientDoc, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);


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

        $repo_document = $this->getDoctrine()->getRepository(Document::class);
        $document = $repo_document->findOneBy(['nomDocument' => $contientDoc->getNomDocument()]);

        $repo_docsat = $this->getDoctrine()->getRepository(Docsat::class);
        $docsats = $repo_docsat->findBy(['id_document' => $document->getIdDocument()]);

        if ($form->getClickedButton() && 'retour' === $form->getClickedButton()->getName()) {

            return $this->redirect($this->generateUrl('page_editer_demande_par_la_doc',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        if ($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) {

            $em->persist($contientDoc);
            $em->flush();

            return $this->redirect($this->generateUrl('page_editer_demande_par_la_doc',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }


        return $this->render('default/Doc/editer-demande-contientdocs.html.twig', [
            'docsats' => $docsats,
            'form' => $form->createView(),
            'repro' => $repro,
            'nom_du_doc' => $nom_du_doc,
            'refDocument' => $contientDoc->getRefDocument(),
        ]);
    }

    /**
     * @param $request
     * @param $reprographie
     * @param $contientDoc
     * @param $document
     *
     * @Route("/editer/demande/documents/doc/{numeroReprographie}/documentations-satellites/{refDocument}", name="page_editer_docsats_par_doc")
     *
     * @return Response
     */
    public function editerDocsatsParLaDoc(Request $request, Reprographie $reprographie, ContientDoc $contientDoc, Document $document)
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

                return $this->redirect($this->generateUrl('page_editer_docsats_par_doc',
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

                return $this->redirect($this->generateUrl('page_editer_docsats_par_doc',
                    array('numeroReprographie' => $reprographie->getNumeroReprographie(),'refDocument' => $document->getRefDocument())));

            }

        }

        return $this->render('default/Doc/modifier-docsats-document-doc.html.twig', [
            'form' => $form->createView(),
            'form_presta' => $form_presta->createView(),
            'refDocument' => $document->getRefDocument(),
            'repro' => $reprographie,
        ]);
    }
}
