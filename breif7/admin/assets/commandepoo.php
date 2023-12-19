<?php 
 
    class commande{

        private $command_id;
        private $client_username;
        private $product_refrence;
        private $createDate;
        private $envoiDate;
        private $livraisonDate;
        private $totalPrice;
     


        public function __construct($command_id, $client_username, $product_refrence, $createDate,$envoiDate, $livraisonDate, $totalPrice){
            $this->command_id = $command_id;
            $this->client_username = $client_username;
            $this->product_refrence = $product_refrence;
            $this->createDate = $createDate;
            $this->envoiDate = $envoiDate;
            $this->livraisonDate = $livraisonDate;
            $this->totalPrice = $totalPrice;
         
        
        }
        /**
         * Get the value of ISBN
         */ 
        public function getcommand_id()
        {
                return $this->command_id;
        }

        /**
         * Get the value of title
         */ 
        public function getclient_username()
        {
                return $this->client_username;
        }

        /**
         * Get the value of Genre
         */ 
        public function getproduct_refrence()
        {
                return $this->product_refrence;
        }

        /**
         * Get the value of NumofPges
         */ 
        public function getcreateDate()
        {
                return $this->createDate;
        }

        /**
         * Get the value of Price
         */ 
        public function getenvoiDate()
        {
                return $this->envoiDate;
        }

        public function getlivraisonDate()
        {
                return $this->livraisonDate;
        }

        public function gettotalPrice()
        {
                return $this->totalPrice;
        }

    }

?>