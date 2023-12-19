<?php 
 
    class categories{
        private $name;
        private $descrt;
        private $img;
        private $isHide;
  

     


        public function __construct($name, $descrt, $img, $isHide){
            $this->name = $name;
            $this->descrt = $descrt;
            $this->img = $img;
            $this->isHide = $isHide;
         
        
        }
        /**
         * Get the value of ISBN
         */ 
        public function getname()
        {
                return $this->name;
        }

        /**
         * Get the value of title
         */ 
        public function getdescrt()
        {
                return $this->descrt;
        }

        /**
         * Get the value of Genre
         */ 
        public function getimg()
        {
                return $this->img;
        }

        /**
         * Get the value of NumofPges
         */ 
        public function getisHide()
        {
                return $this->isHide;
        }


    }

?>