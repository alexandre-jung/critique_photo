let showCheckboxes = document.querySelectorAll('.show-password');

let passwordInput = document.querySelector('#password');

for (let checkbox of showCheckboxes) {

    let inputId = checkbox.dataset.target;
    let passwordInput = document.getElementById(inputId);

    checkbox.addEventListener('click', () => {
        if (checkbox.checked) {
            passwordInput.setAttribute('type', 'text');
        } else {
            passwordInput.setAttribute('type', 'password');
        }
    });
}