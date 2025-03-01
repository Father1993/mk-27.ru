BX.ready(function () {
    // Переключение видимости пароля
    const togglePassword = document.querySelector('.toggle-password')
    const passwordInput = document.querySelector('#user-password')

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type =
                passwordInput.getAttribute('type') === 'password'
                    ? 'text'
                    : 'password'
            passwordInput.setAttribute('type', type)

            const icon = this.querySelector('i')
            icon.classList.toggle('fa-eye')
            icon.classList.toggle('fa-eye-slash')
        })
    }

    // Автофокус на нужное поле
    try {
        if (BX.message('LAST_LOGIN') !== '') {
            document.form_auth.USER_PASSWORD.focus()
        } else {
            document.form_auth.USER_LOGIN.focus()
        }
    } catch (e) {}
})
