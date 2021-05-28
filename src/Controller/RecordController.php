<?php

namespace App\Controller;

use App\Repository\RecordRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecordController extends AbstractController
{
    /**
     * @Route("/record", name="record-index")
     * @param RecordRepository $recordRepository
     * @return Response
     */
    public function index(RecordRepository $recordRepository): Response
    {
        $data = $recordRepository->findAll();
        return $this->render('record/index.html.twig',[
            'data' => $data
        ]);
    }
}