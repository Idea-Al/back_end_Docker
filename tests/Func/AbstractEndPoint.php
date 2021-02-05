<?php
namespace App\Tests\Func;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbstractEndpoint extends WebTestCase{
    private $serverInformations = ["ACCEPT"=> "application/json", "CONTENT"=>"application/json"];

    public function getResponseFromRequest($method, $uri, $payload = ''): Response
    {
        $client = $this->createClient();
        $client->request(
            $method, 
            $uri.'.json',
            [],
            [], 
            $this->serverInformations, 
            $payload);
        
        return $client->getResponse();
    }
}