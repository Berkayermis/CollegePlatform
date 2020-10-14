<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessagesRepository::class)
 */
class Messages
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
    private $message_date;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToMany(targetEntity="App\Entity\User",inversedBy="id")
     */
    private $to_user_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToMany (targetEntity="App\Entity\User",inversedBy="id")
     */
    private $from_user_id;

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

    public function getMessageDate(): ?DateTimeImmutable
    {
        return $this->message_date;
    }

    public function setMessageDate(DateTimeImmutable $message_date): self
    {
        $this->message_date = $message_date;

        return $this;
    }

    public function getToUserId(): ?int
    {
        return $this->to_user_id;
    }

    public function setToUserId(int $to_user_id): self
    {
        $this->to_user_id = $to_user_id;

        return $this;
    }

    public function getFromUserId(): ?int
    {
        return $this->from_user_id;
    }

    public function setFromUserId(int $from_user_id): self
    {
        $this->from_user_id = $from_user_id;

        return $this;
    }
}
