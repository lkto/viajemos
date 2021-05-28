<?php

namespace App\Controller;

use App\Entity\Record;
use App\Form\MapType;
use App\Services\CreateRecord;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * @Route("/", name="map")
     * @param Request $request
     * @param CreateRecord $createRecord
     * @return Response
     */
    public function map(Request $request, CreateRecord $createRecord)
    {
        $form = $this->createForm(MapType::class, null);
        $form->handleRequest($request);
        $data = new Record();
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $createRecord->handle($form->getData());
        }
        return $this->render('map/index.html.twig', [
            'form' => $form->createView(),
            'data' => $data
        ]);
    }
}