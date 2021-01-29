<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"project:read"}},
 *     denormalizationContext={"groups"={"project:write"}},
 *     iri="http://schema.org/Project"
 * )
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"project:read", "techno:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"project:read", "techno:read", "logbook:read", "project:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"project:read", "project:write"})
     */
    private $resume;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"project:read", "project:write"})
     */
    private $maxParticipant;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("project:read")
     */
    private $is_moderated;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"project:read","project:write"})
     */
    private $picture;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"project:read","project:write"})
     */
    private $link;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("project:read")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToMany(targetEntity=Techno::class, inversedBy="projects",cascade={"persist"})
     * @Groups({"project:read","project:write"})
     */
    private $technos;

    /**
     * @ORM\OneToMany(targetEntity=ProjectFav::class, mappedBy="project",  orphanRemoval=true)
     * @Groups({"project:read"})
     */
    private $favorites;
    
    /**
     * @ORM\OneToOne(targetEntity=ProjectDescription::class, mappedBy="project", cascade={"persist", "remove"})
     * @Groups({"project:read","project:write"})
     */
    private $projectDescription;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"project:read"})
     */
    private $is_completed;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"project:read", "project:write"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Job::class, inversedBy="projects")
     * @Groups({"project:read", "project:write"})
     * @ApiProperty(iri="http://schema.org/Jobs")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="project")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity=Logbook::class, mappedBy="project")
     * @Groups("project:read")
     */
    private $logbooks;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creator;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasOwner;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFull;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->technos = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->logbooks = new ArrayCollection();
        $this->is_completed = false;
        $this->is_moderated = false;
        
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
        return $this->maxParticipant;
    }


    public function setMaxParticipant(int $maxParticipant): self
    {

        $this->maxParticipant = $maxParticipant;

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

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getHasOwner(): ?bool
    {
        return $this->hasOwner;
    }

    public function setHasOwner(bool $hasOwner): self
    {
        $this->hasOwner = $hasOwner;

        return $this;
    }

    public function getIsFull(): ?bool
    {
        return $this->isFull;
    }

    public function setIsFull(bool $isFull): self
    {
        $this->isFull = $isFull;

        return $this;
    } 
}
