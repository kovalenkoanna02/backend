<!DOCTYPE html>
<html lang="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <title>Задание 4</title>
</head>

<body>
    <?php
    if (!empty($messages)) {
        print('<div id="messages">');
        foreach ($messages as $message) {
            print($message);
        }
        print('</div>');
    }
    ?>
    <div class="form-container">
        <form method="POST" action="">
            <div class="input-group block">
                <input type="text" name="name" placeholder="Ваше имя" <?php if ($errors['name']) {
                                                                            print 'class="error"';
                                                                        } ?> value="<?php print $values['name']; ?>" />
            </div>
            <div class="input-group block">
                <input type="text" name="email" placeholder="example@mail.ru" <?php if ($errors['email']) {
                                                                                    print 'class="error"';
                                                                                } ?> value="<?php print $values['email']; ?>" />
            </div>
            <div class="block" id="date-block">
                <span>Дата рождения</span>
                <input type="date" name="date" <?php if ($errors['date']) {
                                                    print 'class="error"';
                                                } ?> value="<?php print $values['date']; ?>" />
            </div>
            <div class="block" id="gender-block">
                <span <?php if ($errors['gender']) {
                            print 'class="error"';
                        } ?>>Пол</span>
                <div class="radios">
                    <div class="male-radio">
                        <input type="radio" name="gender" value="m" <?php if ($values['gender'] == 'm') {
                                                                        print 'checked';
                                                                    }; ?> />
                        <label for="male">Мужской</label>
                    </div>
                    <div class="female-radio">
                        <input type="radio" name="gender" value="f" <?php if ($values['gender'] == 'f') {
                                                                        print 'checked';
                                                                    }; ?> />
                        <label for="female">Женский</label>
                    </div>
                </div>
            </div>
            <div class="block" id="limbs-block">
                <span <?php if ($errors['limbs']) {
                                                print 'class="error"';
                                            } ?>>Конечности</span>
                <div class="radios">
                    <div class="limbs-radio">
                        <input type="radio" name="limbs" value="1" <?php if ($values['limbs'] == '1') {
                                                                        print 'checked';
                                                                    }; ?> />
                        <label for="male">1</label>
                    </div>
                    <div class="limbs-radio">
                        <input type="radio" name="limbs" value="2" <?php if ($values['limbs'] == '2') {
                                                                        print 'checked';
                                                                    }; ?> />
                        <label for="female">2</label>
                    </div>
                    <div class="limbs-radio">
                        <input type="radio" name="limbs" value="3" <?php if ($values['limbs'] == '3') {
                                                                        print 'checked';
                                                                    }; ?> />
                        <label for="female">3</label>
                    </div>
                    <div class="limbs-radio">
                        <input type="radio" name="limbs" value="4" <?php if ($values['limbs'] == '4') {
                                                                        print 'checked';
                                                                    }; ?> />
                        <label for="female">4</label>
                    </div>
                </div>
            </div>
            <div class="block">
                <span class="block-title">Способности</span>
                <select name="select[]" multiple <?php if ($errors['select']) {
                                                        print 'class="error"';
                                                    } ?>>
                    <option value="inf" <?php $arr = explode(',', $values['select']);
                                        if ($arr != '') {
                                            foreach ($arr as $value) {
                                                if ($value == "inf") {
                                                    print 'selected';
                                                }
                                            }
                                        }
                                        ?>>Бессмертие</option>
                    <option value="through" <?php $arr = explode(',', $values['select']);
                                            if ($arr != '') {
                                                foreach ($arr as $value) {
                                                    if ($value == "through") {
                                                        print 'selected';
                                                    }
                                                }
                                            }
                                            ?>>Прохождение сквозь стены</option>
                    <option value="levitation" <?php $arr = explode(',', $values['select']);
                                                if ($arr != '') {
                                                    foreach ($arr as $value) {
                                                        if ($value == "levitation") {
                                                            print 'selected';
                                                        }
                                                    }
                                                }
                                                ?>>Левитация</option>
                </select>
            </div>
            <div class="block">
                <textarea placeholder="Расскажите о себе..." name="bio" <?php if ($errors['bio']) {
                                                                            print 'class="error"';
                                                                        } ?>><?php print $values['bio']; ?></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="y" id="policy" name="policy" checked />
                <label class="form-check-label" for="policy">Согласен с политикой конфиденциальности</label>
            </div>
            <button class="btn btn-primary" type="submit" id="send-btn">Отправить</button>
        </form>
    </div>
</body>

</html>
