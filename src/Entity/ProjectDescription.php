<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectDescriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ProjectDescriptionRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"projectDescription:read"}},
 *     denormalizationContext={"groups"={"projectDescription:write"}},
 *     iri="http://schema.org/ProjectDescription"
 * )
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
     * @Groups({"project:read","project:write", "projectDescription:read", "projectDescription:write"})
     * @Assert\NotBlank(message="Bah? Il a bien un objectif ton projet, non?")
     * @Assert\Length(
     *      min = 100,
     *      max = 1500,
     *      minMessage = "Moins de {{ limit }} caractères? Pense a détailler un peu plus.",
     *      maxMessage = "Il te faut vraiment plus de {{ limit }} caractères?? Va à l'essentiel."
     * )
     */
    private $purpose; 

    /**
     * @ORM\Column(type="text")
     * @Groups({"project:read","project:write", "projectDescription:read", "projectDescription:write"})
     * @Assert\NotBlank(message="Quel profil visitera ton site selon toi?")
     * @Assert\Length(
     *      min = 30,
     *      max = 500,
     *      minMessage = "Allez, un petit effort ! Il te faut au moins {{ limit }} caractères",
     *      maxMessage = "Il te faut vraiment plus de {{ limit }} caractères?? Va à l'essentiel."
     * )
     */
    private $target;

    /**
     * @ORM\Column(type="text")
     * @Groups({"project:read", "project:write", "projectDescription:read", "projectDescription:write"})
     * @Assert\NotBlank(message="Il y a bien quelque chose que tu veux apprendre à travers ce projet")
     * @Assert\Length(
     *      min = 30,
     *      max = 350,
     *      minMessage = "Allez, un petit effort ! Il te faut au moins {{ limit }} caractères",
     *      maxMessage = "Il te faut vraiment plus de {{ limit }} caractères?? Va à l'essentiel."
     * )
     */
    private $learningSkill; 

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="projectDescription")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     * @Groups({"projectDescription:read", "projectDescription:write"})
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
