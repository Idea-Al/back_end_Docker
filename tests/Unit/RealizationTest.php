<?php

namespace App\Tests\Unit;

use App\Entity\Realization;
use App\Entity\Techno;
use App\Entity\User;
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
        $value = new Techno;
        $value1 = new Techno;
        $value2 = new Techno;

        $this->realization->addTechno($value);
        $this->realization->addTechno($value1);
        $this->realization->addTechno($value2);

        self::assertCount(3, $this->realization->getTechnos());
        self::assertTrue($this->realization->getTechnos()->contains($value));
        self::assertTrue($this->realization->getTechnos()->contains($value1));
        self::assertTrue($this->realization->getTechnos()->contains($value2));

        $response = $this->realization->removeTechno($value1);

        self::assertInstanceOf(Realization::class, $response);
        self::assertCount(2, $this->realization->getTechnos());
        self::assertTrue($this->realization->getTechnos()->contains($value));
        self::assertFalse($this->realization->getTechnos()->contains($value1));
        self::assertTrue($this->realization->getTechnos()->contains($value2));
    }

    public function testGetUser(){
        $value = new User;
        
        $response = $this->realization->setUser($value);

        self::assertInstanceOf(Realization::class, $response);
        self::assertInstanceOf(User::class, $this->realization->getUser());
    }
}