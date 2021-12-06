<?php
     require_once("Action/DAO/Connection.php");

    class ContentDAO {

        public static function getIndexText() {
            return file_get_contents("data/index.txt");
        }

        public static function setIndexText($text) {
            file_put_contents("data/index.txt", $text);
        }

        public static function WriteNote($note){
            $connection = Connection::getConnection();
            $result = null;

            $statement = $connection->prepare("INSERT INTO notes (contenu) VALUES(?)");
            $statement->bindParam(1, $note);
            $statement->setFetchMode(PDO::FETCH_ASSOC); 
            $statement->execute();
        }

        public static function GetAllNotes(){
            $connection = Connection::getConnection();
            $result = null;

            $statement = $connection->prepare("SELECT * FROM notes");
            $statement->setFetchMode(PDO::FETCH_ASSOC); 
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;

        }

        public static function DeleteNote($id){
            $connection = Connection::getConnection();
            $result = null;
            $statement = $connection->prepare("DELETE FROM notes WHERE noteid = ?");
            $statement->bindParam(1, $id);
            $statement->setFetchMode(PDO::FETCH_ASSOC); 
            $statement->execute();

        }

    }