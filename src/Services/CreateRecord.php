<?php

namespace App\Services;

use App\Entity\Record;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CreateRecord
{

    /**
     * @var ApiClient
     */
    private $apiClient;
    /**
     * @var Location
     */
    private $location;
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(Location $location, EntityManagerInterface $entityManager)
    {
        $this->location = $location;
        $this->entityManager = $entityManager;
    }

    public function handle(Record $request): Record
    {
        $codeCity = $request->getCity()->getCode() . ',' . $request->getCity()->getCounty()->getCodeIso();
        $location = $this->location->get($codeCity);
        $humidity = $location->current_observation->atmosphere->humidity;
        $latitude = $location->location->lat;
        $longitude = $location->location->long;
        $record = new Record();
        $record->setCity($request->getCity());
        $record->setHumidity($humidity);
        $record->setLatitude($latitude);
        $record->setLongitude($longitude);
        $record->setCreatedAt(new \DateTime());
        $this->entityManager->persist($record);
        $this->entityManager->flush();
        return $record;
    }

}