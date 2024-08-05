document.getElementById('deposit_for_pop').addEventListener("click", function() {
    document.getElementById('ref_img').src = '../presentation/img/deposits.png';
    document.getElementById('message').textContent = 'Deposit on Investments...';
    document.getElementsByClassName('no_see_input_1')[0].classList.add("visible_input");
    document.getElementsByClassName('no_see_input_2')[0].classList.add("visible_input");
    document.getElementsByClassName('popup')[0].classList.add("active");
});
document.getElementById('withdraw_for_pop').addEventListener("click", function() {
    document.getElementById('ref_img').src = '../presentation/img/withdraws.png';
    document.getElementById('message').textContent = 'Withdraw Earnings...';
    document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
    document.getElementsByClassName('no_see_input_2')[0].classList.add("visible_input");
    document.getElementsByClassName('popup')[0].classList.add("active");
});
document.getElementById('plan_standard').addEventListener("click", function() {
    document.getElementById('ref_img').src = '../presentation/img/deposits.png';
    document.getElementById('message').textContent = 'Invest on Standard Plan...';
    document.getElementById('message_details').textContent = 'This Investment plan will give you up to 1.4% of your deposit per day...';
    document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
    document.getElementsByClassName('no_see_input_2')[0].classList.add("visible_input");
    document.getElementsByClassName('popup')[0].classList.add("active");
});
document.getElementById('plan_referral').addEventListener("click", function() {
    document.getElementById('ref_img').src = '../presentation/img/deposits.png';
    document.getElementById('message').textContent = 'Invest on Referral Plan...';
    document.getElementById('message_details').textContent = 'This Investment plan will give you up to 1.8% of your deposit per day...';
    document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
    document.getElementsByClassName('no_see_input_2')[0].classList.add("visible_input");
    document.getElementsByClassName('popup')[0].classList.add("active");
});
document.getElementById('plan_cost').addEventListener("click", function() {
    document.getElementById('ref_img').src = '../presentation/img/deposits.png';
    document.getElementById('message').textContent = 'Invest on Cost Plan...';
    document.getElementById('message_details').textContent = 'This Investment plan will give you up to 2.0% of your deposit per day just for $10.0 ...';
    document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
    document.getElementsByClassName('no_see_input_2')[0].classList.add("visible_input");
    document.getElementsByClassName('popup')[0].classList.add("active");
});
document.getElementById('pop_btn').addEventListener("click", function() {
    document.getElementsByClassName('popup')[0].classList.remove("active");
    refreshAll();
});

document.getElementById('sponsor_friends_btn').addEventListener("click", async function() {

    var link = document.getElementById('share_link');

    link.focus();
    link.select();

    if (!navigator.canShare) {

        try {
            var res = document.execCommand('copy');
            navigator.clipboard.writeText('\tPetrolix...\nJoin the Community of Investors and Let Us EARN Together...\n\n' +
                link.value).then(function() {
                document.getElementById('ref_img').src = '../presentation/img/success.png';
                document.getElementById('message').textContent = 'Link copied...';
                document.getElementById('message_details').textContent = 'The link has been successfully copied into the clipboard...';
                document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
                document.getElementsByClassName('no_see_input_2')[0].classList.remove("visible_input");
                document.getElementsByClassName('popup')[0].classList.add("active");
            }, function(err) {
                document.getElementById('ref_img').src = '../presentation/img/failed.png';
                document.getElementById('message').textContent = 'Copy missed !!!';
                document.getElementById('message_details').textContent = 'Sorry your browser was unable to copy the link...';
                document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
                document.getElementsByClassName('no_see_input_2')[0].classList.remove("visible_input");
                document.getElementsByClassName('popup')[0].classList.add("active");
            });
        } catch (error) {
            document.getElementById('ref_img').src = '../presentation/img/failed.png';
            document.getElementById('message').textContent = 'Failed to share !!!';
            document.getElementById('message_details').textContent = 'Sorry your browser was unable to share the link...';
            document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
            document.getElementsByClassName('no_see_input_2')[0].classList.remove("visible_input");
            document.getElementsByClassName('popup')[0].classList.add("active");
        }
        return;
    }

    if (navigator.canShare) {
        try {
            await navigator.share({
                title: 'Petrolix\n',
                text: 'Join the Community of Investors and Let Us EARN Together...\n\n',
                url: link.value
            });
        } catch (error) {
            document.getElementById('ref_img').src = '../presentation/img/failed.png';
            document.getElementById('message').textContent = 'Failed to share !!!';
            document.getElementById('message_details').textContent = 'Sorry your browser was unable to share the link...';
            document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
            document.getElementsByClassName('no_see_input_2')[0].classList.remove("visible_input");
            document.getElementsByClassName('popup')[0].classList.add("active");
        }
    } else {
        try {
            var res = document.execCommand('copy');
            navigator.clipboard.writeText('\tPetrolix...\nJoin the Community of Investors and Let Us EARN Together...\n\n' +
                link.value).then(function() {
                document.getElementById('ref_img').src = '../presentation/img/success.png';
                document.getElementById('message').textContent = 'Link copied...';
                document.getElementById('message_details').textContent = 'The link has been successfully copied into the clipboard...';
                document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
                document.getElementsByClassName('no_see_input_2')[0].classList.remove("visible_input");
                document.getElementsByClassName('popup')[0].classList.add("active");
            }, function(err) {
                document.getElementById('ref_img').src = '../presentation/img/failed.png';
                document.getElementById('message').textContent = 'Copy missed !!!';
                document.getElementById('message_details').textContent = 'Sorry your browser was unable to copy the link...';
                document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
                document.getElementsByClassName('no_see_input_2')[0].classList.remove("visible_input");
                document.getElementsByClassName('popup')[0].classList.add("active");
            });
        } catch (error) {
            document.getElementById('ref_img').src = '../presentation/img/failed.png';
            document.getElementById('message').textContent = 'Failed to share !!!';
            document.getElementById('message_details').textContent = 'Sorry your browser was unable to share the link...';
            document.getElementsByClassName('no_see_input_1')[0].classList.remove("visible_input");
            document.getElementsByClassName('no_see_input_2')[0].classList.remove("visible_input");
            document.getElementsByClassName('popup')[0].classList.add("active");
        }
        return;
    }
});


let _requestMade = (user_mail) => {

    code = document.getElementById('in_6');
    $.ajax({

        type: "POST",
        url: _userApi(),
        data: {
            findWith: escapeHtml(user_mail),
            info: apiInfo(code)
        },
        success: function(response) {
            res = JSON.parse(response);
            if ((res['rows_founded'] != 0)) {
                return response;
            } else {
                return 'no data';
            }

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert('error');
            return 'error';
        }

    });
}