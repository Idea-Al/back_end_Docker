<?php

namespace App\Tests\Unit;

use App\Entity\Job;
use App\Entity\Logbook;
use App\Entity\Message;
use App\Entity\Project;
use App\Entity\ProjectDescription;
use App\Entity\ProjectFav;
use App\Entity\Techno;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase{

    private $project;

    protected function setUp(){
        parent::setUp();
        $this->project = new Project;
        
    }
 
    public function testGetName(){
        $value = 'Crazyyy_?';
        $response = $this->project->setName($value);
        
        self::assertInstanceOf(Project::class, $response);
         //Regex that check if there is letter, number and those special characters: - _ ! ?
        self::assertRegExp("/^[-_!&?.0-9A-Za-z]+$/", $this->project->getName());
        self::assertEquals($value, $this->project->getName());
    }
    
    public function testGetResume(){
        $value = 'Insulte';
        $response = $this->project->setResume($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertEquals($value, $this->project->getResume());
    }

    public function testGetMaxParticipant(){
        $value = 1;
        $response = $this->project->setMaxParticipant($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertEquals($value, $this->project->getMaxParticipant());
    }

    public function testGetIsModerated(){
        $value = true;
        $response = $this->project->setIsModerated($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertIsBool($value, $this->project->getIsModerated());
    }

    public function testGetPicture(){
        $value = 1;
        $response = $this->project->setPicture($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertEquals($value, $this->project->getPicture());
    }

    public function testGetLink(){
        $value = 1;
        $response = $this->project->setLink($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertEquals($value, $this->project->getLink());
    }

    public function testGetCreatedAt(){

        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->project->setCreatedAt($dateTime);

        self::assertInstanceOf(Project::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }

    public function testGetUpdatedAt(){


        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->project->setUpdatedAt($dateTime);

        self::assertInstanceOf(Project::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }

    public function testGetTechno(){
        for($i = 1; $i <= 6; $i++){
        $values[] = new Techno;
    }
        foreach($values as $value){
            $response = $this->project->addTechno($value);
    }
        self::assertInstanceOf(Project::class, $response);
        self::assertCount(6, $this->project->getTechnos());
    }

    public function testGetProjectFavorite(){

        for($i = 1; $i <= 3; $i++){
            $values[] = new ProjectFav;
        }
        foreach($values as $value){
            $response = $this->project->addFavorite($value);
        
        }
        
        self::assertInstanceOf(Project::class, $response);
        self::assertCount(3, $this->project->getFavorites());
    }

    public function testGetProjectDescription(){

            $value = new ProjectDescription;
 
            $response = $this->project->setProjectDescription($value);
    
        
        self::assertInstanceOf(Project::class, $response);
        self::assertEquals($value, $this->project->getProjectDescription());
    }

    public function testGetIsCompleted(){
        $value = true;
        $response = $this->project->setIsCompleted($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertIsBool($value, $this->project->getIsCompleted());
    }

    public function testGetJob(){

        for($i = 1; $i <= 3; $i++){
            $values[] = new Job;
        }
        foreach($values as $value){
            $response = $this->project->addJob($value);
        
        }
        
        self::assertInstanceOf(Project::class, $response);
        self::assertCount(3, $this->project->getJobs());
    }

    public function testGetMessage(){

        for($i = 1; $i <= 3; $i++){
            $values[] = new Message;
        }
        foreach($values as $value){
            $response = $this->project->addMessage($value);
        
        }
        
        self::assertInstanceOf(Project::class, $response);
        self::assertCount(3, $this->project->getMessages());
    }

    public function testGetLogbook(){

        for($i = 1; $i <= 3; $i++){
            $values[] = new Logbook;
        }
        foreach($values as $value){
            $response = $this->project->addLogbook($value);
        
        }
        
        self::assertInstanceOf(Project::class, $response);
        self::assertCount(3, $this->project->getLogbooks());
    }

    public function testGetCreator(){
      
        $value = new User;
        
        $response = $this->project->setCreator($value);

        self::assertInstanceOf(Project::class, $response);
        self::assertEquals($value, $this->project->getCreator());
    }

    public function testGetHasOwner(){
      
        $value = false;
        
        $response = $this->project->setHasOwner($value);

        self::assertInstanceOf(Project::class, $response);
        self::assertIsBool($value, $this->project->getHasOwner());
    }

    public function testGetIsFull(){
      
        $value = true;
        
        $response = $this->project->setIsFull($value);

        self::assertInstanceOf(Project::class, $response);
        self::assertIsBool($value, $this->project->getIsFull());
    }
   
}