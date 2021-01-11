<?php
namespace App\EventSubscriber;

// ...

use App\Service\MailerService;
use CoopTilleuls\ForgotPasswordBundle\Event\CreateTokenEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;

final class ForgotPasswordEventSubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public static function getSubscribedEvents()
    {
        return [
            // Symfony 4.3 and inferior, use 'coop_tilleuls_forgot_password.create_token' event name
            CreateTokenEvent::class => 'onCreateToken',
        ];
    }

    public function onCreateToken(CreateTokenEvent $event)
    {

        $mailerService = new MailerService($this->mailer);

        

        $passwordToken = $event->getPasswordToken();
        $user = $passwordToken->getUser();

        $email = $user->getEmail();
        $resetToken = $passwordToken->getToken();
        $username = $user->getUsername();
        $mailerService->sendToken($resetToken, $email, $username, null, 'résiliation de votre mot de passe', 'reset_password/email.html.twig');
        dd('coucou');
       
        //    throw new \RuntimeException('Unable to send email');
        
    }
}