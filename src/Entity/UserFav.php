<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserFavRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserFavRepository::class)
 * @ApiResource()
 */
class UserFav
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="send_fav")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userLiked;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="receive_fav")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userLike;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserLiked(): ?User
    {
        return $this->userLiked;
    }

    public function setUserLiked(?User $userLiked): self
    {
        $this->userLiked = $userLiked;

        return $this;
    }

    public function getUserLike(): ?User
    {
        return $this->userLike;
    }

    public function setUserLike(?User $userLike): self
    {
        $this->userLike = $userLike;

        return $this;
    }
}