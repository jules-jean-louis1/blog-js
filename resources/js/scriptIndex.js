// Declaration des variables pour les elements du DOM Register/ Login
// Varaiables presente dans le header de tous les pages
const BtnLogin = document.querySelector('#buttonLoginHeader');
const BtnRegister = document.querySelector('#buttonRegisterHeader');
const formDisplayer = document.querySelector('#formDisplayer');

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
function closeModal() {
    let dialog = document.querySelector("#dialog");
    dialog.close();
    dialog.remove();
}


// Evenement pour afficher le formulaire d'inscription
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
                     closeModal();
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

// Evenement pour afficher le formulaire de connexion
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
                        closeModal();
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
                            }, 2000);
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