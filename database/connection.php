<?php
    // ****************** ACESSO AO BANCO DE DADOS DE INTEGRACAO

    $ServidorIntegracao = '172.17.135.151';
    $portaIntegracao = '5433';
    $bdIntegracao = 'serverdados';
    $usuarioIntegracao = 'postgres';
    $senhaIntegracao = 'esus';

    /* $Servidor = 'localhost';
    $porta = '5432';
    $bancodedados = 'postgres';
    $usuario = 'postgres';
    $senha = '123456'; */

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

    $ServidorEsus = '172.17.135.142';
    $portaEsus = '5433';
    $bdEsus = 'esus';
    $usuarioEsus = 'postgres';
    $senhaEsus = 'esus';

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

    $ServidorSinan = '10.10.5.106';
    $portaSinan = '5445';
    $bdSinan = 'sinanpop92';
    $usuarioSinan = 'postgres';
    $senhaSinan = '';

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