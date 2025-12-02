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


