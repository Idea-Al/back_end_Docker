<?php

namespace App\Tests\Unit;

use App\Entity\Job;
use App\Entity\Logbook;
use App\Entity\UserDescription;
use App\Entity\Message;
use App\Entity\Project;
use App\Entity\ProjectDescription;
use App\Entity\ProjectFav;
use App\Entity\Techno;
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
   
   
}