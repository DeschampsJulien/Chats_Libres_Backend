<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MemberRepository;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['member:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['member:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['member:read'])]
    private ?string $image = null;

    #[ORM\Column]
    #[Groups(['member:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    // GETTERS & SETTERS
    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getImage(): ?string { return $this->image; }
    public function setImage(?string $image): self { $this->image = $image; return $this; }

    public function getCreatedAt(): ?\DateTimeImmutable { return $this->createdAt; }
    public function setCreatedAt(\DateTimeImmutable $createdAt): self { $this->createdAt = $createdAt; return $this; }
}