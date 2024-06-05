<?php

namespace App\Entity;

use App\Repository\TestEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestEntityRepository::class)]
class TestEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $x1 = null;

    #[ORM\Column]
    private ?float $x2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getX1(): ?float
    {
        return $this->x1;
    }

    public function setX1(float $x1): static
    {
        $this->x1 = $x1;

        return $this;
    }

    public function getX2(): ?float
    {
        return $this->x2;
    }

    public function setX2(float $x2): static
    {
        $this->x2 = $x2;

        return $this;
    }
}
