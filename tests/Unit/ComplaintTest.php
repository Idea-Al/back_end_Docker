<?php

namespace App\Tests\Unit;

use App\Entity\Complaint;
use App\Entity\UserReport;
use PHPUnit\Framework\TestCase;

class ComplaintTest extends TestCase{

    private $complaint;

    protected function setUp(){
        parent::setUp();
        $this->complaint = new Complaint;
        
    }

    public function testGetName(){
        $value = 'Insulte';
        $response = $this->complaint->setName($value);
        
        self::assertInstanceOf(Complaint::class, $response);
        self::assertEquals($value, $this->complaint->getName());
    }

    public function testGetUserReports(){

        $value = new UserReport;
        $value1 = new UserReport;
        $value2 = new UserReport;  

        $this->complaint->addUserReport($value);
        $this->complaint->addUserReport($value1);
        $this->complaint->addUserReport($value2);

        self::assertCount(3, $this->complaint->getUserReports());
        self::assertTrue($this->complaint->getUserReports()->contains($value));
        self::assertTrue($this->complaint->getUserReports()->contains($value1));
        self::assertTrue($this->complaint->getUserReports()->contains($value2));

        $response = $this->complaint->removeUserReport($value);
     
        self::assertInstanceOf(Complaint::class, $response);
        self::assertCount(2, $this->complaint->getUserReports());
        self::assertFalse($this->complaint->getUserReports()->contains($value));
        self::assertTrue($this->complaint->getUserReports()->contains($value1));
        self::assertTrue($this->complaint->getUserReports()->contains($value2));

}