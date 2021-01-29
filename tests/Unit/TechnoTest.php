<?php

namespace App\Tests\Unit;

use App\Entity\Learning;
use App\Entity\Project;
use App\Entity\Realization;
use App\Entity\Techno;
use PHPUnit\Framework\TestCase;

class TechnoTest extends TestCase{

    private $techno;

    protected function setUp(){
        parent::setUp();
        $this->techno = new Techno();
        
    }

    public function testGetName(){
        $value = 'PHP';
        $response = $this->techno->setName($value);
        
        self::assertInstanceOf(Techno::class, $response);
        self::assertEquals($value, $this->techno->getName());
    }

    public function testGetLogo(){
        $value = 'PHP';
        $response = $this->techno->setLogo($value);
        
        self::assertInstanceOf(Techno::class, $response);
        self::assertEquals($value, $this->techno->getLogo());
    }


    public function testGetProjects(){

        for($i = 1; $i <= 3; $i++ )
        {
            $values[] = new Project;
        }        
     

        foreach($values as $value){
        $response = $this->techno->addProject($value);
    }
        
        self::assertInstanceOf(Techno::class, $response);
        self::assertCount(3, $this->techno->getProjects());
    }

    public function testGetRealizations(){

        for($i = 1; $i <= 3; $i++ )
        {
            $values[] = new Realization;
        }        

        foreach($values as $value){
        $response = $this->techno->addRealization($value);
    }
        
        self::assertInstanceOf(Techno::class, $response);
        self::assertCount(3, $this->techno->getRealizations());
    }

    public function testGetLearnings(){

        for($i = 1; $i <= 3; $i++ )
        {
            $values[] = new Learning;
        }        
     

        foreach($values as $value){
        $response = $this->techno->addLearning($value);
    }
        
        self::assertInstanceOf(Techno::class, $response);
        self::assertCount(3, $this->techno->getLearnings());
    }

}