<?php
include '../model/db.php';

function eliminarTrayectoria($id) {
    global $conn;

    $sql = "DELETE FROM trayectorias2 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}
