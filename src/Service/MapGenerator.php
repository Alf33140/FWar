<?php

namespace App\Service;

use App\Entity\Tile;
use Doctrine\ORM\EntityManagerInterface;

class MapGenerator
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

public function generateRectangularMap(int $width, int $height): void
{
    // Désactiver le logging SQL pour gagner de la vitesse
    $this->entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
    
    // Nettoyage rapide
    $this->entityManager->createQuery('DELETE FROM App\Entity\Tile')->execute();

    $terrains = ['plaine', 'colline', 'montagne', 'desert', 'sable', 'marecage', 'neige', 'steppe', 'eau', 'eau_profonde'];
    $batchSize = 500; // On enregistre toutes les 500 tuiles

    for ($r = 0; $r < $height; $r++) {
        for ($q = 0; $q < $width; $q++) {
            $tile = new Tile();
            $tile->setCoordQ($q);
            $tile->setCoordR($r);
            $type = $terrains[array_rand($terrains)];
            $tile->setType($type);
            $tile->setIsPassable($type !== 'eau_profonde');

            $this->entityManager->persist($tile);

            if (($q + ($r * $width)) % $batchSize === 0) {
                $this->entityManager->flush();
                $this->entityManager->clear(); // Libère la mémoire
            }
        }
    }
    $this->entityManager->flush();
}
}