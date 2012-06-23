<?php
// Database Settings
// Server access to DBMail, maybe the same user as dbmail use. 

// mysql, pgsql or sqlite
define ( 'DATABASE_TYPE', 'mysql');

// MySQL
define ( 'MYSQL_HOST', 	 'localhost' );
define ( 'MYSQL_PORT',  '3306' );
define ( 'MYSQL_LOGIN',  'dbmail_user' );
define ( 'MYSQL_PASSWORD',  'dbmail_pw' );
define ( 'MYSQL_DATABASE', 'dbmail' );

// PostgreSQL
define ( 'PGSQL_HOST', 'localhost' );
define ( 'PGSQL_PORT', '5432');
define ( 'PGSQL_LOGIN',  'dbmail_user' );
define ( 'PGSQL_PASSWORD',  'dbmail_pw' );
define ( 'PGSQL_DATABASE', 'dbmail' );

// SQLite
// not implemented yet


// simple DBMail Admin web-user
define ('SDBMA_LOGIN', 'admin');
define ('SDBMA_PASSWORD', 'sdbma');
?>