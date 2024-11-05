<?php include "../alumno/header_alumno.php"; ?>
<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];
?>
    <article class="entrada">
        <div class="entrada_contenido">
            <h4 class="no-margin">Alumno</h4>
            <?php
            echo "<h4>Bienvenido " . htmlspecialchars($user) . "</h4>";
            ?>
        </div>
    </article>
<?php
} else {
    header("Location: login.php");
}
?>
