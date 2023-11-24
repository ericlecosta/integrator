<?php

$ServidorIntegracao = 'localhost';
$portaIntegracao = '5433';
$bdIntegracao = 'postgres';
$usuarioIntegracao = 'postgres';
$senhaIntegracao = 'esus'; 

$sql = 'select * from tb_conexoes order by id';

$conectar = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
$result = pg_exec($conectar,$sql);

pg_close ($conectar);

while ($dados_conexao = pg_fetch_assoc($result))
{

    if($dados_conexao['id']==1){
        $ServidorSinan = $dados_conexao['hostname'];
        $portaSinan = $dados_conexao['porta'];
        $bdSinan = $dados_conexao['base_dados'];
        $usuarioSinan = $dados_conexao['usuario'];
        $senhaSinan = $dados_conexao['senha'];
    } elseif ($dados_conexao['id']==2){
        $ServidorEsus =  $dados_conexao['hostname'];
        $portaEsus = $dados_conexao['porta'];
        $bdEsus = $dados_conexao['base_dados'];
        $usuarioEsus = $dados_conexao['usuario'];
        $senhaEsus = $dados_conexao['senha'];
    }
}

    // ****************** ACESSO AO BANCO DE DADOS DE INTEGRACAO
/*
    //$conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");

    /*
    if(!$conectarlocal)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Algo errado aconteceu. <strong> Erro de conexão com o Banco de Dados do Integrador
        <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button></div>";
    }
    else
    {
        //echo "Banco de Dados Conectado!";
    }
    */

    
    // ****************** ACESSO AO BANCO DE DADOS ESUS
/*
    $ServidorEsus = '172.17.135.142';
    $portaEsus = '5433';
    $bdEsus = 'esus';
    $usuarioEsus = 'postgres';
    $senhaEsus = 'esus'; */

    //$conectarESUS = pg_connect("host=$ServidorESUS port=$porta dbname=$bancodedados user=$usuario password=$senha");
/*
    if(!$conectarESUS)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Algo errado aconteceu. <strong> Erro de conexão com o Banco de Dados do e-SUS
        <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button></div>";
    }
    else
    {
        //echo "Banco de Dados Conectado!";
    }  
*/    
    // ****************** ACESSO AO BANCO DE DADOS SINAN
/*
    $ServidorSinan = '10.10.5.106';
    $portaSinan = '5445';
    $bdSinan = 'sinanpop92';
    $usuarioSinan = 'postgres';
    $senhaSinan = ''; */

/*
    if(!$conectarSINAN)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Algo errado aconteceu. <strong> Erro de conexão com o Banco de Dados do SINAN
        <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button></div>";
    }
    else
    {
        //echo "Banco de Dados Conectado!";
    }     
*/
?>