<?php

namespace App\Tests\Entity;

use App\Entity\MovieChoice;
use PHPUnit\Framework\TestCase;

class MovieChoiceTest extends TestCase
{
    public function testMovieChoice()
    {
    	$movieChoice = new MovieChoice();

        $this->assertInstanceOf(\DateTimeInterface::class, $movieChoice->getCreatedAt());
    }
}