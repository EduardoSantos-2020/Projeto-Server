<?Php
        //$conn=new PDO('mysql:host=localhost:3306;dbname=Banco_users','root','');

        $conn=mysqli_connect('localhost:3306','root','','Banco_users');       
        if (!$conn) {
            $obj->status('error', 'temos problemas tecnicos !');
            echo json_encode($obj);
        }

?>