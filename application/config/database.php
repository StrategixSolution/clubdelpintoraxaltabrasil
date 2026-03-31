<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_group = 'default';
$query_builder = TRUE;
$db['default'] = array(   
    'hostname'      => 'Driver={SQL Server};Server=LENOVOLUISFE;Database=clubdelpintoraxaltabrasil;Uid=CDPBrasilUser;Pwd=CDPBrasil2026@;',
    'username'      => 'CDPBrasilUser',
    'password'      => 'CDPBrasil2026@',
    'database'      => 'clubdelpintoraxaltabrasil',
    'dbdriver'      => 'odbc',
    'dbprefix'      => '',
    'pconnect'      => FALSE,
    'db_debug'      => (ENVIRONMENT !== 'production'),
    'cache_on'      => FALSE,
    'cachedir'      => '',
    'char_set'      => 'utf8',
    'dbcollat'      => 'utf8_general_ci',
    'swap_pre'      => '',
    'encrypt'       => FALSE,
    'compress'      => FALSE,
    'stricton'      => FALSE,
    'failover'      => array(),
    'save_queries'  => TRUE
);
$db['sx'] = array(
        'hostname' => 'Driver={SQL Server};Server=LENOVOLUISFE;Database=Strategix;Uid=StrategixUser;Pwd=KuwecRVpMg89;',
	'username' => 'StrategixUser',
	'password' => 'KuwecRVpMg89',
	'database' => 'Strategix',
	'dbdriver' => 'odbc',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
