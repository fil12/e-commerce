<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParametersRepository")
 */
class Parameters
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductParametersValue", mappedBy="parameter_id")
     */
    private $productParametersValues;

    public function __construct()
    {
        $this->productParametersValues = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|ProductParametersValue[]
     */
    public function getProductParametersValues(): Collection
    {
        return $this->productParametersValues;
    }

    public function addProductParametersValue(ProductParametersValue $productParametersValue): self
    {
        if (!$this->productParametersValues->contains($productParametersValue)) {
            $this->productParametersValues[] = $productParametersValue;
            $productParametersValue->setParameterId($this);
        }

        return $this;
    }

    public function removeProductParametersValue(ProductParametersValue $productParametersValue): self
    {
        if ($this->productParametersValues->contains($productParametersValue)) {
            $this->productParametersValues->removeElement($productParametersValue);
            // set the owning side to null (unless already changed)
            if ($productParametersValue->getParameterId() === $this) {
                $productParametersValue->setParameterId(null);
            }
        }

        return $this;
    }
}
