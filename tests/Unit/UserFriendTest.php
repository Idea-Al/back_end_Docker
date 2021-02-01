<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Entity\UserFriend;
use PHPUnit\Framework\TestCase;

class UserFriendTest extends TestCase{

    private $userFriend;

    protected function setUp(){
        parent::setUp();
        $this->userFriend = new UserFriend();
        
    }

    public function testGetUser(){
        $value = new User;
        $response = $this->userFriend->setUser($value);

        self::assertInstanceOf(UserFriend::class, $response);
        self::assertInstanceOf(User::class, $this->userFriend->getUser());
        
    }

    public function testGetFriend(){
        $value = new User;
        $response = $this->userFriend->setFriend($value);

        self::assertInstanceOf(UserFriend::class, $response);
        self::assertInstanceOf(User::class, $this->userFriend->getFriend());
        
    }

    public function testGetIsAnswered(){
        $value = true;
        $response = $this->userFriend->setIsAnswered($value);

        self::assertInstanceOf(UserFriend::class, $response);
        self::assertIsBool($value, $this->userFriend->getIsAnswered());
        
    }

    public function testGetIsAccepted(){
        $value = false;
        $response = $this->userFriend->setIsAccepted($value);

        self::assertInstanceOf(UserFriend::class, $response);
        self::assertIsBool($value, $this->userFriend->getIsAccepted());
        
    }

    public function testGetCreatedAt(){

        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->userFriend->setCreatedAt($dateTime);

        self::assertInstanceOf(UserFriend::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }

    public function testGetUpdatedAt(){


        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->userFriend->setUpdatedAt($dateTime);

        self::assertInstanceOf(UserFriend::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }


}