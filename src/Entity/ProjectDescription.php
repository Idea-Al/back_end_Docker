<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectDescriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProjectDescriptionRepository::class)
 * @ApiResource()
 */
class ProjectDescription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"project:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"project:read","project:write"})
     */
    private $purpose; 

    /**
     * @ORM\Column(type="text")
     * @Groups({"project:read","project:write"})
     */
    private $target;

    /**
     * @ORM\Column(type="text")
     * @Groups({"project:read", "project:write"})
     */
    private $learningSkill; 

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="projectDescription")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     */
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPurpose(): ?string
    {
        return $this->purpose;
    }

    public function setPurpose(string $purpose): self
    {
        $this->purpose = $purpose;

        return $this;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function setTarget(string $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function getLearningSkill(): ?string
    {
        return $this->learningSkill;
    }

    public function setLearningSkill(string $learningSkill): self
    {
        $this->learningSkill = $learningSkill;

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
}
