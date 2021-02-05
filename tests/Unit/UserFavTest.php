<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Entity\UserFav;
use PHPUnit\Framework\TestCase;

class UserFavTest extends TestCase{

    private $userFav;

    protected function setUp(){
        parent::setUp();
        $this->userFav = new UserFav();
        
    }

    public function testGetUserLiked(){
        $value = new User;
        $response = $this->userFav->setUserLiked($value);

        self::assertInstanceOf(UserFav::class, $response);
        self::assertInstanceOf(User::class, $this->userFav->getUserLiked());
        
    }

    public function testGetUserLike(){
        $value = new User;
        $response = $this->userFav->setUserLike($value);

        self::assertInstanceOf(UserFav::class, $response);
        self::assertInstanceOf(User::class, $this->userFav->getUserLike());
        
    }

}