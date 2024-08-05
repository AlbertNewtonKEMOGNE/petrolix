var value_actual_user = localStorage.getItem('User');
var value_account_amount = "0.10";
var value_account_daily = "0.10";
var value_account_refers = "0";
var value_account_code = "XM0HQ";
var value_withdrawable = "0.00";
var value_current_link = "http://localhost/projects/petrolix/presentation/sign_in.html?ref=";
var value_share_link = value_current_link + value_account_code;
var value_total_deposits_text = "0.00";
var value_total_withdrawals_text = "0.00";
var value_total_earnings_text = "0.10";
var value_amount_in_standard = "0.00";
var value_amount_in_referral = "0.00";
var value_amount_in_cost = "0.00";
var value_best_first_operation = "Bonus";
var value_best_first_operation_amount = "0.10";
var value_best_second_operation = "";
var value_best_second_operation_amount = "";
var value_recent_operation = ''; //= new Array[5];
var value_recent_operation_amount = ''; // = new Array[5];
value_recent_operation[0] = "Bonus";
value_recent_operation_amount[0] = "0.10";

for (i = 1; i < 5; i++) {

    value_recent_operation[i] = "";
    value_recent_operation_amount[i] = "";

}


let loadingSignIn = () => {
    var ref = new URLSearchParams(window.location.search).get("ref");
    if ((ref.length == 5) && (ref == ref.toUpperCase())) {
        document.getElementById('in_5').value = ref;
    }
    localeHidden = generateKey(14);
    localStorage.setItem('hiddenCodeSign', localeHidden);
    document.getElementById('in_6').value = localeHidden;
}

let refresh = () => {

    if (localStorage.getItem('isConnected')) {
        localStorage.removeItem('isConnected');
        key = generateKey(32);
        document.getElementById('in_6').value = key;
        localStorage.setItem('accountKey', key);
        getToMakeRequest();
        refreshAll();
        localStorage.clear();
    } else {
        window.location = '../index.html';
    }

}
let getToMakeRequest = () => {

    mail = localStorage.getItem('Mail');

    _setVariables = _requestMade(mail);

    alert(_setVariables);

    if (_setVariables != null) {

        _setVariables = JSON.parse(_setVariables);

        _setVariables = JSON.stringify(_setVariables['user_data']);

        _setVariables = JSON.parse(_setVariables);

        index_s = _setVariables.length;

        value_actual_user = _setVariables[0].user_full_name_field;
        value_account_amount = _setVariables[0].hidden_user_amount_field;
        value_account_daily = _setVariables[0].hidden_daily_amount_field;
        value_account_refers = _setVariables[0].user_ref_friends_field;
        value_account_code = _setVariables[0].user_ref_code_field;
        value_withdrawable = _setVariables[0].hidden_withdrawable_field;
        value_current_link = "http://localhost/projects/petrolix/presentation/sign_in.html?ref=";
        value_share_link = value_current_link + value_account_code;
        value_total_deposits_text = _setVariables[0].hidden_total_deposit_field;
        value_total_withdrawals_text = _setVariables[0].hidden_total_withdraw_field;
        value_total_earnings_text = _setVariables[0].hidden_total_earning_field;
        value_amount_in_standard = _setVariables[0].hidden_in_standard_field;
        value_amount_in_referral = _setVariables[0].hidden_in_referral_field;
        value_amount_in_cost = _setVariables[0].hidden_in_cost_field;

        value_best_first_operation = _setVariables[0].hidden_best_type;
        value_best_first_operation_amount = _setVariables[0].hidden_best_amount;
        value_best_second_operation = _setVariables[0].hidden_second_type;
        value_best_second_operation_amount = _setVariables[0].hidden_second_amount;

        for (i = 0; i < index_s && index_s < 5; i++) {

            value_recent_operation[i] = _setVariables[i].hidden_transaction_type;
            value_recent_operation_amount[i] = _setVariables[i].hidden_transaction_amount;

        }

    } else {
        alert("Sorry, an error occurred... Please try to login again.");
        localStorage.clear();
        //window.location = '../index.html';
    }

}
let refreshAll = () => {
    document.getElementById('actual_user').textContent = value_actual_user;
    document.getElementById('account_amount').value = "$" + value_account_amount;
    document.getElementById('account_daily').value = "today $" + value_account_daily;
    document.getElementById('account_refers').value = value_account_refers + " friend(s)";
    document.getElementById('account_code').value = "ref : " + value_account_code;
    document.getElementById('share_link').value = value_share_link;
    document.getElementById('withdrawable').textContent = "$" + value_withdrawable;
    document.getElementById('total_deposits_text').textContent = "$" + value_total_deposits_text;
    document.getElementById('total_withdrawals_text').textContent = "$" + value_total_withdrawals_text;
    document.getElementById('total_earnings_text').textContent = "$" + value_total_earnings_text;
    document.getElementById('amount_in_standard').textContent = "$" + value_amount_in_standard;
    document.getElementById('amount_in_referral').textContent = "$" + value_amount_in_referral;
    document.getElementById('amount_in_cost').textContent = "$" + value_amount_in_cost;
    document.getElementById('best_first_operation').textContent = value_best_first_operation;
    document.getElementById('best_second_operation').textContent = value_best_second_operation;
    document.getElementById('best_first_operation_amount').textContent = "$" + value_best_first_operation_amount;
    document.getElementById('best_second_operation_amount').textContent = value_best_second_operation_amount;
    document.getElementById('recent_operation_1').textContent = value_recent_operation[0];
    document.getElementById('recent_operation_2').textContent = value_recent_operation[1];
    document.getElementById('recent_operation_3').textContent = value_recent_operation[2];
    document.getElementById('recent_operation_4').textContent = value_recent_operation[3];
    document.getElementById('recent_operation_5').textContent = value_recent_operation[4];
    document.getElementById('recent_operation_1_amount').textContent = "$" + value_recent_operation_amount[0];
    document.getElementById('recent_operation_2_amount').textContent = value_recent_operation_amount[1];
    document.getElementById('recent_operation_3_amount').textContent = value_recent_operation_amount[2];
    document.getElementById('recent_operation_4_amount').textContent = value_recent_operation_amount[3];
    document.getElementById('recent_operation_5_amount').textContent = value_recent_operation_amount[4];
    document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
    document.getElementsByClassName('no_see_input_2')[0].classList.remove("visible_input");
    document.getElementsByClassName('popup')[0].classList.remove("active");
}

