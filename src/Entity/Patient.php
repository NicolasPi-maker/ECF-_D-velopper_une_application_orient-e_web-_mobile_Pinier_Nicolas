<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $name = null;

    #[ORM\Column(length: 60)]
    private ?string $lastName = null;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    private ?User $patient_user_id = null;

    #[ORM\OneToMany(mappedBy: 'patient_id', targetEntity: Review::class)]
    private Collection $reviews;

    #[ORM\ManyToMany(targetEntity: Allergens::class, inversedBy: 'patients')]
    private Collection $allergen_id;

    #[ORM\ManyToMany(targetEntity: Diets::class, inversedBy: 'patients')]
    private Collection $diet_id;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->allergen_id = new ArrayCollection();
        $this->diet_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPatientUserId(): ?User
    {
        return $this->patient_user_id;
    }

    public function setPatientUserId(?User $patient_user_id): self
    {
        $this->patient_user_id = $patient_user_id;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setPatientId($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getPatientId() === $this) {
                $review->setPatientId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Allergens>
     */
    public function getAllergenId(): Collection
    {
        return $this->allergen_id;
    }

    public function addAllergenId(Allergens $allergenId): self
    {
        if (!$this->allergen_id->contains($allergenId)) {
            $this->allergen_id->add($allergenId);
        }

        return $this;
    }

    public function removeAllergenId(Allergens $allergenId): self
    {
        $this->allergen_id->removeElement($allergenId);

        return $this;
    }

    /**
     * @return Collection<int, Diets>
     */
    public function getDietId(): Collection
    {
        return $this->diet_id;
    }

    public function addDietId(Diets $dietId): self
    {
        if (!$this->diet_id->contains($dietId)) {
            $this->diet_id->add($dietId);
        }

        return $this;
    }

    public function removeDietId(Diets $dietId): self
    {
        $this->diet_id->removeElement($dietId);

        return $this;
    }
}
