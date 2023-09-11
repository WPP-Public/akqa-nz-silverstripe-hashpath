<?php

namespace Heyday\HashPath\Tests;

use Heyday\HashPath\HashPathExtension;
use PHPUnit\Framework\TestCase;

/**
 * Class HashPathExtensionTest
 */
class HashPathExtensionTest extends TestCase
{
    public function testHashFile()
    {

        $hashPath = new HashPathExtension();

        $this->assertEquals(
            'L32cPgz9Rj8qwwSRHsr8A',
            $hashPath->HashFile(
                __DIR__ . '/test.txt',
                false
            )
        );

        $this->assertEquals(
            '',
            $hashPath->HashFile(
                'fakefile',
                false
            )
        );
    }


    public function testHashPath()
    {
        $hashPath = new HashPathExtension();

        $this->assertStringContainsString(
            'tests/test.vL32cPgz9Rj8qwwSRHsr8A.txt',
            $hashPath->HashPath(
                __DIR__ . '/test.txt',
                false
            )
        );

        $hashPath->setFormat('%s/%s.v.%s.%s');

        $this->assertStringContainsString(
            'tests/test.v.L32cPgz9Rj8qwwSRHsr8A.txt',
            $hashPath->HashPath(
                __DIR__ . '/test.txt',
                false
            )
        );
    }
}
