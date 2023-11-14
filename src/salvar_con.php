
<?php

include ("../database/connection.php");

$servidor = $_POST['host_p'];
$db = $_POST['database_p'];
$port= $_POST['port_p'];
$user = $_POST['user_p'];
$senha = $_POST['password_p'];
$id_bd = $_POST['id_p'];
echo $_SERVER['REQUEST_METHOD'];
$st_update = '';

if (isset($_POST["salvar"])) {
    //echo "botão salvar";
    $sqlup = "UPDATE tb_conexoes 
    SET hostname = '$servidor', base_dados = '$db', porta = '$port', usuario = '$user', senha = '$senha', 
        st_conexao = 'Configurado', dt_conexao = null
    WHERE id = '$id_bd';";

    $conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
    $res = pg_exec($conectarlocal,$sqlup);

    pg_close ($conectarlocal);

    if($id_bd <> 3) {
        if($res) {
            $st_update = "Registro salvo com sucesso!";
        } else {
            $st_update = "Não foi possível salvar registro!";
        }
    } else {
        $st_update = "Não é possível alterar esta conexão!";
    }
}
  if (isset($_POST["excluir"])) {
    echo "botão excluir";
    $sqlup = "UPDATE tb_conexoes 
    SET hostname = null, base_dados = null, porta = null, usuario = null, senha = null, 
        st_conexao = null, dt_conexao = null
    WHERE id = '$id_bd';";

    $conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
    $res = pg_exec($conectarlocal,$sqlup);

    pg_close ($conectarlocal);

    if($id_bd <> 3) {
      if($res) {
          $st_update = "Registro excluído com sucesso!";
      } else {
          $st_update = "Não foi possível excluir registro!";
      }
    } else {
      $st_update = "Não é possível alterar esta conexão!";
  }
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
    <link rel="icon" href="../img/icone_tb_bi.png">
    <title>TB BI - v1.3</title>

  </head>
  <body>

    <nav style="background-color: #3B8C6E!important;" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="../index.php"><font color="#223A5E"><b>TB BI</b></font></a>
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
        <h4 style="margin: 35px;"><b><?php echo $st_update ?></b></h4>
        <a href="conexao.php?"><button style="margin-right: 10px;" type="button" class="btn btn-primary">Voltar</button>
    </div>


  </body>
