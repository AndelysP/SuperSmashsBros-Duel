<?php
class Attack
{
    public $name;
    public $damage;

    public function __construct($name, $damage)
    {
        $this->name = $name;
        $this->damage = $damage;
    }
}

class AttackCollection
{
    private $items = array();

    public function add(Attack $obj)
    {
        $this->items[] = $obj;
    }

    public function delete(Attack $obj)
    {
        foreach ($this->items as $key => $value) {
            if ($value == $obj) {
                unset($this->items[$key]);
                exit;
            }
        }
    }

    public function get(Attack $obj)
    {
        foreach ($this->items as $key => $value) {
            if ($value == $obj) {
                return $this->items[$key];
            }
        }

        return false;
    }

    public function getAll()
    {
        return $this->items;
    }

    public function length()
    {
        return count($this->items);
    }
}