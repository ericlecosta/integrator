
<?php

include ("../database/connection.php");

$servidor = $_GET['host_p'];
$db = $_GET['database_p'];
$port= $_GET['port_p'];
$user = $_GET['user_p'];
$senha = $_GET['password_p'];
$id_bd = $_GET['id_p'];
echo "Servidor:<BR>".$servidor;


$sqlup = "UPDATE tb_conexoes 
SET hostname = '$servidor', base_dados = '$db', porta = '$port', usuario = '$user', senha = '$senha', 
    st_conexao = 'Configurado', dt_conexao = null
WHERE id = '$id_bd';";

$conectarlocal = pg_connect("host=$ServidorIntegracao port=$portaIntegracao dbname=$bdIntegracao user=$usuarioIntegracao password=$senhaIntegracao");
$res = pg_exec($conectarlocal,$sqlup);

pg_close ($conectarlocal);

if($id_bd <> 3) {
    if($res) {
        echo "Registro salvo com sucesso!";
    } else {
        echo "Não foi possível salvar registro!";
    }
} else {
    echo "Não é possível alterar esta conexão!";
}



?>

