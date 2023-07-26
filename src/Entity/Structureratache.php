<?php

namespace App\Entity;

use App\Repository\StructureratacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureratacheRepository::class)]
class Structureratache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $codestructureratache = null;

    #[ORM\Column(length: 30)]
    private ?string $libele = null;

    #[ORM\ManyToOne(inversedBy: 'structurerataches')]
    private ?structure $parentstructure = null;

    #[ORM\OneToMany(mappedBy: 'parentstructureratache', targetEntity: Decision::class)]
    private Collection $decisions;

    public function __construct()
    {
        $this->decisions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodestructureratache(): ?string
    {
        return $this->codestructureratache;
    }

    public function setCodestructureratache(string $codestructureratache): static
    {
        $this->codestructureratache = $codestructureratache;

        return $this;
    }

    public function getLibele(): ?string
    {
        return $this->libele;
    }

    public function setLibele(string $libele): static
    {
        $this->libele = $libele;

        return $this;
    }

    public function getParentstructure(): ?structure
    {
        return $this->parentstructure;
    }

    public function setParentstructure(?structure $parentstructure): static
    {
        $this->parentstructure = $parentstructure;

        return $this;
    }

    /**
     * @return Collection<int, Decision>
     */
    public function getDecisions(): Collection
    {
        return $this->decisions;
    }

    public function addDecision(Decision $decision): static
    {
        if (!$this->decisions->contains($decision)) {
            $this->decisions->add($decision);
            $decision->setParentstructureratache($this);
        }

        return $this;
    }

    public function removeDecision(Decision $decision): static
    {
        if ($this->decisions->removeElement($decision)) {
            // set the owning side to null (unless already changed)
            if ($decision->getParentstructureratache() === $this) {
                $decision->setParentstructureratache(null);
            }
        }

        return $this;
    }
}
