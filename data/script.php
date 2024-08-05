<?php
    

    function _login($_email, $_password){

        include '../connection/_DB_CONFIG.php';

        $_con = _connection();

        $sql = 'SELECT '.$_email_user_table.' FROM '.$_User_Table.' WHERE '.$_email_user_table.' = "'.$_email.'" AND '.$_pass_user_table. ' = "'.$_password.'"';

        $_request = $_con->prepare($sql); 

        $_res = $_request->execute();

        $_name = $_request->fetchAll(PDO::FETCH_ASSOC);

        if(!is_null($_name)) $rows = count($_name);
        else $rows = 0;

        $_back_response = array('founded' => $_res, 'user' => $_name[0], 'rows_founded' => $rows);

        echo json_encode($_back_response);

    }

    function _register($_fname, $_email, $_password, $_refCode){

        include '../connection/_DB_CONFIG.php';
        include '../connection/_HIDDEN_CONFIG.php';

        $_con = _connection();

        $_sql_1  = 'INSERT INTO '.$_User_Table.'( id,'.$_fname_user_table.','.
            $_email_user_table.','.
            $_pass_user_table.','.
            $_refCode_user_table.','.
            $_friends_user_table.')'.
            ' VALUES ( null,?,?,?,?)';

        $query_1 = $_con->prepare($_sql_1);

        $res_1 = $query_1->execute(array($_fname, $_email, $_password, $_refCode));

        $_sql_2  = 'INSERT INTO '.$_First_Hidden_Table.'( id_transactions,'.$_user_identifier_field.','.
            $_user_second_transaction .','.
            $_user_third_transaction .','.
            $_user_fourth_transaction .','.
            $_user_fifth_transaction .','.
            $_user_sixth_transaction .','.
            $_user_seventh_transaction.')'.
            ' VALUES ( null,?,?,?,?,?,?,?)';
        
        
        $query_2 = $_con->prepare($_sql_2);
    
        $res_2 = $query_2->execute(array($_email, "Bonus", 0.10, "Bonus", 0.10, "Other", 0.00));
        
        $_sql_3  = 'INSERT INTO '.$_Second_Hidden_Table.'(id_operations,'.$_first_field.','.
            $_second_field.','.
            $_third_field.','.
            $_fourth_field.','.
            $_fifth_field.','.
            $_sixth_field.','.
            $_seventh_field.','.
            $_heighth_field.','.
            $_ninth_field.','.
            $_tenth_field.','.
            $_eleventh_field.','.
            $_th_field.','.
            $_thirteenth_field.','.
            $_fourteenth_field.','.
            $_fifteenth_field.','.
            $_sixteenth_field.','.
            $_seventeenth_field.','.
            $_eighteenth_field.','.
            $_nineteenth_field.')'.
            ' VALUES ( null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';


        $query_3 = $_con->prepare($_sql_3);
    
        $res_3 = $query_3->execute(array($_email, 0.10, 0.10, $_refCode, 0.00, 0, 0.00, 0.00, 0.10, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0.014, 0.014, 0.014));

        $res = $res_1 && $res_2 && $res_3;

        $_back_response = array('insertion_1' => $res_1, 'insertion_2' => $res_2, 'insertion_3' => $res_3, 'final' => $res);

        $_back_response = array('final' => true);
        echo json_encode($_back_response);

    }

?>