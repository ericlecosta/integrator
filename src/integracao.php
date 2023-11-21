<?php
    include ("../database/connection.php");
    ini_set('display_errors', 0);    

    $string_result = "";
    $idexe = isset($_GET['id'])?$_GET['id']:0;

    if($idexe==1){
      $sql = "select * from tb_conexoes";
      $conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
      $result = pg_exec($conectarlocal,$sql);
      pg_close ($conectarlocal);

      $st_conexao = 0;

      while ($dados_conexao = pg_fetch_assoc($result))
      {
        if($dados_conexao['st_conexao'] <> 'Conectado'){
          $st_conexao = $st_conexao+1;
        }
      }

      if($st_conexao<>0){
        $result_exec .= "# ERRO, Verificar parâmetros das conexões!!".PHP_EOL;
      } else {
        $result_exec .= "Conexões estabelecidas.".PHP_EOL;
      }
    }

  

    //$conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
    //$result = pg_exec($conectarlocal,$sql);
    
    //pg_close ($conectarlocal);

    //$result_exec = "Teste...";
    
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
                <a class="nav-link" href="integracao.php"><font color="#223A5E">Integração</font></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="mt-4 text-center"><a href="integracao.php?id=1"><button style="margin-right: 10px;" type="button" name="salvar" class="btn btn-dark">Executar Integração</button></a>
            <a href="conexao.php?"><button style="margin-right: 10px;" type="button" class="btn btn-primary">Voltar</button></a>
      </div>
      <div class="mt-4 text-center"> <?php echo nl2br($result_exec); ?>
      </div>
      <?php
      if($idexe==1 and )
      ?>
  </body>
</html>