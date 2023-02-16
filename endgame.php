<?php
if (isset($_GET["win"])) {
    $win = true;
    if ($_GET["win"] == 0) {
        $win = false;
    }
}

include("templates/header.php");
session_start();
?>
<main id="endgame">

    <p><?= $_SESSION["winner_character_name"] ?> a gagné</p>
    <img src="assets/gifs/<?= $_SESSION["winner_character_id"] ?>.gif" alt="<?= $_SESSION["winner_character_name"] ?>">

    <a class="btn" href="./">Nouvelle Partie</a>
</main>

<?php include("templates/footer.php"); ?>