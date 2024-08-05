<?php

    include 'C:\wamp64\www\projects\petrolix\connection\index.php';
    include 'C:\wamp64\www\projects\petrolix\data\script.php';
    include 'C:\wamp64\www\projects\petrolix\data\user.php';

    $connect = _connection();

    $_info = $_POST['info'];

    if($_info == 'login'){

        $_mail = $_POST['find'];
        $_pass = $_POST['corresponding'];

        _login($_mail, $_pass);

    }elseif($_info == 'register'){

        $_name = $_POST['name'];
        $_mail = $_POST['mail'];
        $_pass = $_POST['pass'];
        $_code = $_POST['ref'];

        _register($_name, $_mail, $_pass, $_code);

    }
    elseif($_info == 'user_home'){

        $_arg = $_POST['findWith'];

        _retrieve_user_data($_arg);

    }

?>