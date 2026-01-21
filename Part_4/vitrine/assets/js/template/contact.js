const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const messageInput = document.getElementById('message');
const btn = document.getElementById('submitBtn');

function checkForm(){
    const nameValue = nameInput.value;
    const emailValue = emailInput.value;
    const messageValue = messageInput.value;

    if (emailValue !== "" && nameValue !== "" && messageValue !== ""){ 
        btn.disabled = false;
        btn.classList.remove('btn-disabled');
    } else{
        btn.disabled = true;
        btn.classList.add('btn-disabled');
    }
}

nameInput.addEventListener('input', checkForm);
emailInput.addEventListener('input', checkForm);
messageInput.addEventListener('input', checkForm);