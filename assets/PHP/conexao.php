<?Php

header("Access-Control-Allow-Headers:Content-Type");
header('Content-Type: application/json');
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET,POST");

$obj = new Obj;

class Obj
{
    public $status, $message;
    function status($status, $message)
    {
        $this->status = $status;
        $this->message = $message;
    }
}

//$conn=new PDO('mysql:host=localhost:3306;dbname=Banco_users','root','');

$conn = mysqli_connect('localhost:3306', 'root', '', 'Banco_users');


   
