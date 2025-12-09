<?php 

require 'config/config.php';

function getEquipements(PDO $pdo)
{
    $stmt = $pdo->query("SELECT * FROM equipements");
    return $stmt->fetchAll();
}

$equipements = getEquipements($pdo);

function addEquipement(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add') {

        $title = $_POST['title'];
        $type = $_POST['type'];
        $quantite = $_POST['quantite'];
        $etat = $_POST['etat'];

        $sql = "INSERT INTO equipements (title, type, quantite, etat)
                VALUES (:title, :type, :quantite, :etat)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':title'    => $title,
            ':type'     => $type,
            ':quantite' => $quantite,
            ':etat'     => $etat
        ]);
    }
    return false;
}


function getEquipementById(PDO $pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM equipements WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

$equipToEdit = null;
if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['id'])) {
    $equipToEdit = getEquipementById($pdo, $_GET['id']);
}


function updateEquipement(PDO $pdo)
{
    if (isset($_POST['action']) && $_POST['action'] === 'update') {

        $sql = $pdo->prepare("UPDATE equipements 
                              SET title = :title, 
                                  type = :type,
                                  quantite = :quantite,
                                  etat = :etat 
                              WHERE id = :id");

        return $sql->execute([
            ':title'    => $_POST['title'],
            ':type'     => $_POST['type'],
            ':quantite' => $_POST['quantite'],
            ':etat'     => $_POST['etat'],
            ':id'       => $_POST['id']
        ]);
    }
}


function deleteEquipement(PDO $pdo, $id)
{
    $sql = $pdo->prepare("DELETE FROM equipements WHERE id = :id");
    $sql->execute([':id' => $id]);
    return $sql->rowCount() > 0;
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    deleteEquipement($pdo, $_GET['id']);
    header("Location: equip.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['action'] === 'add') {
        addEquipement($pdo);
    }

    if ($_POST['action'] === 'update') {
        updateEquipement($pdo);
    }

    header("Location: equip.php");
    exit;
}


function getTotalEquipments(PDO $pdo){
     $sql = $pdo->query('SELECT count(*) as total FROM course');
     $result =$sql->fetch(PDO::FETCH_ASSOC); 
     return $result['total'];
}

$totalEquipments = getTotalEquipments($pdo);


function getEquipmentsByType($pdo) {
    try {
        $sql = $pdo->query('SELECT type, COUNT(*) as count FROM equipements GROUP BY type');
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $types = [];
        foreach ($result as $row) {
            $types[$row['type']] = $row['count'];
        }
        return $types;
    } catch (Exception $e) {
        return [];
    }
}


$equipmentsByType = getEquipmentsByType($pdo);
