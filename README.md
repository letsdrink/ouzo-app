Ouzo - 5 minutes tutorial
=========================

[![Build Status](https://travis-ci.org/letsdrink/ouzo-app.svg?branch=1.4.0)](https://travis-ci.org/letsdrink/ouzo-app)

How to use Ouzo step by step. It takes only 5 minutes to set up sample project and start experiencing Ouzo.

Set up project
--------------

Simply use composer (http://getcomposer.org):

```
composer.phar create-project letsdrink/ouzo-app:1.4.0 myproject
```

Where `myproject` is your project's name.

After downloading Ouzo and its dependencies you will be asked what database you want to use. Ouzo will prepare config files for you. Database configuration can be changed manually later if needed.

PHP Version
-----------

You need:
* PHP 5.3 or later installed. Currently Ouzo is tested on 5.3, 5.4, 5.5 and 5.6 environments.
* Database driver, accordingly to the database your are using.

In order to get list of available drivers check http://www.php.net/manual/en/pdo.getavailabledrivers.php.

Configure HTTP Server
---------------------

Ouzo apps can be run on Apache web server. It needs mod_rewrite enabled. Once you have previous step completed, change document root to `myproject`.

Ouzo Configuration
------------------

Ouzo configuration is located under `config/prod/config.php`.

What's important for now is that debug is turned on by default. Please, leave it like this for installation purposes, as you will be able to see detailed error messages in case something goes wrong.

Database Configuration
----------------------

Configuration is automatically generated for database of your choice. The only thing you need to do is to create database and database user first.

For MySQL:
```sql
CREATE DATABASE myproject;
CREATE USER 'ouzo'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON myproject.* TO 'ouzo'@'localhost';
```

For PostgreSQL:
```sql
CREATE DATABASE myproject;
CREATE USER ouzo WITH PASSWORD 'password';
GRANT ALL PRIVILEGES ON DATABASE myproject to ouzo;
```

If you do not use composer, sample project has PostgreSQL by default. Database config can be found in Ouzo configuration file:

```php
$config['db']['dbname'] = 'myproject';
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

Test configuration can be found in `config/test/config.php`. You will need separate database for tests purposes only. 

Set up for MySQL:
```sql
CREATE DATABASE myproject_test;
GRANT ALL PRIVILEGES ON myproject_test.* TO 'ouzo'@'localhost';
```

Set up for PostgreSQL:
```sql
CREATE DATABASE myproject_test;
GRANT ALL PRIVILEGES ON DATABASE myproject_test to ouzo;
```

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

Skeleton app explained:
http://ouzo.readthedocs.org/en/latest/tutorials/project_structure_explained.html

Ouzo documentation:
http://ouzo.readthedocs.org
