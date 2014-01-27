Ouzo - 5 minutes tutorial
=========================

How to use Ouzo step by step. It takes only 5 minutes to set up sample project and start experiencing Ouzo.

Set up project
--------------

Simply use composer (http://getcomposer.org):

```
composer.phar create-project letsdrink/ouzo-app:dev-master myproject
```

Where `myproject` is your project's name.

PHP Version
-----------

You need PHP 5.3 or newer installed. Currently Ouzo is tested on 5.3, 5.4 and 5.5 environments. You will need database driver as well, accordingly to the database your are using.

In order to get list of available drivers check http://www.php.net/manual/en/pdo.getavailabledrivers.php.

Configure HTTP Server
---------------------

Ouzo apps can be run on Apache web server. It needs mod_rewrite enabled. Once you have previous step completed, change document root to `myproject`.

Ouzo Configuration
------------------

Ouzo configuration is located under `config/prod/Config.php`.

What's important for now is that debug is turned on by default. Please, leave it like this for installation purposes, as you will be able to see detailed error messages in case something goes wrong.

Database Configuration
----------------------

Sample project is using PostgreSQL by default. Database config can be found in Ouzo configuration file:

```php
$config['db']['dbname'] = 'app';
$config['db']['user'] = 'ouzo';
$config['db']['pass'] = 'password';
$config['db']['driver'] = 'pgsql';
$config['db']['host'] = '127.0.0.1';
$config['db']['port'] = '5432';
$config['sql_dialect'] = '\\Ouzo\\Db\\Dialect\\PostgresDialect';
```

You need to provide database name, user name & password, driver, host, port and SQL dialect class. For now Ouzo supports:
* PostgreSQL - \\Ouzo\\Db\\Dialect\\PostgresDialect
* MySQL - \\Ouzo\\Db\\Dialect\\MySqlDialect
* SQLite3 - \\Ouzo\\Db\\Dialect\\Sqlite3Dialect

Remember to create your database and database user first. For PostgreSQL:
```
createuser -P ouzo
createdb app
GRANT ALL PRIVILEGES ON DATABASE app TO ouzo;
```

Migrations
----------

Your database is empty at the beginning. To demonstrate Ouzo capabilities we have created a sample database. Use db.sh script to apply migrations:
```
./db.sh db:migrate
```

To see full list of possible migrations related actions run:
```
./db.sh
```

Ouzo uses Ruckusing framework for migrations (https://github.com/ruckus/ruckusing-migrations).

Check out the app!
------------------

Open your favourite browser and go to http://localhost/myproject. Your first Ouzo project is now running! You can play around by adding, browsing and editing users.

Running tests
-------------

Test configuration can be found in `config/test/Config.php`. You will need separate database for tests purposes only. Set it up in the same way as production one, as described in Database Configration section.

Apply migrations:
```
environment=test ./db.sh db:migrate
```

Now run tests:
```
phpunit --bootstrap bootstrap_test.php test/
```

If all tests are passing, you're good to go!

More
----

Check out Ouzo tutorial:
https://github.com/letsdrink/ouzo/wiki/Tutorial

Ouzo documentation:
https://github.com/letsdrink/ouzo/wiki
