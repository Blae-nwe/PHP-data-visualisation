<?php
class Data
{
    public $TypeOfForce;
    public $Tactic;
    public $Total;

    public function __construct($typeOfForce, $tactic, $total)
    {
        $this->TypeOfForce = $typeOfForce;
        $this->Tactic = $tactic;
        $this->Total = $total;
    }

    public function getTypeOfForce()
    {
        return $this->TypeOfForce;
    }

    public function getTactic()
    {
        return $this->Tactic;
    }

    public function getTotal()
    {
        return $this->Total;
    }
}
?>
