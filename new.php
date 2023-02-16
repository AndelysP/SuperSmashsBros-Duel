<?php
require("src/Character.php");

session_start();

$json = file_get_contents("characters.json");
$characters = json_decode($json, true);

$user = array_search($_GET["id"], array_column($characters, "id"));

if (is_bool($user)) {
    header("location:./");
}

$obj = $characters[$user];
// Création du personnage que nous avons sélectionné
$player = new Character($obj["id"], $obj["name"], $obj["puissance"], $obj["esquive"]);
// Ajout des attaques à notre personnage
foreach ($obj["attacks"] as $attack) {
    $objAttack = new Attack($attack["name"], $attack["damage"]);
    $player->addAttack($objAttack);
}
// Stockage de l'objet en session
$_SESSION["player"] = $player;

// Obtenir une ia aléatoire et différente du joueur sélectionné
$ia = array_search($_GET["id"], array_column($characters, "id"));
do {
    $user = array_rand($characters);
} while ($user == $ia);


$obj = $characters[$user];
// Création du personnage de l'ia
$ia = new Character($obj["id"], $obj["name"], $obj["puissance"], $obj["esquive"]);
foreach ($obj["attacks"] as $attack) {
    $objAttack = new Attack($attack["name"], $attack["damage"]);
    $ia->addAttack($objAttack);
}
$_SESSION["ia"] = $ia;

// Initialisation du résumé du combat à venir
$_SESSION["fightSummary"] = "";

header("Location: ./game.php");
