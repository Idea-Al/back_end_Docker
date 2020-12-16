<?php

// api/src/Handler/ResetPasswordRequestHandler.php

namespace App\Handler;

use App\Entity\ResetPasswordRequest;
use App\Entity\User;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ResetPasswordRequestHandler implements MessageHandlerInterface
{
    public function __invoke(ResetPasswordRequest $data)
    {
       dd('coucou');
    }
}