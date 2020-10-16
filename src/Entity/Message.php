<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass=MessagesRepository::class)
 * @Table("messagesTable")
 */
class Message
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
     * @ORM\ManyToMany(targetEntity="App\Entity\User",inversedBy="id")
     */
    private $to_user;

    /**
     * @ORM\ManyToMany (targetEntity="App\Entity\User",inversedBy="id")
     */
    private $from_user;

    public function getId(): int
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

    public function getToUser(): User
    {
        return $this->to_user;
    }

    public function setToUser(User $to_user): self
    {
        $this->to_user = $to_user;

        return $this;
    }

    public function getFromUser(): User
    {
        return $this->from_user;
    }

    public function setFromUser(User $from_user): self
    {
        $this->from_user = $from_user;

        return $this;
    }
}
