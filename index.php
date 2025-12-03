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


function getCourseById(PDO $pdo, $id){
    $stmt = $pdo->prepare("SELECT * from course where id = :id");
    $stmt->execute([ ':id'=> $id]);
    return $stmt->fetch();
}

$courseEdit = null ;
if(isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['id'])){
    $courseEdit =  getCourseById($pdo , $_GET['id']);
}


function updateCourse(PDO $pdo){
    if(isset($_POST['action']) && $_POST['action'] === 'update'){

        $sql = $pdo->prepare("UPDATE course SET fullname = :fullname, category = :category , 
        course_date =:date_c, heure = :heure , duree = :duree , max_participants = :max_p WHERE id = :id");
        $sql->execute([
           ':fullname' => $_POST['fullname'],
            ':category' => $_POST['category'],
            ':date_c'   => $_POST['date_c'],
            ':heure'    => $_POST['hour'],
            ':duree'    => $_POST['duree'],
            ':max_p'    => $_POST['max_p'],
            ':id'       => $_POST['id']
        ]);
        echo 'course updated'; 
    }
}

function deleteCourse(PDO $pdo, $id){
        $sql = $pdo->prepare("DELETE FROM course WHERE id = :id");
        $sql->execute([':id' => $id]);
        return $sql->rowCount() > 0 ; 

    // }:
}

if(isset($_GET['action']) && $_GET['action'] === "delete"){
    $id = $_GET['id'];
    deleteCourse($pdo , $id);
}



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_POST['action'] === 'add'){
        addCourses($pdo);
    }

    if($_POST['action'] === 'update'){
        updateCourse($pdo);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<table >
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>

    <?php foreach($courses as $course): ?>
    <tr>
        <td><?= $course['id'] ?></td>
        <td><?= $course['fullname'] ?></td>
        <td><?= $course['category'] ?></td>
        <td><?= $course['course_date'] ?></td>
        <td>
            <a href="index.php?action=update&id=<?= $course['id'] ?>">Edit</a>
            <a href="index.php?action=delete&id=<?= $course['id'] ?>">delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


<form method="POST">
    <input type="hidden" name="action" value="add">

    <input type="text"     name="fullname" placeholder="Name">
    <input type="text"     name="category" placeholder="Category">
    <input type="date"     name="date_c">
    <input type="time"     name="hour">
    <input type="number"   name="duree" placeholder="Duration">
    <input type="number"   name="max_p" placeholder="Max participants">

    <button type="submit">Add</button>
</form>


<?php if ($courseEdit): ?>
<form method="POST">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?= $courseEdit['id'] ?>">

    <input type="text" name="fullname" value="<?= $courseEdit['fullname'] ?>">
    <input type="text" name="category" value="<?= $courseEdit['category'] ?>">
    <input type="date" name="date_c" value="<?= $courseEdit['course_date'] ?>">
    <input type="time" name="hour" value="<?= $courseEdit['heure'] ?>">
    <input type="number" name="duree" value="<?= $courseEdit['duree'] ?>">
    <input type="number" name="max_p" value="<?= $courseEdit['max_participants'] ?>">

    <button type="submit">Update</button>
</form>
<?php endif; ?>

</body>
</html>




<!-- NOTE: QUAND ON FAIT UPDATE THE USER IS BEING UPDATED MAIS IL EST AJOUTEE UNE AUTRE FOIS C4EST PARCEQUE ON TRAVAIL AVEC 2 FORM ET LES DEUX ENVOIE UNE REPONSE PAR LA METHODE POST ALORS ça CREER UN CONFLIT  -->