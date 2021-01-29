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

        for($i = 1; $i <= 4; $i++ )
        {
            $values[] = new UserReport;
        }        
     

        foreach($values as $value){
        $response = $this->complaint->addUserReport($value);
    }
        
        self::assertInstanceOf(Complaint::class, $response);
        self::assertCount(4, $this->complaint->getUserReports());
    }

}