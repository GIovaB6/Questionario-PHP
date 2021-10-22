<?php
include 'Category.php';
include 'Utils.php';

//Indica che form stiamo
$flag = 0;

//prendo categoria se passata da post
if (isset($_POST['categoria'])) {
    $cat = $_POST['categoria'];
}
//cat iniziale
else {
    $cat = 'env';
}

//Query
$query = "SELECT * FROM domanda WHERE categoria='".$cat."'" ;
$result = $db->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>

    <div class="col-md-12" style="display: flex;padding: 30px;justify-content: center;">

    </div>

    <div class="col-md-12" style="display: flex;padding: 30px;justify-content: center;">

        <div class="col-md-8" style="height: 100%;background: aliceblue;border-radius: 35px;text-align: center;">

            <form action="load.php" method="post">

                <?php 
                    // $total=mysqli_num_rows($result);
                    // print($total);
                    
                    //Index domanda per stampa
                    $i = 0;

                    //Fetcho dati dal DB
                    while ($estrazione = $result->fetch_array()) { 
                 
                        $i++;
                        $id = $estrazione['id'];
                        $testo = $estrazione['testo'];
                        $sub_cat = $estrazione['sottocategoria'];

                
                    // <!-- DOMANDE  -->
                    
                    if($i%2 == 0 ) 
                    {
                ?>
                        <div class="questionContainer">
                            <div class="header1">
                        
                <?php

                    }
                    else 
                    {
                        
                ?>
                        <div class="questionContainer">
                            <div class="header2">

                <?php
                    }
                ?>

                            <p class="numQuestion">Domanda numero <?php print($i) ?></p>
                            
                            <p class="question"><?php print($testo) ?></p>
                        </div> 
                        <div style="padding-top: 20px;">
                            <input type="radio" name="scelta_<?php print($id) ?>" value="1" required="required"> SI

                            <input type="radio" name="scelta_<?php print($id) ?>" value="0" > NO
                            
                        </div>
                            <input type="hidden" name="sub_cat_<?php print($id) ?>" value="<?php print($sub_cat) ?>">
                            <br>
                    </div>    

                <?php } ?>
                    <!-- Passo categoria corrente per $obj->name -->
                    <input type="hidden" name="cat" value="<?php print($cat) ?>">

                <?php
                //se settato ripasso l'array
                if (isset($_POST['arrayEnv'])) {
                
                    $arrayEnv = $_POST['arrayEnv'];
                    
                ?>
                
                 <input type="hidden" name="arrayEnv" value="<?php print($arrayEnv) ?>">
                
                <?php
                
                }
                //se settato ripasso l'array
                if (isset($_POST['arrayEco'])) {

                    $arrayEco = $_POST['arrayEco'];

                ?>

                 <input type="hidden" name="arrayEco" value="<?php print($arrayEco) ?>">

                <?php

                }
                
                ?>
                
                <button id="btn" type="submit">Invia</button>

            </form>

        </div>

    </div>
    
</body>
</html>

