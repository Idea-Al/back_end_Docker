<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @ApiResource()
 */
class Project
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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_participant;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_moderated;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToMany(targetEntity=Techno::class, inversedBy="projects")
     */
    private $technos;

    /**
     * @ORM\OneToMany(targetEntity=ProjectFav::class, mappedBy="project",  orphanRemoval=true)
     */
    private $favorites;
    
    /**
     * @ORM\OneToOne(targetEntity=ProjectDescription::class, mappedBy="project", cascade={"persist", "remove"})
     */
    private $projectDescription;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_completed;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Job::class, inversedBy="projects")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="project")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity=Logbook::class, mappedBy="project")
     */
    private $logbooks;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->technos = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->logbooks = new ArrayCollection();
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

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getMaxParticipant(): ?int
    {
        return $this->max_participant;
    }

    public function setMaxParticipant(int $max_participant): self
    {
        $this->max_participant = $max_participant;

        return $this;
    }

    public function getIsModerated(): ?bool
    {
        return $this->is_moderated;
    }

    public function setIsModerated(bool $is_moderated): self
    {
        $this->is_moderated = $is_moderated;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }



    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

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

    public function getIsCompleted(): ?bool
    {
        return $this->is_completed;
    }

    public function setIsCompleted(bool $is_completed): self
    {
        $this->is_completed = $is_completed;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Techno[]
     */
    public function getTechnos(): Collection
    {
        return $this->technos;
    }

    public function addTechno(Techno $techno): self
    {
        if (!$this->technos->contains($techno)) {
            $this->technos[] = $techno;
        }

        return $this;
    }

    public function removeTechno(Techno $techno): self
    {
        $this->technos->removeElement($techno);

        return $this;
    }
    
    /**
     * @return Collection|ProjectFav[]
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(ProjectFav $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites[] = $favorite;
            $favorite->setProject($this);
        }

        return $this;
    }

    public function removeFavorite(ProjectFav $favorite): self
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getProject() === $this) {
                $favorite->setProject(null);
            }
        }

        return $this;
    }

    public function getProjectDescription(): ?ProjectDescription
    {
        return $this->projectDescription;
    }

    public function setProjectDescription(?ProjectDescription $projectDescription): self
    {
        $this->projectDescription = $projectDescription;

        // set (or unset) the owning side of the relation if necessary
        $newProject = null === $projectDescription ? null : $this;
        if ($projectDescription->getProject() !== $newProject) {
            $projectDescription->setProject($newProject);
        }

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        $this->jobs->removeElement($job);

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setProject($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getProject() === $this) {
                $message->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Logbook[]
     */
    public function getLogbooks(): Collection
    {
        return $this->logbooks;
    }

    public function addLogbook(Logbook $logbook): self
    {
        if (!$this->logbooks->contains($logbook)) {
            $this->logbooks[] = $logbook;
            $logbook->setProject($this);
        }

        return $this;
    }

    public function removeLogbook(Logbook $logbook): self
    {
        if ($this->logbooks->removeElement($logbook)) {
            // set the owning side to null (unless already changed)
            if ($logbook->getProject() === $this) {
                $logbook->setProject(null);
            }
        }

        return $this;
    }



}
