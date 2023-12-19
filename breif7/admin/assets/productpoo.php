<?php 
 
    class product{
        private $reference;
        private $etiquette;
        private $descpt;
        private $codeBarres;
        private $img;
        private $rixAchat;
        private $prixAchat;
        private $qntMin;
        private $qntStock;
        private $catg;
        private $isHide;
     


        public function __construct($reference, $etiquette, $descpt, $codeBarres, $img, $rixAchat, $prixAchat, $qntMin, $qntStock, $catg, $isHide){
            $this->reference = $reference;
            $this->etiquette = $etiquette;
            $this->descpt = $descpt;
            $this->codeBarres = $codeBarres;
            $this->img = $img;
            $this->rixAchat = $rixAchat;
            $this->prixAchat = $prixAchat;
            $this->qntMin = $qntMin;
            $this->qntStock = $qntStock;
            $this->catg = $catg;
        
        }
        /**
         * Get the value of ISBN
         */ 
        public function getreference()
        {
                return $this->reference;
        }

        /**
         * Get the value of title
         */ 
        public function getetiquette()
        {
                return $this->etiquette;
        }

        /**
         * Get the value of Genre
         */ 
        public function getdescpt()
        {
                return $this->descpt;
        }

        /**
         * Get the value of NumofPges
         */ 
        public function codeBarres()
        {
                return $this->codeBarres;
        }

        /**
         * Get the value of Price
         */ 
        public function getimg()
        {
                return $this->img;
        }

        /**
         * Get the value of Author
         */ 
        public function getrixAchat()
        {
                return $this->rixAchat;
        }



        public function getprixAchat()
        {
                return $this->rixAchat;
        }



        public function prixFinal()
        {
                return $this->rixAchat;
        }



        public function prixOffre()
        {
                return $this->rixAchat;
        }



        public function prixqntMin()
        {
                return $this->rixAchat;
        }




        public function qntStock()
        {
                return $this->rixAchat;
        }




        public function catg()
        {
                return $this->rixAchat;
        }




        public function isHide()
        {
                return $this->rixAchat;
        }
    }

?>