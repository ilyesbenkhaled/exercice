<?php

namespace App\Entity;

use App\Repository\ChantierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChantierRepository::class)
 */
class Chantier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDebut;

    /**
     * @ORM\OneToOne(targetEntity=Pointage::class, mappedBy="Chantier_pointage", cascade={"persist", "remove"})
     */
    private $pointage_chantier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->DateDebut;
    }

    public function setDateDebut(\DateTimeInterface $DateDebut): self
    {
        $this->DateDebut = $DateDebut;

        return $this;
    }

    public function getPointageChantier(): ?Pointage
    {
        return $this->pointage_chantier;
    }

    public function setPointageChantier(?Pointage $pointage_chantier): self
    {
        // unset the owning side of the relation if necessary
        if ($pointage_chantier === null && $this->pointage_chantier !== null) {
            $this->pointage_chantier->setChantierPointage(null);
        }

        // set the owning side of the relation if necessary
        if ($pointage_chantier !== null && $pointage_chantier->getChantierPointage() !== $this) {
            $pointage_chantier->setChantierPointage($this);
        }

        $this->pointage_chantier = $pointage_chantier;

        return $this;
    }

    public function __toString()
    {
        return $this->Nom;
    }
}
