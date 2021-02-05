<?php

namespace App\Tests\Unit;

use App\Entity\Rhythm;
use PHPUnit\Framework\TestCase;

class RhythmTest extends TestCase{

    private $rhythm;

    protected function setUp(){
        parent::setUp();
        $this->rhythm = new Rhythm();
        
    }

    public function testGetName(){
        $value = 'Intense';

        $response = $this->rhythm->setName($value);

        self::assertInstanceOf(Rhythm::class, $response);
        self::assertEquals($value, $this->rhythm->getName());
        
    }

    public function testGetDescription(){
        $value = 'Accroche toi sinon j\'te laisse sur le coté';

        $response = $this->rhythm->setDescription($value);

        self::assertInstanceOf(Rhythm::class, $response);
        self::assertEquals($value, $this->rhythm->getDescription());
        
    }

}