<?php
$config['db']['dbname'] = 'app';
$config['db']['user'] = 'postgres';
$config['db']['pass'] = '';
$config['db']['driver'] = 'pgsql';
$config['db']['host'] = '127.0.0.1';
$config['db']['port'] = '5432';
$config['global']['prefix_system'] = '/ouzo-test';
$config['debug'] = true;
$config['sql_dialect'] = '\\Ouzo\\Db\\Dialect\\PostgresDialect';

return $config;