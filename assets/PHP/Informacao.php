<?php
header("Access-Control-Allow-Headers:Content-Type");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET,POST");
class Obj
{
    public $status, $message;
    function status($status, $message)
    {
        $this->status = $status;
        $this->message = $message;
    }
}
include_once('conecao.php');

$_Nome = $_POST['nome'];
$_SobNome = $_POST['Sob_nome'];
$_Genero = $_POST['genero'];
$_Data = $_POST['Indata'];

$obj = new Obj;

switch ($_POST) {
    case empty($_POST['nome']):
        $obj->status('error', 'Erro ao confimar Digite seu nome !');
        echo json_encode($obj);
        break;

    case empty($_POST['Sob_nome']):
        $obj->status('error', 'Erro ao confimar Digite seu sobrenome !');
        echo json_encode($obj);
        break;

    case empty($_POST['genero']):
        $obj->status('error', 'Erro ao confimar Selecione um genero valido !');
        echo json_encode($obj);
        break;

    case empty($_POST['Indata']):
        $obj->status('error', 'Erro ao confimar uma data de nacimento!');
        echo json_encode($obj);
        break;

    default:
    $sql = "INSERT INTO Users(Nome,Sobrenome,Nacimento,Genero) VALUES('$_Nome','$_SobNome','$_Data','$_Genero')";
    mysqli_query($conn,$sql);
    mysqli_close($conn);  
    $obj->status('success', 'Cadastro feito com sucesso !');
    echo json_encode($obj);
    break;
}

// $stmt = $conn->prepare($sql);
// $stmt->bindParam(':nome', $_Nome);
// $stmt->bindParam(':Sob_nome', $_SobNome);
// $stmt->bindParam(':genero', $_Genero);
// $stmt->bindParam(':Indata', $_Data);
// $stmt->execute();

?>