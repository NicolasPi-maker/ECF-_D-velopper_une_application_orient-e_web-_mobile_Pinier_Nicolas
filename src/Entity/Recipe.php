<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $setup_time = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $rest_time = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $cooking_time = null;

    #[ORM\Column]
    private array $ingredients = [];

    #[ORM\Column(length: 255)]
    private ?string $steps = null;

    #[ORM\ManyToMany(targetEntity: Allergens::class, inversedBy: 'recipes')]
    private Collection $allergen_id;

    #[ORM\ManyToMany(targetEntity: Diets::class, inversedBy: 'recipes')]
    private Collection $diet_id;

    public function __construct()
    {
        $this->allergen_id = new ArrayCollection();
        $this->diet_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSetupTime(): ?\DateTimeInterface
    {
        return $this->setup_time;
    }

    public function setSetupTime(\DateTimeInterface $setup_time): self
    {
        $this->setup_time = $setup_time;

        return $this;
    }

    public function getRestTime(): ?\DateTimeInterface
    {
        return $this->rest_time;
    }

    public function setRestTime(\DateTimeInterface $rest_time): self
    {
        $this->rest_time = $rest_time;

        return $this;
    }

    public function getCookingTime(): ?\DateTimeInterface
    {
        return $this->cooking_time;
    }

    public function setCookingTime(\DateTimeInterface $cooking_time): self
    {
        $this->cooking_time = $cooking_time;

        return $this;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getSteps(): ?string
    {
        return $this->steps;
    }

    public function setSteps(string $steps): self
    {
        $this->steps = $steps;

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
