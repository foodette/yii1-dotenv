<?php

use PHPUnit\Framework\TestCase;
use foodette\extension\dotenv\Loader;

class LoaderTest extends TestCase
{
    public function testLoad()
    {
        require __DIR__ . '/../vendor/yiisoft/yii/framework/yii.php';
        \Yii::setPathOfAlias('@app', __DIR__);
        $this->assertTrue(Loader::load());
        $this->assertEquals('foo', env('YII_DOTENV_TEST'));
    }
}
