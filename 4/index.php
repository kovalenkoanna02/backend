<?php

header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();

    if (!empty($_COOKIE['save'])) {
        setcookie('save', 100000);

        $messages[] = 'Спасибо, результаты сохранены.';
    }
    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['date'] = !empty($_COOKIE['date_error']);
    $errors['gender'] = !empty($_COOKIE['gender_error']);
    $errors['limbs'] = !empty($_COOKIE['limbs_error']);
    $errors['select'] = !empty($_COOKIE['select_error']);
    $errors['bio'] = !empty($_COOKIE['bio_error']);
    $errors['policy'] = !empty($_COOKIE['policy_error']);

    if ($errors['name']) {
        setcookie('name_error', '', 100000);
        $messages[] = '<div class="message">Введите корректное имя(оно не может быть пустым и может содержать только буквы).</div>';
    }
    if ($errors['email']) {
        setcookie('email_error', '', 100000);
        $messages[] = '<div class="message">Введите корректный email.</div>';
    }
    if ($errors['date']) {
        setcookie('date_error', '', 100000);
        $messages[] = '<div class="message">Введите корректную дату рождения.</div>';
    }
    if ($errors['gender']) {
        setcookie('gender_error', '', 100000);
        $messages[] = '<div class="message">Выберите пол.</div>';
    }
    if ($errors['limbs']) {
        setcookie('limbs_error', '', 100000);
        $messages[] = '<div class="message">Выберите количество конечностей.</div>';
    }
    if ($errors['select']) {
        setcookie('select_error', '', 100000);
        $messages[] = '<div class="message">Выберите суперспособнос(ть/ти).</div>';
    }
    if ($errors['bio']) {
        setcookie('bio_error', '', 100000);
        $messages[] = '<div class="message">Расскажите о себе.</div>';
    }
    if ($errors['policy']) {
        setcookie('policy_error', '', 100000);
        $messages[] = '<div class="message">Ознакомтесь с политикой обработки данных.</div>';
    }

    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
    $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
    $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
    $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
    $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
    $values['select'] = empty($_COOKIE['select_value']) ? '' : $_COOKIE['select_value'];
    $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
    $values['policy'] = empty($_COOKIE['policy_value']) ? '' : $_COOKIE['policy_value'];

    include('form.php');
} else {
    $errors = FALSE;
    if (!preg_match('/^([a-zA-Z]|[а-яА-Я])/', $_POST['name'])) {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('name_value', $_POST['name'], time() + 12 * 30 * 24 * 60 * 60);
    }

    if (!preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/', $_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('email_value', $_POST['email'], time() + 12 * 30 * 24 * 60 * 60);
    }

    $date = explode('-', $_POST['date']);
    $age = (int)date('Y') - (int)$date[0];
    if ($age > 100 || $age < 0) {
        setcookie('date_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('date_value', $_POST['date'], time() + 12 * 30 * 24 * 60 * 60);
    }

    if (empty($_POST['gender'])) {
        setcookie('gender_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('gender_value', $_POST['gender'], time() + 12 * 30 * 24 * 60 * 60);
    }

    if (empty($_POST['limbs'])) {
        setcookie('limbs_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('limbs_value', $_POST['limbs'], time() + 12 * 30 * 24 * 60 * 60);
    }

    if (empty($_POST['select'])) {
        setcookie('select_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('select_value', implode(',', $_POST['select']), time() + 12 * 30 * 24 * 60 * 60);
    }

    if (empty($_POST['bio'])) {
        setcookie('bio_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('bio_value', $_POST['bio'], time() + 12 * 30 * 24 * 60 * 60);
    }

    if (empty($_POST['policy'])) {
        setcookie('policy_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('policy_value', $_POST['policy'], time() + 12 * 30 * 24 * 60 * 60);
    }

    if ($errors) {
        header('Location: index.php');
        exit();
    } else {
        setcookie('name_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('date_error', '', 100000);
        setcookie('gender_error', '', 100000);
        setcookie('limbs_error', '', 100000);
        setcookie('select_error', '', 100000);
        setcookie('bio_error', '', 100000);
        setcookie('policy_error', '', 100000);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $limbs = $_POST['limbs'];
    $bio = $_POST['bio'];
    $policy = $_POST['policy'];
    $powers = implode(',', $_POST['select']);

    $user = 'u47433';
    $pass = '4431370';
    $db = new PDO('mysql:host=localhost;dbname=u47433', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

    try {
        $stmt = $db->prepare("INSERT INTO clients SET name = ?, email = ?, date = ?, gender = ?, limbs = ?, bio = ?, policy = ?");
        $stmt->execute(array($name, $email, $date, $gender, $limbs, $bio, $policy));
        $power_id = $db->lastInsertId();

        $superpowers = $db->prepare("INSERT INTO powers SET powers = ?, user_id = ? ");
        $superpowers->execute(array($powers, $power_id));
    } catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        exit();
    }
    setcookie('save', '1');

    // Делаем перенаправление.
    header('Location: index.php');
}
