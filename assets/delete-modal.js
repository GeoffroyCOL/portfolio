let deleteButtons = document.querySelectorAll(".js-delete-button");
let linkModalDelete = document.getElementById("js-link-delete");

deleteButtons.forEach((elt, index) => {
    elt.addEventListener("click", () => {
        let url = elt.getAttribute("data-mdb-url");
        linkModalDelete.setAttribute("href", url)
    })
});

