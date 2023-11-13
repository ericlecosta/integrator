
<?php

include ("../database/connection.php");

$servidor = $_GET['host_p'];
$db = $_GET['database_p'];
$port= $_GET['port_p'];
$user = $_GET['user_p'];
$senha = $_GET['password_p'];
$id_bd = $_GET['id_p'];
echo "Servidor:<BR>".$servidor;


$sqlup = "UPDATE tb_conexoes 
SET hostname = '$servidor', base_dados = '$db', porta = '$port', usuario = '$user', senha = '$senha', 
    st_conexao = 'Configurado', dt_conexao = null
WHERE id = '$id_bd';";

$conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
$res = pg_exec($conectarlocal,$sqlup);

pg_close ($conectarlocal);

if($id_bd <> 3) {
    if($res) {
        echo "Registro salvo com sucesso!";
    } else {
        echo "Não foi possível salvar registro!";
    }
} else {
    echo "Não é possível alterar esta conexão!";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- teste git -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="img/icone_tb_bi.png">
    <title>TB BI - v1.3</title>

  </head>
  <body>

    <nav style="background-color: #3B8C6E!important;" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href=""><font color="#223A5E"><b>TB BI</b></font></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="src/conexao.php"><font color="#223A5E">Configuração</font></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="src/config_con.php"><font color="#223A5E">Integração</font></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <div style="text-align: center; vertical-align: middle;" class="container">
        <h2><b>Integração de dados dos sistemas e-SUS e SINAN</b></h2>
        <h2><b>para colaborar no controle dos casos de tuberculose</b></h2>
        <img src="img/img_pulmao.png" width="900" height="550" />
    </div>


  </body>

