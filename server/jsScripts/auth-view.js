// Auth
const signUpBtn = document.getElementById("sign-up");
const signInBtn = document.getElementById("sign-in");

const container = document.querySelector('.auth-container')

signUpBtn.addEventListener('click', () => {
    container.classList.add('right-panel-active')
});

signInBtn.addEventListener('click', () => {
    container.classList.remove('right-panel-active')
});