const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const messageInput = document.getElementById('message');
const emailNotGoodInput = document.getElementById('emailNotGood');
const btn = document.getElementById('submitBtn');

function checkForm(){
    const emailValue = emailInput.value;
    const passValue = passInput.value;
    const messageValue = messageInput.value;
    const emailNotGoodValue = emailNotGoodInput.value;

    if(emailNotGoodValue !== ""){
        emailNotGoodInput.hidden = false;
    } else {
        emailNotGoodInput.hidden = true;
    }
    if (emailValue !== "" && passValue !== "" && messageValue !== ""){ 
        btn.disabled = false;
        btn.readonly = true;
        btn.classList.remove('btn-disabled');
    } else{
        btn.disabled = true;
        btn.readonly = false;
        btn.classList.add('btn-disabled');
    }
}

nameInput.addEventListener('input', checkForm);
emailInput.addEventListener('input', checkForm);
messageInput.addEventListener('input', checkForm);
emailNotGoodInput.addEventListener('input', checkForm);