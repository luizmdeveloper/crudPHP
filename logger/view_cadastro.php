<html>
<head>
        <title><?=$title?></title>
    </head>
    <body>
        <form method="post" action="index.php?r=logger&p=cadastrar">
            <div id="campo_login">
                <lable>Login</lable>
                <input type="text" maxlength="10" name="login"/>
            </div>
            <br/>
            <div>
                <lable>Senha</lable>
                <input type="password" maxlength="10" name="senha"/>
            </div>
            <br/>
            <input type="hidden" name="abriu"/>
            <input type="submit" name="p" value="cadastrar"/>
        </form>
    </body>
</html>