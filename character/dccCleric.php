<!DOCTYPE html>
<html>
<head>
<title>Dungeon Crawl Classics Cleric Character Generator Version 4</title>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
	<meta charset="UTF-8">
	<meta name="description" content="Dungeon Crawl Classics Cleric Character Generator. Goblinoid Games.">
	<meta name="keywords" content="Dungeon Crawl Classics, Goblinoid Games,HTML5,CSS,JavaScript">
	<meta name="author" content="Mark Tasaka 2023">
    
    <link rel="icon" href="../../../../images/favicon/icon.png" type="image/png" sizes="16x16"> 
		

	<link rel="stylesheet" type="text/css" href="css/cleric.css">
	<link rel="stylesheet" type="text/css" href="css/cleric_post.css">
    
    
    <script type="text/javascript" src="./js/dieRoll.js"></script>
    <script type="text/javascript" src="./js/modifiers.js"></script>
    <script type="text/javascript" src="./js/hitPoinst.js"></script>
    <script type="text/javascript" src="./js/abilityScoreAddition.js"></script>
    <script type="text/javascript" src="./js/criticalDie.js"></script>
    <script type="text/javascript" src="./js/classAbilities.js"></script>
    <script type="text/javascript" src="./js/occupation.js"></script>
    <script type="text/javascript" src="./js/luckySign.js"></script>
    <script type="text/javascript" src="./js/adjustments.js"></script>
    <script type="text/javascript" src="./js/languages.js"></script>
    
    
    
