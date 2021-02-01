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
        $value = new Project;
        $value1 = new Project;
        $value2 = new Project;

        $this->techno->addProject($value);
        $this->techno->addProject($value1);
        $this->techno->addProject($value2);

        self::assertCount(3, $this->techno->getProjects());
        self::assertTrue($this->techno->getProjects()->contains($value));
        self::assertTrue($this->techno->getProjects()->contains($value1));
        self::assertTrue($this->techno->getProjects()->contains($value2));

        $response = $this->techno->removeProject($value);
        $response = $this->techno->removeProject($value1);

        self::assertInstanceOf(Techno::class, $response);
        self::assertCount(1, $this->techno->getProjects());
        self::assertFalse($this->techno->getProjects()->contains($value));
        self::assertFalse($this->techno->getProjects()->contains($value1));
        self::assertTrue($this->techno->getProjects()->contains($value2));
    }

    public function testGetRealizations(){

        $value = new Realization;
        $value1 = new Realization;
        $value2 = new Realization;

        $this->techno->addRealization($value);
        $this->techno->addRealization($value1);
        $this->techno->addRealization($value2);

        self::assertCount(3, $this->techno->getRealizations());
        self::assertTrue($this->techno->getRealizations()->contains($value));
        self::assertTrue($this->techno->getRealizations()->contains($value1));
        self::assertTrue($this->techno->getRealizations()->contains($value2));

        $response = $this->techno->removeRealization($value);
        $response = $this->techno->removeRealization($value1);

        self::assertInstanceOf(Techno::class, $response);
        self::assertCount(1, $this->techno->getRealizations());
        self::assertFalse($this->techno->getRealizations()->contains($value));
        self::assertFalse($this->techno->getRealizations()->contains($value1));
        self::assertTrue($this->techno->getRealizations()->contains($value2));
    }

    public function testGetLearnings(){

        $value = new Learning;
        $value1 = new Learning;
        $value2 = new Learning;

        $this->techno->addLearning($value);
        $this->techno->addLearning($value1);
        $this->techno->addLearning($value2);

        self::assertCount(3, $this->techno->getLearnings());
        self::assertTrue($this->techno->getLearnings()->contains($value));
        self::assertTrue($this->techno->getLearnings()->contains($value1));
        self::assertTrue($this->techno->getLearnings()->contains($value2));

        $response = $this->techno->removeLearning($value);
        $response = $this->techno->removeLearning($value1);

        self::assertInstanceOf(Techno::class, $response);
        self::assertCount(1, $this->techno->getLearnings());
        self::assertFalse($this->techno->getLearnings()->contains($value));
        self::assertFalse($this->techno->getLearnings()->contains($value1));
        self::assertTrue($this->techno->getLearnings()->contains($value2));
    }
}