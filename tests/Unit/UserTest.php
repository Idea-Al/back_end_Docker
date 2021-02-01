<?php

namespace App\Tests\Unit;

use App\Entity\UserDescription;
use App\Entity\Job;
use App\Entity\Learning;
use App\Entity\Logbook;
use App\Entity\Message;
use App\Entity\Project;
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
    self::assertEquals($value, filter_var($this->user->getEmail(), FILTER_VALIDATE_EMAIL));
    self::assertEquals($value, $this->user->getUsername());
    self::assertEquals($value, $this->user->getEmail());
}

    public function testGetPseudo(){
        $value = 'Martin';
        $response = $this->user->setPseudo($value);
        
        self::assertInstanceOf(User::class, $response);
         //Regex that check if there is letter, number and those two special caracters: - and _
        self::assertRegExp("/^[-_.0-9A-Za-z]+$/", $this->user->getPseudo());
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
        self::assertInstanceOf(UserDescription::class, $this->user->getDescription());
    }

    public function testGetFavoriteProjects(){

        $value = new ProjectFav;
        $value1 = new ProjectFav;
        $value2 = new ProjectFav;

        $this->user->addFavoriteProject($value);
        $this->user->addFavoriteProject($value1);
        $this->user->addFavoriteProject($value2);

        self::assertCount(3, $this->user->getFavoriteProjects());
        self::assertTrue($this->user->getFavoriteProjects()->contains($value));
        self::assertTrue($this->user->getFavoriteProjects()->contains($value1));
        self::assertTrue($this->user->getFavoriteProjects()->contains($value2));

        $response = $this->user->removeFavoriteProject($value);
        $response = $this->user->removeFavoriteProject($value1);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getFavoriteProjects());
        self::assertFalse($this->user->getFavoriteProjects()->contains($value));
        self::assertFalse($this->user->getFavoriteProjects()->contains($value1));
        self::assertTrue($this->user->getFavoriteProjects()->contains($value2));
    }

    public function testGetLearnings(){

        $value = new Learning;
        $value1 = new Learning;
        $value2 = new Learning;

        $this->user->addLearning($value);
        $this->user->addLearning($value1);
        $this->user->addLearning($value2);

        self::assertCount(3, $this->user->getLearnings());
        self::assertTrue($this->user->getLearnings()->contains($value));
        self::assertTrue($this->user->getLearnings()->contains($value1));
        self::assertTrue($this->user->getLearnings()->contains($value2));

        $response = $this->user->removeLearning($value);
        $response = $this->user->removeLearning($value1);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getLearnings());
        self::assertFalse($this->user->getLearnings()->contains($value));
        self::assertFalse($this->user->getLearnings()->contains($value1));
        self::assertTrue($this->user->getLearnings()->contains($value2));
    }   


    public function testGetFriends(){
        $value = new UserFriend;
        $value1 = new UserFriend;
        $value2 = new UserFriend;

        $this->user->addFriend($value);
        $this->user->addFriend($value1);
        $this->user->addFriend($value2);

        self::assertCount(3, $this->user->getFriends());
        self::assertTrue($this->user->getFriends()->contains($value));
        self::assertTrue($this->user->getFriends()->contains($value1));
        self::assertTrue($this->user->getFriends()->contains($value2));

        $response = $this->user->removeFriend($value);
        $response = $this->user->removeFriend($value1);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getFriends());
        self::assertFalse($this->user->getFriends()->contains($value));
        self::assertFalse($this->user->getFriends()->contains($value1));
        self::assertTrue($this->user->getFriends()->contains($value2));
    }

    public function testGetFriendWithMe(){
        $value = new UserFriend;
        $value1 = new UserFriend;
        $value2 = new UserFriend;

        $this->user->addFriendWithMe($value);
        $this->user->addFriendWithMe($value1);
        $this->user->addFriendWithMe($value2);

        self::assertCount(3, $this->user->getFriendWithMe());
        self::assertTrue($this->user->getFriendWithMe()->contains($value));
        self::assertTrue($this->user->getFriendWithMe()->contains($value1));
        self::assertTrue($this->user->getFriendWithMe()->contains($value2));

        $response = $this->user->removeFriendWithMe($value);
        $response = $this->user->removeFriendWithMe($value1);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getFriendWithMe());
        self::assertFalse($this->user->getFriendWithMe()->contains($value));
        self::assertFalse($this->user->getFriendWithMe()->contains($value1));
        self::assertTrue($this->user->getFriendWithMe()->contains($value2));
    }

    public function testGetReportedUsers(){
        $value = new UserReport;
        $value1 = new UserReport;
        $value2 = new UserReport;

        $this->user->addReportedUser($value);
        $this->user->addReportedUser($value1);
        $this->user->addReportedUser($value2);

        self::assertCount(3, $this->user->getReportedUsers());
        self::assertTrue($this->user->getReportedUsers()->contains($value));
        self::assertTrue($this->user->getReportedUsers()->contains($value1));
        self::assertTrue($this->user->getReportedUsers()->contains($value2));

        $response = $this->user->removeReportedUser($value);
        $response = $this->user->removeReportedUser($value1);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getReportedUsers());
        self::assertFalse($this->user->getReportedUsers()->contains($value));
        self::assertFalse($this->user->getReportedUsers()->contains($value1));
        self::assertTrue($this->user->getReportedUsers()->contains($value2));
    }

    public function testGetReportedBy(){
        $value = new UserReport;
        $value1 = new UserReport;
        $value2 = new UserReport;

        $this->user->addReportedBy($value);
        $this->user->addReportedBy($value1);
        $this->user->addReportedBy($value2);

        self::assertCount(3, $this->user->getReportedBy());
        self::assertTrue($this->user->getReportedBy()->contains($value));
        self::assertTrue($this->user->getReportedBy()->contains($value1));
        self::assertTrue($this->user->getReportedBy()->contains($value2));

        $response = $this->user->removeReportedBy($value);
        $response = $this->user->removeReportedBy($value1);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getReportedBy());
        self::assertFalse($this->user->getReportedBy()->contains($value));
        self::assertFalse($this->user->getReportedBy()->contains($value1));
        self::assertTrue($this->user->getReportedBy()->contains($value2));
    }

    public function testGetMessagesSent(){
        $value = new Message;
        $value1 = new Message;
        $value2 = new Message;

        $this->user->addMessagesSent($value);
        $this->user->addMessagesSent($value1);
        $this->user->addMessagesSent($value2);

        self::assertCount(3, $this->user->getMessagesSent());
        self::assertTrue($this->user->getMessagesSent()->contains($value));
        self::assertTrue($this->user->getMessagesSent()->contains($value1));
        self::assertTrue($this->user->getMessagesSent()->contains($value2));

        $response = $this->user->removeMessagesSent($value);
        $response = $this->user->removeMessagesSent($value1);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getMessagesSent());
        self::assertFalse($this->user->getMessagesSent()->contains($value));
        self::assertFalse($this->user->getMessagesSent()->contains($value1));
        self::assertTrue($this->user->getMessagesSent()->contains($value2));
    }

    public function testGetMessagesReceived(){
        $value = new Message;
        $value1 = new Message;
        $value2 = new Message;

        $this->user->addMessagesReceived($value);
        $this->user->addMessagesReceived($value1);
        $this->user->addMessagesReceived($value2);

        self::assertCount(3, $this->user->getMessagesReceived());
        self::assertTrue($this->user->getMessagesReceived()->contains($value));
        self::assertTrue($this->user->getMessagesReceived()->contains($value1));
        self::assertTrue($this->user->getMessagesReceived()->contains($value2));

        $response = $this->user->removeMessagesReceived($value);
        $response = $this->user->removeMessagesReceived($value1);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getMessagesReceived());
        self::assertFalse($this->user->getMessagesReceived()->contains($value));
        self::assertFalse($this->user->getMessagesReceived()->contains($value1));
        self::assertTrue($this->user->getMessagesReceived()->contains($value2));
    }

    public function testGetSendFav(){
        $value = new UserFav;
        $value1 = new UserFav;

        $this->user->addSendFav($value);
        $this->user->addSendFav($value1);

        self::assertCount(2, $this->user->getSendFav());
        self::assertTrue($this->user->getSendFav()->contains($value));
        self::assertTrue($this->user->getSendFav()->contains($value1));

        $response = $this->user->removeSendFav($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getSendFav());
        self::assertFalse($this->user->getSendFav()->contains($value));
        self::assertTrue($this->user->getSendFav()->contains($value1));
    }

    public function testGetReceiveFav(){
        $value = new UserFav;
        $value1 = new UserFav;

        $this->user->addReceiveFav($value);
        $this->user->addReceiveFav($value1);

        self::assertCount(2, $this->user->getReceiveFav());
        self::assertTrue($this->user->getReceiveFav()->contains($value));
        self::assertTrue($this->user->getReceiveFav()->contains($value1));

        $response = $this->user->removeReceiveFav($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getReceiveFav());
        self::assertFalse($this->user->getReceiveFav()->contains($value));
        self::assertTrue($this->user->getReceiveFav()->contains($value1));
    }

    public function testGetRhythm(){
        $value = new Rhythm;

        $response = $this->user->setRhythm($value);
        
        self::assertInstanceOf(User::class, $response);
        self::assertInstanceOf(Rhythm::class, $this->user->getRhythm());
    }


    public function testGetLogbooks(){

        $value = new Logbook;
        $value1 = new Logbook;

        $this->user->addLogbook($value);
        $this->user->addLogbook($value1);

        self::assertCount(2, $this->user->getLogbooks());
        self::assertTrue($this->user->getLogbooks()->contains($value));
        self::assertTrue($this->user->getLogbooks()->contains($value1));

        $response = $this->user->removeLogbook($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getLogbooks());
        self::assertFalse($this->user->getLogbooks()->contains($value));
        self::assertTrue($this->user->getLogbooks()->contains($value1));
    }

    public function testGetRealizations(){
        $value = new Realization;
        $value1 = new Realization;

        $this->user->addRealization($value);
        $this->user->addRealization($value1);

        self::assertCount(2, $this->user->getRealizations());
        self::assertTrue($this->user->getRealizations()->contains($value));
        self::assertTrue($this->user->getRealizations()->contains($value1));

        $response = $this->user->removeRealization($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getRealizations());
        self::assertFalse($this->user->getRealizations()->contains($value));
        self::assertTrue($this->user->getRealizations()->contains($value1));
    }

    public function testConfirmationToken(){
        $value = '$argon66545d3s4f5dsfnjkndskjksdnjfs';
        $response = $this->user->setConfirmationToken($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getConfirmationToken());
    }

    public function testGetProjects(){

        $value = new Project;
        $value1 = new Project;

        $this->user->addProject($value);
        $this->user->addProject($value1);

        self::assertCount(2, $this->user->getProjects());
        self::assertTrue($this->user->getProjects()->contains($value));
        self::assertTrue($this->user->getProjects()->contains($value1));

        $response = $this->user->removeProject($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getProjects());
        self::assertFalse($this->user->getProjects()->contains($value));
        self::assertTrue($this->user->getProjects()->contains($value1));
    }


}

