<?php

namespace App\Entity;

use App\Repository\YearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: YearRepository::class)]
class Year
{
    #[ORM\Id]
    // #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'year', targetEntity: PopulationStation::class, cascade: ['persist'])]
    private $populationStations;

    #[ORM\OneToMany(mappedBy: 'year', targetEntity: CompletedResidences::class, cascade: ['persist'])]
    private $completedResidences;

    #[ORM\OneToMany(mappedBy: 'year', targetEntity: ResidenceStation::class, cascade: ['persist'])]
    private $residenceStations;

    public function __construct()
    {
        $this->populationStations = new ArrayCollection();
        $this->completedResidences = new ArrayCollection();
        $this->residenceStations = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection<int, PopulationStation>
     */
    public function getPopulationStations(): Collection
    {
        return $this->populationStations;
    }

    public function addPopulationStation(PopulationStation $populationStation): self
    {
        if (!$this->populationStations->contains($populationStation)) {
            $this->populationStations[] = $populationStation;
            $populationStation->setYear($this);
        }

        return $this;
    }

    public function removePopulationStation(PopulationStation $populationStation): self
    {
        if ($this->populationStations->removeElement($populationStation)) {
            // set the owning side to null (unless already changed)
            if ($populationStation->getYear() === $this) {
                $populationStation->setYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompletedResidences>
     */
    public function getCompletedResidences(): Collection
    {
        return $this->completedResidences;
    }

    public function addCompletedResidence(CompletedResidences $completedResidence): self
    {
        if (!$this->completedResidences->contains($completedResidence)) {
            $this->completedResidences[] = $completedResidence;
            $completedResidence->setYear($this);
        }

        return $this;
    }

    public function removeCompletedResidence(CompletedResidences $completedResidence): self
    {
        if ($this->completedResidences->removeElement($completedResidence)) {
            // set the owning side to null (unless already changed)
            if ($completedResidence->getYear() === $this) {
                $completedResidence->setYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ResidenceStation>
     */
    public function getResidenceStations(): Collection
    {
        return $this->residenceStations;
    }

    public function addResidenceStation(ResidenceStation $residenceStation): self
    {
        if (!$this->residenceStations->contains($residenceStation)) {
            $this->residenceStations[] = $residenceStation;
            $residenceStation->setYear($this);
        }

        return $this;
    }

    public function removeResidenceStation(ResidenceStation $residenceStation): self
    {
        if ($this->residenceStations->removeElement($residenceStation)) {
            // set the owning side to null (unless already changed)
            if ($residenceStation->getYear() === $this) {
                $residenceStation->setYear(null);
            }
        }

        return $this;
    }
}
