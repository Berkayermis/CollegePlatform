<?php

namespace App\Entity;

use App\Repository\ThreadsRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThreadsRepository::class)
 */
class Threads
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_date;

    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Categories",inversedBy="id")
     */
    private $category;


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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlugOfThread(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedDate(): ?DateTimeImmutable
    {
        return $this->created_date;
    }

    public function setCreatedDate(DateTimeImmutable $created_date): self
    {
        $this->created_date = $created_date;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category = $category_id;

        return $this;
    }
}