</head>
<body>
    
    <!--PHP-->
    <?php
    
    include 'php/armour.php';
    include 'php/checks.php';
    include 'php/weapons.php';
    include 'php/gear.php';
    include 'php/classDetails.php';
    include 'php/clothing.php';
    include 'php/abilityScoreGen.php';
    include 'php/randomName.php';
    include 'php/clericAlignment.php';
    include 'php/xp.php';
    include 'php/nameSelect.php';
    include 'php/gender.php';
    

    if(isset($_POST["theCharacterName"]))
    {
        $characterName = $_POST["theCharacterName"];

    }

    
    if(isset($_POST["theGivenName"]))
    {
        $givenName = $_POST["theGivenName"];

    }

    if($givenName == '100')
    {
        $givenName = rand(0, 49);
    }
    else
    {
        $givenName = $givenName;
    }
    


    if(isset($_POST["theSurname"]))
    {
        $surname = $_POST["theSurname"];

    }

    if($surname == '100')
    {
        $surname = rand(0, 37);
    }
    else
    {
        $surname = $surname;
    }



    if(isset($_POST['theCheckBoxCustomName']) && $_POST['theCheckBoxCustomName'] == 1) 
    {
        $givenName = 200;
        $surname = 200;
        
    } 
    
    if(isset($_POST["theGender"]))
    {
        $gender = $_POST["theGender"];
    }

    
    $genderName = getGenderName($gender);
    $genderNameIdentifier = genderNameGeneration ($gender);

    $fullName = getName($givenName, $surname, $genderNameIdentifier);


    if(isset($_POST["thePlayerName"]))
    {
        $playerName = $_POST["thePlayerName"];

    }


        if(isset($_POST['theCheckBoxRandomName']) && $_POST['theCheckBoxRandomName'] == 1) 
        {
            $characterName = getRandomName($gender) . " " . getSurname();
        } 

    //For Random Select Diety
    if(isset($_POST['thecheckBoxRandomDiety']) && $_POST['thecheckBoxRandomDiety'] == 1) 
    {
        $deity = rand (0, 18);
       /* $deity = getRandomDiety();*/

    }
    else
    {
        if(isset($_POST["theDeity"]))
        {
            $deity = $_POST["theDeity"];
        }

    }


        $deityName = getDeity($deity)[0];
        $deityDescription = getDeity($deity)[1];
        $alignment = getDeity($deity)[2];

        $weaponsAllowed = getDeityWeapons($deity);

        $unholy = getDeityUnholy($deity);


    
        if(isset($_POST["theLevel"]))
        {
            $level = $_POST["theLevel"];
        
        } 

        $xpNextLevel = getXPNextLevel ($level);
        
        if(isset($_POST["theAbilityScore"]))
        {
            $abilityScoreGen = $_POST["theAbilityScore"];
        
        } 
    
    $generationMessage = generationMesssage ($abilityScoreGen);
            
    $abilityScoreArray = array();

    if(isset($_POST['theCustomAbilityScore']) && $_POST['theCustomAbilityScore'] == 1) 
    {        
        
        if(isset($_POST["theStrength"]))
        {
            $strengthString = $_POST["theStrength"];
            $strength = intval($strengthString);
        }      

        if(isset($_POST["theAgility"]))
        {
            $agilityString = $_POST["theAgility"];
            $agility = intval($agilityString);
        }     

        if(isset($_POST["theStamina"]))
        {
            $staminaString = $_POST["theStamina"];
            $stamina = intval($staminaString);
        }    

        if(isset($_POST["thePersonality"]))
        {
            $personalityString = $_POST["thePersonality"];
            $personality = intval($personalityString);
        }  

        if(isset($_POST["theIntelligence"]))
        {
            $intelligenceString = $_POST["theIntelligence"];
            $intelligence = intval($intelligenceString);
        }  


        if(isset($_POST["theLuck"]))
        {
            $luckString = $_POST["theLuck"];
            $luck = intval($luckString);
        }  

        $generationMessage = "Custom Ability Scores";
        $optimizeAbilityScoreMessage = "";

    }
    else
    {
        
        for($i = 0; $i < 6; ++$i)
        {
            $abilityScore = rollAbilityScores ($abilityScoreGen);

            array_push($abilityScoreArray, $abilityScore);

        }
        
         $generationMessage = generationMesssage ($abilityScoreGen);

        if(isset($_POST['theOptimizeAbilityScore']) && $_POST['theOptimizeAbilityScore'] == 1) 
        {
            rsort($abilityScoreArray);

            $strength = $abilityScoreArray[3];
            $agility = $abilityScoreArray[5];
            $stamina = $abilityScoreArray[4];
            $personality = $abilityScoreArray[0];
            $intelligence = $abilityScoreArray[1];
            $luck = $abilityScoreArray[2];

            $optimizeAbilityScoreMessage = "<br/>Ability Scores optimized in the order of Per, Int, Luck, Str, Sta, Agi.";
        }
        else
        {
            $strength = $abilityScoreArray[0];
            $agility = $abilityScoreArray[1];
            $stamina = $abilityScoreArray[2];
            $personality = $abilityScoreArray[3];
            $intelligence = $abilityScoreArray[4];
            $luck = $abilityScoreArray[5];
            
            $optimizeAbilityScoreMessage = "";
        } 

    } 
    

    $strengthMod = getAbilityModifier($strength);
    $agilityMod = getAbilityModifier($agility);
    $staminaMod = getAbilityModifier($stamina);
    $personalityMod = getAbilityModifier($personality);
    $intelligenceMod = getAbilityModifier($intelligence);
    $luckMod = getAbilityModifier($luck);

    $nameGenMessage = getNameDescript($givenName, $surname);

    
    
        if(isset($_POST["theArmour"]))
        {
            $armour = $_POST["theArmour"];
        }
    
        $armourName = getArmour($armour)[0];
        
        $armourACBonus = getArmour($armour)[1];
        $armourCheckPen = getArmour($armour)[2];
        $armourSpeedPen = getArmour($armour)[3];
        $armourFumbleDie = getArmour($armour)[4];

        if(isset($_POST['theCheckBoxShield']) && $_POST['theCheckBoxShield'] == 1) 
        {
            $shieldName = getArmour(10)[0];
            $shieldACBonus = getArmour(10)[1];
            $shieldCheckPen = getArmour(10)[2];
            $shieldSpeedPen = getArmour(10)[3];
            $shieldFumbleDie = getArmour(10)[4];
        }
        else
        {
            $shieldName = getArmour(11)[0];
            $shieldACBonus = getArmour(11)[1];
            $shieldCheckPen = getArmour(11)[2];
            $shieldSpeedPen = getArmour(11)[3];
            $shieldFumbleDie = getArmour(11)[4];
        } 

       $totalAcDefense = $armourACBonus + $shieldACBonus;
       $totalAcCheckPen = $armourCheckPen + $shieldCheckPen;
       $speedPenality = $armourSpeedPen;

       $speed = 30 - $armourSpeedPen;

       $reflexBase = savingThrowReflex($level);
       $fortBase = savingThrowFort($level);
       $willBase = savingThrowWill($level);

       $criticalDie = criticalDie($level);

       $attackBonus = attackBonus($level);

       $actionDice = actionDice($level);

       $title = title($level, $alignment);
       
       $layHandsLaw = layOnHandsLaw($alignment);
       $layHandsLaw1 = $layHandsLaw[0];
       $layHandsLaw2 = $layHandsLaw[1];
       $layHandsLaw3 = $layHandsLaw[2];
       $layHandsLaw4 = $layHandsLaw[3];
       $layHandsLaw5 = $layHandsLaw[4];

       $layHandsNeutral = layOnHandsNeutral($alignment);
       $layHandsNeutral1 = $layHandsNeutral[0];
       $layHandsNeutral2 = $layHandsNeutral[1];
       $layHandsNeutral3 = $layHandsNeutral[2];
       $layHandsNeutral4 = $layHandsNeutral[3];
       $layHandsNeutral5 = $layHandsNeutral[4];

       $layHandsChaos = layOnHandsChaos($alignment);
       $layHandsChaos1 = $layHandsChaos[0];
       $layHandsChaos2 = $layHandsChaos[1];
       $layHandsChaos3 = $layHandsChaos[2];
       $layHandsChaos4 = $layHandsChaos[3];
       $layHandsChaos5 = $layHandsChaos[4];

       $spellsPerLevel = spellsPerLevel($level);
       $level1Spells = $spellsPerLevel[0];
       $level2Spells = $spellsPerLevel[1];
       $level3Spells = $spellsPerLevel[2];
       $level4Spells = $spellsPerLevel[3];
       $level5Spells = $spellsPerLevel[4];


        $weaponArray = array();
        $weaponNames = array();
        $weaponDamage = array();
    
    

    //For Random Select weapon
    if(isset($_POST['thecheckBoxRandomWeaponsV3']) && $_POST['thecheckBoxRandomWeaponsV3'] == 1) 
    {
        $weaponArray = getRandomWeapons($alignment);

    }
    else
    {
        if(isset($_POST["theWeapons"]))
        {
            foreach($_POST["theWeapons"] as $weapon)
            {
                array_push($weaponArray, $weapon);
            }
        }
    }

    
    foreach($weaponArray as $select)
    {
        array_push($weaponNames, getWeapon($select)[0]);
    }
        
    foreach($weaponArray as $select)
    {
        array_push($weaponDamage, getWeapon($select)[1]);
    }
        
        $gearArray = array();
        $gearNames = array();
    
    
    //For Random Select gear
    if(isset($_POST['theCheckBoxRandomGear']) && $_POST['theCheckBoxRandomGear'] == 1) 
    {
        $gearArray = getRandomGear();

        $weaponCount = count($weaponArray);

        $hasLongbow = false;
        $hasShortbow = false;

        for($i = 0; $i < $weaponCount; ++$i)
        {
            if($weaponArray[$i] == "12" && $hasShortbow == false)
            {
                array_push($gearArray, 24);
                array_push($gearArray, 25);
                
                $hasLongbow = true;
            }

            if($weaponArray[$i] == "16" && $hasLongbow == false)
            {
                array_push($gearArray, 24);

                $hasShortbow = true;
            }

            if($weaponArray[$i] == "4")
            {
                array_push($gearArray, 26);
            }

            if($weaponArray[$i] == "18")
            {
                array_push($gearArray, 27);
            }


        }

    }
    else
    {
        //For Manually select gear
        if(isset($_POST["theGear"]))
            {
                foreach($_POST["theGear"] as $gear)
                {
                    array_push($gearArray, $gear);
                }
            }

    }


        foreach($gearArray as $select)
        {
            array_push($gearNames, getGear($select)[0]);
        }
    
    
    ?>

    
	
