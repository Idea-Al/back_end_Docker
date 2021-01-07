<?php

// api/src/Entity/ResetPasswordRequest.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestTrait;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * @ApiResource(
 *     messenger=true,
 *     collectionOperations={
 *         "post"={"status"=202},
 *     },
 *     itemOperations={},
 *     output=false,
 *     normalizationContext={"groups"={"passwordRequest:read"}},
 *     denormalizationContext={"groups"={"passwordRequest:write"}},
 * )
 */
final class ResedddddtPasswordRequest 
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Groups({"passwordRequest:read", "passwordRequest:write"})
     * @ORM\ManyToOne(targetEntity=User::class ) 
     * @ORM\JoinColumn(nullable=false)
     */
    public $user;


    /**
     * @ORM\Column(type="string", length=20)
     *
     */
    private $selector;

    /**
     * @ORM\Column(type="string", length=100)
     *
     */
    private $hashedToken;

    /**
     * @ORM\Column(type="datetime_immutable")
     *
     */
    private $requestedAt;


    /**
     * @ORM\Column(type="datetime_immutable")
     * 
     * @Groups({"passwordRequest:read", "passwordRequest:write"})
     * 
     */
    private $expires_at;


    public function __construct($user)
    {
        $this->user = $user;
        
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): object
    {
        dd("coucou");
        return $this->user;
    }

    /**
     * Get the value of hashedToken
     */ 
    public function getHashedToken()
    {
        return $this->hashedToken;
    }

    /**
     * Set the value of hashedToken
     *
     * @return  self
     */ 
    public function setHashedToken($hashedToken)
    {
        $this->hashedToken = $hashedToken;

        return $this;
    }

    /**
     * Get the value of selector
     */ 
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * Set the value of selector
     *
     * @return  self
     */ 
    public function setSelector($selector)
    {
        $this->selector = $selector;

        return $this;
    }

    /**
     * Get the value of expiresAt
     */ 
    public function getExpires_at()
    {
        return $this->expires_at;
    }

    /**
     * Set the value of expiresAt
     *
     * @return  self
     */ 
    public function setExpires_at($expires_at)
    {
        $this->expires_at = $expires_at;

        return $this;
    }
}
