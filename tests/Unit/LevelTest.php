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

    public function testGetLearning(){
        for($i = 1; $i <= 3; $i++){
             $values[] = new Learning;
        }
       foreach($values as $value){
        $response = $this->level->addLearning($value);
       }
         
        self::assertInstanceOf(Level::class, $response);
        self::assertCount(3, $this->level->getLearnings());
    }

}