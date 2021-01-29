<?php 

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserActionControllerTest extends WebTestCase
{

    public function testRegister()
    {
        $client = self::createClient();

        $client->request(
            'POST',
            '/api/users',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"email":"idealtest@oclock.io",
             "password": "idealtest37!",
             "pseudo": "Ideal"}'
        );
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }


    public function testLogin()
    {
        $client = self::createClient();

        $client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"username":"idealtest@oclock.io", "password": "idealtest37!"}'
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testForgotPassword()
    {
        $client = self::createClient();

        $client->request(
            'POST',
            '/forgot_password/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"email":"idealtest@oclock.io"}'
        );

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    } 
}
