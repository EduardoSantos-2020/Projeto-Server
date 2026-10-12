<?php

include_once('conexao.php');

if (!$conn) {

    $obj->status('error', 'Estamos com problemas com o site aguarde !');

    
}else {
    $obj->status('success', 'Site carregado com sucesso !');
    
    }


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $campos = ["nome", "sobrenome", "genero", "data_nacimento"];
  $erros = [];
  $dados = [];

  // Laço for para validar os campos

  for ($i = 0; $i < count($campos); $i++) {

    $campo = $campos[$i];
    $valor = trim($_POST[$campo]);

    if (empty($valor)) {


      if ($campo != 'genero') {

        $obj->status('error', 'preencha  ' . $erros[] = ucfirst(str_replace("_", " ", $campo)) . " é obrigatório.");
       
        break;
      } else {
        $obj->status('error', 'Erro ao confimar Selecione um ' . $erros[] = ucfirst(str_replace("_", " ", $campo)) . ' valido !');
    
        break;
      }
    } else {
      $dados[$campo] = mysqli_real_escape_string($conn, $valor);
    }

   
  }

  if (empty($erros)) {

    $CapsName = ucfirst($dados['nome']);
    $CapsSobName = ucfirst($dados['sobrenome']);

    $sql = "INSERT INTO Users(Nome,Sobrenome,Nacimento,Genero) VALUES('$CapsName','$CapsSobName', '$dados[data_nacimento]','$dados[genero]')";

    mysqli_query($conn, $sql);
    mysqli_close($conn);
    $obj->status('success', 'Cadastro feito com sucesso !');
  
  }
}
 echo json_encode($obj);
// $stmt = $conn->prepare($sql);
// $stmt->bindParam(':nome', $_Nome);
// $stmt->bindParam(':Sob_nome', $_sobNome);
// $stmt->bindParam(':genero', $_Genero);
// $stmt->bindParam(':Indata', $_Data);
// $stmt->execute();