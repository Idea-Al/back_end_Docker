<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserDescriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=UserDescriptionRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"userDescription:read"}},
 *     denormalizationContext={"groups"={"userDescription:write"}},
 *     iri="http://schema.org/User"
 * )
 * )
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
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank(message="Il y a bien quelque chose que tu veux apprendre à travers ce projet")
     * @Assert\Length(
     *      min = 30,
     *      max = 350,
     *      minMessage = "Allez, un petit effort ! Il te faut au moins {{ limit }} caractères",
     *      maxMessage = "Il te faut vraiment plus de {{ limit }} caractères?? Va à l'essentiel."
     * )
     */
    private $journey;

    /**
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write", "userDescription:read", "userDescription:write"})
     * @Assert\NotBlank(message="Il y a bien quelque chose que tu veux apprendre à travers ce projet")
     * @Assert\Length(
     *      min = 30,
     *      max = 350,
     *      minMessage = "Allez, un petit effort ! Il te faut au moins {{ limit }} caractères",
     *      maxMessage = "Il te faut vraiment plus de {{ limit }} caractères?? Va à l'essentiel."
     * )
     */
    private $purpose;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"user:read", "user:write","userDescription:read", "userDescription:write" })
     * @Assert\NotBlank(message="Il y a bien quelque chose que tu veux apprendre à travers ce projet")
     * @Assert\Length(
     *      min = 30,
     *      max = 350,
     *      minMessage = "Allez, un petit effort ! Il te faut au moins {{ limit }} caractères",
     *      maxMessage = "Il te faut vraiment plus de {{ limit }} caractères?? Va à l'essentiel."
     * )
     */
    private $aboutMe;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="description")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Groups({"userDescription:read", "userDescription:write" })
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