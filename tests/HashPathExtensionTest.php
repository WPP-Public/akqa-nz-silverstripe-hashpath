<?php

class HashPathExtensionTest extends PHPUnit_Framework_TestCase
{

    public function testHashFile()
    {

        $hashPath = new HashPathExtension();

        $this->assertEquals(
            '2f7d9c3e0cfd47e8fcab0c12447b2bf0',
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
            '/tests/test.v2f7d9c3e0cfd47e8fcab0c12447b2bf0.txt',
            $hashPath->HashPath(
                '/tests/test.txt',
                false
            )
        );

        $hashPath->setFormat('%s/%s.v.%s.%s');

        $this->assertEquals(
            '/tests/test.v.2f7d9c3e0cfd47e8fcab0c12447b2bf0.txt',
            $hashPath->HashPath(
                '/tests/test.txt',
                false
            )
        );

    }

}