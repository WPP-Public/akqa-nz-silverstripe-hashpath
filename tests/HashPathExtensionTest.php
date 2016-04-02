<?php

class HashPathExtensionTest extends PHPUnit_Framework_TestCase
{
    public function testHashFile()
    {
        $this->assertEquals(
            'L32cPgz9Rj8qwwSRHsr8A',
            HashPath::generateHashForFile(
                __DIR__ . '/test.txt',
                false
            )
        );
        
        $this->assertEquals(
            '',
            HashPath::generateHashForFile(
                'fakefile',
                false
            )
        );
    }

    public function testHashPath()
    {
        $this->assertEquals(
            '/tests/test.vL32cPgz9Rj8qwwSRHsr8A.txt',
            HashPath::generateHashForPath(
                '/tests/test.txt',
                false
            )
        );

        HashPath::setFormat('%s/%s.v.%s.%s');

        $this->assertEquals(
            '/tests/test.v.L32cPgz9Rj8qwwSRHsr8A.txt',
            HashPath::generateHashForPath(
                '/tests/test.txt',
                false
            )
        );
    }
    
    public function testGlobalTemplateConfiguration()
    {
        $globalTemplateVars = HashPath::get_template_global_variables();
        $this->assertEquals('generateHashForFile', $globalTemplateVars['HashFile']);
        $this->assertEquals('generateHashForPath', $globalTemplateVars['HashPath']);
    }
}
