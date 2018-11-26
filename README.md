<p align="center">
    <h1 align="center">Dynamic Parameter Yii 2</h1>
    <br>
</p>


For license information check the [LICENSE](LICENSE.md)-file.


Installation
------------


The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist loutrux/yii2-dynamic-parameter
```

or add

```
"loutrux/yii2-dynamic-parameter": "~1.0.0"
```

to the require section of your composer.json.

Migration
------------
```
$ php yii migrate --migrationPath=@loutrux/dp/migrations/mysql --db=db
```

Component Configuration
-----------------------

To use this extension, simply add the following code in your application configuration:

```php
     'components' => [
        'parameters' => 'loutrux\dp\DynamicParameter',
     ]
  // or optionally with configuration:
     'components' => [
        'parameters' => [
            'class' => 'loutrux\dp\Parameters',
            'dbms' => 'mysql', // "mysql" is default 
            'db' => 'db', // "db" is default 
     ]

  // or if you have activate the Parameters Module API on a distant server is using this Component:
    'components' => [
        'parameters' => [
            'class' => 'loutrux\dp\Parameters',
            'dbms' => 'api', // "mysql" is default 
            'api'   => [
                'url'          => 'https://wwwmydomain.com/parameters/api',
                'auth_token'    => '1mYcmJb1XEG8bE4hvnUICOb4d665W1JB'
           ],
     ]

```


Component Usage
----------------

Store a value identified by an oid and a key
```php
\Yii::$app->parameters->set('oid.1','my_key_int',123);
\Yii::$app->parameters->set('oid.1','my_key_double',1.23);
\Yii::$app->parameters->set('oid.1','my_key_string','abc');
\Yii::$app->parameters->set('oid.1','my_key_array',['abc']);
\Yii::$app->parameters->set('oid.1','my_key_boolean',true);
\Yii::$app->parameters->set('oid.1','my_key_datetime',new \DateTime());

var_dump( \Yii::$app->parameters->get('oid.1','param2.misc'));

```

Retrieve a value identified by an oid and a key

```php
\Yii::$app->parameters->get('oid.1','my_key_string');
```

Retrieve all values identified by an oid (return array key => value)

```php
\Yii::$app->parameters->get('oid.1');
```


Module API configuration
========================
add a module configuration entry:
```php
     'modules' => [
        'parameters' => 'loutrux\dp\ParametersApi',
     ]
//   or optionally with configuration:
     'modules' => [
        'parameters' => [
            'class' => 'loutrux\dp\ParametersApi',
            'componentName' => 'parameters', //Default is 'parameters' but you can specify other component name implementing loutrux\dp\Parameters class
              
     ]
```
this module use bearerAuth, the User function findIdentityByAccessToken($token, $type = null) must be implemented
