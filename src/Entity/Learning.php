<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LearningRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LearningRepository::class)
 * @ApiResource()
 */
class Learning
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Techno::class, inversedBy="learnings")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("user:read")
     */
    private $techno;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="learnings")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("techno:read")
     */
    private $user ;

    /**
     * @ORM\ManyToOne(targetEntity=Level::class, inversedBy="learnings")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("user:read")
     */
    private $level ;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTechno(): ?Techno
    {
        return $this->techno;
    }

    public function setTechno(?Techno $techno): self
    {
        $this->techno = $techno;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }
}
