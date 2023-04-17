form.addEventListener('submit', (event) => {
    if (passwordInput.value !== confirmPasswordInput.value) {
        errorMessage.style.display = 'block';
        event.preventDefault();
     
    } else {
        errorMessage.style.display = 'none';
        return true;
    }
});

function validateForm() {
    const username = document.querySelector('input[type="text"]').value;
    const password = document.querySelector('input[type="password"]').value;
    const errorMessages = document.querySelectorAll('.error-message');

    if (username === '' || password === '') {
        errorMessages[0].innerHTML = "Please enter both username and password";
        return false;
    }
    if(isset($error) && count($error) > 0){
        errorMessages[0].innerHTML = "User already exists";
        return false;
    }

    return true;
}