let toApiUrl = () => {
    return "http://localhost/projects/petrolix/data/";
}
let _userApi = () => {
    return "http://localhost/projects/petrolix/data/";
}

let apiInfo = (_code) => {
    nf = localStorage.getItem('callback');
    if ((_code == localStorage.getItem('hiddenCode')) && (nf == 'log')) {
        localStorage.clear();
        return nf + 'in';
    } else if (_code = localStorage.getItem('accountKey')) {
        return 'user_home';
    } else
    if ((_code == localStorage.getItem('hiddenCodeSign')) && (nf == 'regis')) {
        localStorage.clear();
        return nf + 'ter';
    } else {
        return 'info';
    }
}

let generateKey = (lengthOf) => {

    const charactersCode = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';

    let res = '';

    const cLength = charactersCode.length;

    for (let i = 0; i < cLength; i++) {
        res += charactersCode.charAt(Math.floor(Math.random() * cLength));
    }

    return res;

}

let escapeHtml = (text) => {
    var based_on = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '+': '&pls;',
        '/': '&slh;',
        '*': '&mtp;',
        '=': '&eql;',
        '$': '&dlr;',
        '#': '&dsh;',
        '%': '&ptg;',
        '[': '&br1;',
        '{': '&bs1;',
        '}': '&bs2;',
        '-': '&mns;'
    };

    return text.replace(/[&<>+/*=$#%[{}-]/g, function(m) { return based_on[m] });
}
let removeEscapeHtml = (text) => {
    var based_on = {
        '&amp;': '&',
        '&lt;': '<',
        '&gt;': '>',
        '&pls;': '+',
        '&slh;': '/',
        '&mtp;': '*',
        '&eql;': '=',
        '&dlr;': '$',
        '&dsh;': '#',
        '&ptg;': '%',
        '&br1;': '[',
        '&bs1;': '{',
        '&bs2;': '}',
        '&mns;': '-',
    };

    text = text.replace('&amp;', '&');
    text = text.replace('&lt;', '<');
    text = text.replace('&gt;', '>');
    text = text.replace('&pls;', '+');
    text = text.replace('&slh;', '/');
    text = text.replace('&mtp;', '*');
    text = text.replace('&eql;', '=');
    text = text.replace('&dlr;', '$');
    text = text.replace('&dsh;', '#');
    text = text.replace('&ptg;', '%');
    text = text.replace('&br1;', '[');
    text = text.replace('&bs1;', '{');
    text = text.replace('&bs2;', '}');
    text = text.replace('&mns;', '-');

    return text;
};