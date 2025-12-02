<?php

require 'config/config.php';

function getCourses(PDO $pdo)
{

    $stmt = $pdo->query("SELECT* FROM course");
    return $stmt->fetchAll();
}

$courses = getCourses($pdo);
foreach ($courses as $course) {
    echo "ID: " . $course['id'] . "<br>";
    echo "Name: " . $course['fullname'] . "<br>";
    echo "Category: " . $course['category'] . "<br>";
    echo "Date: " . $course['course_date'] . "<br>";
    echo "----------------------<br>";
}


function addCourses(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $name = $_POST['fullname'];
        $category = $_POST['category'];
        $date = $_POST['date_c'];
        $hour = $_POST['hour'];
        $duree = $_POST['duree'];
        $max = $_POST['max_p'];

        $sql = "INSERT INTO course (fullname, category, course_date, heure, duree, max_participants)
        VALUES (:fullname, :category, :date_c, :hour, :duree, :max_p)";

        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            ':fullname' => $name,
            ':category' => $category,
            ':date_c' => $date,
            ':hour' => $hour,
            ':duree' => $duree,
            ':max_p' => $max
        ]);

        echo 'saved';
        return $result;
    }

    echo 'not saved';
    return false;
}

addCourses($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="POST">
    <input type="text"     name="fullname">
    <input type="text"     name="category">
    <input type="date"     name="date_c">
    <input type="time"     name="hour">
    <input type="number"   name="duree">
    <input type="number"   name="max_p">

    <button type="submit">Add</button>
</form>

</body>
</html>