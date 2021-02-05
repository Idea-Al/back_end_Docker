<?php

namespace App\Tests\Unit;

use App\Entity\Logbook;
use App\Entity\Project;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class LogbookTest extends TestCase{

    private $logbook;

    protected function setUp(){
        parent::setUp();
        $this->logbook = new Logbook;
        
    }

    public function testGetTask(){
        $value = 'J\'ai créer les entités';
        $response = $this->logbook->setTask($value);
        
        self::assertInstanceOf(Logbook::class, $response);
        self::assertEquals($value, $this->logbook->getTask());
    }

    public function testGetProject(){
        $value= new Project;
        $response = $this->logbook->setProject($value);
        
        self::assertInstanceOf(Logbook::class, $response);
        self::assertInstanceOf(Project::class, $this->logbook->getProject());
    }

    public function testGetUser(){
        $value= new User;
        $response = $this->logbook->setUser($value);
        
        self::assertInstanceOf(Logbook::class, $response);
        self::assertInstanceOf(User::class, $this->logbook->getUser());
    }

    public function testGetCreatedAt(){

        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->logbook->setCreatedAt($dateTime);

        self::assertInstanceOf(Logbook::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }

    public function testGetUpdatedAt(){


        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->logbook->setUpdatedAt($dateTime);

        self::assertInstanceOf(Logbook::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }


}