<?php

namespace Prince\Testunit;

use PHPUnit\Framework\TestCase;

class MathManagerTest extends TestCase
{
    public function testSomme()
    {
        $manager = new MathManager();

        $this->assertEquals(3, $manager->somme(1, 2)); // test assert
        $this->assertEquals(2, $manager->somme(0, 2));
        $this->assertEquals(1, $manager->somme(-1, 2));
    }
}
