<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LogbookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LogbookRepository::class)
 * @ApiResource(normalizationContext={"groups"={"logbook:read"}},
 *     iri="http://schema.org/Logbook")
 */
class Logbook
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"project:read", "logbook:read"})
     */
    private $task;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="logbooks")
     * @Groups("logbook:read")
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="logbooks")
     * @Groups("logbook:read")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("logbook:read")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("logbook:read")
     */
    private $updated_at;




    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(string $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    
}