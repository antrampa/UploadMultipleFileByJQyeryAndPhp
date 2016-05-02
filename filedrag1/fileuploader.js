/**
 * Created by ambitos on 2/5/2016.
 */
$(document).ready(function ()
{
    $("body").on("click", "#submit", function() {
        $("#upload").submit(function(e) {
            // alert('on submit');
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

    function $id(id) {
        return document.getElementById(id);
    }

    function Output(msg) {
        var m = $id("messages");
        m.innerHTML = msg + m.innerHTML;
    }


    // file drag hover
    function FileDragHover(e) {
        // alert('inside FileDragHover');
        e.stopPropagation();
        e.preventDefault();
        e.target.className = (e.type == "dragover" ? "hover" : "");
    }


    // file selection
    function FileSelectHandler(e)
    {
        // alert('inside FileSelectHandler');
        // cancel event and hover styling
        FileDragHover(e);

        // fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // process all File objects

        for (var i = 0, f; f = files[i]; i++)
        {
            ParseFile(f);
            //UploadFile(f);
        }
        // alert('inside upload');
        $("#submit").click();
        // alert('inside upload');
    }


    // output file information
    function ParseFile(file) {
//        alert('Start Parsing file :'+file.name);
        Output(
            "<p>File information: <strong>" + file.name +
            "</strong> type: <strong>" + file.type +
            "</strong> size: <strong>" + file.size +
            "</strong> bytes</p>"
        );

        var path = $('#uplfr').val();
        // display an image
        if (file.type.indexOf("image") == 0) {
            var reader = new FileReader();
            reader.onload = function(e) {
                Output(
                    "<p><strong>" + file.name + ":</strong><br />" +
                    '<img src="ajaxupl/' + path + '/' + file.name + '" /></p>'
                );
            }
            reader.readAsDataURL(file);
        }

        // display text
        if (file.type.indexOf("text") == 0) {
            var reader = new FileReader();
            reader.onload = function(e) {
                Output(
                    "<p><strong>" + file.name + ":</strong></p><pre>" +
                    e.target.result.replace(/</g, "&lt;").replace(/>/g, ">") +
                    "</pre>"
                );
            }
            reader.readAsText(file);
        }

    }

    // initialize
    function Init() {
        // alert('inside init');

        var fileselect = $id("fileselect"),
            filedrag = $id("filedrag"),
            submitbutton = $id("submitbutton");

        // file select
        fileselect.addEventListener("change", FileSelectHandler, false);
    }

    // call initialization file
    if (window.File && window.FileList && window.FileReader)
    {
        Init();
    }


});