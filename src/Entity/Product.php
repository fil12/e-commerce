<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
    private $title;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $sku;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_new;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * Many Products have Many categories.
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", mappedBy="products", fetch="EAGER")
     */
    private $categories;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductImages", mappedBy="product", orphanRemoval=true)
     */
    private $productImages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductParametersValue", mappedBy="product", orphanRemoval=true)
     */
    private $productParametersValues;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderProduct", mappedBy="product_id")
     */
    private $orderProducts;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_published;

    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productImages = new ArrayCollection();
        $this->productParametersValues = new ArrayCollection();
        $this->orderProducts = new ArrayCollection();

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getIsNew(): ?bool
    {
        return $this->is_new;
    }

    public function setIsNew(bool $is_new): self
    {
        $this->is_new = $is_new;

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
     * @return Collection|Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }
    public function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }

    /**
     * @return Collection|ProductImages[]
     */
    public function getProductImages(): Collection
    {
        return $this->productImages;
    }

    public function addProductImage(ProductImages $productImage): self
    {
        if (!$this->productImages->contains($productImage)) {
            $this->productImages[] = $productImage;
            $productImage->setProduct($this);
        }

        return $this;
    }

    public function removeProductImage(ProductImages $productImage): self
    {
        if ($this->productImages->contains($productImage)) {
            $this->productImages->removeElement($productImage);
            // set the owning side to null (unless already changed)
            if ($productImage->getProduct() === $this) {
                $productImage->setProduct(null);
            }
        }

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
            $productParametersValue->setProduct($this);
        }

        return $this;
    }

    public function removeProductParametersValue(ProductParametersValue $productParametersValue): self
    {
        if ($this->productParametersValues->contains($productParametersValue)) {
            $this->productParametersValues->removeElement($productParametersValue);
            // set the owning side to null (unless already changed)
            if ($productParametersValue->getProduct() === $this) {
                $productParametersValue->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrderProduct[]
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct): self
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts[] = $orderProduct;
            $orderProduct->setProductId($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProducts->contains($orderProduct)) {
            $this->orderProducts->removeElement($orderProduct);
            // set the owning side to null (unless already changed)
            if ($orderProduct->getProductId() === $this) {
                $orderProduct->setProductId(null);
            }
        }

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->is_published;
    }

    public function setIsPublished(bool $is_published): self
    {
        $this->is_published = $is_published;

        return $this;
    }
}
