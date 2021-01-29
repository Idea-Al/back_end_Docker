<?php

namespace App\Tests\Unit;

use App\Entity\Complaint;
use App\Entity\User;
use App\Entity\UserReport;
use PHPUnit\Framework\TestCase;

class UserReportTest extends TestCase{

    private $userReport;

    protected function setUp(){
        parent::setUp();
        $this->userReport = new UserReport;
        
    }

    public function testGetReporter(){
        $value = new User;
        $response = $this->userReport->setReporter($value);
        
        self::assertInstanceOf(UserReport::class, $response);
        self::assertEquals($value, $this->userReport->getReporter());
    }
    public function testGetReportee(){
        $value = new User;
        $response = $this->userReport->setReportee($value);
        
        self::assertInstanceOf(UserReport::class, $response);
        self::assertEquals($value, $this->userReport->getReportee());
    }

    public function testGetReason(){
        $value = new Complaint;
        $response = $this->userReport->setReason($value);
        
        self::assertInstanceOf(UserReport::class, $response);
        self::assertEquals($value, $this->userReport->getReason());
    }
    
    public function testGetCustomReason(){
        $value = 'Ya rien a faire';
        $response = $this->userReport->setCustomReason($value);
        
        self::assertInstanceOf(UserReport::class, $response);
        self::assertEquals($value, $this->userReport->getCustomReason());
    }

    public function testGetScreen(){
        $value = 'Ya rien a faire';
        $response = $this->userReport->setScreen($value);
        
        self::assertInstanceOf(UserReport::class, $response);
        self::assertEquals($value, $this->userReport->getScreen());
    }

    public function testGetIsConfirmed(){
        $value = true;
        $response = $this->userReport->setIsConfirmed($value);

        self::assertInstanceOf(UserReport::class, $response);
        self::assertIsBool($value, $this->userReport->getIsConfirmed());
        
    }

    public function testGetCreatedAt(){

        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->userReport->setCreatedAt($dateTime);

        self::assertInstanceOf(UserReport::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }

    public function testGetUpdatedAt(){


        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->userReport->setUpdatedAt($dateTime);

        self::assertInstanceOf(UserReport::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }
}