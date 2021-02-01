<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 * @ApiResource(normalizationContext={"groups"={"job:read"}},
 *     iri="http://schema.org/Job")
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"job:read","project:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "project:read", "job:read"}) 
     * @Assert\NotBlank(message="Ce champs est obligatoire. Veuillez le remplir")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Ce champs n'accepte pas les nombres"
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="job")
     * @Groups("job:read")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, mappedBy="jobs")
     * @Groups("job:read")
     */
    private $projects;

    
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->projects = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setJob($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getJob() === $this) {
                $user->setJob(null);
            }
        }

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
            $project->addJob($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeJob($this);
        }

        return $this;
    }
}
