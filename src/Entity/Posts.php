<?php

namespace App\Entity;

use App\Repository\PostRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @Table("Posts")
 */
class Posts implements JsonSerializable
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $body;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="titles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;



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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getDateTime(): ?DateTimeInterface
    {
        return $this->created_date;
    }

    public function setDateTime(DateTimeInterface $DateTime): self
    {
        $this->created_date = $DateTime;

        return $this;
    }

    public function getUserID(): ?User
    {
        return $this->user_id;
    }

    public function setUserID(?User $userID): self
    {
        $this->user_id = $userID;

        return $this;
    }


    public function jsonSerialize()
    {
        return [
            "id"=>$this->getId(),
            "title" => $this->getTitle(),
            "body" => $this->getBody(),
            "created_time"=>$this->getDateTime(),
            "user_id" => $this->getUserID()
        ];
    }
}
