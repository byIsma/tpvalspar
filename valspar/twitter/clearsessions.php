<?php
/**
 * @file
 * Clears PHP sessions and redirects to the connect page.
 */
 
/* Load and clear sessions */
session_start();
 
/* Redirect to page with the connect to Twitter option. */
header('Location: ./connect.php?ID='.$_GET['ID'].'&SubmitID='.$_GET['SubmitID']);

?>
