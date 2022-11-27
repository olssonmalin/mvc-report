<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: PopulationStation::class, cascade: ['persist'])]
    private $populationStations;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: CompletedResidences::class, cascade: ['persist'])]
    private $completedResidences;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: ResidenceStation::class, cascade: ['persist'])]
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $populationStation->setRegion($this);
        }

        return $this;
    }

    public function removePopulationStation(PopulationStation $populationStation): self
    {
        if ($this->populationStations->removeElement($populationStation)) {
            // set the owning side to null (unless already changed)
            if ($populationStation->getRegion() === $this) {
                $populationStation->setRegion(null);
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
            $completedResidence->setRegion($this);
        }

        return $this;
    }

    public function removeCompletedResidence(CompletedResidences $completedResidence): self
    {
        if ($this->completedResidences->removeElement($completedResidence)) {
            // set the owning side to null (unless already changed)
            if ($completedResidence->getRegion() === $this) {
                $completedResidence->setRegion(null);
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
            $residenceStation->setRegion($this);
        }

        return $this;
    }

    public function removeResidenceStation(ResidenceStation $residenceStation): self
    {
        if ($this->residenceStations->removeElement($residenceStation)) {
            // set the owning side to null (unless already changed)
            if ($residenceStation->getRegion() === $this) {
                $residenceStation->setRegion(null);
            }
        }

        return $this;
    }
}
