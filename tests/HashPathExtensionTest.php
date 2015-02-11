<?php

class HashPathExtensionTest extends PHPUnit_Framework_TestCase
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

        $this->assertEquals(
            '/tests/test.vL32cPgz9Rj8qwwSRHsr8A.txt',
            $hashPath->HashPath(
                '/tests/test.txt',
                false
            )
        );

        $hashPath->setFormat('%s/%s.v.%s.%s');

        $this->assertEquals(
            '/tests/test.v.L32cPgz9Rj8qwwSRHsr8A.txt',
            $hashPath->HashPath(
                '/tests/test.txt',
                false
            )
        );

    }

}