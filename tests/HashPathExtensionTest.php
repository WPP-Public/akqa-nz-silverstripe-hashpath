<?php
use Heyday\HashPath\HashPathExtension;

/**
 * Class HashPathExtensionTest
 */
class HashPathExtensionTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     */
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

    /**
     *
     */
    public function testHashPath()
    {

        $hashPath = new HashPathExtension();

        $this->assertEquals(
            '/silverstripe-hashpath/tests/test.vL32cPgz9Rj8qwwSRHsr8A.txt',
            $hashPath->HashPath(
                '/silverstripe-hashpath/tests/test.txt',
                false
            )
        );

        $hashPath->setFormat('%s/%s.v.%s.%s');

        $this->assertEquals(
            '/silverstripe-hashpath/tests/test.v.L32cPgz9Rj8qwwSRHsr8A.txt',
            $hashPath->HashPath(
                '/silverstripe-hashpath/tests/test.txt',
                false
            )
        );

    }

}