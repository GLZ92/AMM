<?php
    class Model
    {
        private static $mysqli;
        private static $usernameRoot = "loizeddaGiovanni";
        private static $passwordRoot = "pipistrello5274";
        public function __construct()
        {
            self::$mysqli = new mysqli();
            session_start();
        }
           
        private function connectToDB()
        {
            @self::$mysqli->connect("localhost", self::$usernameRoot, self::$passwordRoot, "amm15_loizeddaGiovanni");
        }
        
        //gestione del tentativo di login
        public function login()
        {
            if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
            {  
                $this->connectToDB();
	       	if(self::$mysqli->errno > 0)
                    return "ERRORE";
                $result = self::$mysqli->query("SELECT username, password, id FROM utenti;");
                while($row = $result->fetch_row())
                {
	            if(($_REQUEST['username'] == $row[0]) && ($_REQUEST['password'] == $row[1]))
    	            {
   		        $_SESSION["loggedIn"] = true;
                        $_SESSION["username"] = $_REQUEST['username'];
                        $_SESSION["password"] = $_REQUEST['password'];
                        if($row[2] == 1)
                            $_SESSION["admin"] = true;
                    
                        return $_SESSION["username"];
                    }
                }
                return "ERRORE";
            }
            else
                return "ERRORE";
        }	

        //esecuzione del logout e distruzione della sessione
        public function logout()
        {
            $_SESSION = array();
            if(session_id() != "" || isset($_COOKIE[session_name()]))
                setcookie(session_name(), '', time() - 2592000, '/');
            session_destroy();
        }

        //restituisce l'elenco dei libri presenti nel database
        public function libri()
        {            
            if(isset($_SESSION["loggedIn"]))
                $this->connectToDB();
            else
                return "ERRORE LOGIN";
            $result = self::$mysqli->query("SELECT titolo, nome, cognome FROM libri, autori WHERE autori.id = libri.autore_id;");
            if(self::$mysqli->errno > 0)
                return "ERRORE";
            else
                return $result;
        }
        
        //restituisce l'elenco dei libri non prestati
        public function libriNonPrestati()
        {            
            if(isset($_SESSION["loggedIn"]))
                $this->connectToDB();
            else
                return "ERRORE";
            $result = self::$mysqli->query("SELECT titolo, nome, cognome FROM libri, autori WHERE autori.id = libri.autore_id AND prestatoA IS NULL;");
            if(self::$mysqli->errno > 0)
                return "ERRORE";
            else
                return $result;
        }
        
        //gestione inserimento nuovo utente
        public function nuovoUtente()
        {
            if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
            {
                $result = $this->connectToDB();
                if(self::$mysqli->errno > 0)
                    return "ERRORE";
                $user = $_REQUEST['username'];
                $password = $_REQUEST['password'];

                self::$mysqli->autocommit(false);
                $result = self::$mysqli->query("INSERT INTO utenti (username, password) VALUES ('$user', 'pass');");
                if(self::$mysqli->errno > 0)
                {
                    self::$mysqli->rollback();
                    self::$mysqli->close();
                    return "ERRORE INSERT";
                }
                else
                {
                    $result = self::$mysqli->query("UPDATE utenti SET password = '$password' WHERE username = '$user';");
                    if(self::$mysqli->errno > 0)
                    {
                        self::$mysqli->rollback();
                        self::$mysqli->close();
                        return "ERRORE";
                    }
                    else
                    {
                        self::$mysqli->commit();
                        self::$mysqli->autocommit(true);
                        return "OK";
                    }
                }
            }
            else
                return "ERRORE";
        }
        
        //restituisce l'elenco degli utenti, escluso l'admin (ha id 1)
        public function elencoUtenti()
        {
            if(isset($_SESSION["loggedIn"]))
                $this->connectToDB();
            else
                return "ERRORE";
            $result = self::$mysqli->query("SELECT username FROM utenti WHERE id > 1;");
            if(self::$mysqli->errno > 0)
                return "ERRORE";
            else
                return $result;
        }
        
        //gestisce l'assegnazione di un libro in prestito a un dato utente
        public function effettuaPrestito()
        {
            if(isset($_REQUEST['user']) && isset($_REQUEST['libro']))
            {
                $user = $_REQUEST['user'];
                $libro = $_REQUEST['libro'];
                $this->connectToDB();

                str_replace("'", "''", $libro); 
                if(self::$mysqli->errno > 0)
                    return "ERRORE";    
                else
                {        
                    self::$mysqli->query("UPDATE libri SET prestatoA = (SELECT id FROM utenti WHERE username = '$user') WHERE titolo = '$libro' AND prestatoA IS NULL;");

                    if(self::$mysqli->errno > 0)    
                        return "ERRORE";
                    else
                        return "OK";
                }
            }
            else
                "ERRORE";
        }
        
        //restituisce l'elenco dei libri prestati
        public function prestiti()
        {            
            if(isset($_SESSION["loggedIn"]) && isset($_SESSION["admin"]))
            {
                if($_SESSION["admin"] == true)
                    $this->connectToDB();
                else
                    return "ERRORE";
            }
            else
                return "ERRORE";
            $result = self::$mysqli->query("SELECT titolo, autori.nome, autori.cognome, utenti.username FROM libri, autori, utenti WHERE autori.id = libri.autore_id && utenti.id= libri.prestatoA;");
            if(self::$mysqli->errno > 0)
                return "ERRORE";
            else
                return $result;
        }
        
        //cancella un prestito
        public function cancellaPrestito()
        {
            if(isset($_REQUEST['libro']))
            {
                $libro = $_REQUEST['libro'];
                $this->connectToDB();
                
                if(self::$mysqli->errno > 0)
                    return "ERRORE";    
                else
                {   
                    self::$mysqli->query("UPDATE libri SET prestatoA = NULL WHERE titolo = '$libro';");
                    if(self::$mysqli->errno > 0)
                        return "ERRORE";
                    else
                        return "OK";
                }
            }
            else
                "ERRORE";
        }
}
?>
