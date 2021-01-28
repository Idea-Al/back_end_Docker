<?php

namespace App\Tests\Unit;

use App\Entity\UserDescription;
use App\Entity\Job;
use App\Entity\Learning;
use App\Entity\Logbook;
use App\Entity\Message;
use App\Entity\ProjectFav;
use App\Entity\Realization;
use App\Entity\Rhythm;
use App\Entity\User;
use App\Entity\UserFav;
use App\Entity\UserFriend;
use App\Entity\UserReport;
use DateTime;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{
    
    private $user;

    protected function setUp(){
        parent::setUp();
        $this->user = new User();
        
    }

public function testGetEmail(){
    $value = 'test@test.fr';

    $response = $this->user->setEmail($value);
    
    self::assertInstanceOf(User::class, $response);
    self::assertEquals($value, $this->user->getEmail());
    self::assertEquals($value, $this->user->getUsername());
}

    public function testGetPseudo(){
        $value = 'Martin';
        $response = $this->user->setPseudo($value);
        
        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getPseudo());
    }

    public function testGetPassword(){
        $value = 'password';
        $response = $this->user->setPassword($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getPassword());
    }

    public function testGetPlainPassword(){
        $value = 'password';
        $response = $this->user->setPlainPassword($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getPlainPassword());
    }

    public function testGetAvatar(){
        $value = 'new picture';
        $response = $this->user->setAvatar($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getAvatar());
    }

    public function testGetSchool(){
        $value = 'O\'clock';
        $response = $this->user->setSchool($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getSchool());
    }

    public function testGetStatus(){
        $value = true;
        $response = $this->user->setStatus($value);

        self::assertInstanceOf(User::class, $response);
        self::assertIsBool($value, $this->user->getStatus());
    }

    public function testGetIsActive(){
        $value = false;
        $response = $this->user->setIsActive($value);

        self::assertInstanceOf(User::class, $response);
        self::assertIsBool($value, $this->user->getIsActive());
    }

    public function testGetIsBanned(){
        $value = false;
        $response = $this->user->setIsBanned($value);

        self::assertInstanceOf(User::class, $response);
        self::assertIsBool($value, $this->user->getIsBanned());
    }

    public function testGetCreatedAt(){

        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->user->setCreatedAt($dateTime);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }

    public function testGetUpdatedAt(){


        $dateTime = new \DateTime('2017-01-31 09:30', new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone('CET'));
        
        $response = $this->user->setUpdatedAt($dateTime);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals(new \DateTime('2017-01-31 10:30', new \DateTimeZone('CET')), $dateTime);
    }

    public function testGetRoles(){
        $value = ["ROLE_ADMIN"];
        $response = $this->user->setRoles($value);

        self::assertInstanceOf(User::class, $response);
        self::assertContains("ROLE_ADMIN", $this->user->getRoles());
        self::assertContains("ROLE_USER", $this->user->getRoles());
       self::assertCount(2, $this->user->getRoles());
    }

    public function testGetJob(){
        $value = new Job;

        $response = $this->user->setJob($value);
        
        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getJob());
    }

    public function testGetDescription(){
        $value = new UserDescription;

        $response = $this->user->setDescription($value);
        
        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getDescription());
    }

    public function testFavoriteProjects(){

        for($i = 1; $i <= 3; $i++ )
        {
            $values[] = new ProjectFav;
        }        
     

        foreach($values as $value){
        $response = $this->user->addFavoriteProject($value);
    }
        
        self::assertInstanceOf(User::class, $response);
        self::assertCount(3, $this->user->getFavoriteProjects());
    }

    public function testGetLearnings(){


        for($i = 1; $i <= 4; $i++ )
        {
            $values[] = new Learning;
        }        
               foreach($values as $value){
        $response = $this->user->addLearning($value);
    }
        
        self::assertInstanceOf(User::class, $response);
        self::assertCount(4, $this->user->getLearnings());
    }   


    public function testGetFriends(){
        for($i = 1; $i <= 10; $i++){
            $values[] = new UserFriend;
        }

        foreach($values as $value){
            $response = $this->user->addFriend($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(10, $this->user->getFriends());
    }

    public function testGetFriendWithMe(){
        for($i = 1; $i <= 10; $i++){
            $values[] = new UserFriend;
        }

        foreach($values as $value){
            $response = $this->user->addFriendWithMe($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(10, $this->user->getFriendWithMe());
    }

    public function testGetReportedUsers(){
        for($i = 1; $i <= 10; $i++){
            $values[] = new UserReport;
        }

        foreach($values as $value){
            $response = $this->user->addReportedUser($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(10, $this->user->getReportedUsers());
    }

    public function testGetReportedBy(){
        for($i = 1; $i <= 10; $i++){
            $values[] = new UserReport;
        }

        foreach($values as $value){
            $response = $this->user->addReportedBy($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(10, $this->user->getReportedBy());
    }

    public function testGetMessagesSent(){
        for($i = 1; $i <= 10; $i++){
            $values[] = new Message;
        }

        foreach($values as $value){
            $response = $this->user->addMessagesSent($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(10, $this->user->getMessagesSent());
    }

    public function testGetMessagesReceived(){
        for($i = 1; $i <= 10; $i++){
            $values[] = new Message;
        }

        foreach($values as $value){
            $response = $this->user->addMessagesReceived($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(10, $this->user->getMessagesReceived());
    }

    public function testGetSendFav(){
        for($i = 1; $i <= 10; $i++){
            $values[] = new UserFav;
        }

        foreach($values as $value){
            $response = $this->user->addSendFav($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(10, $this->user->getSendFav());
    }

    public function testGetReceiveFav(){
        for($i = 1; $i <= 10; $i++){
            $values[] = new UserFav;
        }

        foreach($values as $value){
            $response = $this->user->addReceiveFav($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(10, $this->user->getReceiveFav());
    }

    public function testGetRhythm(){
        $value = new Rhythm;

        $response = $this->user->setRhythm($value);
        
        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getRhythm());
    }


    public function testGetLogbooks(){

        for($i = 1; $i <= 7; $i++){
            $values[] = new Logbook;
        }

        foreach($values as $value){
            $response = $this->user->addLogbook($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(7, $this->user->getLogbooks());
    }

    public function testGetRealizations(){

        for($i = 1; $i <= 7; $i++){
            $values[] = new Realization;
        }

        foreach($values as $value){
            $response = $this->user->addRealization($value);
        }
        self::assertInstanceOf(User::class, $response);
        self::assertCount(7, $this->user->getRealizations());
    }

    public function testConfirmationToken(){
        $value = '$argon66545d3s4f5dsfnjkndskjksdnjfs';
        $response = $this->user->setConfirmationToken($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getConfirmationToken());
    }



}

