<?php
    include_once("model/Model.php");

    class Controller 
    {
        public $model;
        public function __construct()
        {		
            $this->model = new Model();
        }

        public function invoke($arg)
        {
            if(($arg == "" && !isset($_SESSION['loggedIn'])) || ($arg == "loginAttempt"))
                include 'view/loginAttempt.php';
            else if($arg == "" && isset($_SESSION['loggedIn']))
                include 'view/loginDone.php';
            else if($arg == "login")
            {
                $result = $this->model->login();
                if($result != "ERRORE")
                    include 'view/loginDone.php';
                else
                    include 'view/loginAttempt.php';
            }
            else if($arg == "logout")
            {
                $result = $this->model->logout();     
                if($result != "ERRORE")
                    include 'view/loginAttempt.php';
            }
            else if($arg == "libri")
            {
                $result = $this->model->libri(); 

                if($result == "ERRORE LOGIN")
                    include 'view/faiLogin.php';
                else if($result == "ERRORE")
                    include 'view/errore.php';
                else
                    include 'view/elencoLibri.php';
            }
            else if($arg == "prestiti")
            {
                $result = $this->model->prestiti();
                
                if($result == "ERRORE")
                    include 'view/soloAdmin.php';
                else
                    include 'view/elencoPrestiti.php';
            }
            else if($arg == "nuovoPrestito")
            {             
                $utenti = $this->model->elencoUtenti(); 
                $libri = $this->model->libriNonPrestati();
                
                if(isset($_SESSION['loggedIn'])  && isset($_SESSION['admin']))
                    include 'view/nuovoPrestito.php';
                else
                    include 'view/soloAdmin.php';   
            }
            else if($arg == "nuovoPrestito2")
            {             
                $flag = $this->model->effettuaPrestito(); 
                if($flag == "ERRORE")
                {
                    echo "ERRORE. Riprovare";
                    include 'view/nuovoPrestito.php';
                }
                else
                    include 'view/prestitoCompletato.php';   
            }
            else if($arg == "cancellaPrestito")
            {
                $result = $this->model->cancellaPrestito();
                if($result == "ERRORE")
                {
                    echo "ERRORE. Riprovare";
                    include 'view/elencoPrestiti.php';
                }
                else
                    include 'view/prestitoRimosso.php';
            }
            else if($arg == "iscriviti")
            {
                if(isset($_SESSION['loggedIn']))
                    include 'view/faiLogout.php';
                else
                    include 'view/iscrizione.php';
            }
            else if($arg == "nuovoUtente")
            {
                $result = $this->model->nuovoUtente();

                if($result == "ERRORE INSERT")
                    include 'view/usernameOccupato.php';
                else if($result == "ERRORE")
                    include 'view/errore.php';
                else
                    include 'view/iscrizioneCompletata.php';
            }
        }
    }
?>
