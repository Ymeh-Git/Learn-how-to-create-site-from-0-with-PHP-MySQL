const nameInput = document.getElementById('name');
const priceInput = document.getElementById('price');
const avatarInput = document.getElementById('avatar');
const labelAltImgInput = document.getElementById('labelAltImage');
const altImgInput = document.getElementById('altImage');
const descriptionInput = document.getElementById('description');
const referenceInput = document.getElementById('reference');
const forgotImgInput = document.getElementById('forgotImage');
const btn = document.getElementById('submitBtn');

function checkForm(){
    const nameValue = nameInput.value;
    const priceValue = priceInput.value;
    const avatarValue = avatarInput.value;
    const altImgValue = altImgInput.value;
    const descriptionValue = descriptionInput.value;
    const referenceValue = referenceInput.value;

    if(avatarValue == ""){
        labelAltImgInput.hidden = true;
        altImgInput.hidden = true;
    } else {
        labelAltImgInput.hidden = false;
        altImgInput.hidden = false;
        forgotImgInput.hidden = true;
    }

    if (nameValue !== "" && 
        priceValue !== "" &&
        descriptionValue !== "" &&
        referenceValue !== ""){ 
        if(avatarValue == ""){
            forgotImgInput.hidden = false;
        } else {
            forgotImgInput.hidden = true;
        }
        btn.disabled = false;
        btn.classList.remove('btn-disabled');
        btn.classList.add('btn-green');
    } else{
        btn.disabled = true;
        btn.classList.remove('btn-green');
        btn.classList.add('btn-disabled');
    }
}

nameInput.addEventListener('input', checkForm);
priceInput.addEventListener('input', checkForm);
avatarInput.addEventListener('input', checkForm);
altImgInput.addEventListener('input', checkForm);
descriptionInput.addEventListener('input', checkForm);
referenceInput.addEventListener('input', checkForm);