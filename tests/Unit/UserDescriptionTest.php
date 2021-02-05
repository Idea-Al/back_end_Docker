<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Entity\UserDescription;
use PHPUnit\Framework\TestCase;

class UserDescriptionTest extends TestCase{

    private $userDescription;

    protected function setUp(){
        parent::setUp();
        $this->userDescription = new UserDescription;
        
    }

    public function testGetJourney(){
        $value = 'Insulte';
        $response = $this->userDescription->setJourney($value);
        
        self::assertInstanceOf(UserDescription::class, $response);
        self::assertEquals($value, $this->userDescription->getJourney());
    }

    public function testGetPurpose(){
        $value = 'Insulte';
        $response = $this->userDescription->setPurpose($value);
        
        self::assertInstanceOf(UserDescription::class, $response);
        self::assertEquals($value, $this->userDescription->getPurpose());
    }

    public function testGetAboutMe(){
        $value = 'Insulte';
        $response = $this->userDescription->setAboutMe($value);
        
        self::assertInstanceOf(UserDescription::class, $response);
        self::assertEquals($value, $this->userDescription->getAboutMe());
    }

    public function testGetUser(){
        $value = new User;
        $response = $this->userDescription->setUser($value);
        
        self::assertInstanceOf(UserDescription::class, $response);
        self::assertInstanceOf(User::class, $this->userDescription->getUser());
    }
}