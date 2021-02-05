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
        $value = 'Un projet qui révolutionnera le monde ! Enfin... Je crois';
        $response = $this->project->setResume($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertEquals($value, $this->project->getResume());
    }

    public function testGetMaxParticipant(){
        $value = 4;
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
        $value = 'fdfddfdg.jpg';
        $response = $this->project->setPicture($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertEquals($value, $this->project->getPicture());
    }

    public function testGetLink(){
        $value = 'fdfdlkfjsdfds.com';
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
        $value = new Techno;
        $value1 = new Techno;
        $value2 = new Techno;

        $this->project->addTechno($value);
        $this->project->addTechno($value1);
        $this->project->addTechno($value2);

        self::assertCount(3, $this->project->getTechnos());
        self::assertTrue($this->project->getTechnos()->contains($value));
        self::assertTrue($this->project->getTechnos()->contains($value1));
        self::assertTrue($this->project->getTechnos()->contains($value2));

        $response = $this->project->removeTechno($value1);

        self::assertInstanceOf(Project::class, $response);
        self::assertCount(2, $this->project->getTechnos());
        self::assertTrue($this->project->getTechnos()->contains($value));
        self::assertFalse($this->project->getTechnos()->contains($value1));
        self::assertTrue($this->project->getTechnos()->contains($value2));
    }

    public function testGetFavorites(){

        $value = new ProjectFav;
        $value1 = new ProjectFav;
        $value2 = new ProjectFav;

        $this->project->addFavorite($value);
        $this->project->addFavorite($value1);
        $this->project->addFavorite($value2);

        self::assertCount(3, $this->project->getFavorites());
        self::assertTrue($this->project->getFavorites()->contains($value));
        self::assertTrue($this->project->getFavorites()->contains($value1));
        self::assertTrue($this->project->getFavorites()->contains($value2));

        $response = $this->project->removeFavorite($value1);

        self::assertInstanceOf(Project::class, $response);
        self::assertCount(2, $this->project->getFavorites());
        self::assertTrue($this->project->getFavorites()->contains($value));
        self::assertFalse($this->project->getFavorites()->contains($value1));
        self::assertTrue($this->project->getFavorites()->contains($value2));
    }

    public function testGetProjectDescription(){

            $value = new ProjectDescription;
 
            $response = $this->project->setProjectDescription($value);
    
        
        self::assertInstanceOf(Project::class, $response);
        self::assertInstanceOf(ProjectDescription::class, $this->project->getProjectDescription());
    }

    public function testGetIsCompleted(){
        $value = true;
        $response = $this->project->setIsCompleted($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertIsBool($value, $this->project->getIsCompleted());
    }

    public function testGetSlug(){
        $value = 'Voici le slug pour le lien';
        $response = $this->project->setSlug($value);
        
        self::assertInstanceOf(Project::class, $response);
        self::assertEquals($value, $this->project->getSlug());
    }

    public function testGetJob(){
        $value = new Job;
        $value1 = new Job;
        $value2 = new Job;

        $this->project->addJob($value);
        $this->project->addJob($value1);
        $this->project->addJob($value2);

        self::assertCount(3, $this->project->getJobs());
        self::assertTrue($this->project->getJobs()->contains($value));
        self::assertTrue($this->project->getJobs()->contains($value1));
        self::assertTrue($this->project->getJobs()->contains($value2));

        $response = $this->project->removeJob($value1);

        self::assertInstanceOf(Project::class, $response);
        self::assertCount(2, $this->project->getJobs());
        self::assertTrue($this->project->getJobs()->contains($value));
        self::assertFalse($this->project->getJobs()->contains($value1));
        self::assertTrue($this->project->getJobs()->contains($value2));
    }

    public function testGetMessage(){

        $value = new Message;
        $value1 = new Message;
        $value2 = new Message;

        $this->project->addMessage($value);
        $this->project->addMessage($value1);
        $this->project->addMessage($value2);

        self::assertCount(3, $this->project->getMessages());
        self::assertTrue($this->project->getMessages()->contains($value));
        self::assertTrue($this->project->getMessages()->contains($value1));
        self::assertTrue($this->project->getMessages()->contains($value2));

        $response = $this->project->removeMessage($value1);

        self::assertInstanceOf(Project::class, $response);
        self::assertCount(2, $this->project->getMessages());
        self::assertTrue($this->project->getMessages()->contains($value));
        self::assertFalse($this->project->getMessages()->contains($value1));
        self::assertTrue($this->project->getMessages()->contains($value2));
        
    }

    public function testGetLogbook(){

        $value = new Logbook;
        $value1 = new Logbook;
        $value2 = new Logbook;

        $this->project->addLogbook($value);
        $this->project->addLogbook($value1);
        $this->project->addLogbook($value2);

        self::assertCount(3, $this->project->getLogbooks());
        self::assertTrue($this->project->getLogbooks()->contains($value));
        self::assertTrue($this->project->getLogbooks()->contains($value1));
        self::assertTrue($this->project->getLogbooks()->contains($value2));

        $response = $this->project->removeLogbook($value1);

        self::assertInstanceOf(Project::class, $response);
        self::assertCount(2, $this->project->getLogbooks());
        self::assertTrue($this->project->getLogbooks()->contains($value));
        self::assertFalse($this->project->getLogbooks()->contains($value1));
        self::assertTrue($this->project->getLogbooks()->contains($value2));
    }

    public function testGetCreator(){
      
        $value = new User;
        
        $response = $this->project->setCreator($value);

        self::assertInstanceOf(Project::class, $response);
        self::assertInstanceOf(User::class, $this->project->getCreator());
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