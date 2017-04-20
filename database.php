<?php 

class Database{
    public $isConn;
    protected $datab;

    // connect to db
    public function __construct($username = "root", $password = "", $host = "localhost", $dbname = "projetweb", $options = []){
        $this->isConn = TRUE;
        try {
            $this->datab = new PDO("mysql:host={$host}; dbname={$dbname}; charset=utf8", $username, $password, $options);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    // disconnect from db
    public function Disconnect(){
        $this->datab = NULL;
        $this->isConn = FALSE;
    }

    public function query($sql, $data = array()){
        $req = $this->datab->prepare($sql);
        $req->execute($data);
        return $req->fetchALL(PDO::FETCH_OBJ);
    }

}

?>