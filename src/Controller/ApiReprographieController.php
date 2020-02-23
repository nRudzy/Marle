<?php

namespace App\Controller;

use App\Repository\ReprographieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiReprographieController extends AbstractController
{
    /**
     * @Route("/api/reprographies", name="api_reprographie", methods={"GET"})
     * @param ReprographieRepository $reprographieRepository
     * @return Response
     */
    public function avoirToutesReprographies(ReprographieRepository $reprographieRepository)
    {
        return $this->json($reprographieRepository->findAll(),200,[],['groups' => 'repro:read']);
    }

    /**
     * @Route("/api/reprographies/{nni}", name="api_reprographie", methods={"GET"})
     * @param ReprographieRepository $reprographieRepository
     * @param string $nni
     * @return Response
     */
    public function avoirReprographiesParNni(ReprographieRepository $reprographieRepository, string $nni)
    {
        return $this->json($reprographieRepository->findBy(['nni' => $nni]),200,[],['groups' => 'repro:read']);
    }
}
