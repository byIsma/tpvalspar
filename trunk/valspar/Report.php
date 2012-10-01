<?php
/*
 * PHP code to export MySQL data to CSV
 * http://911-need-code-help.blogspot.com/2009/07/export-mysql-data-to-csv-using-php.html
 *
 * Sends the result of a MySQL query as a CSV file for download
 */

/*
 * establish database connection
 */

include("mysql_connect.php");


/*
 * send response headers to the browser
 * following headers instruct the browser to treat the data as a csv file called export.csv
 */

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=export.csv');

/*
 * execute sql query
 */

/*
 * output header row (if atleast one row exists)
 */
echo "Image Selected, Number\r\n";
for ( $i = 1 ; $i <= 5 ; $i++ )
{
	$strSqlCommand = 'SELECT COUNT(*) FROM submitlist WHERE PictureSelect = "'. $i . '"';

	if (! $result = mysql_query($strSqlCommand))
	{
		echo "Connection Database Failed, Please Try again later.";
	}
	else
	{
		$row = @mysql_fetch_array($result);
		echo "Image ".$i." Total Share, ".$row[0]."\r\n";
	}
}

$query = sprintf('SELECT Name, Email, PictureSelect, Date, Facebook, Twitter FROM submitlist');
$result = mysql_query($query);

$row = mysql_fetch_assoc($result);
if ($row) {
    echocsv(array_keys($row));
}

/*
 * output data rows (if atleast one row exists)
 */

while ($row) {
    echocsv($row);
    $row = mysql_fetch_assoc($result);
}

/*
 * echo the input array as csv data maintaining consistency with most CSV implementations
 * - uses double-quotes as enclosure when necessary
 * - uses double double-quotes to escape double-quotes 
 * - uses CRLF as a line separator
 */

function echocsv($fields)
{
    $separator = '';
    foreach ($fields as $field) {
        if (preg_match('/\\r|\\n|,|"/', $field)) {
            $field = '"' . str_replace('"', '""', $field) . '"';
        }
        echo $separator . $field;
        $separator = ',';
    }
    echo "\r\n";
}
?>