<html>
    <head>
        <title><?=$title ?></title>
    </head>
    <body>
        <?php
            if (isset($resultadoExc)){ ?>
                <h1><?=$resultadoExc ?></h1>
         <?php
            }
        ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Login</td>
                <td>Senha</td>
                <td>-</td>
                <td>-</td>
            </tr>
            <?php foreach ($dados as $linha) { ?>
                <tr>
                    <td><?=$linha['id'] ?></td>
                    <td><?=$linha['login'] ?></td>
                    <td><?=$linha['senha'] ?></td>
                    <td><a href="index.php?r=logger&p=deletar&codigo=<?=$linha['id'] ?>" onclick="return confirm('Deseja excluir esse usuario ?')">Excluir</a> </td>
                    <td><a href="index.php?r=logger&p=alterar&codigo=<?=$linha['id'] ?>">Alterar</a> </td>
                </tr>
            <?php } ?>
            <a href="index.php?r=logger&p=cadastrar">novo login</a></br>
            <a href="index.php?r=logger&p=exportar">exportar xml</a>
        </table>
    </body>
</html>