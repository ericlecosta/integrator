<?php
    include ("../database/connection.php");
    ini_set('display_errors', 0);    

    $idBanco = isset($_GET['id'])?$_GET['id']:0;

    $sql = "select * from tb_conexoes where id = '$idBanco'";

    $conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
    $result = pg_exec($conectarlocal,$sql);
    
    pg_close ($conectarlocal);

    $dados_conexao = pg_fetch_assoc($result);
    
?> 

<!doctype html>
<style> 
</style>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="../img/icone_tb_bi.png">
    <title>TB BI</title>
  </head>
  <script>
      function refreshPage() {
        location.reload();
        console.log("refresh")
      }
    </script>
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
                <a class="nav-link" href="conexao.php"><font color="#223A5E">Configuração</font></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="src/config_con.php"><font color="#223A5E">Integração</font></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

   <form action="" method="post">
        <div class="container">
            <h3>Paramêtros de Conexão</h1>
            <h5><input style = "border: 0px; outline: none; color: #223A5E; font-weight: bold;" name="no_dados_p" type="text" value="<?php echo $dados_conexao['conexao']; ?>" readonly></h3>
            <div class="row">
                <div class="col-2" ><font color="#0D65D9"><b>Host:</b></font><input style = "border: 1px solid silver;" name="host_p" class="form-control-sm" type="text" value="<?php echo $dados_conexao['hostname'];?>"></div>
                <div class="col-2" ><font color="#0D65D9"><b>Database:</b></font><input style = "border: 1px solid silver;" name="database_p" class="form-control-sm" type="text" value="<?php echo $dados_conexao['base_dados']; ?>"></div>
                <div class="col-2" ><font color="#0D65D9"><b>Port:</b></font><input style = "border: 1px solid silver;" name="port_p" class="form-control-sm" type="text" value="<?php echo $dados_conexao['porta']; ?>"></div>
                <div class="col-2" ><font color="#0D65D9"><b>User:</b></font><input style = "border: 1px solid silver;" name="user_p" class="form-control-sm" type="text" value="<?php echo $dados_conexao['usuario']; ?>"></div>
                <div class="col-2" ><font color="#0D65D9"><b>Password:</b></font><input style = "border: 1px solid silver;" name="password_p" class="form-control-sm" type="text" value="<?php echo $dados_conexao['senha']; ?>"></div>
            </div>
            <div style="color:#00BFFF;" class="container p-2">{{ st_altera }}</div>
        </div>
    </form>
   
