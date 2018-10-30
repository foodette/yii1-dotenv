<?php
namespace tests;

use PHPUnit\Framework\TestCase;

class AutoloadTest extends TestCase
{
    public function testAutolaod()
    {
        define('DOTENV_PATH', __DIR__);
        $this->assertEquals(false, env('DUMMY_ENV_VARIABLE'));
        $this->assertEquals('foo', env('YII_DOTENV_TEST'));
    }

    public function testNoAutolaod()
    {
        define('DISABLE_DOTENV_LOAD', true);
        $this->assertEquals(false, env('DUMMY_ENV_VARIABLE'));
    }
}
