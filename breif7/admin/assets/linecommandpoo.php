<?php 
 
    class linecommand{

        private $command_id;
        private $product_ref;
        private $qnt;


        public function __construct($command_id, $product_ref, $qnt){
            $this->command_id = $command_id;
            $this->product_ref = $product_ref;
            $this->qnt = $qnt;
         
        
        }
      


        public function getcommand_id()
        {
                return $this->command_id;
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