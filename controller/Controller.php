<?php
    include_once("model/Model.php");

    class Controller 
    {
        public $model;
        public function __construct()
        {		
            $this->model = new Model();
        }

        public function content($arg)
        {
            /*se si entra per la prima volta nel sito o se si clicca su login si 
             presenta il menu il login */
            if(($arg == "" && !isset($_SESSION['loggedIn'])) || ($arg == "loginAttempt"))
                include 'view/loginAttempt.php';
            else if($arg == "" && isset($_SESSION['loggedIn'])) //se ci si è loggati si da conferma
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
                $libri = $this->model->libri(); 

                if($libri == "ERRORE LOGIN")
                    include 'view/faiLogin.php';
                else if($libri == "ERRORE")
                    include 'view/errore.php';
                else
                {
                    if(isset($_SESSION['admin']))
                    {
                        $autori = $this->model->autori();                 
                        include 'view/elencoLibriAdmin.php';
                    }
                    else
                        include 'view/elencoLibri.php';
                }
            }
            else if($arg == "nuovoLibro")
            {
                $result = $this->model->aggiungiLibro();
                
                if($result != "ERRORE")
                    include 'view/libroRegistrato.php';
                else
                    include 'view/errore.php';
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
            else if($arg == "nuovoAutore")
            {
                include 'view/nuovoAutore.php';
            }
            else if($arg == "nuovoAutore2")
            {             
                $flag = $this->model->aggiungiAutore();
                if($flag == "ERRORE")
                {
                    echo "ERRORE. Riprovare";
                    include 'view/nuovoAutore.php';
                }
                else
                    include 'view/autoreRegistrato.php';
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
    
        public function sidebar()
        {
            if(isset($_SESSION['loggedIn']))
            {
                if(isset($_SESSION['admin']))
                    include "view/sidebar/admin.php";
                else
                    include "view/sidebar/user.php";
            }
            else
                include "view/sidebar/guest.php";
        }
    }
?>
