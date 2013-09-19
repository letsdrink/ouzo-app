<?php
$config['db']['dbname'] = '';
$config['db']['user'] = '';
$config['db']['pass'] = '';
$config['db']['driver'] = '';
$config['db']['host'] = '';
$config['db']['port'] = '';
$config['global']['controller'] = 'hello_world';
$config['global']['action'] = 'index';
$config['global']['prefix_system'] = '/framework-skeleton';
$config['debug'] = true;
$config['sql_dialect'] = '\\Ouzo\\Db\\Dialect\\PostgresDialect';

return $config;