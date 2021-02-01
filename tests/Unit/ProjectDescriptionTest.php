<?php

namespace App\Tests\Unit;

use App\Entity\Project;
use App\Entity\ProjectDescription;
use PHPUnit\Framework\TestCase;

class ProjectDescriptionTest extends TestCase{

    private $projectDescription;

    protected function setUp(){
        parent::setUp();
        $this->projectDescription = new ProjectDescription();
        
    }

    public function testGetPurpose(){
        $value = 'Apprendre à créer des test unitaires';
        $response = $this->projectDescription->setPurpose($value);
        
        self::assertInstanceOf(ProjectDescription::class, $response);
        self::assertEquals($value, $this->projectDescription->getPurpose());
    }

    
    public function testGetTarget(){
        $value = 'Utilisation de PHPUnit';
        $response = $this->projectDescription->setTarget($value);
        
        self::assertInstanceOf(ProjectDescription::class, $response);
        self::assertEquals($value, $this->projectDescription->getTarget());
    }

    public function testGetLearningSkill(){
        $value = 'To be a better developper';
        $response = $this->projectDescription->setLearningSkill($value);
        
        self::assertInstanceOf(ProjectDescription::class, $response);
        self::assertEquals($value, $this->projectDescription->getLearningSkill());
    }

    public function testGetProject(){
        $value = new Project;      
        $response = $this->projectDescription->setProject($value);
        
        self::assertInstanceOf(ProjectDescription::class, $response);
        self::assertInstanceOf(Project::class, $this->projectDescription->getProject());
    }

}