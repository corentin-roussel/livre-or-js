let inscription = document.querySelector("#inscription")
let connexion = document.querySelector("#connexion")
let div = document.querySelector("#place");



inscription.addEventListener("click", () => {

    fetch('inscription.php')
        .then(response => {
            return response.text();
        })
        .then(form => {
            div.innerHTML = form;
            let submit = document.querySelector("#submitReg");
            let registerForm = document.querySelector('#register');

            submit.addEventListener("click", (e) => {

                e.preventDefault();
                let formRegister = new FormData(registerForm);
                fetch("inscription.php", {
                    method: "POST",
                    body: formRegister
                })
                    .then(response => {
                        return response;
                    })
            })
        })


})

connexion.addEventListener("click", () => {

    fetch('connexion.php')
        .then(response  => {
            return response.text();
        })
        .then(form => {
            div.innerHTML = form;
            let submitCon = document.querySelector("#submitCon");
            let connexionForm = document.querySelector("#connexion-form");
            console.log(connexionForm);

            submitCon.addEventListener("click", (e) => {
                e.preventDefault();
                let formConnexion = new FormData(connexionForm);
                fetch("connexion.php", {
                    method: "POST",
                    body: formConnexion
                })
                .then(response => {
                    return response;
                })
            })
        })
})