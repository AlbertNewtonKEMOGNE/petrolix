document.getElementById('form_submit_log').addEventListener("click", function() {

    let email = document.getElementById('in_2').value;
    let password = document.getElementById('in_3').value;
    let code = document.getElementById('in_6').value;

    let _at = email.indexOf("@");
    let _dot = email.lastIndexOf(".");

    if ((code == localStorage.getItem('hiddenCode')) && !(_at < 1 || _dot < _at + 2 || _dot + 2 >= email.length)) {

        localStorage.setItem('callback', 'log');

        $.ajax({
            type: "POST",
            url: toApiUrl(),
            data: {
                find: escapeHtml(email),
                corresponding: escapeHtml(password),
                info: apiInfo(code)
            },
            success: function(response) {
                response = JSON.parse(response);
                if ((response['rows_founded'] == 1)) {
                    res = JSON.stringify(response['user']);
                    res = JSON.parse(res);
                    localStorage.setItem('isConnected', response['founded']);
                    localStorage.setItem('Mail', removeEscapeHtml(res['user_email_field']));
                    window.location = 'http://localhost/projects/petrolix/presentation/index.html';
                }
                if ((response['rows_founded'] == 0)) {
                    document.getElementById('ref_img').src = './presentation/img/failed.png';
                    document.getElementById('message').textContent = 'Failed to Log-In !';
                    document.getElementById('message_details').textContent = 'Bad email or password, please try again...';
                    document.getElementsByClassName('popup')[0].classList.add("active");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                localStorage.removeItem('hiddenCode');
                document.getElementById('ref_img').src = './presentation/img/failed.png';
                document.getElementById('message').textContent = 'Failed to Log-In !';
                document.getElementById('message_details').textContent = 'Bad email or password, please try again...';
                document.getElementsByClassName('popup')[0].classList.add("active");
            }
        });

    } else {
        localStorage.removeItem('hiddenCode');
        document.getElementById('ref_img').src = './presentation/img/failed.png';
        document.getElementById('message').textContent = 'Failed to Log-In !';
        document.getElementById('message_details').textContent = 'If you are not a robot, please try again...';
        document.getElementsByClassName('popup')[0].classList.add("active");
    }
});

let start = () => {
    localeHidden = generateKey(32);
    localStorage.setItem('hiddenCode', localeHidden);
    document.getElementById('in_6').value = localeHidden;
}

document.getElementById('pop_btn').addEventListener("click", function() {
    document.getElementsByClassName('popup')[0].classList.remove("active");
    window.location = 'http://localhost/projects/petrolix/index.html';
});