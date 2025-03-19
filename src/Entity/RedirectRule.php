<?php

namespace App\Entity;

use App\Repository\RedirectRuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RedirectRuleRepository::class)]
#[ORM\Table(name: self::TABLE_NAME)]
class RedirectRule
{
    public const TABLE_NAME = 'app_redirect_rule';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Concert::class, inversedBy: 'redirectRules')]
    #[ORM\JoinColumn(name: 'concert_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Concert $concert = null;

    #[ORM\Column(type: Types::STRING)]
    protected ?string $redirectUrl = null;

    #[ORM\OneToMany(targetEntity: Rule::class, mappedBy: 'redirectRule', cascade: ['persist', 'remove'])]
    protected Collection $rules;

    public function __construct()
    {
        $this->rules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConcert(): ?Concert
    {
        return $this->concert;
    }

    public function setConcert(?Concert $concert): self
    {
        $this->concert = $concert;

        return $this;
    }

    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }

    public function setRedirectUrl(?string $redirectUrl): self
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    public function getRules(): Collection
    {
        return $this->rules;
    }

    public function addRule(Rule $rule): self
    {
        if (!$this->rules->contains($rule)) {
            $this->rules->add($rule);
            $rule->setRedirectRule($this);
        }

        return $this;
    }

    public function removeRule(Rule $rule): self
    {
        if ($this->rules->contains($rule)) {
            $this->rules->removeElement($rule);
        }

        return $this;
    }
}
