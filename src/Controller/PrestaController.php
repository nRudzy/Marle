<?php

namespace App\Controller;

use App\Entity\ContientDoc;
use App\Entity\Docsat;
use App\Entity\Document;
use App\Entity\Reprographie;
use App\Entity\Taxonomie;
use App\Form\ContientDocCoteUtilisateurModifierType;
use App\Form\ReprographieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestaController extends AbstractController
{
    /**
     * @Route("/consulter/demandes-validees", name="page_demandes_presta")
     */
    public function consulterDemandesValidees()
    {
        /* Récupération des données d'une reprographie pour l'afficher en tableau */

        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repros = $repo_repro->trouverParIdTaxonomiePourPresta();


        return $this->render('default/Presta/consulter-demandes-presta.html.twig',[
            'repros' => $repros,
        ]);
    }


    /*********************************************************************************************/


    /**
     * @param $reprographie
     * @param $request
     *
     * @Route("/consulter/demande/repro/{numeroReprographie}", name="page_une_demande_par_le_presta")
     *
     * @return Response
     */
    public function consulterUneDemandeParLePresta(Reprographie $reprographie, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /* Récupération des données d'une reprographie pour l'afficher seule */
        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);

        if($reprographie->getIdTaxonomie()->getCodeTaxonomie() == 'TAP'){
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'CPP']);
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
                    'onclick' => 'return confirm("Confirmer le renvoie de la demande ?")',
                ],

            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Traiter la demande',
                'attr' => [
                    'class' => 'btn btn-info btn-sm',
                    'onclick' => 'return confirm("La demande sera en cours de traitement. Continuer ?")',
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        $doit_afficher_alerte_contenu = false;
        $doit_afficher_alerte_mail = false;

        if ($form->getClickedButton() && 'refuse' === $form->getClickedButton()->getName()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'DRP']);
            $reprographie->setIdTaxonomie($taxonomie);
        }


        if ($form->getClickedButton() && 'modify' === $form->getClickedButton()->getName()) {

            return $this->redirect($this->generateUrl('page_editer_demande_par_le_presta',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {
            $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                ->findOneBy(['codeTaxonomie' => 'ECP']);
            $reprographie->setIdTaxonomie($taxonomie);
            $reprographie->setMotifAnnulation(null);

            $em->persist($reprographie);
            $em->flush();

            return $this->redirectToRoute('page_demandes_presta');

        }

        $repo_contientdocs = $this->getDoctrine()->getRepository(ContientDoc::class);
        $contientDocs = $repo_contientdocs->findBy(['id_reprographie' => $reprographie->getIdReprographie()]);

        return $this->render('default/Presta/consulter-une-demande-par-le-presta.html.twig', [
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
     * @Route("/editer/demande/repro/{numeroReprographie}", name="page_editer_demande_par_le_presta")
     *
     * @return Response
     */
    public function editerUneDemandeParLePresta(Reprographie $reprographie, Request $request)
    {
        $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
            ->findOneBy(['codeTaxonomie' => 'ECDP']);
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
                ]
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
                ->findOneBy(['codeTaxonomie' => 'ECDP']);
            $reprographie->setIdTaxonomie($taxonomie);

            $reprographie->setDeadlineOld($dl);

            $em->persist($reprographie);
            $em->flush();

            return $this->redirect($this->generateUrl('page_une_demande_par_le_presta',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));
        }

        return $this->render('default/Presta/editer-demande-par-le-presta.html.twig', [
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
     * @Route("/editer/demande/documents/repro/{numeroReprographie}/{refDocument}", name="page_editer_demande_un_document_presta")
     *
     */
    public function editerUneDemandeContientDocParPresta(Reprographie $reprographie, ContientDoc $contientDoc, Request $request)
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

            return $this->redirect($this->generateUrl('page_editer_demande_par_le_presta',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }

        if ($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) {

            $em->persist($contientDoc);
            $em->flush();

            return $this->redirect($this->generateUrl('page_editer_demande_par_le_presta',
                array('numeroReprographie' => $reprographie->getNumeroReprographie())));

        }


        return $this->render('default/Presta/editer-demande-contientdocs.html.twig', [
            'docsats' => $docsats,
            'form' => $form->createView(),
            'repro' => $repro,
            'nom_du_doc' => $nom_du_doc,
            'refDocument' => $contientDoc->getRefDocument(),

        ]);
    }


    /**
     * @Route("/repro/remplir/recapitulatif-de-la-repro-{numeroReprographie}", name="page_remplir_recap_repro")
     * @param Reprographie $reprographie
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function remplirRecapRepro(Reprographie $reprographie, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repo_repro = $this->getDoctrine()->getRepository(Reprographie::class);
        $repro = $repo_repro->findOneBy(['numeroReprographie' => $reprographie->getNumeroReprographie()]);

        $repo_contientdocs = $this->getDoctrine()->getRepository(ContientDoc::class);
        $contientDocs = $repo_contientdocs->findBy(['id_reprographie' => $reprographie->getIdReprographie()]);

        $form = $this->createFormBuilder($reprographie)
            ->add('datemiseenplace', DateType::class, [
                'label' => 'Mise en place des docsat effectué le :',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker',
                ],
                'required' => false,
            ])
            ->add('lieuRenvoie', ChoiceType::class,[
                'choices' => [
                    'Conservé chez prestataire' => 'Conservé chez prestataire',
                    'Retour métier' => 'Retour métier',
                    'Retour Doc' => 'Retour Doc',
                    'Retour Accueil DOC' => 'Retour Accueil DOC',

                ],
                'label' => 'Lieu de renvoi',
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Travail effectué',
                'attr' => [
                    'class' => 'btn btn-success btn-sm',
                    'onclick' => 'return confirm("La demande sera considérée comme traitée. Elle ne sera plus modifiable. Continuer ?")',

                ],

            ])
            ->getForm();

        $form->handleRequest($request);

        if (($form->getClickedButton() && 'submit' === $form->getClickedButton()->getName()) && $form->isValid()) {

            $lieu_de_renvoie = $form->get('lieuRenvoie')->getData();

                if($lieu_de_renvoie == 'Conservé chez prestataire'){
                    $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                        ->findOneBy(['codeTaxonomie' => 'CSP']);
                    $reprographie->setIdTaxonomie($taxonomie);

                } else if($lieu_de_renvoie == 'Retour métier'){
                    $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                        ->findOneBy(['codeTaxonomie' => 'RAME']);
                    $reprographie->setIdTaxonomie($taxonomie);

                } else if($lieu_de_renvoie == 'Retour Doc'){
                    $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                        ->findOneBy(['codeTaxonomie' => 'RPD']);
                    $reprographie->setIdTaxonomie($taxonomie);

                } else if($lieu_de_renvoie == 'Retour Accueil DOC'){
                    $taxonomie = $this->getDoctrine()->getRepository(Taxonomie::class)
                        ->findOneBy(['codeTaxonomie' => 'RAM']);
                    $reprographie->setIdTaxonomie($taxonomie);
                }

                foreach ($contientDocs as $cd){

                    $repo_document = $this->getDoctrine()->getRepository(Document::class);
                    $documents = $repo_document->findBy(['id_contientDocs' => $cd->getIdContientDocs()]);
                    if($cd->getNomDocument()){
                        foreach ($documents as $docs){
                            if(file_exists('uploads/brochures/'.$docs->getNomDocument()))
                            {
                                unlink('uploads/brochures/'.$docs->getNomDocument());
                            }
                        }
                    }

                }

                $em->persist($reprographie);
                $em->flush();

                return $this->redirectToRoute('page_demandes_presta');
            }
            else{
                $doit_afficher_alerte_mail = true;
            }

        return $this->render('default/Presta/consulter-recap-repro.html.twig',[
            'form' => $form->createView(),
            'repro' => $repro,
            'contientDocs' => $contientDocs,
            'doit_afficher_alerte_mail' => $doit_afficher_alerte_mail,
        ]);
    }
}
