<?php

namespace App\Entity;

use App\Repository\TileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TileRepository::class)]
class Tile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $coordQ = null;

    #[ORM\Column]
    private ?int $coordR = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?bool $isPassable = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoordQ(): ?int
    {
        return $this->coordQ;
    }

    public function setCoordQ(int $coordQ): static
    {
        $this->coordQ = $coordQ;

        return $this;
    }

    public function getCoordR(): ?int
    {
        return $this->coordR;
    }

    public function setCoordR(int $coordR): static
    {
        $this->coordR = $coordR;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function isPassable(): ?bool
    {
        return $this->isPassable;
    }

    public function setIsPassable(bool $isPassable): static
    {
        $this->isPassable = $isPassable;

        return $this;
    }
}
