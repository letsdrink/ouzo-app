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

What's important for now is that is debug turned on by default. Please, leave it like this for installation purposes, as you will be able to see detailed error messages in case something goes wrong.

Database Configuration
----------------------

Sample project is using PostgreSQL by default. Database config can be found in Ouzo configuration file:

```
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

Your database is empty at the beginning. To demonstrate Ouzo capabilities we have created sample database. Use db.sh script to apply migrations:
```
./db.sh db:migrate
```

To see full list of possible migrations related actions run:
```
./db.sh
```

Ouzo uses Ruckusing framework for migrations (https://github.com/ruckus/ruckusing-migrations).
