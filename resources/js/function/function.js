// Fonction pour la gestion des messages d'erreurs
function displayError(message) {
    message.classList.add('alert-danger');
    message.classList.remove('alert-success');
}

// Fonction pour la gestion des messages de success
function displaySuccess(message) {
    message.classList.add('alert-success');
    message.classList.remove('alert-danger');
}
// Formatage de la date
function formatDate(timestamp) {
    const months = ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Jui', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'];
    const date = new Date(timestamp);
    const year = date.getFullYear();
    const month = months[date.getMonth()];
    const day = date.getDate();
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    return `${month} ${day}, ${year} à ${hours}:${minutes}`;
}
function formatDateSansh(timestamp) {
    const months = ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Jui', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'];
    const date = new Date(timestamp);
    const year = date.getFullYear();
    const month = months[date.getMonth()];
    const day = date.getDate();
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    return `${month} ${day}, ${year}`;
}
// Fonction Login
function loginFormHeader(BtnLogin) {
    BtnLogin.addEventListener('click', async (ev) => {
        // Créer l'élément dialog
        const dialog = document.createElement('dialog');
        dialog.setAttribute('id', 'dialog');
        dialog.className = 'dialog_modal';
        formDisplayer.appendChild(dialog);
        dialog.innerHTML = '';
        await fetch('resources/assests/fetch/login.php')
            .then(response => response.text())
            .then(data => {
                dialog.innerHTML = data;

                // Afficher le dialog
                dialog.showModal();
                document.addEventListener('click', (ev) => {
                    if (ev.target.id === 'closeDialog') {
                        closeModalDialog();
                    }
                });
            });
        const formLogin = document.querySelector('#login-form');
        formLogin.addEventListener('submit', (ev) => {
            ev.preventDefault();
            fetch('resources/assests/fetch/login.php', {
                method: 'POST',
                body: new FormData(formLogin)
            })
                .then(response => response.json())
                .then(data => {
                    let message = document.querySelector('#errorMsg');
                    if (data.status === 'success') {
                        message.innerHTML = data.message;
                        displaySuccess(message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                    if (data.status === 'empty') {
                        message.innerHTML = data.message;
                        displayError(message);
                    }
                    if (data.status === 'loginFail') {
                        message.innerHTML = data.message;
                        displayError(message);
                    }
                });
        });
    });
}
// Fonction Register
function registerHeader(BtnRegister) {
    BtnRegister.addEventListener('click', async (ev) => {
        // Créer l'élément dialog
        const dialog = document.createElement('dialog');
        dialog.setAttribute('id', 'dialog');
        dialog.className = 'dialog_modal';
        formDisplayer.appendChild(dialog);
        dialog.innerHTML = '';
        // Affichage du formulaire d'inscription
        await fetch('resources/assests/fetch/register.php')
            .then(response => response.text())
            .then(data => {
                // Insérer le contenu de la réponse dans l'élément dialog
                dialog.innerHTML = data;

                // Afficher le dialog
                dialog.showModal();
                document.addEventListener('click', (ev) => {
                    if (ev.target.id === 'closeDialog') {
                        closeModalDialog();
                    }
                });
            });
        const formRegister = document.querySelector('#resgister-form');
        formRegister.addEventListener('submit', (ev) => {
            ev.preventDefault();
            fetch('resources/assests/fetch/register.php', {
                method: 'POST',
                body: new FormData(formRegister)
            })
                .then(response => response.json())
                .then(data => {
                    let message = document.querySelector('#errorMsg');
                    if (data.status === 'success') {
                        message.innerHTML = data.message;
                        displaySuccess(message);
                    }
                    if (data.status === 'empty') {
                        message.innerHTML = data.message;
                        displayError(message);
                    }
                    if (data.status === 'loginExist') {
                        message.innerHTML = data.message;
                        displayError(message);
                    }
                    if (data.status === 'passwordInvalid') {
                        message.innerHTML = data.message;
                        displayError(message);
                    }
                    if (data.status === 'passwordConfirm') {
                        message.innerHTML = data.message;
                        displayError(message);
                    }
                });
        });
    });
}

function closeModalDialog() {
    let dialog = document.querySelector("#dialog");
    dialog.close();
    dialog.remove();
}
function toggleMenu() {
    let menuItems = document.getElementById("menuItems");
    if (menuItems.classList.contains("hidden")) {
        menuItems.classList.remove("hidden");
    } else {
        menuItems.classList.add("hidden");
    }
}

// Export des fonctions pour une utilisation externe
export { displayError};
export {displaySuccess};
export {formatDate};
export {formatDateSansh};
export {loginFormHeader};
export {registerHeader};
export {closeModalDialog};
export {toggleMenu};

