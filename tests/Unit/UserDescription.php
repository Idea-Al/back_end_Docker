<?php

namespace App\Tests\Unit;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserDescription extends TestCase{

    private $userDescription;

    protected function setUp(){
        parent::setUp();
        $this->userDescription = new UserDescription;
        
    }

    public function testGetJourney(){
        $value = 'De cuisinier à développeur';
        $response = $this->userDescription->setJourney($value);
        
        self::assertInstanceOf(UserDescription::class, $response);
        self::assertEquals($value, $this->userDescription->getJourney());
    }
   
    public function testGetPurpose(){
        $value = 'Je cherche à améliorer la qualité de mon code';
        $response = $this->userDescription->setPurpose($value);
        
        self::assertInstanceOf(UserDescription::class, $response);
        self::assertEquals($value, $this->userDescription->getPurpose());
    }

    public function testGetAboutMe(){
        $value = '32 ans, je code au calme avec ma petite bière';
        $response = $this->userDescription->setAboutMe($value);
        
        self::assertInstanceOf(UserDescription::class, $response);
        self::assertEquals($value, $this->userDescription->getAboutMe());
    }
    
    public function testGetUser(){
        $value = new User;
        $response = $this->project->setUser($value);
        
        self::assertInstanceOf(UserDescription::class, $response);
        self::assertEquals($value, $this->userDescription->getAboutMe());
    }
    
}