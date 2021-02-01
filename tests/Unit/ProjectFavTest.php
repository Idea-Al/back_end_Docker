<?php

namespace App\Tests\Unit;

use App\Entity\Project;
use App\Entity\ProjectFav;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ProjectFavTest extends TestCase{

    private $projectFav;

    protected function setUp(){
        parent::setUp();
        $this->projectFav = new ProjectFav;
        
    }

    public function testGetUser(){
        $value = new User;
        $response = $this->projectFav->setUser($value);
        
        self::assertInstanceOf(ProjectFav::class, $response);
        self::assertInstanceOf(User::class, $this->projectFav->getUser());
    }

    public function testGetProject(){
        $value = new Project;
        $response = $this->projectFav->setProject($value);
        
        self::assertInstanceOf(ProjectFav::class, $response);
        self::assertInstanceOf(Project::class, $this->projectFav->getProject());
    }
   
}