<?php

namespace App\Entity;

use App\Repository\ThreadUserFollowsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass=ThreadUserFollowsRepository::class)
 * @Table("threaduserfollowsTable")
 */
class ThreadUserFollow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Thread",inversedBy="id")
     */
    private $thread;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="id")
     */
    private $user;

    public function getId(): int
    {
        return $this->id;
    }

    public function getThread(): Thread
    {
        return $this->thread;
    }

    public function setThread(Thread $thread): self
    {
        $this->thread = $thread;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
