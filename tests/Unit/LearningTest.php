<?php

namespace App\Tests\Unit;

use App\Entity\Learning;
use App\Entity\Level;
use App\Entity\Techno;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class LearningTest extends TestCase{

    private $learning;

    protected function setUp(){
        parent::setUp();
        $this->learning = new Learning();
        
    }
    public function testGetUser(){
        $value = new User;
        $response = $this->learning->setUser($value);
        
        self::assertInstanceOf(Learning::class, $response);
        self::assertInstanceOf(User::class, $this->learning->getUser());
    }

    public function testGetTechno(){
        $value = new Techno;
        $response = $this->learning->setTechno($value);
        
        self::assertInstanceOf(Learning::class, $response);
        self::assertInstanceOf(Techno::class, $this->learning->getTechno());
    }

    public function testGetLevel(){
        $value = new Level;
        $response = $this->learning->setLevel($value);
        
        self::assertInstanceOf(Learning::class, $response);
        self::assertInstanceOf(Level::class, $this->learning->getLevel());
    }
}