<?php
declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserManagementControllerTest extends WebTestCase
{
    public function testUserListBehindFirewall()
    {
        $client = static::createClient();

        $client->request('GET', '/user/list');
        $this->assertResponseRedirects();
    }
}