<!-- JQuery -->
  <img id="character_sheet"/>
   <section>
       
		<span id="profession"></span>
           
		<span id="strength"></span>
		<span id="agility"></span> 
		<span id="stamina"></span> 
		<span id="intelligence"></span>
		<span id="personality"></span>
       <span id="luck"></span>
       
       
           
		<span id="strengthMod"></span>
		<span id="agilityMod"></span> 
		<span id="staminaMod"></span> 
		<span id="intelligenceMod"></span>
		<span id="personalityMod"></span>
       <span id="luckMod"></span>

       <span id="reflex"></span>
       <span id="fort"></span>
       <span id="will"></span>
		  
       
       <span id="gender">
           <?php
           echo $gender;
           ?>
       </span>

       <span id="deity">
           <?php
           echo $deityName . " (" . $deityDescription . ")<br/><br/> Weapons (holy): " . $weaponsAllowed . "<br/><br/> Unholy Creatures: " . $unholy;
           ?>
       </span>



       
       
       <span id="dieRollMethod"></span>

       
       <span id="class">Cleric</span>
       
       <span id="armourClass"></span>

       <span id="baseAC"></span>
       
       <span id="hitPoints"></span>

       <span id="languages"></span>
       
       <span id="trainedWeapon"></span>
       <span id="tradeGoods"></span>

       
       <span id="level">
           <?php
                echo $level;
           ?>
        </span>

        
        
       <span id="xpNextLevel">
           <?php
                echo $xpNextLevel;
           ?>
        </span>

       
       

       
       <span id="characterName">
           <?php
                echo $characterName;
           ?>
        </span>
        
       <span id="characterName2">
           <?php
                echo $fullName;
           ?>
        </span>

        
       <span id="playerName">
           <?php
                echo $playerName;
           ?>
        </span>
       
              
         <span id="alignment">
           <?php
                echo $alignment;
           ?>
        </span>
        
        <span id="speed"></span>


              
       <span id="armourName">
           <?php
           if($armourName == "")
           {
               echo $shieldName;
           }
           else if($shieldName == "")
           {
                echo $armourName;
           }
           else
           {
            echo $armourName . " & " . $shieldName;
           }
           ?>
        </span>

        <span id="armourACBonus">
            <?php
                echo $totalAcDefense;
            ?>
        </span>

        
        <span id="armourACCheckPen">
            <?php
                echo $totalAcCheckPen;
            ?>
        </span>
        
        <span id="armourACSpeedPen">
            <?php
            if($speedPenality == 0)
            {
                echo "-";
            }
            else
            {
                echo "-" . $speedPenality;
            }
            ?>
        </span>

        <span id="fumbleDie">
            <?php
            if($armourName == "")
            {
                echo $shieldFumbleDie;
            }
            else
            {
                echo $armourFumbleDie;
            }
            ?>
        </span>

        <span id="criticalDieTable">
            <?php
                echo $criticalDie;
            ?>
        </span>
        
        <span id="attackBonus">
            <?php
                echo "+" . $attackBonus;
            ?>
        </span>

        <span id="initiative">
        </span>
        
        <span id="actionDice">
            <?php
                echo $actionDice;
            ?>
        </span>

        <span id="spellCheck"></span>

        
        <span id="title">
            <?php
                echo $title;
            ?>
        </span>
        
        <span id="layHandsLaw1">
            <?php
                echo $layHandsLaw1;
            ?>
        </span>
        
        <span id="layHandsLaw2">
            <?php
                echo $layHandsLaw2;
            ?>
        </span>
        
        <span id="layHandsLaw3">
            <?php
                echo $layHandsLaw3;
            ?>    
        </span>

        <span id="layHandsLaw4">
            <?php
                echo $layHandsLaw4;
            ?>
        </span>

        <span id="layHandsLaw5">
            <?php
                echo $layHandsLaw5;
            ?>
        </span>

        
        <span id="layHandsNeutral1">
            <?php
                echo $layHandsNeutral1;
            ?>
        </span>
        
        <span id="layHandsNeutral2">
            <?php
                echo $layHandsNeutral2;
            ?>
        </span>
        
        <span id="layHandsNeutral3">
            <?php
                echo $layHandsNeutral3;
            ?>
        </span>
        
        <span id="layHandsNeutral4">
            <?php
                echo $layHandsNeutral4;
            ?>
        </span>
        
        <span id="layHandsNeutral5">
            <?php
                echo $layHandsNeutral5;
            ?>
        </span>

        
        
        <span id="layHandsChaos1">
            <?php
                echo $layHandsChaos1;
            ?>
        </span>
        
        <span id="layHandsChaos2">
            <?php
                echo $layHandsChaos2;
            ?>
        </span>
        
        <span id="layHandsChaos3">
            <?php
                echo $layHandsChaos3;
            ?>
        </span>
        
        <span id="layHandsChaos4">
            <?php
                echo $layHandsChaos4;
            ?>
        </span>
        
        <span id="layHandsChaos5">
            <?php
                echo $layHandsChaos5;
            ?>
        </span>

        
        
        <span id="level1Spells">
            <?php
                echo $level1Spells;
            ?>
        </span>
        
        <span id="level2Spells">
            <?php
                echo $level2Spells;
            ?>
        </span>
        
        <span id="level3Spells">
            <?php
                echo $level3Spells;
            ?>
        </span>
        
        <span id="level4Spells">
            <?php
                echo $level4Spells;
            ?>
        </span>
        
        <span id="level5Spells">
            <?php
                echo $level5Spells;
            ?>
        </span>
        

        
		<p id="birthAugur"><span id="luckySign"></span>: <span id="luckyRoll"></span> (<span id="LuckySignBonus"></span>)</p>

        
        <span id="melee"></span>
        <span id="range"></span>
        
        <span id="meleeDamage"></span>
        <span id="rangeDamage"></span>

       
       
       <span id="weaponsList">
           <?php
           
           foreach($weaponNames as $theWeapon)
           {
               echo $theWeapon;
               echo "<br/>";
           }
           
           ?>  
        </span>

       <span id="weaponsList2">
           <?php
           foreach($weaponDamage as $theWeaponDam)
           {
               echo $theWeaponDam;
               echo "<br/>";
           }
           ?>        
        </span>
       

       <span id="gearList">
           <?php

           $gearCount = count($gearNames);
           $counter = 1;
           
           foreach($gearNames as $theGear)
           {
              echo $theGear;

              if($counter == $gearCount-1)
              {
                  echo " & ";
              }
              elseif($counter > $gearCount-1)
              {
                  echo ".";
              }
              else
              {
                  echo ", ";
              }

              ++$counter;
           }
           ?>
       </span>


       <span id="abilityScoreGeneration">
            <?php
           echo $generationMessage . $optimizeAbilityScoreMessage . '<br/>' . $nameGenMessage;
           ?>
       </span>
       

       
	</section>
	

		
  <script>
      

	  
	/*
	 Character() - Cleric Character Constructor
	*/
	function Character() {
 
        let strength = <?php echo $strength ?>;
        let	intelligence = <?php echo $intelligence ?>;
        let	personality = <?php echo $personality ?>;
        let agility = <?php echo $agility ?>;
        let stamina = <?php echo $stamina ?>;
        let	luck = <?php echo $luck ?>;
        let strengthMod = <?php echo $strengthMod ?>;
        let intelligenceMod = <?php echo $intelligenceMod ?>;
        let personalityMod = <?php echo $personalityMod ?>;
        let agilityMod = <?php echo $agilityMod ?>;
        let staminaMod = <?php echo $staminaMod ?>;
        let luckMod = <?php echo $luckMod ?>;
        let level = '<?php echo $level ?>';
        let gender = '<?php echo $gender ?>';
        let armour = '<?php echo $armourName ?>';
	    let	profession = getOccupation();
	    let birthAugur = getLuckySign();
        let bonusLanguages = getBonusLanguages(intelligenceMod, birthAugur, luckMod);
	    let baseAC = getBaseArmourClass(agilityMod) + adjustAC(birthAugur, luckMod);

		let clericCharacter = {
			"strength": strength,
			"agility": agility,
			"stamina": stamina,
			"intelligence": intelligence,
			"personality": personality,
			"luck": luck,
            "strengthModifer": addModifierSign(strengthMod),
            "intelligenceModifer": addModifierSign(intelligenceMod),
            "personalityModifer": addModifierSign(personalityMod),
            "agilityModifer": addModifierSign(agilityMod),
            "staminaModifer": addModifierSign(staminaMod),
            "luckModifer": addModifierSign(luckMod),
			"profession":  profession.occupation,
            "acBase": baseAC,
			"luckySign": birthAugur.luckySign,
            "luckyRoll": birthAugur.luckyRoll,
            "move": <?php echo $speed ?> + addLuckToSpeed (birthAugur, luckMod),
            "trainedWeapon": profession.trainedWeapon,
            "tradeGoods": profession.tradeGoods,
            "addLanguages": "Common" + bonusLanguages,
            "armourClass": <?php echo $totalAcDefense ?> + baseAC,
            "hp": getHitPoints (level, staminaMod) + hitPointAdjustPerLevel(birthAugur,  luckMod),
            "spellCheck": personalityMod + <?php echo $level ?>,
			"melee": <?php echo $attackBonus ?> + strengthMod + meleeAdjust(birthAugur, luckMod),
			"range": <?php echo $attackBonus ?> + agilityMod + rangeAdjust(birthAugur, luckMod),
			"meleeDamage": strengthMod + meleeDamageAdjust(birthAugur, luckMod),
			"rangeDamage": rangeDamageAdjust(birthAugur, luckMod),
            "reflex": <?php echo $reflexBase ?> + agilityMod + adjustRef(birthAugur, luckMod),
            "fort": <?php echo $fortBase ?> + staminaMod + adjustFort(birthAugur,luckMod),
            "will": <?php echo $willBase ?> + personalityMod + adjustWill(birthAugur, luckMod),
            "initiative": agilityMod + adjustInit(birthAugur, luckMod)

		};
	    if(clericCharacter.hitPoints <= 0 ){
			clericCharacter.hitPoints = 1;
		}
		return clericCharacter;
	  
	  }
	  


  
       let imgData = "images/cleric.png";
      
        $("#character_sheet").attr("src", imgData);
      

      let data = Character();
      
      $("#profession").html(data.profession);
		 
      $("#strength").html(data.strength);
      
      $("#intelligence").html(data.intelligence);
      
      $("#personality").html(data.personality);
      
      $("#agility").html(data.agility);
      
      $("#stamina").html(data.stamina);
      
      $("#luck").html(data.luck);
      
      
		 
      $("#strengthMod").html(data.strengthModifer);
      
      $("#intelligenceMod").html(data.intelligenceModifer);
      
      $("#personalityMod").html(data.personalityModifer);
      
      $("#agilityMod").html(data.agilityModifer);
      
      $("#staminaMod").html(data.staminaModifer);
      
      $("#luckMod").html(data.luckModifer);
      
      
      
      $("#dieRollMethod").html(data.dieRollMethod);
            
      $("#hitPoints").html(data.hp);
      
      $("#armourClass").html(data.armourClass);
      
      $("#reflex").html(addModifierSign(data.reflex));
      $("#fort").html(addModifierSign(data.fort));
      $("#will").html(addModifierSign(data.will));
      
      $("#initiative").html(addModifierSign(data.initiative));
      
      $("#speed").html(data.move + "'");
      
      $("#luckySign").html(data.luckySign);
      $("#luckyRoll").html(data.luckyRoll);    
      $("#LuckySignBonus").html(data.luckModifer);

      $("#languages").html(data.addLanguages);
      $("#melee").html(addModifierSign(data.melee));
      $("#range").html(addModifierSign(data.range));
      $("#meleeDamage").html(addModifierSign(data.meleeDamage));
      $("#rangeDamage").html(addModifierSign(data.rangeDamage));

      
      $("#baseAC").html("(" + data.acBase + ")");
      $("#trainedWeapon").html("Trained Weapon: " + data.trainedWeapon);
      $("#tradeGoods").html("Trade Goods: " + data.tradeGoods);
      
      $("#spellCheck").html(addModifierSign(data.spellCheck));
      

	 
  </script>
		
	
    
</body>
</html>