<?php

include ("../database/connection.php");
ini_set('display_errors', 0);    

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

?>