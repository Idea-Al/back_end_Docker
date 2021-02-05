<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=LevelRepository::class)
 * @ApiResource(
 *      normalizationContext={"groups"={"level:read"}},
 *      denormalizationContext={"groups"={"level:write"}},
 *          collectionOperations={
 *              "get"={},
 *              "post"={},
 *              "CheckLevel"={
 *                  "method" ="GET",
 *                  "path"="/levels",
 *                  "controller"="App\Controller\Api\CheckLevel::class"  
 * },
 *       },
 *)
 */
class Level
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("level:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"level:read", "level:write", "user:read"})
     * @Assert\NotBlank(message="Ce champs est obligatoire. Veuillez le remplir")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Ce champs n'accepte pas les nombres"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"level:read", "level:write"})
     * @Assert\NotBlank(message="Ce champs est obligatoire. Veuillez le remplir")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Ce champs n'accepte pas les nombres"
     * )
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Learning::class, mappedBy="level", orphanRemoval=true, cascade={"persist"})
     * @Groups("level:read")
     */
    private $learnings;

    public function __construct()
    {
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $learning->setLevel($this);
        }

        return $this;
    }

    public function removeLearning(Learning $learning): self
    {
        if ($this->learnings->removeElement($learning)) {
            // set the owning side to null (unless already changed)
            if ($learning->getLevel() === $this) {
                $learning->setLevel(null);
            }
        }

        return $this;
    }
}