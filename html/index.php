<?php
    function testDBConnection($servername, $dbname, $username, $password)
    {
        echo "<h2>Test the connection to $servername</h2>\n";
        try
        {
            $conn = new PDO("sqlsrv:Server=$servername;Database=$dbname;TrustServerCertificate=true", $username, $password);
            echo "Connected successfully (with PDO)<br>\n";
            $conn = null; // close connection
        }
        catch (Throwable $e)
        {
            echo "PDO failed: " . $e->getMessage() . "<br>\n";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Docker MSSQL NGINX PHP</title>
</head>
<body>
<h1>Docker MSSQL NGINX PHP</h1>
<?php
    // Information
    echo "<h2>Information</h2>\n";
    echo "<pre>\n";
    echo "PHP Version:        " . phpversion() . "\n";
    echo "IP of php:          " . gethostbyname("php") . "\n";
    echo "IP of nginx:        " . gethostbyname("nginx") . "\n";
    echo "IP of mssqldb:      " . gethostbyname("mssqldb") . "\n";
    echo "Int range and size: " . PHP_INT_MIN . " to " . PHP_INT_MAX . " (" . PHP_INT_SIZE . " bytes)" . "\n";
    echo "Year 2038 check:    " . (date("y", strtotime("2039-01-01")) == 39 ? "OK no bug" : "bug present!") . "\n";
    echo "</pre>\n";

    // Test DB connection
    // Note: for MSSQL Servers separate the server name and the port with a comma and not a colon.
    echo "<p>For the following tests a \"Connection refused\" may be returned when the DB server is starting.</p>\n";
    testDBConnection("mssqldb,1433", "", "sa", "123456Ms");
?>
<br>
<hr>
<a href="phpinfo.php" target="_blank">Show PHP info</a>
</body>
</html>