<?php

namespace App\Entity;

use App\Repository\CatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CatRepository::class)]
#[ORM\Table(name: '`cat`')]
class Cat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 75)]
    #[Assert\NotBlank]
    private $name;

    #[ORM\ManyToOne(targetEntity: Breed::class, inversedBy: 'cats')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?Breed $breed = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    #[Assert\Type("\Date")]
    private $borned;

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

    public function getBreed()
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function getBorned(): ?\DateTimeInterface
    {
        return $this->borned;
    }

    public function setBorned(\DateTimeInterface $borned): self
    {
        $this->borned = $borned;

        return $this;
    }

    public function __toArray(): array
    {
        return [
            'id' => $this->getId(),
            'cat_name' => $this->getName(),
            'breed_name' => $this->getBreed()?->getName(),
        ];
    }
}
