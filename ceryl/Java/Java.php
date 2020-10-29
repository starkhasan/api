<?php
class Java{
    private $conn;
    public $table_name = "java";
    public $title;
    public $content1;
    public $image_content1;
    public $content2;
    public $image_content2;
    public $content3;
    public $image_content3;
    public $content4;
    public $image_content4;
    public $content5;
    public $image_content5;

    function __construct($db){
        $this->conn = $db;
    }
    
    function getContent(){
        $query = "SELECT * FROM java";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $contents = null;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($row['title'] == $this->title){
                $contents = $row;
            }
        }
        return $contents;

    }

}
?>