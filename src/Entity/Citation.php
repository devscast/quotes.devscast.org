<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\CitationRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CitationRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]
class Citation
{
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    private ?string $french = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    private ?string $english = null;

    #[ORM\Column(length: 255)]
    private ?string $unique_hash;

    #[ORM\ManyToOne(inversedBy: 'citations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Author $author = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?DateTimeImmutable $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrench(): ?string
    {
        return $this->french;
    }

    public function setFrench(string $french): self
    {
        $this->french = $french;

        return $this;
    }

    public function getEnglish(): ?string
    {
        $this->unique_hash = md5(strtolower(str_replace(' ', '', $this->english)));

        return $this->english;
    }

    public function setEnglish(string $english): self
    {
        $this->english = $english;

        return $this;
    }

    public function getUniqueHash(): ?string
    {
        return $this->unique_hash;
    }

    public function setUniqueHash(string $unique_hash): self
    {
        $this->unique_hash = $unique_hash;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function __toString(): string
    {
        return $this->author;
    }

}
