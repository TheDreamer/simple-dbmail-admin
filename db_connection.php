<?php
	$db_link = @mysql_connect (localhost,
                           root,
                           JuthKuz1);
	if ( ! $db_link ){
		die('keine Verbindung zur Zeit möglich - später probieren ');
	}
	$db_sel = mysql_select_db( 'dbmail' )
    or die("Auswahl der Datenbank fehlgeschlagen");
?>