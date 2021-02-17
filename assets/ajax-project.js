$(document).ready(function () {
    let compteur = 0;

    $("#js-load-all-projets").on("click", function() {
        $(this).html("<span class= 'spinner-border spinner-border-sm' role='status' aria-hidden='true'></span > Chargement...");
        compteur++;
        sendAjax("/ajax/projects/"+compteur);
    });

    const toHtml = function (data) {
        let html = "";
        for (let project of data) {
            html += "<div class='col-12 col-md-6 col-xl-4 mb-5 animate__animated animate__fadeIn'>" +
                        "<article class='card hover-shadow border text-center text-md-left overflow-hidden'>" +
                            "<header class='embed-responsive embed-responsive-16by9'>" +
                                "<img class='embed-responsive-item' src='/uploads/images/project/" + project.featured + "' alt='{{ project.featured.alt }}' />" +
                            "</header>" +
                            "<div class='card-body'>" +
                                "<h3 class='mb-2 typo-title text-primary-color-dark'>" + project.title + "</h3>" +
                                    "<p class='mb-4'>";

                                    for (let category of project.category) {
                                        html += "<span class='js-button-category badge text-white bg-primary-color ml-1'>" + category.name + "</span>";
                                    }

                            html += "</p></div>" +
                            
                            "<footer class='card-footer border-top-0 mb-2 d-flex justify-content-center justify-content-md-end'>" +
                                "<a href='/project/" + project.slug + "' class='btn btn-outline-card'>Voir</a>" +
                            "</footer>" +
                        "</article>" +
                    "</div>";
        };
        return html;
    }

    let sendAjax = function (path) {
        $.ajax({
            url: path,
            type: "GET",
            dataType: "json",
        })

        .done(function (data) {
            if (data) {
                $("#js-load-all-projets").html("Plus de projets");
            }

            if (data.number <= 0) {
                $("#js-load-all-projets").hide();
            }

            $("#js-load-all-projets").parent().before(toHtml(data.projects));
        })

        .fail(function (error) {
            alert(error);
        });
    };
})