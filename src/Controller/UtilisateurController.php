<?php

namespace App\Controller;

use App\Entity\ContientDoc;
use App\Entity\Docsat;
use App\Entity\Document;
use App\Entity\Reprographie;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    /**
     * @param Request $request
     * @param $nni
     * @return Response
     * @Route("/supprimer/utilisateur/{nni}", name="page_supprimer_utilisateur")
     *
     */
    public function supprimerUtilisateur(Request $request, $nni)
    {
        // Il faut tout supprimer d'un agent lors de sa suppression sinon les contraintes FK SQL l'empêchent. -> Erreur 500
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $nni]);
        $repro_user = $this->getDoctrine()->getRepository(Reprographie::class)->findBy(['nni' => $nni]);
        if($repro_user){
            foreach ($repro_user as $ru){
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
            $em->remove($user);
            $em->flush();
            return $this->redirect($request->server->get('HTTP_REFERER'));
        }
        else {
            $em->remove($user);
            $em->flush();
            return $this->redirect($request->server->get('HTTP_REFERER'));

        }
    }

    /**
     * @param Utilisateur $utilisateur
     *
     * @param Request $request
     * @return Response
     * @Route("/modifier/utilisateur/{nni}", name="page_modifier_utilisateur")
     *
     */
    public function modifierUtilisateur(Utilisateur $utilisateur, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['nni' => $utilisateur->getNni()]);

//        $form = $this->createForm(UtilisateurType::class, $utilisateur)
//            ->add('modify', SubmitType::class,[
//                'label' => 'Modifier',
//                'attr' => [
//                    'class' => 'btn btn-warning btn-sm',
//                    'onclick' => 'return confirm("Êtes-vous sur de vouloir assigner ce rôle ?")',
//                ],
//            ]);

        $roleDef = [];
        $form = $this->createFormBuilder($roleDef)
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => "ROLE_USER",
                    'Pôle DOC' => "ROLE_DOC",
                    'Prestataire' => "ROLE_REPRO",
                    'Accueil' => "ROLE_BOTH",
                    'Administrateur' => "ROLE_ADMIN"
                ],
                'label' => ' ',
            ])
            ->add('modify', SubmitType::class,[
                'label' => 'Modifier',
                'attr' => [
                    'class' => 'btn btn-warning btn-sm',
                    'onclick' => 'return confirm("Êtes-vous sur de vouloir assigner ce rôle ?")',
                ],
            ])
        ->getForm();

        $form->handleRequest($request);

        if (($form->getClickedButton() && 'modify' === $form->getClickedButton()->getName()) && $form->isValid()) {

            $nouveauRole = [$form->get('roles')->getData()];
            $utilisateur->setRoles($nouveauRole);
            $em->persist($utilisateur);
            $em->flush();
        }

        return $this->render('default/Utilisateur/modifier-utilisateur.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
