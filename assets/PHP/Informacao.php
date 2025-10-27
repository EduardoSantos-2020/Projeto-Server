<?php

include_once('conecao.php');
header("Access-Control-Allow-Headers:Content-Type");
header('Content-Type: application/json');
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET,POST");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $campos = ["nome", "sobre_nome", "genero", "data_nacimento"];
  $erros = [];
  $dados = [];

  // Laço for para validar os campos

  for ($i = 0; $i < count($campos); $i++) {

    $campo = $campos[$i];
    $valor = trim($_POST[$campo]);

    if (empty($valor)) {


      if ($campo != 'genero') {

        $obj->status('error', 'preencha o ' . $erros[] = ucfirst(str_replace("_", " ", $campo)) . " é obrigatório.");
        echo json_encode($obj);
        break;
      } else {
        $obj->status('error', 'Erro ao confimar Selecione um ' . $erros[] = ucfirst(str_replace("_", " ", $campo)) . ' valido !');
        echo json_encode($obj);
        break;
      }
    } else {
      $dados[$campo] = mysqli_real_escape_string($conn, $valor);
    }
  }

  if (empty($erros)) {

    $CapsName = ucfirst($dados['nome']);
    $CapsSobName = ucfirst($dados['sobre_nome']);

    $sql = "INSERT INTO Users(Nome,Sobrenome,Nacimento,Genero) VALUES('$CapsName','$CapsSobName', '$dados[data_nacimento]','$dados[genero]')";

    mysqli_query($conn, $sql);
    mysqli_close($conn);
    $obj->status('success', 'Cadastro feito com sucesso !');
    echo json_encode($obj);
  }
}

// $stmt = $conn->prepare($sql);
// $stmt->bindParam(':nome', $_Nome);
// $stmt->bindParam(':Sob_nome', $_sobNome);
// $stmt->bindParam(':genero', $_Genero);
// $stmt->bindParam(':Indata', $_Data);
// $stmt->execute();