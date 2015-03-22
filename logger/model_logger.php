<?php
/**
 * Created by PhpStorm.
 * User: Luiz Mario
 * Date: 3/20/2015
 * Time: 10:13 PM
 */

    function listarDados_usuario($conection){
        $sql =  "SELECT * FROM tb_usuario";
        return mysqli_query($conection, $sql);
    }

    function listarDados_usuario_id($conection, $id_usuario){
        $sql =  sprintf("SELECT * FROM tb_usuario WHERE id = %s", $id_usuario);
        return mysqli_query($conection, $sql);
    }

    function excluir_usuario($conection, $id_usuario){
        $sql =  sprintf("DELETE FROM tb_usuario WHERE ID = %s", $id_usuario);
        return mysqli_query($conection, $sql);
    }

    function cadastrar_usuario($connection, $login, $senha){
        $sql =  sprintf("INSERT INTO tb_usuario (login, senha) VALUES ('%s','%s')", $login, $senha);
        return mysqli_query($connection, $sql);
    }

    function alterar_usuario($connection, $login, $senha, $id_usuario){
        $sql =  sprintf("UPDATE tb_usuario set login = '%s', senha = '%s' WHERE id = %s", $login, $senha, $id_usuario);
        return mysqli_query($connection, $sql);
    }