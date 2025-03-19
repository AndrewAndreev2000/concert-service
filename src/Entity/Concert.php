<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: self::TABLE_NAME)]
class Concert
{
    public const TABLE_NAME = 'app_concert';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $id = null;

    #[ORM\Column(type: Types::STRING)]
    protected ?string $name = null;

    #[ORM\Column(type: Types::STRING, unique: true)]
    protected ?string $slug = null;

    #[ORM\ManyToOne(targetEntity: City::class)]
    #[ORM\JoinColumn(name: 'city_id', referencedColumnName: 'id', nullable: false)]
    private ?City $city = null;

    #[ORM\OneToMany(targetEntity: RedirectRule::class, mappedBy: 'concert', cascade: ['persist', 'remove'])]
    protected Collection $redirectRules;

    public function __construct()
    {
        $this->redirectRules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getRedirectRules(): Collection
    {
        return $this->redirectRules;
    }

    public function addRedirectRule(RedirectRule $redirectRule): self
    {
        if (!$this->redirectRules->contains($redirectRule)) {
            $this->redirectRules->add($redirectRule);
            $redirectRule->setConcert($this);
        }

        return $this;
    }

    public function removeRedirectRule(RedirectRule $redirectRule): self
    {
        if ($this->redirectRules->contains($redirectRule)) {
            $this->redirectRules->removeElement($redirectRule);
        }

        return $this;
    }
}
