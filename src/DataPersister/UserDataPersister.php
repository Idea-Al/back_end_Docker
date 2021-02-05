<?php 

namespace App\DataPersister;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use App\Service\MailerService;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mime\Address;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;


/**
 *
 */
class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $_passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        MailerService $mailerService,
        ResetPasswordHelperInterface $resetPasswordHelper
    ) {
        $this->_entityManager = $entityManager;
        $this->_passwordEncoder = $passwordEncoder;
        $this->mailerService = $mailerService;
        $this->resetPasswordHelper = $resetPasswordHelper;
    }
    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    /**
     * @param User $data
     */
    public function persist($data, array $context = [])
    {

        $confirmationToken = $data->setConfirmationToken($this->generateToken());
        $data->setPassword($this->_passwordEncoder->encodePassword($data, $data->getPlainPassword()));
        $this->_entityManager->persist($data);
        $this->_entityManager->flush();

        $to = $data->getEmail();
        $info = ['email' => $data->getUsername(), 'username' => $data->getPseudo()]; //
        $tokenLifeTime = $this->resetPasswordHelper->getTokenLifetime();


        $this->mailerService->sendToken($confirmationToken, $to, $info, $tokenLifeTime, 'Confirmation de votre inscription', 'registration/confirmation_email.html.twig');

        

        return new JsonResponse(["data"=>"Votre inscription a été validée, vous allez recevoir un email de confirmation pour activer votre compte et pouvoir vous connecter"], 201);
        //return $this->respondWithSuccess(sprintf('Votre inscription a été validée, vous aller recevoir un email de confirmation pour activer votre compte et pouvoir vous connecter', $data->getPseudo()));
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }

     /**
     * generate a token
     *
     * 
     */
    private function generateToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
}