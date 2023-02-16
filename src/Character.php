<?php
require_once("Attack.php");

class Character
{
    public $id;
    public $name;
    public $puissance;
    private $health = 100;
    private $attacks = array();
    private $evasion;
    // private $attacks = new AttackCollection();

    public function __construct(int $id, string $name, int $puissance, $evasion) {
        $this->id = $id;
        $this->name = $name;
        $this->puissance = $puissance;
        $this->evasion = $evasion;
    }
    
    public function getHealth() {
        return $this->health;
    }

    public function addAttack(Attack $attackObj) {
        array_push($this->attacks, $attackObj);
        //$this->attacks->add($attackObj);
    }

    public function getAttacks() {
        return $this->attacks;
        //return $this->attacks->getAll();
    }

    public function getEvasion() {
        return $this->evasion;
    }

    public function attack(Attack $attackObj) {
        $shot = ($attackObj->damage * $this->puissance) / 100;
        return $shot;
    }

    public function isAttacked(float $damage) {
        $this->health -= $damage;
    }
}
