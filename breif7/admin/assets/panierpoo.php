<?php 
 
    class panier{

        private $client_username;
        private $product_ref;
        private $qnt;


        public function __construct($client_username, $product_ref, $qnt){
            $this->client_username = $client_username;
            $this->product_ref = $product_ref;
            $this->qnt = $qnt;
         
        
        }
      


        public function getclient_username()
        {
                return $this->client_username;
        }

       

        public function getproduct_re()
        {
                return $this->product_ref;
        }

       

        public function getqnt()
        {
                return $this->qnt;
        }


    }

?>