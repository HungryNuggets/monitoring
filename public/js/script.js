// SIGN UP / SIGN IN FORM EFFECTS
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

if ((typeof  sessionStorage.getItem("registration") !== 'undefined')) {
    if ( sessionStorage.getItem("registration") === "yes") {
        container.classList.add('right-panel-active');
    } else if ( sessionStorage.getItem("registration") === "no") {
        container.classList.remove('right-panel-active');
    }
}

signUpButton.addEventListener('click', function(){
    container.classList.add('right-panel-active');
    sessionStorage.removeItem('registration');
    sessionStorage.setItem('registration','yes');
});

signInButton.addEventListener('click', function() {
    container.classList.remove('right-panel-active');
    sessionStorage.removeItem('registration');
    sessionStorage.setItem('registration','no');
});