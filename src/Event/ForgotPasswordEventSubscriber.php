<?php
namespace App\Event;

// ...
use CoopTilleuls\ForgotPasswordBundle\Event\UpdatePasswordEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class ForgotPasswordEventSubscriber implements EventSubscriberInterface
{
    private $userManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->_entityManager = $entityManager;
        $this->_passwordEncoder = $passwordEncoder;
    }

    // ...
    /**
     * @param RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event)
    {
        if (!$event->isMasterRequest()
            || !preg_match('/^coop_tilleuls_forgot_password/i', $event->getRequest()->get('_route'))
        ) {
            return;
        }

        // User should not be authenticated on forgot password
        $token = $this->tokenStorage->getToken();
        if (null !== $token && $token->getUser() instanceof UserInterface) {
            throw new AccessDeniedHttpException();
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            // Symfony 4.3 and inferior, use 'coop_tilleuls_forgot_password.update_password' event name
            UpdatePasswordEvent::class => 'onUpdatePassword',
        ];
    }

    public function onUpdatePassword(UpdatePasswordEvent $event)
    {
        //dd($event);
        $passwordToken = $event->getPasswordToken();
        $user = $passwordToken->getUser();
        $user->setPassword($this->_passwordEncoder->encodePassword($user, $event->getPassword()));
        $this->_entityManager->persist($user);
        $this->_entityManager->flush();
    }
}

