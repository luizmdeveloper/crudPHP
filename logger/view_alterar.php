<html>
<head>
        <title><?=$title?></title>
    </head>
    <body>
        <form method="post" action="index.php?r=logger&p=alterar">
            <div id="campo_login">
                <lable>Login</lable>
                <input type="text" maxlength="10" name="login" value="<?=$dados['login']?>"/>
            </div>
            <br/>
            <div>
                <lable>Senha</lable>
                <input type="text" maxlength="10" name="senha" value="<?=$dados['senha']?>"/>
            </div>
            <br/>
            <input type="hidden" name="id" value="<?=$dados['id']?>" />
            <input type="submit" name="p" value="alterar"/>
        </form>
    </body>
</html>