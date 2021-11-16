function redirect(url) {
    window.location.href = url;
}

timer = null;

function checkUsername() {
    clearTimeout(timer);

    timer = setTimeout(() => {
        var resolved = document.querySelector('#resolved_username_block');
        var username = document.querySelector('input[name=username]');

        fetch('/resolve/' + username.value)
            .then(response => response.json())
            .then(data => {
                if (data.username !== '') {
                    resolved.classList.remove('hide');
                    document.querySelector('#resolved_username').innerText =
                    data.username + '@' + document.querySelector('select[name=domain]').value
                } else {
                    resolved.classList.add('hide');
                }
            });
    }, 400);
}