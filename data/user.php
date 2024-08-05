<?php

    function _retrieve_user_data($argument){

        include '../connection/_HIDDEN_CONFIG.php';
        include '../connection/_DB_CONFIG.php';

        $_con = _connection();

        $sql = 'SELECT * FROM '.$_User_Table.','.$_First_Hidden_Table.','.$_Second_Hidden_Table.
            ' WHERE '.$_User_Table.'.'.$_email_user_table.' = "'.$_First_Hidden_Table.'.'.$_user_identifier_field.
            '" AND '.$_User_Table.'.'.$_email_user_table.' = "'.$_Second_Hidden_Table.'.'.$_first_field.'"'.
            ' AND '.$_User_Table.'.'.$_email_user_table.' = "'.$argument.'"';

        $_request = $_con->prepare($sql); 

        $_res = $_request->execute();

        $_name = $_request->fetchAll(PDO::FETCH_ASSOC);

        if(!is_null($_name)) $rows = count($_name);
        else $rows = 0;

        $_back_response = array('founded' => $_res, 'user_data' => $_name, 'rows_founded' => $rows);

        echo json_encode($_back_response);

    }
    function _user_operation($_user_mailARG, $_trans_typeARG, $_trans_amountARG){

        include '../connection/_HIDDEN_CONFIG.php';
        include '../connection/_DB_CONFIG.php';

        $_connect = _connection();

        $_last_best_transaction_amount_request = 'SELECT MAX('.$_user_third_transaction.') FROM '.$_First_Hidden_Table.' WHERE'.$_user_identifier_field.' = "'.$_user_mailARG.'"';
        $_last_best_transaction_amount = $_connect->prepare($_last_best_transaction_amount_request);
        $_last_best_transaction_amount->execute();
        $_last_best_transaction_amount = $_last_best_transaction_amount->fetchAll(PDO::FETCH_ASSOC);

        $_last_best_transaction_type_request = 'SELECT '.$_user_second_transaction.' FROM '.$_First_Hidden_Table.' WHERE '.$_user_third_transaction.' = "'.$_last_best_transaction_amount[0].'" AND'.$_user_identifier_field.' = "'.$_user_mailARG.'"';
        $_last_best_transaction_type = $_connect->prepare($_last_best_transaction_type_request);
        $_last_best_transaction_type->execute();
        $_last_best_transaction_type = $_last_best_transaction_type->fetchAll(PDO::FETCH_ASSOC);

        $insertion_operation = 'INSERT INTO '.$_First_Hidden_Table.' (id_transactions, '.$_user_identifier_field.','.
            ''.$_user_second_transaction.','.$_user_third_transaction.','.$_user_fourth_transaction.',
            '.$_user_fifth_transaction.','.$_user_sixth_transaction.','.$_user_seventh_transaction.') 
            VALUES(null,"'.$_user_mailARG.'","'.$_trans_typeARG.'", '.$_trans_amountARG.', "'
                .$_last_best_transaction_type[0].'",'.$_last_best_transaction_amount[0].','
                .'"'.$_last_best_transaction_type[0].'",'.$_last_best_transaction_amount[0].',
            )';

        
        $_request_insert = $_connect->prepare($insertion_operation); 

        $response_1 = $_request_insert->execute();
        
        $_new_best_transaction_amount_request = 'SELECT MAX('.$_user_third_transaction.') FROM '.$_First_Hidden_Table.' WHERE'.$_user_identifier_field.' = "'.$_user_mailARG.'"';
        $_new_best_transaction_amount = $_connect->prepare($_new_best_transaction_amount_request);
        $_new_best_transaction_amount->execute();
        $_new_best_transaction_amount = $_new_best_transaction_amount->fetchAll(PDO::FETCH_ASSOC);

        $_new_best_transaction_type_request = 'SELECT '.$_user_second_transaction.' FROM '.$_First_Hidden_Table.' WHERE '.$_user_third_transaction.' = "'.$_new_best_transaction_amount[0].'" AND'.$_user_identifier_field.' = "'.$_user_mailARG.'"';
        $_new_best_transaction_type = $_connect->prepare($_new_best_transaction_type_request);
        $_new_best_transaction_type->execute();
        $_new_best_transaction_type = $_new_best_transaction_type->fetchAll(PDO::FETCH_ASSOC);

        $_second_best_transaction_amount_request = 'SELECT MAX('.$_user_third_transaction.') FROM '.$_First_Hidden_Table.' WHERE '.$_user_third_transaction.' < (SELECT MAX('.$_user_third_transaction.') FROM '.$_First_Hidden_Table.') AND'.$_user_identifier_field.' = "'.$_user_mailARG.'"';
        $_second_best_transaction_amount = $_connect->prepare($_second_best_transaction_amount_request);
        $_second_best_transaction_amount->execute();
        $_second_best_transaction_amount = $_second_best_transaction_amount->fetchAll(PDO::FETCH_ASSOC);

        $_second_best_transaction_type_request = 'SELECT '.$_user_second_transaction.' FROM '.$_First_Hidden_Table.' WHERE '.$_user_third_transaction.' = "'.$_second_best_transaction_amount[0].'" AND'.$_user_identifier_field.' = "'.$_user_mailARG.'"';
        $_second_best_transaction_type = $_connect->prepare($_second_best_transaction_type_request);
        $_second_best_transaction_type->execute();
        $_second_best_transaction_type = $_second_best_transaction_type->fetchAll(PDO::FETCH_ASSOC);

        $update_request = 'UPDATE '.$_First_Hidden_Table.' SET '.$_user_fourth_transaction.' = "'.$_new_best_transaction_type[0].'", '.$_user_fifth_transaction.' = '.
        $_new_best_transaction_amount[0].', '.$_user_sixth_transaction.' ="'.$_second_best_transaction_type[0].'", '.$_user_seventh_transaction.' =  '.
        $_second_best_transaction_amount[0].' WHERE '.$_user_identifier_field.' = "'.$_user_mailARG.'"';

        $_request_update = $_connect->prepare($update_request); 

        $response_2 = $_request_update->execute();

        $_update_totals_request = 'SELECT SUM('.$_user_third_transaction.') FROM '.$_First_Hidden_Table.
            ' WHERE '.$_user_second_transaction.' = "'.$_trans_typeARG.'" AND '.$_user_identifier_field.' = "'.$_user_mailARG.'"';
            
        $_totals_update = $_connect->prepare($_update_totals_request); 

        $_totals_update->execute();
        $_totals_update = $_totals_update->fetchAll(PDO::FETCH_ASSOC);

        if($_trans_planARG == 'Deposit') $_totals = $_seventh_field;
        if($_trans_planARG == 'Withdraw') $_totals = $_heighth_field;

        $_set_total_amount_request = 'UPDATE '.$_Second_Hidden_Table.' SET '.$_totals.' = '.$_totals_update[0].','.
            ' WHERE '.$_first_field.' = "'.$_user_mailARG.'"';
        $_set_t = $_connect->prepare($_set_total_amount_request);
        $_set_t->execute();

        $_t_deposits = 'SELECT '.$_seventh_field.' FROM '.$_Second_Hidden_Table.' WHERE '.$_first_field.' = "'.$_user_mailARG.'"';
        $_t_deposits = $_connect->prepare($_t_deposits);
        $_t_deposits->execute();
        $_t_deposits = $_t_deposits->fetchAll(PDO::FETCH_ASSOC);

        $_t_withdraws = 'SELECT '.$_heighth_field.' FROM '.$_Second_Hidden_Table.' WHERE '.$_first_field.' = "'.$_user_mailARG.'"';
        $_t_withdraws = $_connect->prepare($_t_withdraws);
        $_t_withdraws->execute();
        $_t_withdraws = $_t_withdraws->fetchAll(PDO::FETCH_ASSOC);

        $_t_earnings = 'SELECT '.$_ninth_field.' FROM '.$_Second_Hidden_Table.' WHERE '.$_first_field.' = "'.$_user_mailARG.'"';
        $_t_earnings = $_connect->prepare($_t_earnings);
        $_t_earnings->execute();
        $_t_earnings = $_t_earnings->fetchAll(PDO::FETCH_ASSOC);

        $_new_account_amount = $_t_deposits[0] + $_t_earnings[0] - $_t_withdraws[0];

        $_set_new_account_amount_request = 'UPDATE '.$_Second_Hidden_Table.' SET '.$_second_field.' = '.$_new_account_amount.','.
            ' WHERE '.$_first_field.' = "'.$_user_mailARG.'"';
        $_set_new_account_amount_request = $_connect->prepare($_set_new_account_amount_request);
        $_set_new_account_amount_request->execute();
        
        $_result = $response_1 && $response_2;
        
    }
    function _user_operation_deposit($_user_mailARG, $_trans_typeARG, $_trans_amountARG, $_trans_planARG){

        include '../connection/_HIDDEN_CONFIG.php';
        include '../connection/_DB_CONFIG.php';

        if($_trans_planARG == 'standard') {
            $_trans_planARG = $_tenth_field;
            $_daily_field = $_fourteenth_field;
        }
        if($_trans_planARG == 'referral') {
            $_trans_planARG = $_eleventh_field;
            $_daily_field = $_fifteenth_field;
        }
        if($_trans_planARG == 'cost') {
            $_trans_planARG = $_th_field;
            $_daily_field = $_sixteenth_field;
        }

        $_connect = _connection();

        $_previous_plan_amount_request = 'SELECT '.$_trans_planARG.' FROM '.$_Second_Hidden_Table.' WHERE '.$_first_field.' = "'.$_user_mailARG.'"';
        $_previous_plan_amount = $_connect->prepare($_previous_plan_amount_request);
        $_previous_plan_amount->execute();
        $_previous_plan_amount = $_previous_plan_amount->fetchAll(PDO::FETCH_ASSOC);

        $_new_plan_amount = $_previous_plan_amount[0] + $_trans_amountARG;

        $_set_plan_amount_request = 'UPDATE '.$_Second_Hidden_Table.' SET '.$_trans_planARG.' = '.$_new_plan_amount.','
            .$_daily_field.' = 0'.
            ' WHERE '.$_first_field.' = "'.$_user_mailARG.'"';
        $_set = $_connect->prepare($_set_plan_amount_request);
        $_set->execute();

        _user_operation($_user_mailARG, $_trans_typeARG, $_trans_amountARG);   
    }

?>