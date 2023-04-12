<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\Column(type: 'integer')]
    private $valeur1;

    #[ORM\Column(type: 'integer')]
    private $valeur2;

    #[ORM\ManyToOne(targetEntity: Echange::class, inversedBy: 'evaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private $echange;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEvaluation(): ?int
    {
        return $this->id_evaluation;
    }

    public function setIdEvaluation(int $id_evaluation): self
    {
        $this->id_evaluation = $id_evaluation;

        return $this;
    }

    public function getValeur1(): ?int
    {
        return $this->valeur1;
    }

    public function setValeur1(int $valeur1): self
    {
        $this->valeur1 = $valeur1;

        return $this;
    }

    public function getValeur2(): ?int
    {
        return $this->valeur2;
    }

    public function setValeur2(int $valeur2): self
    {
        $this->valeur2 = $valeur2;

        return $this;
    }

    public function getEchange(): ?Echange
    {
        return $this->echange;
    }

    public function setEchange(?Echange $echange): self
    {
        $this->echange = $echange;

        return $this;
    }
}
