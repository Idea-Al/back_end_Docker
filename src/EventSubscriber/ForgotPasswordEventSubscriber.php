<?php
namespace AppBundle\EventSubscriber;

// ...
use CoopTilleuls\ForgotPasswordBundle\Event\CreateTokenEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;

final class ForgotPasswordEventSubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, Environment $twig)
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
        $passwordToken = $event->getPasswordToken();
        $user = $passwordToken->getUser();

        if ($form->isValid()) {
            //dd($form->get('email')->getData());
            return $this->processSendingPasswordResetEmail(
                $form->get('email')->getData(),
                $mailer,
            );
        } else {
            // dd($form->getErrors());
            return $this->json((string) $form->getErrors(true), 400);
        }
        
        $swiftMessage->setFrom('no-reply@example.com');
        $swiftMessage->setTo($user->getEmail());
        $swiftMessage->setContentType('text/html');
        if (0 === $this->mailer->send($swiftMessage)) {
            throw new \RuntimeException('Unable to send email');
        }
    }

    private function processSendingPasswordResetEmail(string $emailFormData, MailerInterface $mailer)
    {


        $mailerService = new MailerService($mailer);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([
            'email' => $emailFormData,
        ]);
        // Marks that you are allowed to see the app_check_email page.
        $this->setCanCheckEmailInSession();

        // Do not reveal whether a user account was found or not.
        if (!$user) {
            return $this->redirectToRoute('app_check_email');
        }

        try {

            $resetToken = $this->resetPasswordHelper->generateResetToken($user);
        } catch (ResetPasswordExceptionInterface $e) {
            return $this->json(sprintf(
                'There was a problem handling your password reset request - %s',
                $e->getReason()
            ));
        }


        $email = $user->getEmail();
        $username = $user->getUsername();
        $tokenLifeTime = $this->resetPasswordHelper->getTokenLifetime();
        $tokenLifeTimeInHour = ($tokenLifeTime / 3600);


        $mailerService->sendToken($resetToken, $email, $username, $tokenLifeTime, 'résiliation de votre mot de passe', 'reset_password/email.html.twig');


        return $this->respondWithSuccess(sprintf('Un email contenant le lien pour mofifier votre mot de passe vous a été envoyé, il expirera dans %s heure', $tokenLifeTimeInHour));
    }
}
}