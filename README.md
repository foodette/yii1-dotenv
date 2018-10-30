Yii 1.1 DotEnv
==============
[![Latest Stable Version](https://poser.pugx.org/foodette/yii1-dotenv/v/stable)](https://packagist.org/packages/foodette/yii1-dotenv)
[![License](https://poser.pugx.org/foodette/yii1-dotenv/license)](https://packagist.org/packages/foodette/yii1-dotenv)

PHP DotEnv for Yii 1.1 Framework.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist foodette/yii1-dotenv "*"
```

or add

```
"foodette/yii1-dotenv": "*"
```

to the require section of your `composer.json` file.

Usage
-----

Once the extension is installed, simply use the provided `env()` function in your code :
```
[
    'db' => [
        'password' => env('DB_PASS'),
    ],
]
```

The env function will autoload .env file, it uses the following search mechanism :

    If there is a Yii class the autoloader will try and detect `vendor` or `root` alias, otherwise 
    up to the project directory to determine dotenv path.
    
Best is to set the `vendor` or `root` alias before calling `env()` function.

    Yii::setPathOfAlias('root', 'PATH/TO/PROJECT/ROOT');
