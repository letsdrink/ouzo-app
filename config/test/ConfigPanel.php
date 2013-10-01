<?php
$config['db']['dbname'] = 'app_test';
$config['db']['user'] = 'thulium_1';
$config['db']['pass'] = '';
$config['db']['driver'] = 'pgsql';
$config['db']['host'] = '127.0.0.1';
$config['db']['port'] = '5432';
$config['global']['controller'] = 'hello_world';
$config['global']['action'] = 'index';
$config['global']['prefix_system'] = '/ouzo-test';
$config['sql_dialect'] = '\\Ouzo\\Db\\Dialect\\PostgresDialect';

return $config;