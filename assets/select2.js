$(document).ready(function () {
    $(".js-select-multiple").select2();

    $("input[type='file']").on("change", (e) => {
        let that = e.currentTarget
        if (that.files && that.files[0]) {
            let reader = new FileReader()
            reader.onload = (e) => {
                $("#js-file-project").remove()
                let img = $("<img id='js-file-project' />").attr("src", e.target.result).addClass("img-fluid");
                $("legend.col-form-label").after(img)
            }
            reader.readAsDataURL(that.files[0])
        }
    })
});