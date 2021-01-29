<?php

namespace App\Tests\Unit;

use App\Entity\Message;
use App\Entity\Project;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase{

    private $message;

    protected function setUp(){
        parent::setUp();
        $this->message = new Message();
        
    }

    public function testGetSender(){
        $value = new User;
        $response = $this->message->setSender($value);
        
        self::assertInstanceOf(Message::class, $response);
        self::assertEquals($value, $this->message->getSender());
    }

    
    public function testGetReceiver(){
        $value = new User;
        $response = $this->message->setReceiver($value);
        
        self::assertInstanceOf(Message::class, $response);
        self::assertEquals($value, $this->message->getReceiver());
    }

    public function testGetText(){
        $value = 'Why can\'t we beeee friend';
        $response = $this->message->setText($value);
        
        self::assertInstanceOf(Message::class, $response);
        self::assertEquals($value, $this->message->getText());
    }

    public function testGetProject(){
        $value = new Project;      
        $response = $this->message->setProject($value);
        
        self::assertInstanceOf(Message::class, $response);
        self::assertEquals($value, $this->message->getProject());
    }

}