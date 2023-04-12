<?php

namespace App\Entity;

use App\Repository\EchangeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EchangeRepository::class)]
class Echange
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\Column(type: 'date')]
    private $date_echange;

    #[ORM\Column(type: 'string', length: 255)]
    private $statut;

    #[ORM\Column(type: 'integer')]
    private $confirmation;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'echanges')]
    #[ORM\JoinColumn(nullable: false)]
    private $user1;

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'echanges')]
    private $article;

    #[ORM\OneToMany(mappedBy: 'echange', targetEntity: Evaluation::class)]
    private $evaluations;

    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEchange(): ?int
    {
        return $this->id_echange;
    }

    public function setIdEchange(int $id_echange): self
    {
        $this->id_echange = $id_echange;

        return $this;
    }

    public function getDateEchange(): ?\DateTimeInterface
    {
        return $this->date_echange;
    }

    public function setDateEchange(\DateTimeInterface $date_echange): self
    {
        $this->date_echange = $date_echange;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getConfirmation(): ?int
    {
        return $this->confirmation;
    }

    public function setConfirmation(int $confirmation): self
    {
        $this->confirmation = $confirmation;

        return $this;
    }

    public function getUser1(): ?User
    {
        return $this->user1;
    }

    public function setUser1(?User $user1): self
    {
        $this->user1 = $user1;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->article->contains($article)) {
            $this->article[] = $article;
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        $this->article->removeElement($article);

        return $this;
    }

    /**
     * @return Collection<int, Evaluation>
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setEchange($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getEchange() === $this) {
                $evaluation->setEchange(null);
            }
        }

        return $this;
    }
}
