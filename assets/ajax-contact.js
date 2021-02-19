$(document).ready(function () {

    /**
     * Si le tableau contient une valeur vide retourne le ou les champs vide 
     * @param {*} array 
     */
    const isErrors = function (array) {
        let error = {};
        for (let data in array) {
            if (array[data] === "") {
                error[data] = "Ce champs est vide";
            }
        }
        return error;
    }

    /**
     * Affiche les messages d'erreurs dans le form
     * @param {*} errors 
     */
    const showError = function (errors) {
        for (let error in errors) {
            $("#js-error-" + error).show().html("ERREUR : " + errors[error]);
        }
    }

    const isErrors = function (data) {
        for (let error in errors) {
            $("#js-error-" + error).show().html("ERREUR : " + errors[error]);
        }
    }

    let sendAjaxContact = function (path, data) {
        $.ajax({
            url: path,
            type: "POST",
            data: data
        })

        .done(function (data) {
            if (data) {
                $("#js-send-button").html("envoyer");
            }

            $("#js-response-formulaire").show(100, function () {
                $(this).addClass("show alert-" + data.status);
            });
            $("#js-response-formulaire p").html(data.message);
                showError(data.errors);
        })
        .fail(function (error) {
            alert(error);
        });
    };

    const hideError = function () {
        $("#js-error-name").hide().html();
        $("#js-error-lastname").hide().html();
        $("#js-error-email").hide().html();
        $("#js-error-message").hide().html();
    }

    /**
     * Soumission du formuliare
     */
    $("form").submit(function (e) {
        e.preventDefault();

        //tableau des données du formulaire
        let contact = {
            "name": $("#name").val(),
            "lastname": $("#lastname").val(),
            "email": $("#email").val(),
            "message": $("#message").val()
        }

        //pour signaler que le formulaire st en cours de traitement
        $("#js-send-button").html("<span class= 'spinner-border spinner-border-sm' role='status' aria-hidden='true'></span > En cours d'envoi ...");

        //On verifie si erreurs
        let errors = isErrors(contact);

        //On traite
        if (!jQuery.isEmptyObject(errors)) {
            showError(errors);
            $("#js-send-button").html("envoyer");
        }

        if (jQuery.isEmptyObject(errors)) {
            hideError();
            let form = $(this).serialize();
            sendAjaxContact("/ajax/contact", form);
        }
    });
});