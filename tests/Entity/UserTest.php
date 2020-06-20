<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUser()
    {
    	$user = new User();

        $this->assertEquals(null, $user->getId());
    }
}