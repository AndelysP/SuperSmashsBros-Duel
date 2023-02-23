<?php
$json = file_get_contents("characters.json");
$characters = json_decode($json, true);

include("templates/header.php");
?>

<main>
    <h2>Sélection du personnage</h2>
    <div class="characters">
        <?php
        foreach ($characters as $character) {
        ?>
            <div class="character selected" data-id="<?= $character["id"] ?>">

                <audio id="myAudio">
                    <source src="./assets/sounds/select_sound.mp3" type="audio/mpeg">
                </audio>

                <img src="assets/img/characters/<?= $character["id"] ?>_card.png" alt="<?= $character["name"] ?>" onmouseover="playSound()">

                <ul class="spells">
                    <?php foreach ($character["attacks"] as $spell) { ?>
                        <li>
                            <img src="assets/img/spells/<?= $spell["id"] ?>.png" alt="">
                            <div class="spell-name">
                                <p><?= $spell["name"] ?></p>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php
        }
        ?>
    </div>
</main>

<?php
include("templates/footer.php");
?>