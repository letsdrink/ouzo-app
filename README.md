Ouzo - Application
==================

How to use Ouzo step by step.

Set up project
--------------

Simply use composer (http://getcomposer.org):

```
composer.phar create-project letsdrink/ouzo-app:dev-master myproject
```

Where `myproject` is your project's name.

Configure HTTP Server
---------------------

Ouzo apps can be run on Apache web server. It needs mod_rewrite enabled. Once you have previous step completed, change document root to `myproject`.

Ouzo Configuration
------------------

Ouzo configuration is located under `config/prod/Config.php`.

What's important there for now is debug turned on by default. Please, leave it like this for installation purposes, as you will be able to see detailed error messages in case something goes wrong.


