<div class="parent">
    <div class="enfant">
        <form action="upload_handler.php" method="POST" enctype="multipart/form-data">   
            <label for="avatar">Votre avatar (JPG, PNG - Max 2Mo)</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /> 
            <input type="file" name="avatar" id="avatar">
            <div class="btn-field">
                <input type="submit" value="Insérez un fichier" id="submitBtn" class="btn btn-grey" disabled>
            </div>
        </form>
    </div>
</div>

<script>
    // Récupérons les inputs
    const avatarInput = document.getElementById('avatar');
    const btn = document.getElementById('submitBtn');

    function checkForm(){
        // Attribuons la valeur d'un input à une variable
        const avatarValue = avatarInput.value;
        // Vérifions que tous les champs soient remplis
        if (avatarValue !== ""){ 
            btn.disabled = false;
            btn.classList.remove('btn-grey');
            btn.classList.add('btn-green');
            btn.value = "Envoyer mon fichier";
        } else{
            // Si les champs sont vides alors le bouton est désactivé
            btn.disabled = true;
            btn.classList.remove('btn-green');
            btn.classList.add('btn-grey');
            btn.value = "Insérez un fichier";
        }
    }

    // Nous écoutons les inputs pour activer ou désactiver le bouton
    avatarInput.addEventListener('input', checkForm);
</script>