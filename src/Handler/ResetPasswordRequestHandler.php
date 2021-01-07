<?php



namespace App\Handler;

use App\Entity\ResetPasswordRequest;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ResetPasswordRequestHandler implements MessageHandlerInterface
{
    public function __invoke(ResetPasswordRequest $forgotPassword)
    {
        dd($forgotPassword);
    }
}