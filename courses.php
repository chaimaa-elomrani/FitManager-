<?php
require 'config/config.php';


function getCourses(PDO $pdo)
{
    $stmt = $pdo->query("SELECT* FROM course");
    return $stmt->fetchAll();
}
$courses = getCourses($pdo);    

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

    return false;
}


function getCourseById(PDO $pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * from course where id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

$courseEdit = null;
if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['id'])) {
    $courseEdit = getCourseById($pdo, $_GET['id']);
}


function updateCourse(PDO $pdo)
{
    if (isset($_POST['action']) && $_POST['action'] === 'update') {

        $sql = $pdo->prepare("UPDATE course SET fullname = :fullname, category = :category , 
        course_date =:date_c, heure = :heure , duree = :duree , max_participants = :max_p WHERE id = :id");
        $sql->execute([
            ':fullname' => $_POST['fullname'],
            ':category' => $_POST['category'],
            ':date_c' => $_POST['date_c'],
            ':heure' => $_POST['hour'],
            ':duree' => $_POST['duree'],
            ':max_p' => $_POST['max_p'],
            ':id' => $_POST['id']
        ]);
        echo 'course updated';
    }
}

function deleteCourse(PDO $pdo, $id)
{
    $sql = $pdo->prepare("DELETE FROM course WHERE id = :id");
    $sql->execute([':id' => $id]);
    return $sql->rowCount() > 0;

}

if (isset($_GET['action']) && $_GET['action'] === "delete") {
    $id = $_GET['id'];
    deleteCourse($pdo, $id);
    header('Location: index.php');
    exit();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'add') {
        addCourses($pdo);
        header('Location: index.php');
        exit();
    }

    if ($_POST['action'] === 'update') {
        updateCourse($pdo);
        header("Location: index.php");
        exit();
    }
}



function getTotalCourses(PDO $pdo){
     $sql = $pdo->query('SELECT count(*) as total FROM course');
     $result =$sql->fetch(PDO::FETCH_ASSOC); 
     return $result['total'];
}

$totalCourses = getTotalCourses($pdo);

function getCoursesByCategory($pdo) {
    $sql = $pdo->query('SELECT category, COUNT(*) as count FROM course GROUP BY category');
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    $categories = [];
    foreach ($result as $row) {
        $categories[$row['category']] = $row['count'];
    }
    return $categories;
}


$coursesByCategory = getCoursesByCategory($pdo);
