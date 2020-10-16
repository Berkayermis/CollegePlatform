<?php

namespace App\Entity;

use App\Repository\PostRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @Table("postsTable")
 */
class Post
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Thread",inversedBy="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $thread;


    /**
     * @return mixed
     */
    public function getThread(): Thread
    {
        return $this->thread;
    }

    /**
     * @param $thread
     */
    public function setThread(Thread $thread): void
    {
        $this->thread = $thread;
    }

    public function getId(): int
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
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }


}
