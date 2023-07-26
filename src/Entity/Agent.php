<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $matricule = null;

    #[ORM\Column(length: 35)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenoms = null;

    #[ORM\Column(length: 5)]
    private ?string $sexe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedenaissance = null;

    #[ORM\Column(length: 4)]
    private ?string $grade = null;

    #[ORM\Column(length: 100)]
    private ?string $Emploi = null;

    #[ORM\Column(length: 10)]
    private ?string $civilite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $premiereprisedeservice = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $telephone = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $telephone1 = null;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Users::class)]
    private Collection $parentusers;

    #[ORM\ManyToOne(inversedBy: 'parentAgent')]
    private ?Structure $structure = null;

    public function __construct()
    {
        $this->parentusers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(string $prenoms): static
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDatedenaissance(): ?\DateTimeInterface
    {
        return $this->datedenaissance;
    }

    public function setDatedenaissance(\DateTimeInterface $datedenaissance): static
    {
        $this->datedenaissance = $datedenaissance;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getEmploi(): ?string
    {
        return $this->Emploi;
    }

    public function setEmploi(string $Emploi): static
    {
        $this->Emploi = $Emploi;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): static
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getPremiereprisedeservice(): ?\DateTimeInterface
    {
        return $this->premiereprisedeservice;
    }

    public function setPremiereprisedeservice(\DateTimeInterface $premiereprisedeservice): static
    {
        $this->premiereprisedeservice = $premiereprisedeservice;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getTelephone1(): ?string
    {
        return $this->telephone1;
    }

    public function setTelephone1(?string $telephone1): static
    {
        $this->telephone1 = $telephone1;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getParentusers(): Collection
    {
        return $this->parentusers;
    }

    public function addParentuser(Users $parentuser): static
    {
        if (!$this->parentusers->contains($parentuser)) {
            $this->parentusers->add($parentuser);
            $parentuser->setAgent($this);
        }

        return $this;
    }

    public function removeParentuser(Users $parentuser): static
    {
        if ($this->parentusers->removeElement($parentuser)) {
            // set the owning side to null (unless already changed)
            if ($parentuser->getAgent() === $this) {
                $parentuser->setAgent(null);
            }
        }

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): static
    {
        $this->structure = $structure;

        return $this;
    }
}
