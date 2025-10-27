<?Php

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

if (!$conn) {

    $obj->status('error', 'Estamos com problemas no servidor aguarde !');
    echo json_encode($obj);
}
