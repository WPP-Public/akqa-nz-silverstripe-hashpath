<?php
// Temporary fix to work around include issue while a better solution is investigated.
if (!defined('HASH_PATH_RELATIVE_PATH')) {
    define('HASH_PATH_RELATIVE_PATH', basename(dirname(__FILE__)));
}


require_once(dirname(__FILE__) . '/../HashPathExtension.php');


class HashPathExtensionTest extends PHPUnit_Framework_TestCase
{

    public function testHashFile()
    {

        $hashPath = new HashPathExtension();

        $this->assertEquals(
            '2f7d9c3e0cfd47e8fcab0c12447b2bf0',
            $hashPath->HashFile(
                BASE_PATH . '/' . HASH_PATH_RELATIVE_PATH . '/code/tests/test.txt',
                false
            )
        );
        
        $this->assertEquals(
            '',
            $hashPath->HashFile(
                'test.txt',
                false
            )
        );

    }

    public function testHashPath()
    {

        $hashPath = new HashPathExtension();

        $this->assertEquals(
            '/' . HASH_PATH_RELATIVE_PATH . '/code/tests/test.v2f7d9c3e0cfd47e8fcab0c12447b2bf0.txt',
            $hashPath->HashPath(
                '/' . HASH_PATH_RELATIVE_PATH . '/code/tests/test.txt',
                false
            )
        );

        $hashPath->setFormat('%s/%s.v.%s.%s');

        $this->assertEquals(
            '/' . HASH_PATH_RELATIVE_PATH . '/code/tests/test.v.2f7d9c3e0cfd47e8fcab0c12447b2bf0.txt',
            $hashPath->HashPath(
                '/' . HASH_PATH_RELATIVE_PATH . '/code/tests/test.txt',
                false
            )
        );

    }

}