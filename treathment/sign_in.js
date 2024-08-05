document.getElementById('pop_btn').addEventListener("click", function() {
    document.getElementsByClassName('popup')[0].classList.remove("active");
    window.location = '#';
});

document.getElementById('form_submit_sign').addEventListener("click", function() {

    let fName = document.getElementById('in_3').value;
    let email = document.getElementById('in_2').value;
    let password = document.getElementById('in_3').value;
    let cPassword = document.getElementById('in_4').value;
    let refCode = document.getElementById('in_5').value;
    let code = document.getElementById('in_6').value;

    let _at = email.indexOf("@");
    let _dot = email.lastIndexOf(".");

    if ((code == localStorage.getItem('hiddenCodeSign') && !(_at < 1 || _dot < _at + 2 || _dot + 2 >= email.length) && (password == cPassword))) {

        localStorage.setItem('callback', 'regis');
        alert('registering...');
        $.ajax({
            type: "POST",
            url: toApiUrl(),
            data: {
                name: escapeHtml(fName),
                mail: escapeHtml(email),
                pass: escapeHtml(password),
                ref: escapeHtml(refCode),
                info: apiInfo(code)
            },
            success: function(response) {
                alert(response);
                response = JSON.parse(response);
                alert(response);
                if (response['final']) {
                    window.location = 'http://localhost/projects/petrolix/index.html';
                } else {
                    document.getElementById('ref_img').src = '../presentation/img/failed.png';
                    document.getElementById('message').textContent = 'Failed to Sign-In !';
                    document.getElementById('message_details').textContent = 'Email may already exist, fill new email...';
                    document.getElementsByClassName('popup')[0].classList.add("active");
                }
            }
        });
    } else {
        localStorage.removeItem('hiddenCodeSign');
        document.getElementById('ref_img').src = '../presentation/img/failed.png';
        document.getElementById('message').textContent = 'Failed to Sign-In !';
        document.getElementById('message_details').textContent = 'Bad email or passwords do not correspond...';
        document.getElementsByClassName('popup')[0].classList.add("active");
    }
});