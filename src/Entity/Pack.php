<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $monthlyPrice = null;

    #[ORM\Column(length: 255)]
    private ?string $periodicPayment = null;

    #[ORM\OneToMany(targetEntity: InsuranceGuarantee::class, mappedBy: 'pack')]
    private Collection $guarantees;

    #[ORM\ManyToOne(inversedBy: 'packs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?InsuranceCategory $category = null;

    public function __construct()
    {
        $this->guarantees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMonthlyPrice(): ?float
    {
        return $this->monthlyPrice;
    }

    public function setMonthlyPrice(float $monthlyPrice): static
    {
        $this->monthlyPrice = $monthlyPrice;

        return $this;
    }

    public function getPeriodicPayment(): ?string
    {
        return $this->periodicPayment;
    }

    public function setPeriodicPayment(string $periodicPayment): static
    {
        $this->periodicPayment = $periodicPayment;

        return $this;
    }

    /**
     * @return Collection<int, InsuranceGuarantee>
     */
    public function getGuarantees(): Collection
    {
        return $this->guarantees;
    }

    public function addGuarantee(InsuranceGuarantee $guarantee): static
    {
        if (!$this->guarantees->contains($guarantee)) {
            $this->guarantees->add($guarantee);
            $guarantee->setPack($this);
        }

        return $this;
    }

    public function removeGuarantee(InsuranceGuarantee $guarantee): static
    {
        if ($this->guarantees->removeElement($guarantee)) {
            // set the owning side to null (unless already changed)
            if ($guarantee->getPack() === $this) {
                $guarantee->setPack(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getCategory(): ?InsuranceCategory
    {
        return $this->category;
    }

    public function setCategory(?InsuranceCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

}
