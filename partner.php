<?php

// economic_rating = (economic_tot/len_domande_economic)*5

include 'Category.php';

$envRating;
$ecoRating;
$socRating;
$totRating;
//Controllo che abbia gia completato il primo form
if (isset($_POST['arrayEnv'])) {
    $arrayEnv = $_POST['arrayEnv'];
    $arrayEnv= str_replace('\'','"',$arrayEnv);
    $arrayEnv = json_decode($arrayEnv,true);
    $tmpEnv = new Category();
    $tmpEnv->setObjWithJson($arrayEnv);
    print("<br>Categoria ENV<br>");
    // $tmpEnv->printKeyValue();
    // print("<br>Tot domande = ".$tmpEnv->getTotQuestion());
    // print("<br>Tot corrette = ".$tmpEnv->getTotCorrect());
    print($tmpEnv->getTotCorrect()."/".$tmpEnv->getTotQuestion());
    $envRating = $tmpEnv->getCatRating();
    print("<br>Env RATING ".$envRating."<br>");
    $tmpEnv->calculateRatingPerSubCat();
    $tmpEnv->printValueForSubCat();
    //Controllo che abbia gia completato il 2 form

    if (isset($_POST['arrayEco'])) {
        $arrayEco = $_POST['arrayEco'];
        $arrayEco = str_replace('\'','"',$arrayEco);
        $arrayEco = json_decode($arrayEco,true);
        $tmpEco = new Category();
        $tmpEco->setObjWithJson($arrayEco);
        print("<br>Categoria ECO<br>");
        // $tmpEco->printKeyValue();
        // print("Tot domande = ".$tmpEco->getTotQuestion());
        // print("<br>Tot corrette = ".$tmpEco->getTotCorrect());
        print($tmpEco->getTotCorrect()."/".$tmpEco->getTotQuestion());
        $ecoRating = $tmpEco->getCatRating();
        print("<br>Env RATING ".$ecoRating."<br>");
        $tmpEco->calculateRatingPerSubCat();
        $tmpEco->printValueForSubCat();
    
        if (isset($_POST['arraySoc'])) {
            $arraySoc = $_POST['arraySoc'];
            $arraySoc = str_replace('\'','"',$arraySoc);
            $arraySoc = json_decode($arraySoc,true);
            $tmpSoc = new Category();
            $tmpSoc->setObjWithJson($arraySoc);
            print("<br>Categoria SOCIAL<br>");
            // $tmpSoc->printKeyValue();
            // print("Tot domande = ".$tmpSoc->getTotQuestion());
            // print("<br>Tot corrette = ".$tmpSOc->getTotCorrect());
            print($tmpSoc->getTotCorrect()."/".$tmpSoc->getTotQuestion());
            $socRating = $tmpSoc->getCatRating();
            print("<br>Soc RATING ".$socRating."<br>");
            $tmpSoc->calculateRatingPerSubCat();
            $tmpSoc->printValueForSubCat();
            // Rating = (2*environmental_rating + 1.5*economic_rating + 1.5*social_rating)/5
         
            //TOTAL RATING
            $totRating =(((2*$envRating) + (1.5*$ecoRating) + (1.5*$socRating))/5);



            print("<br><br>TOTAL RATING ".$totRating."<br>");

        }
    }

}











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
    
</body>
</html>