<?php
    include ("../database/connection.php");

    $sql = 'select * from tb_conexoes';

    $result = pg_exec($conectarlocal,$sql);
?>

<!doctype html>
<style> 
    input[type=text] {
      width: 100%;
      border: 0px;
      outline: none;
    }
    
    input[type=text]:focus {
      border: 0px;
    }
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
                <a class="nav-link" href="conexao.php"><font color="#223A5E">Conexões</font></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="src/config_con.php"><font color="#223A5E">Integração</font></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container">
    &nbsp;
    <table class="table">
        <thead class="text-center">
            <tr style="background-color: #B4BEC9!important;">
                <th class="col">Base de Dados</th>
                <th class="col">Ações</th>
                <th class="col">Conexão</th>
                <th class="col" hidden>Id</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $idBanco = isset($_GET['id'])?$_GET['id']:0;

                while ($dados_conexao = pg_fetch_assoc($result))
                {
            ?>            
            <tr>
                <!-- <form action="conexao.php" method="post"> -->
                    <td class="text-center"><input class="text-center" name="" type="text" value="" readonly><?php echo $dados_conexao['conexao']; ?></td>
                    <td class="text-center"><button style="background-color: #F2EBBF;" class="btn">Configuração</button>&nbsp;<a href="conexao.php?id=<?php echo $dados_conexao['id']; ?>"><button id="teste" name="teste" value="3" style="background-color: #95BEF7;" class="btn">Teste</button></a></td>
                    <td class="text-center">
                    <?php
                        if (($idBanco == 1) and ($idBanco == $dados_conexao['id'])) {

                            $sqlConexao1 = 'Select count(*) from dbsinan.tb_usuario_sinan';
                            
                            $conexao = pg_exec($conectarSINAN,$sqlConexao1);

                            if ($conexao)
                            {
                                echo "CONECTADO AO BANCO DE DADOS DO SINAN!";
                            }
                        }
                        if (($idBanco == 2) and ($idBanco == $dados_conexao['id'])) {
                          $sqlConexao1 = 'Select count(*) from tb_dim_equipe';
                          $conexao = pg_exec($conectarESUS,$sqlConexao1);

                          if ($conexao)
                          {
                              echo "CONECTADO AO BANCO DE DADOS DO ESUS!";
                          }
                        }
                        if (($idBanco == 3) and ($idBanco == $dados_conexao['id'])) {
                          $sqlConexao1 = 'Select * from tb_conexoes';
                          $conexao = pg_exec($conectarlocal,$sqlConexao1);

                          if ($conexao)
                          {
                              echo "CONECTADO AO BANCO DE DADOS DE INTEGRAÇÃO!";
                          }
                        }  
                    ?>
                    </td>
                    <td class="text-center" hidden><input type="text" id="valorId" name="valorId" value=<?php echo $dados_conexao['id']; ?>></td>
                <!-- </form> -->
            <?php
                }
            ?>
            </tr>
        </tbody>
    </table>
 </div>

  </body>
</html>

