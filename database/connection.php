<?php
    // ****************** ACESSO AO BANCO DE DADOS LOCAL

    $Servidor = 'localhost';
    $porta = '5432';
    $bancodedados = 'postgres';
    $usuario = 'postgres';
    $senha = '123456';

    $conectarlocal = pg_connect("host=$Servidor port=$porta dbname=$bancodedados user=$usuario password=$senha");

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

    
    // ****************** ACESSO AO BANCO DE DADOS ESUS

    $Servidor = '172.17.135.141';
    $porta = '5433';
    $bancodedados = 'esus';
    $usuario = 'postgres';
    $senha = 'esus';

    $conectarESUS = pg_connect("host=$Servidor port=$porta dbname=$bancodedados user=$usuario password=$senha");

    if(!$conectarESUS)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Algo errado aconteceu. <strong> Erro de conexão com o Banco de Dados do Integrador
        <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button></div>";
    }
    else
    {
        //echo "Banco de Dados Conectado!";
    }  
    
    // ****************** ACESSO AO BANCO DE DADOS SINAN

    $Servidor = '172.17.135.151';
    $porta = '5433';
    $bancodedados = 'serverdados';
    $usuario = 'postgres';
    $senha = 'esus';

    $conectarSINAN = pg_connect("host=$Servidor port=$porta dbname=$bancodedados user=$usuario password=$senha");

    if(!$conectarSINAN)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Algo errado aconteceu. <strong> Erro de conexão com o Banco de Dados do Integrador
        <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button></div>";
    }
    else
    {
        //echo "Banco de Dados Conectado!";
    }     
?>