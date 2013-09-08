<?php
         
    /*
    * Classe che si occupa dell'interazione tra l'applicazione php e il database
    */
    class database{
        /*
         * Parametri di connessione al database
         */
        public static $dbHost = "localhost";
        public static $dbUser = "root";
        public static $dbPassword = "neoadmin230689";
        public static $dbName = "tourdb";
        
        /*
         * Connessione al database (charset: utf-8)
         */
        public static function dbConnect(){
            //creo una connessione al server
            $conn = mysql_connect(database::$dbHost, database::$dbUser, database::$dbPassword)
                or die("Errore nella connessione al DB Server: " . mysql_error());
			//Imposto charset utf-8
			mysql_query("SET character_set_results=utf8", $conn);
    		mb_language('uni'); 
    		mb_internal_encoding('UTF-8');    		
            //seleziono il database
            mysql_select_db(database::$dbName)
                or die("Errore nella selezione del database: " . mysql_error());
			//Imposto charset utf-8
			mysql_query("set names 'utf8'",$conn);
            return $conn;
        }
        
        /*
         * Esecuzione di query di selezione
         */
        public static function qSelect($conn, $sql){            
            //eseguo la query di selezione
            $risposta = mysql_query($sql)
                or die("Errore nell'esecuzione della query di selezione: " . mysql_error());            
            //restituisco il risultato della query
            return $risposta; 
        }
        
        /*
         * Esecuzione di query di aggiornamento
         */
        public static function qUpdate($conn, $sql){            
            //eseguo la query di aggiornamento
            mysql_query($sql)
                or die("Errore nell'esecuzione della query di aggiornamento: " . mysql_error());
            //valore di ritorno in caso di corretto funzionamento
            return 0;
        }
        
        /*
         * Esecuzione di query di accodamento
         */
        public static function qInsertInto($conn, $sql){            
            //eseguo la query di accodamento
            mysql_query($sql)
                or die("Errore nell'esecuzione della query di accodamento: " . mysql_error());
            //valore di ritorno in caso di corretto funzionamento
            return 0;
        }
        
        /*
         * Esecuzione di query di eliminazione
         */
        public static function qDelete($conn, $sql){            
            //eseguo la query di eliminazione
            mysql_query($sql)
                or die("Errore nell'esecuzione della query di eliminazione: " . mysql_error());
            //valore di ritorno in caso di corretto funzionamento
            return 0;
        }
		
		/*
			chiusura connessione database
		*/
		public static function dbClose()
		{
			mysql_close();
		}
        
    }
?>
