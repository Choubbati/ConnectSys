
function validateForm() {
    let valid = true;

    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value;
    const confirm  = document.getElementById("confirm").value;

    document.getElementById("userError").innerText = "";
    document.getElementById("passError").innerText = "";
    document.getElementById("confirmError").innerText = "";

    const userRegex = /^[a-zA-Z0-9]{3,}$/;

    if (!userRegex.test(username)) {
        document.getElementById("userError").innerText =
            "Au moins 3 caractères alphanumériques";
        valid = false;
    }

    if (password.length < 6) {
        document.getElementById("passError").innerText =
            "Mot de passe ≥ 6 caractères";
        valid = false;
    }

    if (password !== confirm) {
        document.getElementById("confirmError").innerText =
            "Les mots de passe ne correspondent pas";
        valid = false;
    }

    return valid;
}

