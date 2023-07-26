<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureRepository::class)]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $codestructure = null;

    #[ORM\Column(length: 255)]
    private ?string $libeleStructure = null;

    #[ORM\OneToMany(mappedBy: 'structure', targetEntity: agent::class)]
    private Collection $parentAgent;

    #[ORM\OneToMany(mappedBy: 'parentstructure', targetEntity: Structureratache::class)]
    private Collection $structurerataches;

    public function __construct()
    {
        $this->parentAgent = new ArrayCollection();
        $this->structurerataches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodestructure(): ?int
    {
        return $this->codestructure;
    }

    public function setCodestructure(int $codestructure): static
    {
        $this->codestructure = $codestructure;

        return $this;
    }

    public function getLibeleStructure(): ?string
    {
        return $this->libeleStructure;
    }

    public function setLibeleStructure(string $libeleStructure): static
    {
        $this->libeleStructure = $libeleStructure;

        return $this;
    }

    /**
     * @return Collection<int, agent>
     */
    public function getParentAgent(): Collection
    {
        return $this->parentAgent;
    }

    public function addParentAgent(agent $parentAgent): static
    {
        if (!$this->parentAgent->contains($parentAgent)) {
            $this->parentAgent->add($parentAgent);
            $parentAgent->setStructure($this);
        }

        return $this;
    }

    public function removeParentAgent(agent $parentAgent): static
    {
        if ($this->parentAgent->removeElement($parentAgent)) {
            // set the owning side to null (unless already changed)
            if ($parentAgent->getStructure() === $this) {
                $parentAgent->setStructure(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Structureratache>
     */
    public function getStructurerataches(): Collection
    {
        return $this->structurerataches;
    }

    public function addStructureratach(Structureratache $structureratach): static
    {
        if (!$this->structurerataches->contains($structureratach)) {
            $this->structurerataches->add($structureratach);
            $structureratach->setParentstructure($this);
        }

        return $this;
    }

    public function removeStructureratach(Structureratache $structureratach): static
    {
        if ($this->structurerataches->removeElement($structureratach)) {
            // set the owning side to null (unless already changed)
            if ($structureratach->getParentstructure() === $this) {
                $structureratach->setParentstructure(null);
            }
        }

        return $this;
    }
}
