<?php
$envs = getenv();
$dbhost = 'db'; // hostname corresponds to service name from docker-compose.yml file
$dbName = $envs['MYSQL_DATABASE'];
$dbUser = $envs['MYSQL_USER'];
$dbPass = $envs['MYSQL_PASSWORD'];
$dbReset = false;

$db = new mysqli($dbhost,$dbUser,$dbPass,$dbName);
if ($db->connect_error) die($db->connect_error);

if (isset($_POST['rename'])) {
    $oldName = $_POST['oldName'];
    $newName = $_POST['newName'];
    if(!$res = $db->multi_query("UPDATE test339 SET name='$newName' WHERE name='$oldName'")) {
        die("Update failed: (" . $db->errno . ") " . $db->error);
    }
} elseif (isset($_POST['add'])) {
    $name = $_POST['name'];
    if(!$res = $db->multi_query("INSERT INTO test339 VALUES (NULL, '$name')")) {
        die("Insert failed: (" . $db->errno . ") " . $db->error);
    }
} else {
    if (!$db->query("CREATE DATABASE IF NOT EXISTS `$dbName`") ||
        !$db->query("USE `$dbName`") ||
        !$db->query("DROP TABLE IF EXISTS `test339`") ||
        !$db->query("CREATE TABLE `test339` (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(30))") ||
        !$db->query("INSERT INTO `test339` VALUES (1,'Bob'),(2,'Joe'),(3,'Jane')")) {
            die("Database reset failed: (" . $db->errno . ") " . $db->error);
    }
    $dbReset = true;
}

$res = $db->query("SELECT * FROM test339");

?>

<html>
<body>

    <?= $dbReset ? "<p>No form submission detected - Database reset to the default state</p>" : "" ?>

    <?php
      while ($row = $res->fetch_assoc()) {
        echo " id = " . $row['id'] . " name = " . $row['name'] . " <BR>";
      }
    ?>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post"><pre>
        <label>Old Name <input type="text" name="oldName"></label>
        <label>New Name <input type="text" name="newName"></label>
        <input type="submit" name="rename" value="Rename"><input type="reset" value="Reset">
    </pre></form>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post"><pre>
        <label>Name <input type="text" name="name"></label>
        <input type="submit" name="add" value="Add Name">
    </pre></form>

</body>
</html>
