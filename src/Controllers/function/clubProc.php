<?php
//get all club
function getAllClub($db)
{
$sql = 'Select club_name, description';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//get club by id
function getClub($db, $clubId)
{
$sql = 'Select * from club ';
$sql .= 'Where id = :id';
$stmt = $db->prepare ($sql);
$id = (int) $clubId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//add new club
function createClub($db, $form_data) 
    {
    $sql = 'Insert into club (club_name, description) ';
    $sql .= 'values (:club_name, :description)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':club_name', $form_data['club_name']);
    $stmt->bindParam(':description', $form_data['description']);
    $stmt->execute();
    return $db->lastInsertID();
    }

//delete club by id
function deleteClub($db,$clubId)
    {
        $sql =' Delete from club where id =:id';
        $stmt = $db->prepare($sql);
        $id = (int)$clubId;
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute(); 
    }
    //update club by id
    function updateClub($db,$form_data,$clubId) {
        $sql = 'UPDATE club SET club_name = :club_name, description = :description WHERE id = :id';

        $stmt= $db->prepare ($sql);
        $id = (int)$clubId;

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':club_name', $form_data['club_name']);
        $stmt->bindParam(':description', $form_data['description']);
        $stmt->execute();
    }