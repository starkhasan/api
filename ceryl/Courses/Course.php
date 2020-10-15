<?php
class Course{
    private $conn;
    public $table_name = "courses";
    public $course_name;
    public $image;
    public $color;
    public $course_type;

    public function __construct($db){
        $this->conn = $db;
    }

    function getCourse(){
        $query = "SELECT * FROM courses";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $userCourse = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $course_item = array(
                "course_name" => $course_name,
                "image" => $image,
                "color" => $color,
                "course_type" => $course_type
            );
            array_push($userCourse, $course_item);
        }
        return $userCourse;
    }
}
?>