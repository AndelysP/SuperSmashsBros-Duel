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
    <div class="over__content">
        <img src="assets/gifs/<?= $_SESSION["winner_character_id"] ?>.gif" alt="<?= $_SESSION["winner_character_name"] ?> " class="over__content-image">
        <h1 class="over__content-text"><?= $_SESSION["winner_character_name"] ?> a gagné</h1>
        <a class="over__content-replay" href="./">Rejouer</a>
    </div>    
</main>

<?php include("templates/footer.php"); ?>