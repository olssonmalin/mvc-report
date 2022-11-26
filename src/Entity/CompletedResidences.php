<?php

namespace App\Entity;

use App\Repository\CompletedResidencesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompletedResidencesRepository::class)]
class CompletedResidences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Year::class, inversedBy: 'completedResidences', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $year;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'integer')]
    private $amount;

    #[ORM\ManyToOne(targetEntity: Region::class, inversedBy: 'completedResidences', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $region;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

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
}
