<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RealizationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RealizationRepository::class)
 * @ApiResource()
 */
class Realization
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("realization:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("realization:read")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("realization:read")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("realization:read")
     */
    private $screen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("realization:read")
     */
    private $screen2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("realization:read")
     */
    private $repoLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("realization:read")
     */
    private $websiteLink;

    /**
     * @ORM\ManyToMany(targetEntity=Techno::class, inversedBy="realizations")
     * @Groups("realization:read")
     */
    private $technos;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="realizations")
     * @Groups("realization:read")
     */
    private $user;

    public function __construct()
    {
        $this->technos = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getScreen(): ?string
    {
        return $this->screen;
    }

    public function setScreen(string $screen): self
    {
        $this->screen = $screen;

        return $this;
    }

    public function getScreen2(): ?string
    {
        return $this->screen2;
    }

    public function setScreen2(?string $screen2): self
    {
        $this->screen2 = $screen2;

        return $this;
    }

    public function getRepoLink(): ?string
    {
        return $this->repoLink;
    }

    public function setRepoLink(?string $repoLink): self
    {
        $this->repoLink = $repoLink;

        return $this;
    }

    public function getWebsiteLink(): ?string
    {
        return $this->websiteLink;
    }

    public function setWebsiteLink(?string $websiteLink): self
    {
        $this->websiteLink = $websiteLink;

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

}
