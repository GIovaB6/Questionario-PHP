<?php 
    include 'Utils.php';

    class Category {
        public $name;
        // public $n_subCategory;
        public $correctSubCat = array();
        public $totQuestionSubCat = array();
        public $subCatRating = array();
        public $totQuestion = 0;

        function __construct(){
            // $this->totQuestion = 0;
        }


      
        function setObjWithJson($json){
            $this->name = $json['name'];
            $this->totQuestion = $json['totQuestion'];

            foreach ($json['correctSubCat'] as $key => $value) {
                // setSubCat($key);
                $this->correctSubCat[$key] = $value;
            }
            foreach ($json['totQuestionSubCat'] as $key => $value) {
                $this->totQuestionSubCat[$key] = $value;
            }
            foreach ($json['subCatRating'] as $key => $value) {
                $this->subCatRating[$key] = $value;
            }

        }

        
        function getName() {
            return $this->name;
        }
        function getCorrectSubCat($subCat) {
            return $this->correctSubCat[$subCat];
        }
        function getTotQuestion() {
            return $this->totQuestion;
        }
        function getTotQuestionSubCat($subCat) {
            return $this->getTotQuestionSubCat[$subCat];
        }
        function getTotCorrect() {
            $tot = 0;
            foreach ($this->correctSubCat as $key => $value) {
                $tot = $tot+$value;
            }
            
            return $tot;
        }
        function setName($name) {
            $this->name = $name;
        }
        function setTotQuestion($tot) {
            $this->totQuestion = $tot;
        }
        function setSubCat($subCat) {
            $this->correctSubCat[$subCat] = 0;
        }
        function setTotQuestionSubCat($subCat){
            $this->totQuestionSubCat[$subCat] = 0;
        }
        function setRatingPerSubCat($subCat){
            $this->subCatRating[$subCat] = 0;
        }

        // 401_perc = 401_tot/num_domande_GRI	//num_domande_401 = 6
        function calculateRatingPerSubCat(){
            foreach ($this->subCatRating as $key => $value) {
                $rating = ($this->correctSubCat[$key] / $this->totQuestionSubCat[$key]);
                $this->subCatRating[$key] = $rating;
            }
        }

        function incrementSubCat($subCat) {
            $this->correctSubCat[$subCat]++;
        }
        function incrementTotQuestionSubCat($subCat) {
            $this->totQuestionSubCat[$subCat]++;
        }

        function getCatRating(){
            return ($this->getTotCorrect()/$this->getTotQuestion()*5);
        }


        function printKeyValue() {
               
            foreach ($this->correctSubCat as $key => $value) {
                
                echo "Key=" . $key . ", Value=" . $value;
                echo "<br>";
            
            }
        
        }

        function printValueForSubCat(){
            
            foreach ($this->totQuestionSubCat as $key => $value) {
                
                echo"\nSubCat = " . $key . ",  N_DOmande = " . $value. ", Sub Cat Rating = ". $this->subCatRating[$key];
                echo "<br>";
                
            
            }
        }
    }


 

    

?>
