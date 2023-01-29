<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank,Length(min: 1,max: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank,Length(min: 1)]
    private ?string $content = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true, options: ['default' => 0])]
    private ?bool $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true, options: ['default' => 'now()'])]
    private ?DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $posted_at = null;

    public function __construct()
    {
        $this->setCreatedAt(new DateTime());
        $this->setStatus(false);
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isStatus(): string
    {
        if($this->status) {
            return 'active';
        }

        return 'inactive';
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;
        if($status){
            $this->setPostedAt(new DateTime());
        }

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPostedAt(): ?DateTimeInterface
    {
        return $this->posted_at;
    }

    public function setPostedAt(?DateTimeInterface $posted_at): self
    {
        $this->posted_at = $posted_at;

        return $this;
    }
}
