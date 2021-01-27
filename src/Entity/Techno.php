<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TechnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=TechnoRepository::class)
 * @ApiResource(normalizationContext={"groups"={"techno:read"}},
 *     denormalizationContext={"groups"={"techno:write"}},
 *     iri="http://schema.org/Techno")
 */
class Techno
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("techno:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"project:read", "realization:read", "techno:read", "user:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"project:read", "realization:read", "techno:read"})
     */
    private $logo;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, mappedBy="technos")
     * @Groups("techno:read")
     */
    private $projects;

    /**
     * @ORM\ManyToMany(targetEntity=Realization::class, mappedBy="technos")
     */
    private $realizations;

    /**
     * @ORM\OneToMany(targetEntity=Learning::class, mappedBy="techno", orphanRemoval=true, cascade={"persist"})
     * @Groups("techno:read")
     */
    private $learnings;


    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->realizations = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->learnings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addTechno($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeTechno($this);
        }

        return $this;
    }

    /**
     * @return Collection|Realization[]
     */
    public function getRealizations(): Collection
    {
        return $this->realizations;
    }

    public function addRealization(Realization $realization): self
    {
        if (!$this->realizations->contains($realization)) {
            $this->realizations[] = $realization;
            $realization->addTechno($this);
        }

        return $this;
    }

    public function removeRealization(Realization $realization): self
    {
        if ($this->realizations->removeElement($realization)) {
            $realization->removeTechno($this);
        }

        return $this;
    }

    /**
     * @return Collection|Learning[]
     */
    public function getLearnings(): Collection
    {
        return $this->learnings;
    }

    public function addLearning(Learning $learning): self
    {
        if (!$this->learnings->contains($learning)) {
            $this->learnings[] = $learning;
            $learning->setTechno($this);
        }

        return $this;
    }

    public function removeLearning(Learning $learning): self
    {
        if ($this->learnings->removeElement($learning)) {
            // set the owning side to null (unless already changed)
            if ($learning->getTechno() === $this) {
                $learning->setTechno(null);
            }
        }

        return $this;
    }

}
