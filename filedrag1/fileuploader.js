/**
 * Created by ambitos on 2/5/2016.
 */
$(document).ready(function ()
{
    $("body").on("click", "#submit", function() {
        $("#upload").submit(function(e) {
            var formObj = $(this);
            var formURL = formObj.attr("action");
            var formData = new FormData(this);
            $.ajax({
                url: formURL,
                type: 'POST',
                data:  formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    alert('ok');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('error');
                }
            });
            e.preventDefault();
            e.unbind();
        });
    });

});