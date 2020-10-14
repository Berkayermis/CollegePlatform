<?php

namespace App\Entity;

use App\Repository\ThreadUserFollowsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThreadUserFollowsRepository::class)
 */
class ThreadUserFollows
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToMany(targetEntity="App\Entity\Threads",inversedBy="id")
     */
    private $thread_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="id")
     */
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThreadId(): ?int
    {
        return $this->thread_id;
    }

    public function setThreadId(int $thread_id): self
    {
        $this->thread_id = $thread_id;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
