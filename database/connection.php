<?php

    $Servidor = 'localhost';
    $porta = '5433';
    $bancodedados = 'postgres';
    $usuario = 'postgres';
    $senha = 'esus';

    $conectar = pg_connect("host=$Servidor port=$porta dbname=$bancodedados user=$usuario password=$senha");

    if(!$conectar)
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