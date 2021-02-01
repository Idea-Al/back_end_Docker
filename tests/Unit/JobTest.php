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

        $value = new User;
        $value1 = new User;

        $this->job->addUser($value);
        $this->job->addUser($value1);

        self::assertCount(2, $this->job->getUsers());
        self::assertTrue($this->job->getUsers()->contains($value));
        self::assertTrue($this->job->getUsers()->contains($value1));

        $response = $this->job->removeUser($value1);

        self::assertInstanceOf(Job::class, $response);
        self::assertCount(1, $this->job->getUsers());
        self::assertTrue($this->job->getUsers()->contains($value));
        self::assertFalse($this->job->getUsers()->contains($value1));

    }

    public function testGetProjects(){

        $value = new Project;
        $value1 = new Project;
        $value2 = new Project;

        $this->job->addProject($value);
        $this->job->addProject($value1);
        $this->job->addProject($value2);

        self::assertCount(3, $this->job->getProjects());
        self::assertTrue($this->job->getProjects()->contains($value));
        self::assertTrue($this->job->getProjects()->contains($value1));
        self::assertTrue($this->job->getProjects()->contains($value2));

        $response = $this->job->removeProject($value1);

        self::assertInstanceOf(Job::class, $response);
        self::assertCount(2, $this->job->getProjects());
        self::assertTrue($this->job->getProjects()->contains($value));
        self::assertFalse($this->job->getProjects()->contains($value1));
        self::assertTrue($this->job->getProjects()->contains($value2));

    }
}