<?php

namespace App\Tests\Func;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UserTest extends AbstractEndpoint{

    
   public function testGetAllUsers(){ 
        
        $response = $this->getResponseFromRequest('GET', '/api/users');
        $responseContent = $response->getContent();
        
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response);
        self::assertJson($responseContent);
    }   

    public function testPostUser(){ 
        
        $response = $this->getResponseFromRequest(
        'POST', 
        '/api/users',
        );
        $responseContent = $response->getContent();
        
        self::assertEquals(200, $response->getStatusCode());
        self::assertNotEmpty($response);
        self::assertJson($responseContent);
    }   
}