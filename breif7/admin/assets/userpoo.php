<?php 
 
    class users{

        private $email;
        private $login;
        private $pass;
        private $is_admin;
        private $is_approved;
     


        public function __construct($email, $login, $pass, $is_admin,$is_approved,){
            $this->email = $email;
            $this->login = $login;
            $this->pass = $pass;
            $this->is_admin = $is_admin;
            $this->is_approved = $is_approved;
         
        
        }
        /**
         * Get the value of ISBN
         */ 
        public function getemail()
        {
                return $this->email;
        }

        /**
         * Get the value of title
         */ 
        public function getlogin()
        {
                return $this->login;
        }

        /**
         * Get the value of Genre
         */ 
        public function getpass()
        {
                return $this->pass;
        }

        /**
         * Get the value of NumofPges
         */ 
        public function getis_admin()
        {
                return $this->is_admin;
        }

        /**
         * Get the value of Price
         */ 
        public function getis_approved()
        {
                return $this->is_approved;
        }

    }

?>