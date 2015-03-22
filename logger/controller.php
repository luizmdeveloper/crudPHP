<?php
/**
 * Created by PhpStorm.
 * User: Luiz Mario
 * Date: 3/14/2015
 * Time: 9:46 PM
 */
    require("model_logger.php");
    $title = "Crud PHP";
    $connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    if (mysqli_errno($connection)){
        echo "Error of connection ".mysqli_error($connection);
        exit;
    }
    $passo = null;
   if (isset($_GET['p'])){
       $passo = $_GET['p'];
   }

    switch($passo){
        case "cadastrar":
            cadastarUsuario($connection);
            break;
        case "deletar":
            $resultadoExc = deltarUsuario($connection);
            $dados = carregarDados($connection);
            require("view.php");
            break;
        case "alterar":
            alterarUsuario($connection);
            break;
        case "importar":
            importarUsarioXML($connection, "logger/usuarios.xml");
            break;
        case "exportar":
            exportarUsuarioXML($connection, "logger/bckp_usuarios.xml");
            break;
        default:
            $dados = carregarDados($connection);
            require("view.php");
            break;
    }

    function exportarUsuarioXML($connection, $caminho){
        $title = "Exportando Arquivo para XML";
        $resultadoExc = "Exportacao concluida com sucesso !!";
        $dados = listarDados_usuario($connection);
        $xml = "<?xml version='1.0' encoding='iso-8859-1'?>";
        $xml .= "<usuarios>";
        foreach ($dados as $usuario){
            $xml .= "<usuario>";
                $xml .= "<id>".$usuario['id']."</id>";
                $xml .= "<login>".$usuario['login']."</login>";
                $xml .= "<senha>".$usuario['senha']."</senha>";
            $xml .= "</usuario>";
        }
        $xml .= "/<usuarios>";
        require("view.php");
        file_put_contents($caminho, $xml);
    }

    function importarUsarioXML ($connection, $caminho){
        $xml = simplexml_load_file($caminho);
        foreach ($xml as $usuario){
            if (! cadastrar_usuario($connection, $usuario->login, $usuario->senha)){
                echo "Erro ao inserir usuario ". $usuario->login." ".mysqli_error($connection)."</br>";
            }
        }
        $resultadoExc = "Usuarios importados com sucesso !!!";
        $dados = carregarDados($connection);
        require("view.php");
    }

    function alterarUsuario($connection){
        $title = "Alterar usuario";
        if (isset($_POST['id'])){
            $id    = $_POST['id'];
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            if(alterar_usuario($connection, $login, $senha, $id)){
                $resultadoExc = "Usuario alterado com sucesso !!";
                $dados = carregarDados($connection);
                require("view.php");
            }else{
                echo "A atualizacao falhou ".mysqli_connect_error($connection);
                require("view_aletar.php");
            }
            return false;
        }
        $id_usuario =  $_GET['codigo'];
        $retorno = listarDados_usuario_id($connection, $id_usuario);

        if (!$retorno){
            echo "Ocorreu uma falha ao carregar dados do usuario";
            return false;
        }

        $dados_usuario = mysqli_fetch_row($retorno);
        $dados = array( "id" => $dados_usuario[0], "login" => $dados_usuario[1], "senha" => $dados_usuario[2] );
        require("view_alterar.php");
    }

    function carregarDados($connection){
        $resultado = listarDados_usuario($connection);
        $dados     = array();
        while ($row = mysqli_fetch_array($resultado)){
            $dados[] = array("id" => $row['id'], "login" => $row['login'], "senha" => $row['senha'] );
        }
        return $dados;
    }

    function deltarUsuario($connection){
        $id_usuario = (isset($_GET["codigo"])?$_GET["codigo"]:-1);
        $retorno    = excluir_usuario($connection, $id_usuario);
        if ($retorno){
            $mensagem = "Usuario foi excluído com sucesso!!!";
        }else{
            $mensagem = "";
        }
        return $mensagem;
    }

    function cadastarUsuario($connection){
        $title = "Cadastro novo usuario";

        if (!isset($_POST['abriu'])){
            require ("view_cadastro.php");
        } else {
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $retono = cadastrar_usuario($connection, $login, $senha);

            if ($retono){
                $resultadoExc = "Usuario cadastrado com sucesso";
                $dados = carregarDados($connection);
                require("view.php");
            }else {
                echo "Algum erro ocorreu";
            }
        }
    }

    @mysqli_close($connection);