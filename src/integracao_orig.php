<?php
    include ("../database/connection.php");
    ini_set('display_errors', 0);    

    $string_result = "";
    $idexe = isset($_GET['id'])?$_GET['id']:0;

    if($idexe==1){
      $string_result .= "Verificando Conexões...";
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
      <div class="mt-4 text-center"> <?php echo nl2br($string_result);?>
      </div>
      <?php

      //teste conexao

      $st_conexao = 0;
      if($idexe==1){

        $sql = "select * from tb_conexoes";
        $conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
        $result = pg_exec($conectarlocal,$sql);
        pg_close ($conectarlocal);

        if($conectarSINAN = @pg_connect("host=$ServidorSinan port=$portaSinan dbname=$bdSinan user=$usuarioSinan password=$senhaSinan")){
          $st_conexao =  $st_conexao+1;
        };
        pg_close ($conectarSINAN);

        if ($conectarESUS = @pg_connect("host=$ServidorEsus port=$portaEsus dbname=$bdEsus user=$usuarioEsus password=$senhaEsus")){
          $st_conexao =  $st_conexao+1;
        }
        pg_close ($conectarESUS);

        if ($conectarIntegracao = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao")){
          $st_conexao =  $st_conexao+1;
        }
        pg_close ($conectarIntegracao);

        if($st_conexao==0){
          $conect_result = "# ERRO, Verificar parâmetros das conexões!!";
        } else {
          $conect_result = "Conexões Estabelecidas";
          
        }
        echo "<div class='text-center'>$conect_result</div>";
      
      }

      //importar sinan
      $st_sinan = 0;

      if($idexe==1 || $st_conexao>0){
        echo "<div class='text-center'>Preparando Dados do SINAN...</div>";

        $sql = "select tn.nu_notificacao,tn.dt_notificacao,tn.co_municipio_notificacao,un.co_cnes,una.co_cnes as cnes_atual,un.ds_estabelecimento, 
        una.ds_estabelecimento as ds_estab_atual,tn.tp_notificacao,tn.dt_diagnostico_sintoma,tb.co_cid,tb.dt_notificacao_atual, 
        dbsinan.decriptografanova(no_nome_paciente) as nome_pac,dbsinan.decriptografanova(no_nome_mae) as nome_mae,tn.dt_nascimento, 
        tn.tp_sexo,tn.nu_cartao_sus,tn.ds_chave_fonetica,tn.co_municipio_residencia,tn.no_logradouro_residencia, 
        case when tn.nu_residencia like '%$%' then translate(tn.nu_residencia,'$', '') else tn.nu_residencia end as nu_residencia,
        tn.no_bairro_residencia,tn.co_bairro_residencia,tn.nu_cep_residencia,dbsinan.decriptografanova(tn.nu_ddd_residencia) as nu_ddd, 
        dbsinan.decriptografanova(tn.nu_telefone_residencia) as nu_tel,tb.tp_entrada,tb.dt_inicio_tratamento,tb.nu_contato, 
        tb.nu_contato_examinado,tb.tp_hiv,tb.tp_situacao_encerramento,tb.dt_encerramento,tb.tp_transf,tb.tp_forma, 
        tb.tp_extrapulmonar_1,tb.tp_extrapulmonar_2,tb.st_baciloscopia_escarro,tb.st_baciloscopia_escarro2,tb.tp_cultura_escarro, 
        tb.tp_cultura_outro,tb.tp_histopatologia,tb.tp_raio_x,tb.tp_molecular,tb.tp_tratamento,tb.st_baciloscopia_1_mes, 
        tb.st_baciloscopia_2_mes,tb.st_baciloscopia_3_mes,tb.st_baciloscopia_4_mes,tb.st_baciloscopia_5_mes,tb.st_baciloscopia_6_mes, 
        tb.st_bacil_apos_6_mes,tb.tp_pop_imigrante,tb.tp_pop_liberdade,tb.tp_pop_rua,tb.tp_pop_saude,tb.st_agravo_aids,tb.st_agravo_alcolismo, 
        tb.st_agravo_diabete,tb.st_agravo_drogas,tb.st_agravo_mental,tb.st_agravo_outro,tb.st_agravo_tabaco,tb.tp_antirretroviral_trat, 
        tb.tp_sensibilidade,tb.tp_tratamento_acompanhamento from dbsinan.tb_notificacao tn  
        join dbsinan.tb_investiga_tuberculose tb on tb.nu_notificacao = tn.nu_notificacao and tb.dt_notificacao = tn.dt_notificacao  
        join dblocalidade.tb_estabelecimento_saude un on un.co_estabelecimento = tn.co_unidade_notificacao  
        join dblocalidade.tb_estabelecimento_saude una on una.co_estabelecimento = tb.co_unidade_saude_atual 
        join 
        (	--ultima notif
          select
          dbsinan.decriptografanova(no_nome_paciente) as nome_p,
          nt.dt_nascimento,
          max(nt.nu_notificacao::text||nt.dt_notificacao::text) as idnoti
          from dbsinan.tb_notificacao nt 
          join dbsinan.tb_investiga_tuberculose tu on tu.nu_notificacao = nt.nu_notificacao and tu.dt_notificacao = nt.dt_notificacao 
          where tu.co_cid = 'A16.9'
          group by 1,2
        ) ultn on ultn.idnoti = (tn.nu_notificacao::text||tn.dt_notificacao::text)
        where tb.co_cid = 'A16.9' and tn.dt_notificacao > '2022-12-31';";

        $conectarSINAN = pg_connect("host=$ServidorSinan port=$portaSinan dbname=$bdSinan user=$usuarioSinan password=$senhaSinan");

        $result = pg_query($conectarSINAN,$sql);

        if($result) {
          $st_sinan = $st_sinan+1;
          $sinan_result = "Dados do SINAN Importados";
        } else {
          $sinan_result = "ERRO ao Importar Dados do SINAN!";
        }
        pg_close ($conectarSINAN);

        echo "<div class='text-center'>$sinan_result</div>";

      }
      ?>
  </body>
</html>