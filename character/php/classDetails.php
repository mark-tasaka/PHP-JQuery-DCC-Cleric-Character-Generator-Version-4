<?php

/*Cleric*/

function savingThrowReflex($level)
{
    $reflex = 0;

    if($level >= 3 && $level <= 5)
    {
        $reflex = 1;
    }
    
    if($level >= 6 && $level <= 8)
    {
        $reflex = 2;
    }

    if($level >= 9)
    {
        $reflex = 3;
    }

    return $reflex;

}


function savingThrowFort($level)
{
    $fort = 0;

    if($level >= 1 && $level <= 3)
    {
        $fort = 1;
    }
    
    if($level >= 4 && $level <= 6)
    {
        $fort = 2;
    }

    if($level >= 7 && $level <= 9)
    {
        $fort = 3;
    }

    if($level >= 10)
    {
        $fort = 4;
    }

    return $fort;

}


function savingThrowWill($level)
{
    $will = 0;

    if($level >= 1 && $level <= 2)
    {
        $will = 1;
    }
    
    if($level >= 3 && $level <= 4)
    {
        $will = 2;
    }

    if($level == 5)
    {
        $will = 3;
    }
    
    if($level >= 6 && $level <= 7)
    {
        $will = 4;
    }
    
    if($level >= 8 && $level <= 9)
    {
        $will = 5;
    }

    if($level == 10)
    {
        $will = 6;
    }

    return $will;

}

function criticalDie($level)
{
    $critical = "";

    if($level >= 1 && $level <=2)
    {
        $critical = "1d8/III";
    }

    if($level >= 3 && $level <=4)
    {
        $critical = "1d10/III";
    }

    if($level >= 5 && $level <=6)
    {
        $critical = "1d12/III";
    }

    if($level >= 7 && $level <=8)
    {
        $critical = "1d14/III";
    }

    if($level >= 9)
    {
        $critical = "1d16/III";
    }

    return $critical;

}

function attackBonus($level)
{
    $attackBonus = 0;

    if($level == 2)
    {
        $attackBonus = 1;
    }
    
    if($level >= 3 && $level <= 4)
    {
        $attackBonus = 2;
    }

    if($level == 5)
    {
        $attackBonus = 3;
    }

    if($level == 6)
    {
        $attackBonus = 4;
    }
    
    if($level >= 7 && $level <= 8)
    {
        $attackBonus = 5;
    }

    if($level == 9)
    {
        $attackBonus = 6;
    }

    if($level == 10)
    {
        $attackBonus = 7;
    }
    

    return $attackBonus;
}

function actionDice($level)
{
    $actionDice = "";

    if($level <= 5)
    {
        $actionDice = "1d20";
    }

    if($level == 6)
    {
        $actionDice = "1d20+1d14";
    }

    if($level == 7)
    {
        $actionDice = "1d20+1d16";
    }

    if($level >= 8)
    {
        $actionDice = "1d20+1d20";
    }

    return $actionDice;
}


function title($level, $alignment)
{
    $title = "";

    if($alignment == "Lawful")
    {

        if($level == 1)
        {
            $title = "Acolyte";
        }
        else if($level == 2)
        {
            $title = "Heathen-slayer";
        }
        else if($level == 3)
        {
            $title = "Brother";
        }
        else if($level == 4)
        {
            $title = "Curate";
        }
        else
        {
            $title = "Father";
        }

    }

    if($alignment == "Neutral")
    {
        if($level == 1)
        {
            $title = "Witness";
        }
        else if($level == 2)
        {
            $title = "Pupil";
        }
        else if($level == 3)
        {
            $title = "Chronicler";
        }
        else if($level == 4)
        {
            $title = "Judge";
        }
        else
        {
            $title = "Druid";
        }
    }

    if($alignment == "Chaotic")
    {
        if($level == 1)
        {
            $title = "Zealot";
        }
        else if($level == 2)
        {
            $title = "Convert";
        }
        else if($level == 3)
        {
            $title = "Cultist";
        }
        else if($level == 4)
        {
            $title = "Apostle";
        }
        else
        {
            $title = "High Priest";
        }
    }

return $title;

}

function spellsPerLevel($level)
{
    if($level == 1)
    {
        $spells = array("4", "-", "-", "-", "-");
        return $spells;
    }
    
    if($level == 2)
    {
        $spells = array("5", "-", "-", "-", "-");
        return $spells;
    }
    
    if($level == 3)
    {
        $spells = array("5", "3", "-", "-", "-");
        return $spells;
    }
    
    if($level == 4)
    {
        $spells = array("6", "4", "-", "-", "-");
        return $spells;
    }
    
    if($level == 5)
    {
        $spells = array("6", "5", "2", "-", "-");
        return $spells;
    }
    
    if($level == 6)
    {
        $spells = array("7", "5", "3", "-", "-");
        return $spells;
    }
    
    if($level == 7)
    {
        $spells = array("7", "6", "4", "1", "-");
        return $spells;
    }
    
    if($level == 8)
    {
        $spells = array("8", "6", "5", "2", "-");
        return $spells;
    }
    
    if($level == 9)
    {
        $spells = array("8", "7", "5", "3", "1");
        return $spells;
    }
    
    if($level == 10)
    {
        $spells = array("9", "7", "6", "4", "2");
        return $spells;
    }


}


?>