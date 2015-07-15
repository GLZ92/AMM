<?php
    class Model
    {
        private static $mysqli;
        private static $usernameRoot = "root";
        private static $passwordRoot = "davide";
        public function __construct()
        {
            $usernameRoot = "root";
            $passwordRoot = "davide";
            self::$mysqli = new mysqli();
            session_start();
        }
           
        private function connectToDB()
        {
            @self::$mysqli->connect("localhost", self::$usernameRoot, self::$passwordRoot, "amm");
        }
        
        public function login()
        {
            if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
            {                      
                if(($_REQUEST['username'] == self::$usernameRoot) &&($_REQUEST['password'] == self::$passwordRoot))
                {
                    $_SESSION["loggedIn"] = true;
                    $_SESSION["username"] = $_REQUEST['username'];
                    $_SESSION["password"] = $_REQUEST['password'];
                    $_SESSION["admin"] = true;

                    return $_SESSION["username"];
                }
                else
                {
                    $this->connectToDB();
                    $result = self::$mysqli->query("SELECT username, password FROM utenti;");
                    while($row = $result->fetch_row())
                    {
                        if(($_REQUEST['username'] == $row[0]) && ($_REQUEST['password'] == $row[1]))
                        {
                            $_SESSION["loggedIn"] = true;
                            $_SESSION["username"] = $_REQUEST['username'];
                            $_SESSION["password"] = $_REQUEST['password'];
                            $_SESSION["admin"] = false;

                            return $_SESSION["username"];
                        }
                    }
                    return "ERRORE";
                }
            }
            else
                return "ERRORE";
        }	

        public function logout()
        {
            $_SESSION = array();
            if(session_id() != "" || isset($_COOKIE[session_name()]))
                setcookie(session_name(), '', time() - 2592000, '/');
            session_destroy();
        }

        public function libri()
        {            
            if($_SESSION["loggedIn"])
                $this->connectToDB();
            else
                return "ERRORE LOGIN";
            $result = self::$mysqli->query("SELECT titolo, nome, cognome FROM libri, autori WHERE autori.id = libri.autore_id;");
            if(self::$mysqli->errno > 0)
                return "ERRORE";
            else
                return $result;
        }
        
        public function libriNonPrestati()
        {            
            if($_SESSION["loggedIn"])
                $this->connectToDB();
            else
                return "ERRORE";
            $result = self::$mysqli->query("SELECT titolo, nome, cognome FROM libri, autori WHERE autori.id = libri.autore_id AND prestatoA IS NULL;");
            if(self::$mysqli->errno > 0)
                return "ERRORE";
            else
                return $result;
        }
        
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
        
        public function elencoUtenti()
        {
            if($_SESSION["loggedIn"])
                $this->connectToDB();
            else
                return "ERRORE";
            $result = self::$mysqli->query("SELECT username FROM utenti;");
            if(self::$mysqli->errno > 0)
                return "ERRORE";
            else
                return $result;
        }
        
        public function effettuaPrestito()
        {
            if(isset($_REQUEST['user']) && isset($_REQUEST['libro']))
            {
                $user = $_REQUEST['user'];
                $libro = $_REQUEST['libro'];
                $this->connectToDB();
                
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
