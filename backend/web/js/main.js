


$(document).ready(function () {
    $("input[name=string]").change(function () {
        $("#btn-user-search").trigger("click")
        $('#input-user-search').val(null);
    });
});

