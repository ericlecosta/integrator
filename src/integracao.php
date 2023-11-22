<?php
    include ("../database/connection.php");
    //ini_set('display_errors', 0);    

    $string_result = "";
    $idexe = isset($_GET['id'])?$_GET['id']:0;

    if($idexe==1){
      $string_result .= "Verificando Conexões...".PHP_EOL;
    }
    if($idexe==2){
      $string_result .= "Verificando Conexões...".PHP_EOL;
      $string_result .= "Conexões Estabelecidas".PHP_EOL;
      $string_result .= "Preparando Importação do SINAN".PHP_EOL;
    }

    if($idexe==3){
      $string_result .= "Verificando Conexões...".PHP_EOL;
      $string_result .= "Conexões Estabelecidas".PHP_EOL;
      $string_result .= "Preparando Importação do SINAN".PHP_EOL;
    }

    if($idexe==4){
      $string_result .= "Verificando Conexões...".PHP_EOL;
      $string_result .= "Conexões Estabelecidas".PHP_EOL;
      $string_result .= "Preparando Importação do SINAN".PHP_EOL;
      $string_result .= "Dados do SINAN Importados".PHP_EOL;
      $string_result .= "Preparando Importação do e-SUS".PHP_EOL;
    }

    if($idexe==5){
      $string_result .= "Verificando Conexões...".PHP_EOL;
      $string_result .= "Conexões Estabelecidas".PHP_EOL;
      $string_result .= "Preparando Importação do SINAN".PHP_EOL;
      $string_result .= "Dados do SINAN Importados".PHP_EOL;
      $string_result .= "Preparando Importação do e-SUS".PHP_EOL;
    }

    
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

        if($conectarSINAN = @pg_connect("host=$ServidorSinan port=$portaSinan dbname=$bdSinan user=$usuarioSinan password=$senhaSinan")){
          $st_conexao =  $st_conexao+1;
          pg_close ($conectarSINAN);
        };
        

        if ($conectarESUS = @pg_connect("host=$ServidorEsus port=$portaEsus dbname=$bdEsus user=$usuarioEsus password=$senhaEsus")){
          $st_conexao =  $st_conexao+1;
          pg_close ($conectarESUS);
        }
        

        if ($conectarIntegracao = @pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao")){
          $st_conexao =  $st_conexao+1;
          pg_close ($conectarIntegracao);
        }
        
        
        if($st_conexao <3){
          $conect_result = "# ERRO, Verificar parâmetros das conexões!!";
        } else {
          $conect_result = "Conexões Estabelecidas";
          echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=http://localhost/integrator/src/integracao.php?id=2'>";
        }
        echo "<div class='text-center'>$conect_result</div>";
      
      }
      if($idexe==2){
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=http://localhost/integrator/src/integracao.php?id=3'>";
      }
      //importar sinan
      $st_sinan = 0;

      if($idexe==3){
        
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

        $conectarSINAN = @pg_connect("host=$ServidorSinan port=$portaSinan dbname=$bdSinan user=$usuarioSinan password=$senhaSinan");

        $result = @pg_query($conectarSINAN,$sql);

        if($result) {
          $st_sinan = $st_sinan+1;
          $sinan_result = "Dados do SINAN Importados";
          pg_close ($conectarSINAN);
          echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=http://localhost/integrator/src/integracao.php?id=4'>";
        } else {
          $sinan_result = "ERRO ao Importar Dados do SINAN!";
        }
        

        echo "<div class='text-center'>$sinan_result</div>";

      }

      if($idexe==4){
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=http://localhost/integrator/src/integracao.php?id=5'>";
      }
      //importar esus
      $st_esus = 0;
      if($idexe==5){
        $sql = "select distinct cp.co_seq_fat_cidadao_pec,cp.no_cidadao,upper(c.no_mae) as nome_mae,date(dtn.dt_registro) as dt_nasc,
        cp.nu_cns,cp.nu_cpf_cidadao,concat (upper(tl.no_tipo_logradouro),' ',upper(c.ds_logradouro)) as no_end,
        c.nu_numero, upper(c.no_bairro) as bairro_desc,c.ds_cep, c.nu_telefone_celular, c.nu_telefone_residencial,
        c.nu_telefone_contato, ce.nu_cnes, tu.no_unidade_saude, ce.nu_ine, te.no_equipe from tb_fat_cidadao_pec cp 
        join tb_dim_tempo dtn on dtn.co_seq_dim_tempo = cp.co_dim_tempo_nascimento 
        join ( select distinct fai.co_fat_cidadao_pec from tb_fat_atendimento_individual fai 
        where (fai.ds_filtro_cids LIKE ANY (array['%A150%','%A151%','%A152%','%A153%','%A155%','%A157%','%A158%','%A159%']) or 
        (fai.ds_filtro_ciaps like '%A70%' or fai.ds_filtro_ciaps like '%ABP017%')) and fai.co_dim_tempo > 20200000 )  
        tub on tub.co_fat_cidadao_pec = cp.co_seq_fat_cidadao_pec 
        join tb_cidadao c on c.co_seq_cidadao = cp.co_cidadao 
        join tb_tipo_logradouro tl on tl.co_tipo_logradouro = c.tp_logradouro 
        left join tb_cidadao_vinculacao_equipe ce on ce.co_cidadao = c.co_seq_cidadao 
        left join tb_equipe te on te.nu_ine =ce.nu_ine 
        left join tb_unidade_saude tu on tu.nu_cnes = ce.nu_cnes 
        where (te.st_ativo = 1 or te.st_ativo is null);";

        $conectarESUS = @pg_connect("host=$ServidorEsus port=$portaEsus dbname=$bdEsus user=$usuarioEsus password=$senhaEsus");

        $result_pac = @pg_query($conectarESUS,$sql);

        $sql = "select 1 as ativ_cod,'CONSULTA'::text as ativ_ds,fai.co_fat_cidadao_pec, dta.dt_registro as dt_atend, cb.nu_cbo, un.nu_cnes  
        from tb_fat_atendimento_individual fai 
        join tb_dim_cbo cb on cb.co_seq_dim_cbo = fai.co_dim_cbo_1 
        join tb_dim_tempo dta on dta.co_seq_dim_tempo = fai.co_dim_tempo 
        join tb_dim_unidade_saude un on un.co_seq_dim_unidade_saude = fai.co_dim_unidade_saude_1 
        where (fai.ds_filtro_cids LIKE ANY (array['%A150%','%A151%','%A152%','%A153%','%A155%','%A157%','%A158%','%A159%']) or (fai.ds_filtro_ciaps like '%A70%' 
        or fai.ds_filtro_ciaps like '%ABP017%')) and fai.co_dim_tempo > 20200000 and (cb.nu_cbo like '225%' or cb.nu_cbo like '2235%') 
        and fai.co_fat_cidadao_pec is not null;";

        $result_con = @pg_query($conectarESUS,$sql);

        $sql = "select 2 as ativ_cod,'HIV AVALIADO' as ativ_ds,fai.co_fat_cidadao_pec,dtt.dt_registro as dt_atend, cb.nu_cbo, un.nu_cnes 
        from tb_fat_atendimento_individual fai 
        join tb_dim_tempo dtt on dtt.co_seq_dim_tempo = fai.co_dim_tempo 
        join tb_dim_cbo cb on cb.co_seq_dim_cbo = fai.co_dim_cbo_1 
        join tb_dim_unidade_saude un on un.co_seq_dim_unidade_saude = fai.co_dim_unidade_saude_1 
        join (select distinct tfai.co_fat_cidadao_pec 
        from tb_fat_atendimento_individual tfai 
        where tfai.co_dim_tempo > 20200000 
        and (tfai.ds_filtro_cids LIKE ANY (array['%A150%','%A151%','%A152%','%A153%','%A155%','%A157%','%A158%','%A159%']) or (tfai.ds_filtro_ciaps like '%A70%' 
        or tfai.ds_filtro_ciaps like '%ABP017%'))) tb on tb.co_fat_cidadao_pec = fai.co_fat_cidadao_pec 
        where fai.co_dim_tempo > 20200000 and (fai.ds_filtro_proced_avaliados like '%0214010058%' or fai.ds_filtro_proced_avaliados like '%ABPG024%' or 
        fai.ds_filtro_proced_avaliados like '%0202030040%' or fai.ds_filtro_proced_avaliados like '%0202030296%' or fai.ds_filtro_proced_avaliados like '%0202030300%' or 
        fai.ds_filtro_proced_avaliados like '%ABEX018%') and fai.co_fat_cidadao_pec is not null;";

        $result_hiva = @pg_query($conectarESUS,$sql);

        $sql = "select 2 as ativ_cod,'HIV TESTE RAP' as ativ_ds,fap.co_fat_cidadao_pec,dtt.dt_registro as dt_atend, cb.nu_cbo, un.nu_cnes 
        from tb_fat_proced_atend fap 
        join tb_dim_tempo dtt on dtt.co_seq_dim_tempo = fap.co_dim_tempo 
        join tb_dim_cbo cb on cb.co_seq_dim_cbo = fap.co_dim_cbo 
        join tb_dim_unidade_saude un on un.co_seq_dim_unidade_saude = fap.co_dim_unidade_saude 
        join (select distinct tfai.co_fat_cidadao_pec 
        from tb_fat_atendimento_individual tfai 
        where tfai.co_dim_tempo > 20200000 
        and (tfai.ds_filtro_cids LIKE ANY (array['%A150%','%A151%','%A152%','%A153%','%A155%','%A157%','%A158%','%A159%']) or (tfai.ds_filtro_ciaps like '%A70%' 
        or tfai.ds_filtro_ciaps like '%ABP017%'))) tb on tb.co_fat_cidadao_pec = fap.co_fat_cidadao_pec 
        where fap.co_dim_tempo > 20200000 and (fap.ds_filtro_procedimento like '%0214010058%' or fap.ds_filtro_procedimento like '%ABPG024%') 
        and fap.co_fat_cidadao_pec is not null;";

        $result_hivt = @pg_query($conectarESUS,$sql);

        $sql = "select 3 as ativ_cod,'BACILOSCOPIA' as ativ_ds, cp.co_seq_fat_cidadao_pec as co_fat_cidadao_pec, date(ex.dt_realizacao) as dt_atend, ''::text as nu_cbo, un.nu_cnes 
        from tb_fat_cidadao_pec cp 
        join tb_cidadao c on c.co_seq_cidadao = cp.co_cidadao 
        join tb_prontuario pt on pt.co_cidadao = c.co_seq_cidadao 
        join tb_exame_requisitado ex on ex.co_prontuario = pt.co_seq_prontuario 
        join tb_proced p on p.co_seq_proced = ex.co_proced 
        join tb_atend_prof atp on atp.co_seq_atend_prof = ex.co_atend_prof 
        JOIN tb_lotacao lo ON atp.co_lotacao = lo.co_ator_papel
        JOIN tb_unidade_saude un ON lo.co_unidade_saude = un.co_seq_unidade_saude 
        where p.co_proced = '0202080064' and ex.dt_realizacao  > '2019-12-31';";

        $result_bac = @pg_query($conectarESUS,$sql);


        $sql = "select 4 as ativ_cod,'RX TORAX' as ativ_ds,fai.co_fat_cidadao_pec,dtt.dt_registro as dt_atend, cb.nu_cbo, un.nu_cnes  
        from tb_fat_atendimento_individual fai 
        join tb_dim_tempo dtt on dtt.co_seq_dim_tempo = fai.co_dim_tempo 
        join tb_dim_cbo cb on cb.co_seq_dim_cbo = fai.co_dim_cbo_1 
        join tb_dim_unidade_saude un on un.co_seq_dim_unidade_saude = fai.co_dim_unidade_saude_1 
        join (select distinct tfai.co_fat_cidadao_pec 
        from tb_fat_atendimento_individual tfai 
        where tfai.co_dim_tempo > 20200000 
        and (tfai.ds_filtro_cids LIKE ANY (array['%A150%','%A151%','%A152%','%A153%','%A155%','%A157%','%A158%','%A159%']) or (tfai.ds_filtro_ciaps like '%A70%' 
        or tfai.ds_filtro_ciaps like '%ABP017%'))) tb on tb.co_fat_cidadao_pec = fai.co_fat_cidadao_pec 
        where fai.co_dim_tempo > 20200000 and (fai.ds_filtro_proced_avaliados like '%0204030145%' or fai.ds_filtro_proced_avaliados like '%0204030153%' or 
        fai.ds_filtro_proced_avaliados like '%0204030161%' or fai.ds_filtro_proced_avaliados like '%0204030170%' or fai.ds_filtro_proced_avaliados like '%0204030129%' or 
        fai.ds_filtro_proced_avaliados like '%0204030137%') and fai.co_fat_cidadao_pec is not null;";

        $result_rx = @pg_query($conectarESUS,$sql);


        if($result_pac || $result_con || $result_hiva || $result_hivt || $result_rx) {
          $st_esus = $st_esus+1;
          $esus_result = "Dados do e-SUS Importados";
          
          //echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=http://localhost/integrator/src/integracao.php?id=6'>";
        } else {
          $esus_result = "ERRO ao Importar Dados do e-SUS!";
        }

        pg_close ($conectarESUS);

        echo "<div class='text-center'>$esus_result</div>";
      }
      ?>
  </body>
</html>