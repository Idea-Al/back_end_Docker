<?php

namespace App\Tests\Unit;

use App\Entity\Job;
use App\Entity\Project;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase{

    private $job;

    protected function setUp(){
        parent::setUp();
        $this->job = new Job();
        
    }

    public function testGetName(){
        $value = 'Développeur';
        $response = $this->job->setName($value);
        
        self::assertInstanceOf(Job::class, $response);
        self::assertEquals($value, $this->job->getName());
    }

    public function testGetUsers(){

        for($i = 1; $i <= 4; $i++ )
        {
            $values[] = new User;
        }        
     
        foreach($values as $value){
            $response = $this->job->addUser($value);
        }
        
        self::assertInstanceOf(Job::class, $response);
        self::assertCount(4, $this->job->getUsers());
    }

    public function testGetProjects(){

        for($i = 1; $i <= 3; $i++ )
        {
            $values[] = new Project;
        }        
     
        foreach($values as $value){
            $response = $this->job->addProject($value);
        }
        
        self::assertInstanceOf(Job::class, $response);
        self::assertCount(3, $this->job->getProjects());
    }

}