<?php
include 'Category.php';
$flag = 0;
$nextCat = "eco";

//Controllo che abbia gia completato il primo form
if (isset($_POST['arrayEnv'])) {
    
    $arrayEnv = $_POST['arrayEnv'];

    $flag = 1;
    $nextCat = "social";
}
//Controllo che abbia gia completato il 2 form

if (isset($_POST['arrayEco'])) {
    
    $arrayEco = $_POST['arrayEco'];
    
    $flag = 2;
}

//Categoria corrente per la query
$cat = $_POST['cat'];

//Creo oggetto corrente
$currCat = new Category();
$currCat->setName($cat);

//Conn DB
$db = new mysqli("127.0.0.1","root","","questionario");
//Query totale
$query = "SELECT * FROM domanda WHERE categoria='".$cat."'";
$result = $db->query($query);


//Prendo sotto categorie
$querySubCat = "SELECT sottocategoria FROM domanda WHERE categoria='".$cat."'";
$resultSubCat = $db->query($querySubCat);


//Creo sottocategorie nell'oggetto
while($estrazione = $resultSubCat->fetch_array()) 
{
    $currCat->setSubCat($estrazione['sottocategoria']);
    $currCat->setTotQuestionSubCat($estrazione['sottocategoria']);
    $currCat->setRatingPerSubCat($estrazione['sottocategoria']);
}


//Assegno il numero di domande
$total=mysqli_num_rows($result);
// print("\nTOTALE -> ".$total."\n");
$currCat->setTotQuestion($total);


//Controllo risposte esatte e popolo l'oggetto corrente
while ($estrazione = $result->fetch_array()) {
    
    $id = $estrazione['id'];

    // if(isset($_POST['scelta_'.$id])){
    $risp = $_POST['scelta_'.$id];
    $sub_cat = $_POST['sub_cat_'.$id];

    if ($risp == 1) {
        $currCat->incrementSubCat($sub_cat);   
    } 
    // }  
    $currCat->incrementTotQuestionSubCat($sub_cat); 

}

// $currCat->printKeyValue();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php

    if ($flag < 2) {
    
    ?>


        <form id="repostForm" action="index.php" method="post">

        <input type="hidden" name="categoria" value="<?php print($nextCat) ?>">
        
        <?php

        //Se primo form
        if ($flag == 0) {
            //encode and replace
            $arrayEnv = json_encode($currCat);
            $arrayEnv = str_replace('"','\'',$arrayEnv);

            
            ?>
            <!-- Invio post del primo array -->
            <input type="hidden" name="arrayEnv" value="<?php print($arrayEnv) ?>">

            <?php
        }

        //Se secondo form
        if ($flag == 1) {
            //encode and replace
            $arrayEco = json_encode($currCat);
            $arrayEco = str_replace('"','\'',$arrayEco);

            ?>
            <!-- Invio post del secondo array -->
            <input type="hidden" name="arrayEnv" value="<?php print($arrayEnv) ?>">
            <input type="hidden" name="arrayEco" value="<?php print($arrayEco) ?>">
            
            <?php
        }

            ?>
        </form>
        
            <script type="text/javascript">
                // print();
                document.getElementById("repostForm").submit(); // SUBMIT FORM
            </script>
        
    <?php 

    }         
    //Terzo form  
    else 
    {
        
      
        $arraySoc = json_encode($currCat);
        $arraySoc = str_replace('"','\'',$arraySoc);

            
        
    ?>

        <form id="finalForm" action="partner.php" method="post">
        
        
            <input type="hidden" name="arrayEnv" value="<?php print($arrayEnv) ?>">
            <input type="hidden" name="arrayEco" value="<?php print($arrayEco) ?>">
            <input type="hidden" name="arraySoc" value="<?php print($arraySoc) ?>">
        
      
      
        </form>
    
        <script type="text/javascript">
            document.getElementById('finalForm').submit(); // SUBMIT FORM
        </script>
    <?php
    
    }        
    
    ?>



</body>
</html>

