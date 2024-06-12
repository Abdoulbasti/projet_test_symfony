<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OperationRepository::class)]
class Operation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $a = null;

    #[Assert\NotEqualTo(
        value: 0,
        message:"La valeur de b ne doit pas être null")
        ]
    #[ORM\Column]
    private ?float $b = null;

    #[ORM\Column(length:255)]
    private string $resultat;
    
    private const INTEGER_AFTER_COMMA = 3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getA(): ?float
    {
        return $this->a;
    }

    public function setA(float $a): static
    {
        $this->a = $a;

        return $this;
    }

    public function getB(): ?float
    {
        return $this->b;
    }

    public function setB(float $b): static
    {
        $this->b = $b;

        return $this;
    }


    public function getResultat(): ?float
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): static
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function add() : ?float {

        return (float)number_format($this->a + $this->b, self::INTEGER_AFTER_COMMA);
    }

    public function substraction() : ?float {

        return (float)number_format($this->a - $this->b, self::INTEGER_AFTER_COMMA);
    }    
    
    public function multiply() : ?float {

        return (float)number_format($this->a * $this->b, self::INTEGER_AFTER_COMMA);
    }    
    
    public function divide() : ?float {

        return (float)number_format($this->a / $this->b, self::INTEGER_AFTER_COMMA);
    }
}
