<?php

namespace App\Entity;

use App\Repository\PopulationStationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PopulationStationRepository::class)]
class PopulationStation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $distance;

    #[ORM\ManyToOne(targetEntity: Year::class, inversedBy: 'populationStations')]
    #[ORM\JoinColumn(nullable: false)]
    private $year;

    #[ORM\ManyToOne(targetEntity: Region::class, inversedBy: 'populationStations')]
    #[ORM\JoinColumn(nullable: false)]
    private $region;

    #[ORM\Column(type: 'string', length: 255)]
    private $urban;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getYear(): ?Year
    {
        return $this->year;
    }

    public function setYear(?Year $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getUrban(): ?string
    {
        return $this->urban;
    }

    public function setUrban(string $urban): self
    {
        $this->urban = $urban;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
