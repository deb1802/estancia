<?php include "header_conductor.php"; ?>
<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];
?>
    <article class="entrada">
        <div class="entrada_contenido">
            <h4 class="no-margin">upemov</h4>
            <h4 class="no-margin">conductor</h4>
            <?php
            echo "<h4>Hola " . htmlspecialchars($user) . "</h4>";
            ?>
        </div>
    </article>
<?php
} else {
    header("Location: login.php");
}
?>
