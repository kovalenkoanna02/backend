<?php
header('Content-Type: text/html; charset=UTF-8');

// Начинаем сессию.
session_start();

// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.
if (!empty($_SESSION['login'])) {
    header('Location: ./');
}

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['logout'])) {
        session_destroy();
        $_SESSION['login'] = '';
        header('Location: ./');
    }
    if (!empty($_GET['error'])) {
        print('<div>Не верный пароль/логин проверьте корректность введенных данных</div>');
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <title>Login</title>
        <style>
            html,
            body {
                height: 100vh;
            }

            body {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .login-block div {
                margin: 10px 0px;
                display: flex;
                justify-content: space-between;
            }

            .login-block {
                display: flex;
                flex-direction: column;
                justify-content: center;

                border: 1px solid lightgray;
                box-shadow: 0px 10px 20px lightgray;

                padding: 10px;
            }
        </style>
    </head>

    <body>
        <form action="" method="POST" class="login-block">
            <div>
                <span>Логин:</span>
                <input name="login" />
            </div>
            <div>
                <span>Пароль:</span>
                <input name="pass" />
            </div>
            <input class="btn btn-primary" type="submit" value="Войти" />
        </form>
        </div>
    </body>

    </html>

<?php
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {
    $user = 'u47433';
    $pass = '4431370';
    $db = new PDO('mysql:host=localhost;dbname=u47433', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

    $member = $_POST['login'];
    $member_pass_hash = md5($_POST['pass']);

    try {
        $stmt = $db->prepare("SELECT * FROM clients2 WHERE login = ?");
        $stmt->execute(array($member));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        exit();
    }
    if ($result['pass'] == $member_pass_hash) {

        $_SESSION['login'] = $_POST['login'];
        $_SESSION['uid'] = $result['id'];

        header('Location: ./');
    } else {
        header('Location: ?error=1');
    }
}
