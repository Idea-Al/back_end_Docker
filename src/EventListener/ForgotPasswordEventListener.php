<?php

namespace AppBundle\Event;

// ...
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\User\UserInterface;

class ForgotPasswordEventListener
{
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
}