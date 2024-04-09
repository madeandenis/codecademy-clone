function togglePasswordVisibility(passInput, showPassIcon) {
    showPassIcon.addEventListener('click', () => {
        showPassIcon.classList.toggle('fa-eye');
        showPassIcon.classList.toggle('fa-eye-slash');
        passInput.type = (passInput.type === 'password') ? 'text' : 'password';
    });
}

function handlePasswordChecklistVisibility(passInput, passwordChecklist) {
    passInput.addEventListener('focus', () => {
        passwordChecklist.style.visibility = 'visible';
    });

    passInput.addEventListener('blur', () => {
        passwordChecklist.style.visibility = 'hidden';
    });
}

function validatePassword(passInput, passwordChecklist, signupButton) {
    let checkListElements = passwordChecklist.querySelectorAll('.list-item');

    let validationRegex = [
        { regex: /.{8,}/ }, // min 8 letters,
        { regex: /[0-9]/ }, // numbers from 0 - 9
        { regex: /[a-z]/ }, // letters from a - z (lowercase)
        { regex: /[A-Z]/}, // letters from A-Z (uppercase),
        { regex: /[^A-Za-z0-9]/} // special characters
    ];

    passInput.addEventListener('keyup', () => {
        let isButtonInactive = false;

        validationRegex.forEach((item, i) => {
            let isValid = item.regex.test(passInput.value);
            if(isValid) {
                checkListElements[i].classList.add('checked');
            } else{
                checkListElements[i].classList.remove('checked');
                isButtonInactive = true;
            }
        });

        signupButton.disabled = isButtonInactive;
    });
}

function setupPasswordInput() {
    let passInput = document.querySelector('.password-input');
    let showPassIcon = document.querySelector('.show-password');
    let passwordChecklist = document.querySelector('.password-checklist');
    let signupButton = document.querySelector('#signupButton');
    signupButton.disabled = true;
    
    togglePasswordVisibility(passInput, showPassIcon);
    handlePasswordChecklistVisibility(passInput, passwordChecklist);
    validatePassword(passInput, passwordChecklist, signupButton);
}

document.addEventListener("DOMContentLoaded", function(){
    if(document.getElementById('signupForm')){
        setupPasswordInput();
    }
    if(document.getElementById('loginForm')){
        let passInput = document.querySelector('.password-input');
        let showPassIcon = document.querySelector('.show-password')
        togglePasswordVisibility(passInput, showPassIcon);
    }
})
