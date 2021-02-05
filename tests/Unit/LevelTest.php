<?php

namespace App\Tests\Unit;

use App\Entity\Learning;
use App\Entity\Level;
use PHPUnit\Framework\TestCase;

class LevelTest extends TestCase{
    private $level;

    protected function setUp(){

        parent::setUp();
        $this->level = new Level;  
    }

    public function testGetName(){
        $value = 'Insulte';
        $response = $this->level->setName($value);
        
        self::assertInstanceOf(Level::class, $response);
        self::assertEquals($value, $this->level->getName());
    }
    
    public function testGetDescription(){
        $value = 'Insulte';
        $response = $this->level->setDescription($value);
        
        self::assertInstanceOf(Level::class, $response);
        self::assertEquals($value, $this->level->getDescription());
    }

    public function testGetLearnings(){
        
        $value = new Learning;
        $value1 = new Learning;
        $value2 = new Learning;

        $this->level->addLearning($value);
        $this->level->addLearning($value1);
        $this->level->addLearning($value2);

        self::assertCount(3, $this->level->getLearnings());
        self::assertTrue($this->level->getLearnings()->contains($value));
        self::assertTrue($this->level->getLearnings()->contains($value1));
        self::assertTrue($this->level->getLearnings()->contains($value2));

        $response = $this->level->removeLearning($value1);

        self::assertInstanceOf(Level::class, $response);
        self::assertCount(2, $this->level->getLearnings());
        self::assertTrue($this->level->getLearnings()->contains($value));
        self::assertFalse($this->level->getLearnings()->contains($value1));
        self::assertTrue($this->level->getLearnings()->contains($value2));

    }

}