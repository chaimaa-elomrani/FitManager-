<?php
require 'courses.php';

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