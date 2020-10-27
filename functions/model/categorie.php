<?php
    /**
    * @author Marvin Vissers
    */
    class Categorie {
        // Creating the variables
        private $ID;
        private $categorie;

        /**
         * Creates a new instance of Categorie
         * 
         * @param ID ID of the categorie in the database
         * @param categorie name of the categorie
         */
        public function __construct($ID, $categorie) {
            // Setting the given values equal to the variables in the class
            $this->ID = $ID;
            $this->categorie = $categorie;
        }

        public function getID() {
            return $this->ID;
        }
    
        public function setID($ID) {
            $this->ID = $ID;
        }

        public function getCategorie() {
            return $this->categorie;
        }
    
        public function setCategorie($categorie) {
            $this->categorie = $categorie;
        }
    }
?>