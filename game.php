<?php
require("src/Character.php");

session_start();

if (!isset($_SESSION["player"])) {
    header("location:./");
}

function doAttack(Character $attacker, Character $defender, int $index = null)
{
    $attacks = $attacker->getAttacks();
    if (!isset($index)) {
        $index = array_rand($attacks);
    }
    $attack = $attacks[$index];

    $shot = $attacker->attack($attack);

    $counter = rand(0, 100);
    if ($counter <= $defender->getEvasion()) {
        // L'attaque a été esquivée
        $_SESSION["fightSummary"] .= "<p>{$defender->name} esquive l'attaque de {$attacker->name} !</p>";
        return;
    }

    $defender->isAttacked($shot);

    $_SESSION["fightSummary"] .= "<p>{$attacker->name} lance une attaque {$attack->name} qui a infligé {$shot} dégâts sur {$defender->name}</p>";
}

$availableCharacters = [/* Liste des personnages disponibles */];
foreach ($availableCharacters as $index => $character) {
    if ($character == $_SESSION["player"]) {
        unset($availableCharacters[$index]);
    }
}

if (isset($_GET["attack"])) {
    doAttack($_SESSION["player"], $_SESSION["ia"], $_GET["attack"]);

    // au tour de ton adversaire
    doAttack($_SESSION["ia"], $_SESSION["player"]);
}

if ($_SESSION["ia"]->getHealth() <= 0) {
    // Bien joué ;)
    $_SESSION["winner_character_name"] = $_SESSION["player"]->name;
    $_SESSION["winner_character_id"] = $_SESSION["player"]->id;

    header("location:./endgame.php?win=1");
} elseif ($_SESSION["player"]->getHealth() <= 0) {
    // Game over :(
    $_SESSION["winner_character_name"] = $_SESSION["ia"]->name;
    $_SESSION["winner_character_id"] = $_SESSION["ia"]->id;
    header("location:./endgame.php?win=0");
}

$player = $_SESSION["player"];
$ia = $_SESSION["ia"];
$fightSummary = $_SESSION["fightSummary"];

include("templates/header.php");
?>

<main>
    <h2>Duel</h2>
    <div class="characters versus">
        <div class="character">
            <div class="character_card">
                <img src="assets/img/characters/<?= $player->id ?>_card.png" alt="<?= $player->name ?>" class="character_picture">
                <img src="assets/gifs/<?= $player->id ?>.gif" alt="<?= $player->name ?>" class="character_picture-hover">
            </div>
            <div class="character-specs-wrapper">
                <div class="character-specs <?= $player->type ?>-shadow">
                    <div class="character-spec-item">
                        <span><?= $player->puissance ?></span>
                    </div>
                    <div class="character-spec-item">
                        <label class="d-none" for="playerHealth">Santé :</label>
                        <progress id="playerHealth" max="100" value="<?= $player->getHealth() ?>"><?= $player->getHealth() ?>%</progress>
                        <span><?= $player->getHealth() ?>%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="fight-summary">
            <span>vs</span>
            <p><?= $fightSummary ?></p>
        </div>
        <div class="character">
            <div class="character_card">
                <img src="assets/img/characters/<?= $ia->id ?>_card.png" alt="<?= $ia->name ?>" class="character_picture">
                <img src="assets/gifs/<?= $ia->id ?>.gif" alt="<?= $ia->name ?>" class="character_picture-hover">
            </div>

            <div class="character-specs-wrapper">
                <div class="character-specs <?= $ia->type ?>-shadow">
                    <div class="character-spec-item">
                        <span><?= $ia->puissance ?></span>
                    </div>
                    <div class="character-spec-item">
                        <label class="d-none" for="iaHealth">Santé :</label>
                        <progress id="iaHealth" max="100" value="<?= $ia->getHealth() ?>"><?= $ia->getHealth() ?>%</progress>
                        <span><?= $ia->getHealth() ?>%</span>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="attacks">
        <span>Attaques :</span>
        <?php
        foreach ($player->getAttacks() as $index => $attack) {
        ?>
            <a class="btn" href="./game.php?attack=<?= $index ?>"><?= $attack->name ?></a>
        <?php
        }
        ?>
    </div>
</main>

<?php
include("templates/footer.php")
?>