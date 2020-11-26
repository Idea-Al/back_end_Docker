<?php

namespace App\Entity;

use App\Repository\UserReportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserReportRepository::class)
 */
class UserReport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reportedUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reporter;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reportedBy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reportee;

    /**
     * @ORM\ManyToOne(targetEntity=Complaint::class, inversedBy="userReports")
     */
    private $reason;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $custom_reason;


    /**
    *@ORM\Column(type="string", length=255, nullable=true)
    */
    private $screen;
    
    /**
    *@ORM\Column(type="string", length=255, nullable=true)
    */
    private $screen2;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_confirmed;

    /**
    * @ORM\Column(type="datetime")
    */
    private $created_at;

    /**
    * @ORM\Column(type="datetime")
    */
    private $updated_at;

   

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomReason(): ?string
    {
        return $this->custom_reason;
    }

    public function setCustomReason(?string $custom_reason): self
    {
        $this->custom_reason = $custom_reason;

        return $this;
    }

    public function getScreen(): ?string
    {
        return $this->screen;
    }

    public function setScreen(?string $screen): self
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

    public function getIsConfirmed(): ?bool
    {
        return $this->is_confirmed;
    }

    public function setIsConfirmed(bool $is_confirmed): self
    {
        $this->is_confirmed = $is_confirmed;

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

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getReporter(): ?User
    {
        return $this->reporter;
    }

    public function setReporter(?User $reporter): self
    {
        $this->reporter = $reporter;

        return $this;
    }

    public function getReportee(): ?User
    {
        return $this->reportee;
    }

    public function setReportee(?User $reportee): self
    {
        $this->reportee = $reportee;

        return $this;
    }

    public function getReason(): ?Complaint
    {
        return $this->reason;
    }

    public function setReason(?Complaint $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

}