var type;
var extension;
var dropzone;
var height = 0;
$(function(){
    Dropzone.autoDiscover = false;

    dropzone = new Dropzone("#dropzone", {
        autoProcessQueue: false,
        parallelUploads: 1000,
        uploadMultiple: true,
        dictDefaultMessage: "Drop <strong>images/supergifs/video/ziped banner</strong> here"
    });
    //file.width and file.height working only if thumbail was generated
    dropzone.on("thumbnail", function(file) {
        checkType(file);
    });
    dropzone.on("success", function(file) {
        location.reload();
    });
    dropzone.on("addedfile", function(file) {
        extension = file.name.split(".")[file.name.split(".").length - 1];
        if(extension !== "jpg" && extension !== "png" && extension !== "gif") {
            checkType(file);
        }
    });
    $('#dropzone button').click(function(){           
        dropzone.processQueue();
    });
    $("form").submit(function(){
        event.preventDefault();
    });
});

function checkType(file) {
    console.log(file);
    if(extension === "gif" && (type === "supergif" || type === undefined)) {
        supergif(file);
    } else if((extension === "jpg" || extension === "png") && (type === "image" || type === undefined)) {
        image(file);
    } else if(extension === "mp4" && type === undefined) {
        video(file);
    }  else if(extension === "zip" && type === undefined) {
        banner(file);
    } else {
        dropzone.removeFile(file);
        alert("Only images(jpg, png), banners(zip), videos(mp4) and supergifs(gif) are alowed.\nYou can multiply upload images or supergifs");
    }
}

function supergif(file) {
    type = "supergif";
    $("#type").val(type);
    
    $("form.dropzone .input.number").show();
    $("#width").val(file.width);
    $("#height").val(height += file.height);
}

function image(file) {
    type = "image";
    $("#type").val(type);
}

function video(file) {
    type = "video";
    $("#type").val(type);
    
    $("form.dropzone .input.number").show();
    var split = file.name.split(/\.|x/g);
    if(parseInt(split[0]) > 0 && parseInt(split[0]) > 0) {
        $('#width').val(split[0]);
        $('#height').val(split[1]);
    }
}

function banner(file) {
    type = "banner";
    $("#type").val(type);
    
    $("form.dropzone .input.number").show();
    $("form.dropzone .input.number").show();
    var split = file.name.split(/\.|x/g);
    if(parseInt(split[0]) > 0 && parseInt(split[1]) > 0) {
        $('#width').val(split[0]);
        $('#height').val(split[1]);
    }
}
