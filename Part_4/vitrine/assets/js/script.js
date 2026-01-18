
    const emailInput = document.getElementById('email');
    const passInput = document.getElementById('password');
    const btn = document.getElementById('submitBtn');
    
    function checkForm(){
        const emailValue = emailInput.value;
        const passValue = passInput.value;

        if (emailValue !== "" && passValue !== ""){ 
            btn.disabled = false;
            btn.readonly = true;
            btn.classList.remove('btn-disabled');
        } else{
            btn.disabled = true;
            btn.readonly = false;
            btn.classList.add('btn-disabled');
        }
    }
    
    emailInput.addEventListener('input', checkForm);
    passInput.addEventListener('input', checkForm);