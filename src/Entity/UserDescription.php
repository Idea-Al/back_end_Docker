<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserDescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserDescriptionRepository::class)
 * @ApiResource()
 */
class UserDescription
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
    private $journey;

    /**
     * @ORM\Column(type="text")
     */
    private $purpose;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $aboutMe;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="description")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;


     public function __toString()
     {
        return $this->id;
     }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJourney(): ?string
    {
        return $this->journey;
    }

    public function setJourney(string $journey): self
    {
        $this->journey = $journey;

        return $this;
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

    public function getAboutMe(): ?string
    {
        return $this->aboutMe;
    }

    public function setAboutMe(?string $aboutMe): self
    {
        $this->aboutMe = $aboutMe;

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
}




// League can not exist without Country so this is a composition relationship. 
// The nullable=false forces a composition relationship so if you want to create a League then you 
// have to have a Country to go with it.