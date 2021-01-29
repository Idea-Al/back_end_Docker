<?php

namespace App\Tests\Unit;

use App\Entity\Realization;
use App\Entity\Techno;
use PHPUnit\Framework\TestCase;

class RealizationTest extends TestCase{
    private $realization;

    protected function setUp(){

        parent::setUp();
        $this->realization = new Realization;
    }

    public function testGetName(){
        $value = 'Projet Facebook';
        $response = $this->realization->setName($value);
        
        self::assertInstanceOf(Realization::class, $response);
        self::assertEquals($value, $this->realization->getName());
    }
    public function testGetDescription(){
        $value = 'Un réseau social qui va bouleverser internet';
        $response = $this->realization->setDescription($value);
        
        self::assertInstanceOf(Realization::class, $response);
        self::assertEquals($value, $this->realization->getDescription());
    }

    public function testGetScreen(){
       
        $value = 'blablablabla';
      
        $response = $this->realization->setScreen($value);
        
        self::assertInstanceOf(Realization::class, $response);
        self::assertEquals($value, $this->realization->getScreen());
    }

    public function testGetScreen2(){
       
        $value = 'blablablabla bah ouais';
      
        $response = $this->realization->setScreen2($value);
        
        self::assertInstanceOf(Realization::class, $response);
        self::assertEquals($value, $this->realization->getScreen2());
    }

    public function testGetRepoLink(){
       
        $value = 'blablablabla bah ouais';
      
        $response = $this->realization->setRepoLink($value);
        
        self::assertInstanceOf(Realization::class, $response);
        self::assertEquals($value, $this->realization->getRepoLink());
    }

    public function testGetWebsiteLink(){
       
        $value = 'blablablabla bah ouais';
      
        $response = $this->realization->setWebsiteLink($value);
        
        self::assertInstanceOf(Realization::class, $response);
        self::assertEquals($value, $this->realization->getWebsiteLink());
    }

    public function testGetTechnos(){
        for($i = 1; $i <= 5; $i++){
            $values[] = new Techno;
        }
        foreach($values as $value){
            $response = $this->realization->addTechno($value);
        }

        self::assertInstanceOf(Realization::class, $response);
        self::assertCount(5, $this->realization->getTechnos());
    }
}