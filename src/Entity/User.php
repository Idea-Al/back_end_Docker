<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Api\FilterInterface;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 *     iri="http://schema.org/User"
 * )
 * 
 * @UniqueEntity(fields={"pseudo"})
 * @UniqueEntity(fields={"email"})
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write", "realization:read", "logbook:read"})
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $password;
     
    /**
     * @Groups("user:write")
     * 
     * @SerializedName("password")
     *
     * @Assert\NotBlank(message="New password can not be blank.")
     * @Assert\Regex(pattern="/^(?=.{10,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/i",
     *  message="Password is required to be minimum 6 chars in length and to include at least one letter and one number and one special character.")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $avatar;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $school;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status = true ;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("user:read")
     */
    private $is_active = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_banned = false;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("user:read")
     */
    private $created_at ;

    /**
     * @ORM\Column(type="datetime", nullable=true))
     */
    private $updated_at;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\ManyToOne(targetEntity=Job::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=true)
     * @Groups("user:read")
     */
    private $job;

    /**
     * @ORM\OneToOne(targetEntity=UserDescription::class, mappedBy="user", orphanRemoval=true)
     * @Groups({"user:read",  "user:write"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=ProjectFav::class, mappedBy="user",  orphanRemoval=true)
     * @Groups({"user:read", "user:write"})
     */
    private $favorite_projects;

    /**
     * @ORM\OneToMany(targetEntity=Learning::class, mappedBy="user", orphanRemoval=true)
     *  @Groups({"user:read", "user:write"})
     */
    private $learnings;

    /**
     * @ORM\OneToMany(targetEntity=UserFriend::class, mappedBy="user")
     *  @Groups({"user:read", "user:write"})
     */
    private $friends;

    /**
     * @ORM\OneToMany(targetEntity=UserFriend::class, mappedBy="friend")
     * @Groups({"user:read", "user:write"})
     */
    private $friendWithMe;


    /**
     * @ORM\OneToMany(targetEntity=UserReport::class, mappedBy="reporter", orphanRemoval=true)
     * 
     */
    private $reportedUsers;

    /**
     * @ORM\OneToMany(targetEntity=UserReport::class, mappedBy="reportee", orphanRemoval=true)
     */
    private $reportedBy;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="sender")
     */
    private $messages_sent;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="receiver")
     */
    private $messages_received;

    // /**
    //  * @ORM\Column(type="string", length=255, nullable = true)
    //  */
    // private $slug;

    /**
     * @ORM\OneToMany(targetEntity=UserFav::class, mappedBy="userLiked", orphanRemoval=true)
     */
    private $send_fav;

    /**
     * @ORM\OneToMany(targetEntity=UserFav::class, mappedBy="userLike", orphanRemoval=true)
     */
    private $receive_fav;

    /**
     * @ORM\ManyToOne(targetEntity=Rhythm::class)
     * @Groups({"user:read", "user:write"})
     */
    private $rhythm;

    /**
     * @ORM\OneToMany(targetEntity=Logbook::class, mappedBy="user")
     */
    private $logbooks;

    /**
     * @ORM\OneToMany(targetEntity=Realization::class, mappedBy="user",cascade={"persist"})
     * @Groups({"user:read", "user:write"})
     */
    private $realizations;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $confirmationToken;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->logbooks = new ArrayCollection();
        $this->favorite_projects = new ArrayCollection();
        $this->learnings = new ArrayCollection();
        $this->friends = new ArrayCollection();
        $this->friendWithMe = new ArrayCollection();
        $this->reportedUsers = new ArrayCollection();
        $this->reportedBy = new ArrayCollection();
        $this->messages_sent = new ArrayCollection();
        $this->messages_received = new ArrayCollection();
        $this->send_fav = new ArrayCollection();
        $this->receive_fav = new ArrayCollection();
        $this->realizations = new ArrayCollection();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }



    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
         $this->plainPassword = null;
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
            $logbook->setUser($this);
        }

        return $this;
    }

    public function removeLogbook(Logbook $logbook): self
    {
        if ($this->logbooks->removeElement($logbook)) {
            // set the owning side to null (unless already changed)
            if ($logbook->getUser() === $this) {
                $logbook->setUser(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(?string $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getIsBanned(): ?bool
    {
        return $this->is_banned;
    }

    public function setIsBanned(bool $is_banned): self
    {
        $this->is_banned = $is_banned;

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

    // public function getSlug(): ?string
    // {
    //     return $this->slug;
    // }

    // public function setSlug(string $slug): self
    // {
    //     $this->slug = $slug;

    //     return $this;
    // }


    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }
    
    public function getDescription(): ?UserDescription
    {
        return $this->description;
    }

    public function setDescription(?UserDescription $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ProjectFav[]
     */
    public function getFavoriteProjects(): Collection
    {
        return $this->favorite_projects;
    }

    public function addFavoriteProject(ProjectFav $favoriteProject): self
    {
        if (!$this->favorite_projects->contains($favoriteProject)) {
            $this->favorite_projects[] = $favoriteProject;
            $favoriteProject->setUser($this);
        }

        return $this;
    }

    public function removeFavoriteProject(ProjectFav $favoriteProject): self
    {
        if ($this->favorite_projects->removeElement($favoriteProject)) {
            // set the owning side to null (unless already changed)
            if ($favoriteProject->getUser() === $this) {
                $favoriteProject->setUser(null);
            }
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
            $learning->setUser($this);
        }

        return $this;
    }

    public function removeLearning(Learning $learning): self
    {
        if ($this->learnings->removeElement($learning)) {
            // set the owning side to null (unless already changed)
            if ($learning->getUser() === $this) {
                $learning->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserFriend[]
     */
    public function getFriends(): Collection
    {
        return $this->friends;
    }

    public function addFriend(UserFriend $friend): self
    {
        if (!$this->friends->contains($friend)) {
            $this->friends[] = $friend;
            $friend->setUser($this);
        }

        return $this;
    }

    public function removeFriend(UserFriend $friend): self
    {
        if ($this->friends->removeElement($friend)) {
            // set the owning side to null (unless already changed)
            if ($friend->getUser() === $this) {
                $friend->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserFriend[]
     */
    public function getFriendWithMe(): Collection
    {
        return $this->friendWithMe;
    }

    public function addFriendWithMe(UserFriend $friendWithMe): self
    {
        if (!$this->friendWithMe->contains($friendWithMe)) {
            $this->friendWithMe[] = $friendWithMe;
            $friendWithMe->setFriend($this);
        }

        return $this;
    }

    public function removeFriendWithMe(UserFriend $friendWithMe): self
    {
        if ($this->friendWithMe->removeElement($friendWithMe)) {
            // set the owning side to null (unless already changed)
            if ($friendWithMe->getFriend() === $this) {
                $friendWithMe->setFriend(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserReport[]
     */
    public function getReportedUsers(): Collection
    {
        return $this->reportedUsers;
    }

    public function addReportedUser(UserReport $reportedUser): self
    {
        if (!$this->reportedUsers->contains($reportedUser)) {
            $this->reportedUsers[] = $reportedUser;
            $reportedUser->setReporter($this);
        }

        return $this;
    }

    public function removeReportedUser(UserReport $reportedUser): self
    {
        if ($this->reportedUsers->removeElement($reportedUser)) {
            // set the owning side to null (unless already changed)
            if ($reportedUser->getReporter() === $this) {
                $reportedUser->setReporter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserReport[]
     */
    public function getReportedBy(): Collection
    {
        return $this->reportedBy;
    }

    public function addReportedBy(UserReport $reportedBy): self
    {
        if (!$this->reportedBy->contains($reportedBy)) {
            $this->reportedBy[] = $reportedBy;
            $reportedBy->setReportee($this);
        }

        return $this;
    }

    public function removeReportedBy(UserReport $reportedBy): self
    {
        if ($this->reportedBy->removeElement($reportedBy)) {
            // set the owning side to null (unless already changed)
            if ($reportedBy->getReportee() === $this) {
                $reportedBy->setReportee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessagesSent(): Collection
    {
        return $this->messages_sent;
    }

    public function addMessagesSent(Message $messagesSent): self
    {
        if (!$this->messages_sent->contains($messagesSent)) {
            $this->messages_sent[] = $messagesSent;
            $messagesSent->setSender($this);
        }

        return $this;
    }

    public function removeMessagesSent(Message $messagesSent): self
    {
        if ($this->messages_sent->removeElement($messagesSent)) {
            // set the owning side to null (unless already changed)
            if ($messagesSent->getSender() === $this) {
                $messagesSent->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessagesReceived(): Collection
    {
        return $this->messages_received;
    }

    public function addMessagesReceived(Message $messagesReceived): self
    {
        if (!$this->messages_received->contains($messagesReceived)) {
            $this->messages_received[] = $messagesReceived;
            $messagesReceived->setReceiver($this);
        }

        return $this;
    }

    public function removeMessagesReceived(Message $messagesReceived): self
    {
        if ($this->messages_received->removeElement($messagesReceived)) {
            // set the owning side to null (unless already changed)
            if ($messagesReceived->getReceiver() === $this) {
                $messagesReceived->setReceiver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserFav[]
     */
    public function getSendFav(): Collection
    {
        return $this->send_fav;
    }

    public function addSendFav(UserFav $sendFav): self
    {
        if (!$this->send_fav->contains($sendFav)) {
            $this->send_fav[] = $sendFav;
            $sendFav->setUserLiked($this);
        }

        return $this;
    }

    public function removeSendFav(UserFav $sendFav): self
    {
        if ($this->send_fav->removeElement($sendFav)) {
            // set the owning side to null (unless already changed)
            if ($sendFav->getUserLiked() === $this) {
                $sendFav->setUserLiked(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserFav[]
     */
    public function getReceiveFav(): Collection
    {
        return $this->receive_fav;
    }

    public function addReceiveFav(UserFav $receiveFav): self
    {
        if (!$this->receive_fav->contains($receiveFav)) {
            $this->receive_fav[] = $receiveFav;
            $receiveFav->setUserLike($this);
        }

        return $this;
    }

    public function removeReceiveFav(UserFav $receiveFav): self
    {
        if ($this->receive_fav->removeElement($receiveFav)) {
            // set the owning side to null (unless already changed)
            if ($receiveFav->getUserLike() === $this) {
                $receiveFav->setUserLike(null);
            }
        }

        return $this;
    }

    public function getRhythm(): ?Rhythm
    {
        return $this->rhythm;
    }

    public function setRhythm(?Rhythm $rhythm): self
    {
        $this->rhythm = $rhythm;

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
            $realization->setUser($this);
        }

        return $this;
    }

    public function removeRealization(Realization $realization): self
    {
        if ($this->realizations->removeElement($realization)) {
            // set the owning side to null (unless already changed)
            if ($realization->getUser() === $this) {
                $realization->setUser(null);
            }
        }

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }


    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }
}
