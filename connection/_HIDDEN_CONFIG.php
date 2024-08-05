<?php

    $_First_Hidden_Table = 'user_transactions_table';
    $_Second_Hidden_Table = 'user_operations_table';

    $_first_field = 'hidden_email_field';
    $_second_field = 'hidden_user_amount_field';
    $_third_field = 'hidden_daily_amount_field';
    $_fourth_field = 'user_ref_code_field';
    $_fifth_field = 'hidden_withdrawable_field';
    $_sixth_field = 'user_ref_friends_field';
    $_seventh_field = 'hidden_total_deposit_field';
    $_heighth_field = 'hidden_total_withdraw_field';
    $_ninth_field = 'hidden_total_earning_field';
    $_tenth_field = 'hidden_in_standard_field';
    $_eleventh_field = 'hidden_in_referral_field';
    $_th_field = 'hidden_in_cost_field';
    $_thirteenth_field = 'hidden_cost_pay_field';
    $_fourteenth_field = 'hidden_day_left_standard';
    $_fifteenth_field = 'hidden_day_left_referral';
    $_sixteenth_field = 'hidden_day_left_cost';
    $_seventeenth_field = 'hidden_percentage_for_standard';
    $_eighteenth_field = 'hidden_percentage_for_referral';
    $_nineteenth_field = 'hidden_percentage_for_cost';
    
    $_user_identifier_field = 'hidden_email_identity_field';
    $_user_second_transaction = 'hidden_transaction_type';
    $_user_third_transaction = 'hidden_transaction_amount';
    $_user_fourth_transaction = 'hidden_best_type';
    $_user_fifth_transaction = 'hidden_best_amount';
    $_user_sixth_transaction = 'hidden_second_type';
    $_user_seventh_transaction = 'hidden_second_amount';


    /*SET @DEPOSIT = (SELECT SUM(hidden_transaction_amount) FROM user_transactions_table WHERE hidden_transaction_type = 'Deposit' AND hidden_email_identity_field = 'ank@gmail.com');
SET @WITHDRAW = (SELECT SUM(hidden_transaction_amount) FROM user_transactions_table WHERE hidden_transaction_type = 'Withdraw' AND hidden_email_identity_field = 'ank@gmail.com');
SET @AMOUNT = (SELECT SUM(hidden_transaction_amount) FROM user_transactions_table WHERE hidden_transaction_type = 'Bonus' AND hidden_email_identity_field = 'ank@gmail.com') + @DEPOSIT - @WITHDRAW;

SET @STANDARD = (SELECT hidden_in_standard_field FROM user_operations_table WHERE hidden_email_field = 'ank@gmail.com');
SET @REFERRAL = (SELECT hidden_in_referral_field FROM user_operations_table WHERE hidden_email_field = 'ank@gmail.com');
SET @COST = (SELECT hidden_in_cost_field FROM user_operations_table WHERE hidden_email_field = 'ank@gmail.com');

SET @DAILY = @STANDARD*0.014 + @REFERRAL*0.018 + @COST*0.02;

UPDATE user_operations_table SET hidden_daily_amount_field = @DAILY,
	hidden_total_deposit_field = @DEPOSIT,
    hidden_total_withdraw_field = @WITHDRAW,
    hidden_user_amount_field = @AMOUNT + @DAILY
    WHERE hidden_email_field = 'ank@gmail.com';



    INSERT INTO `user_operations_table` (`id_operations`, `hidden_email_field`, `hidden_user_amount_field`, `hidden_daily_amount_field`, `user_ref_code_field`, `hidden_withdrawable_field`, `user_ref_friends_field`, `hidden_total_deposit_field`, `hidden_total_withdraw_field`, `hidden_total_earning_field`, `hidden_in_standard_field`, `hidden_in_referral_field`, `hidden_in_cost_field`, `hidden_cost_pay_field`, `hidden_day_left_standard`, `hidden_day_left_referral`, `hidden_day_left_cost`, `hidden_percentage_for_standard`, `hidden_percentage_for_referral`, `hidden_percentage_for_cost`) VALUES (NULL, 'ank@gmail.com', '0.10', '0.10', 'XSM11', '0.00', '0', '0.00', '0.00', '0.10', '0.00', '0.00', '0.00', '0', '0', '0', '0', '0.014', '0.014', '0.014');
    
    UPDATE `user_operations_table` SET `id_operations`=[value-1],`hidden_email_field`=[value-2],`hidden_user_amount_field`=[value-3],`hidden_daily_amount_field`=[value-4],`user_ref_code_field`=[value-5],`hidden_withdrawable_field`=[value-6],`user_ref_friends_field`=[value-7],`hidden_total_deposit_field`=[value-8],`hidden_total_withdraw_field`=[value-9],`hidden_total_earning_field`=[value-10],`hidden_in_standard_field`=[value-11],`hidden_in_referral_field`=[value-12],`hidden_in_cost_field`=[value-13],`hidden_cost_pay_field`=[value-14],`hidden_day_left_standard`=[value-15],`hidden_day_left_referral`=[value-16],`hidden_day_left_cost`=[value-17],`hidden_percentage_for_standard`=[value-18],`hidden_percentage_for_referral`=[value-19],`hidden_percentage_for_cost`=[value-20] WHERE 1
    
    
    
    SET @BA = (SELECT MAX(hidden_transaction_amount) FROM user_transactions_table);

SET @BT = (SELECT hidden_transaction_type FROM user_transactions_table WHERE hidden_transaction_amount = @BA);

INSERT INTO user_transactions_table (id_transactions, hidden_email_identity_field,hidden_transaction_type,hidden_transaction_amount,hidden_best_type,
                                     hidden_best_amount,hidden_second_type,hidden_second_amount) 
                                     VALUES(null,'ank@gmail.com','Withdraw', 6.01, @BT,@BA,
                                             @BT,@BA
                                           );
                                           
SET @email = 'ank@gmail.com';
                                           
SET @nBA = (SELECT MAX(hidden_transaction_amount) FROM user_transactions_table);
SET @nBT = (SELECT hidden_transaction_type FROM user_transactions_table WHERE hidden_transaction_amount = @nBA);

SET @BA = (SELECT MAX(hidden_transaction_amount) FROM user_transactions_table WHERE hidden_transaction_amount < (SELECT MAX(hidden_transaction_amount) FROM user_transactions_table));
SET @BT = (SELECT hidden_transaction_type FROM user_transactions_table WHERE hidden_transaction_amount = @BA);

UPDATE user_transactions_table SET hidden_best_type = @nBT, hidden_best_amount = @nBA, hidden_second_type = @BT, hidden_second_amount = @BA WHERE hidden_email_identity_field = @email; */
?>
