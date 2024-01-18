<?php
class PDOConn {
    public static $dbname = null;
    private static $serverName = 'localhost';
    private static $serverPort = '5432';
    private static $userName = 'postgres';
    private static $password = 'postgres';
    public static $conn;    

    static function connect(){
        self::disconnect();

        try{
            self::$conn = new PDO('pgsql:host='.self::$serverName.';port='.self::$serverPort.';dbname='.self::$dbname.';user='.self::$userName.';password='.self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "</br>Más datos: </br>Server name: " . self::$serverName . " Server port: " . self::$serverPort . " dbname: " . self::$dbname . " user: " . self::$userName . " pass: " . self::$password;
            die();
        }
        return (self::$conn);
    }    

    static function disconnect(){
        self::$conn = null;
    }

    static function read(){
        try{
            $stmt = self::$conn->prepare("SELECT * FROM misPartidas ORDER BY id DESC LIMIT 1;");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_NUM);

            return $data;
        } catch (PDOException $e){
            echo "Read table failed: " . $e->getMessage();
            die();
        }
    }

    static function readOne($id){
        try{
            $stmt = self::$conn->prepare("SELECT * FROM misPartidas where id =:id;");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch();

            return $data;
        } catch(PDOException $e){
            echo "ReadOne failed: " . $e->getMessage();
            die();
        }
    }

    static function insert($partidaXml){
        try{
            $stmt = self::$conn->prepare("INSERT INTO misPartidas (partida) VALUES(:partidaXml);");
            $stmt->bindParam(':partidaXml', $partidaXml);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e){
            echo "Insert failed: " . $e->getMessage();
            die();
        }
    }

    static function delete($id){
        try{
            $stmt = self::$conn->prepare("DELETE FROM misPartidas WHERE id =:id;");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e){
            echo "Delete failed: " . $e->getMessage();
            die();
        }
    }

    static function update($id, $partidaXml){
        try{
            $stmt = self::$conn->prepare("UPDATE misPartidas SET partida=:partidaXml WHERE id =:id;");
            $stmt->bindParam(':partidaXml', $partidaXml);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e){
            echo "Update failed: " . $e->getMessage();
            die();
        }
    }
}
?>