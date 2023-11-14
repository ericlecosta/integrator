<?php
    include ("../database/connection.php");
    //ini_set('display_errors', 0);    

    $sql = "select * ,concat(TO_CHAR(dt_conexao ,'DD-MM-YYYY'),' ',TO_CHAR(dt_conexao AT TIME ZONE 'Brazil/West', 'HH24:MI:SS')) as dt_hh from tb_conexoes order by id;";

    $conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
    $result = pg_exec($conectarlocal,$sql);
    
    pg_close ($conectarlocal);

    
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
      <div class="container">
    &nbsp;
    <table class="table">
        <thead class="text-center">
            <tr style="background-color: #B4BEC9!important;">
                <th class="col">Base de Dados</th>
                <th class="col">Ações</th>
                <th class="col">Status Conexão</th>
                <th class="col">Verificação</th>
                <th class="col" hidden>Id</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $idBanco = isset($_GET['id'])?$_GET['id']:0;

                $desc_conexao = '';
                
                while ($dados_conexao = pg_fetch_assoc($result))
                {
                  $idlink = $dados_conexao['id']; 
                  /*$link1 = "<a href=config_con.php?id=<?php echo $dados_conexao['id'];?>"><button style="background-color: #F2EBBF;" class="btn">Configurar</button></a>*/
            ?>           
            <tr>
                <!-- <form action="conexao.php" method="post"> -->
                    <td class="text-center"><?php echo $dados_conexao['conexao']; ?></td>
                    <!-- <td class="text-center "><a href="config_con.php?id=<?php echo $dados_conexao['id'];?>"><button style="background-color: #F2EBBF;" class="btn">Configurar</button></a>&nbsp;<a href="conexao.php?id=<?php echo $dados_conexao['id']; ?>"><button id="teste" name="teste" value="3" style="background-color: #95BEF7;" class="btn">Testar</button></a></td> -->
                    <td class="text-center "><a href="
                    <?php if ($dados_conexao['id'] == 3)                          
                          {echo "#"; }
                          else 
                          {echo "config_con.php?id=".$idlink; }
                    ?>"><button style="background-color: <?php if($dados_conexao['id'] == 3) {echo "gray";} else {echo "#F2EBBF";}?>;" class="btn">Configurar</button></a>&nbsp;<a href="conexao.php?id=<?php echo $dados_conexao['id']; ?>"><button id="teste" name="teste" value="3" style="background-color: #95BEF7;" class="btn">Testar</button></a></td>
                    <td class="text-center"><font color="<?php if($dados_conexao['st_conexao']=='Conectado'){} ?>#223A5E">
                    <?php
                            echo $dados_conexao['st_conexao'];
                        // Verificar a conexão com o SINAN
                        if ($dados_conexao['st_conexao'] <> '' and $idBanco <> 0) {
                              if (($idBanco == 1) and ($idBanco == $dados_conexao['id'])) {
                                    if ($conectarSINAN = @pg_connect("host=$ServidorSinan port=$portaSinan dbname=$bdSinan user=$usuarioSinan password=$senhaSinan"))
                                    {
                                      pg_close ($conectarSINAN);
                                      $desc_conexao = "Conectado";
                                    } else {
                                      $desc_conexao = "Não Conectado";
                                    }
                              }
                              if (($idBanco == 2) and ($idBanco == $dados_conexao['id'])) {
                                if ($conectarESUS = @pg_connect("host=$ServidorEsus port=$portaEsus dbname=$bdEsus user=$usuarioEsus password=$senhaEsus"))
                                {
                                  pg_close ($conectarESUS);
                                  $desc_conexao = "Conectado";
                                } else {
                                  $desc_conexao = "Não Conectado";
                                }
                              }
                              if (($idBanco == 3) and ($idBanco == $dados_conexao['id'])) {
                                if ($conectarIntegracao = @pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao"))
                                {
                                  pg_close ($conectarIntegracao);
                                  $desc_conexao = "Conectado";
                                } else {
                                  $desc_conexao = "Não Conectado";
                                }
                              }
                          }
                    ?></font>
                    </td>
                    <td class="text-center"><?php echo $dados_conexao['dt_hh']; ?></td>
                    <td class="text-center" hidden><input type="text" id="<?php echo $dados_conexao['id']+1; ?>" name="valorId" value=<?php echo $dados_conexao['id']; ?>></td>
                <!-- </form> -->
            <?php
                }

                if($desc_conexao <> '') {
                  //$cont = $cont + 1;
                  $sqlup = "UPDATE tb_conexoes 
                            SET st_conexao = '$desc_conexao', dt_conexao = current_timestamp
                            WHERE id = '$idBanco';";
                  
                  $conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
                  $res = pg_exec($conectarlocal,$sqlup);

                  $sql = 'select * from tb_conexoes order by id';
                  $result = pg_exec($conectarlocal,$sql);

                  pg_close ($conectarlocal);
                  
                  echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=http://localhost/integrator/src/conexao.php'>";

                }
            ?>
            </tr>
        </tbody>
    </table>
 </div>

  </body>
</html>

