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
class Posts extends Threads implements JsonSerializable
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
    private $body;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="titles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Threads",inversedBy="id")
     */
    private $thread_id;


    /**
     * @return mixed
     */
    public function getThreadId()
    {
        return $this->thread_id;
    }

    /**
     * @param mixed $thread_id
     */
    public function setThreadId($thread_id): void
    {
        $this->thread_id = $thread_id;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }



    public function jsonSerialize()
    {
        return [
            "id"=>$this->getId(),
            "body" => $this->getBody(),
            "created_time"=>$this->getDateTime(),
            "user" => $this->getUser(),
            "thread_id" => $this->getThreadId()
        ];
    }
}
