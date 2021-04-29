<?php

namespace App\Entity;

use App\Repository\PointageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PointageRepository::class)
 */
class Pointage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Duree;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="pointages")
     * @Assert\NotBlank
     */
    private $Matricule_utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Chantier::class, inversedBy="pointage_chantier")
     * @Assert\NotBlank
     */
    private $Chantier_pointage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->Duree;
    }

    public function setDuree(\DateTimeInterface $Duree): self
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getMatriculeUtilisateur(): ?Utilisateur
    {
        return $this->Matricule_utilisateur;
    }

    public function setMatriculeUtilisateur(?Utilisateur $Matricule_utilisateur): self
    {
        $this->Matricule_utilisateur = $Matricule_utilisateur;

        return $this;
    }

    public function getChantierPointage(): ?Chantier
    {
        return $this->Chantier_pointage;
    }

    public function setChantierPointage(?Chantier $Chantier_pointage): self
    {
        $this->Chantier_pointage = $Chantier_pointage;

        return $this;
    }
}
