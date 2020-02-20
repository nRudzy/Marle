<?php

namespace App\Controller;

use App\Entity\ContientDoc;
use App\Entity\Docsat;
use App\Entity\Document;
use App\Entity\Reprographie;
use App\Entity\Taxonomie;
use App\Form\TaxonomieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrateurController extends AbstractController
{
    public function construireChoixDatesAnnees() {
        $distance = 5;
        $yearsBefore = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") - $distance));
        $yearsAfter = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") + $distance));
        return array_combine(range($yearsBefore, $yearsAfter), range($yearsBefore, $yearsAfter));
    }

    /**
     * @Route("/administrateur", name="page_administrateur")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function ajouterElementsMobiles(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $mail_doc = $this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'MAILDOC']);

        if($mail_doc){
            $taxo = $mail_doc;
        }
        else{
            $taxo = new Taxonomie();
        }


        $services = $this->getDoctrine()->getRepository(Taxonomie::class)->findBy(['codeTaxonomie' => 'SRVC']);

        $form_mail_doc = $this->createForm(TaxonomieType::class,$taxo)
            ->add('maj', SubmitType::class, [
                'label' => 'Mettre à jour',
                'attr' => [
                    'class' => 'btn btn-sm mon-bouton-edf',
                    'onclick' => 'return confirm("Le mail du Pôle DOC sera mis à jour.")',
                ]
            ]);

        $dlai = array();
        $data_delai = '10';
        if($this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'JOUR'])){
            $data_delai = $this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'JOUR'])->getLibelle();
        }
        $form_delai = $this->createFormBuilder($dlai)
            ->add('libelle', TextType::class, [
                'label' => false,
                'data' => $data_delai,
            ])
            ->add('delai', SubmitType::class, [
                'label' => 'Mettre à jour',
                'attr' => [
                    'class' => 'btn btn-sm mon-bouton-edf',
                    'onclick' => 'return confirm("Le délai sera mis à jour.")',
                ]
            ])
            ->getForm();

        $s = array();
        $form_service = $this->createFormBuilder($s)
            ->add('libelle', TextType::class, [
                'label' => false,
            ])
            ->add('create', SubmitType::class, [
                'label' => 'Créer un service',
                'attr' => [
                    'class' => 'btn btn-sm mon-bouton-edf',
                    'onclick' => 'return confirm("Le service sera créé.")',
                ]
            ])
            ->getForm();
        $annee_supp = array();
        $form_supprimer_bdd = $this->createFormBuilder($annee_supp, array('allow_extra_fields' => true))
            ->add('annee', ChoiceType::class, [
                'choices' => $this->construireChoixDatesAnnees(),
            ])
            ->add('delete', SubmitType::class, [
                'label' => 'Supprimer',
                'attr' => [
                    'class' => 'btn btn-sm mon-bouton-edf',
                    'onclick' => 'return confirm("Toutes les reprographies de l\'année sélectionnée seront supprimées. Continuer ?")',
                ],

            ])
            ->getForm();

        $annee_pdf = array();
        $form_gen_pdf_date = $this->createFormBuilder($annee_pdf, array('allow_extra_fields' => true))
            ->add('moispdf', ChoiceType::class, [
                'choices' => [
                    'Janvier' => '01',
                    'Février' => '02',
                    'Mars' => '03',
                    'Avril' => '04',
                    'Mai' => '05',
                    'Juin' => '06',
                    'Juillet' => '07',
                    'Août' => '08',
                    'Septembre' => '09',
                    'Octobre' => '10',
                    'Novemebre' => '11',
                    'Décembre' => '12',
                ],
            ])
            ->add('anneepdf', ChoiceType::class, [
                'choices' => $this->construireChoixDatesAnnees(),
            ])
            ->add('generate', SubmitType::class, [
                'label' => 'Générer PDF',
                'attr' => [
                    'class' => 'btn btn-sm mon-bouton-edf',
                ],

            ])
            ->getForm();




        $form_mail_doc->handleRequest($request);
        $form_service->handleRequest($request);
        $form_supprimer_bdd->handleRequest($request);
        $form_gen_pdf_date->handleRequest($request);
        $form_delai->handleRequest($request);

        $doit_afficher_erreur_date_supp = false;
        $doit_afficher_erreur_pdf = false;
        $annee_pdf_form = null;
        $mois_pdf_form = null;


        if ($form_mail_doc->getClickedButton() && 'maj' === $form_mail_doc->getClickedButton()->getName())
        {
            $taxo->setCodeTaxonomie('MAILDOC');
            $em->persist($taxo);
            $em->flush();
            return $this->redirectToRoute('page_administrateur');
        }
        if ($form_delai->getClickedButton() && 'delai' === $form_delai->getClickedButton()->getName())
        {
            $dlai = $this->getDoctrine()->getRepository(Taxonomie::class)->findOneBy(['codeTaxonomie' => 'JOUR']);
//            $dlai->setCodeTaxonomie('JOUR');
            $dlai->setLibelle($form_delai->get('libelle')->getData());
            $em->persist($dlai);
            $em->flush();
            return $this->redirectToRoute('page_administrateur');
        }

        if ($form_service->getClickedButton() && 'create' === $form_service->getClickedButton()->getName())
        {
            $service = new Taxonomie();
            $service->setCodeTaxonomie('SRVC');
            $service->setLibelle($form_service->get('libelle')->getData());
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('page_administrateur');
        }

        if ($form_gen_pdf_date->getClickedButton() && 'generate' === $form_gen_pdf_date->getClickedButton()->getName())
        {
            $annee_pdf_form = $form_gen_pdf_date->get('anneepdf')->getData();
            $mois_pdf_form = $form_gen_pdf_date->get('moispdf')->getData();

            $repros_pdf = $this->getDoctrine()->getRepository(Reprographie::class)->trouveParMoisEtAnnee($mois_pdf_form,$annee_pdf_form);
            if($repros_pdf){
                return $this->redirect($this->generateUrl('_pdf',
                    array('anneepdf' => $annee_pdf_form, 'moispdf' => $mois_pdf_form)));
            }
            else {
                $doit_afficher_erreur_pdf = true;
            }
        }

        if($form_supprimer_bdd->getClickedButton() && 'delete' === $form_supprimer_bdd->getClickedButton()->getName()){

            $annee_supp = $form_supprimer_bdd->get('annee')->getData();
            $repros_a_supp = $this->getDoctrine()->getRepository(Reprographie::class)->trouveParAnnee($annee_supp);
            if($repros_a_supp){
                foreach ($repros_a_supp as $ru){
                    $contientDocs_a_supp = $this->getDoctrine()->getRepository(ContientDoc::class)->findBy(['id_reprographie' => $ru->getIdReprographie()]);
                    foreach ($contientDocs_a_supp as $cas){
                        $docs_a_supp = $this->getDoctrine()->getRepository(Document::class)->findBy(['nomDocument' => $cas->getNomDocument()]);

                        foreach ($docs_a_supp as $das){
                            $docsat_a_supp = $this->getDoctrine()->getRepository(Docsat::class)->findBy(['id_document' => $das->getIdDocument()]);

                            foreach ($docsat_a_supp as $dsas){
                                $em->remove($dsas);
                            }
                            if($cas->getNomDocument()) {
                                if(file_exists('uploads/brochures/'.$das->getNomDocument())) {
                                    unlink('uploads/brochures/' . $das->getNomDocument());
                                }
                            }
                            $em->remove($das);
                        }
                        $em->remove($cas);
                    }

                    $em->remove($ru);

                }
                $em->flush();
                return $this->redirectToRoute('page_administrateur');
            }
            else {
                $doit_afficher_erreur_date_supp = true;
            }
        }

        $repros = $this->getDoctrine()->getRepository(Reprographie::class)->findAll();

        return $this->render('default/Administrateur/panneau-administrateur.html.twig',[
            'services' => $services,
            'form_mail_doc' => $form_mail_doc->createView(),
            'form_service' => $form_service->createView(),
            'form_supprimer_bdd' => $form_supprimer_bdd->createView(),
            'form_gen_pdf_date' => $form_gen_pdf_date->createView(),
            'form_delai' => $form_delai->createView(),
            'repros' => $repros,
            'annee_supp' => $annee_supp,
            'mois_pdf_form' => $mois_pdf_form,
            'annee_pdf_form' => $annee_pdf_form,
            'doit_afficher_erreur_date_supp' => $doit_afficher_erreur_date_supp,
            'doit_afficher_erreur_pdf' => $doit_afficher_erreur_pdf,
        ]);
    }

    /**
     * @Route("/administrateur/pdf/reprographie-{moispdf}-{anneepdf}", name="_pdf")
     * @return Response
     */
    public function pdfAction($moispdf, $anneepdf){
        $repros = $this->getDoctrine()->getRepository(Reprographie::class)->trouveParAnnee($anneepdf);

        $template = $this->renderView('default/PDF/pdf.html.twig', [
            'repros' => $repros,
            'moispdf' => $moispdf,
            'anneepdf' => $anneepdf,
        ]);

        $html2pdf = $this->get('app.html2pdf');
        $html2pdf->create('L','A4','fr',true,'UTF-8',array(10,15,10,15));

        return $html2pdf->generatePdf($template, "Export_DOCADIFF".$anneepdf);

    }


    /**
     * @Route("/administrateur/supprimer/service-{id}", name="page_administrateur_supprimer_service")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function supprimerService(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $service_a_supprimer = $this->getDoctrine()->getRepository(Taxonomie::class)->find($id);

        $em->remove($service_a_supprimer);
        $em->flush();

        return $this->redirect($request->server->get('HTTP_REFERER'));
    }
}
