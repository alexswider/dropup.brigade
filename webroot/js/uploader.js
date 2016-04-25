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
    dropzone.on("addedfile", function(file) {
        extension = file.name.split(".")[file.name.split(".").length - 1];
        if(extension !== "jpg" && extension !== "png" && extension !== "gif") {
            checkType(file);
        }
    });
    $('#dropzone button').click(function(){           
        dropzone.processQueue();
    });
    dropzone.on("sending", function(file) {
        var $elem = $("body, *");
        $elem.attr('style', $elem.attr('style') + '; ' + 'cursor: wait !important');
        $('#dropzone button').attr('disabled', 'disabled');
    });
    $("form.dropzone").submit(function(){
        event.preventDefault();
    });
    dropzone.on("success", function(file) {
        location.reload();
    });
    $('.show-meta').click(function() {
        $(this).html() === "▼" ? $(this).html('▲') : $(this).html('▼');
        $(this).next('.meta').toggle();
    });
    $('#assets').sortable();
    $('#save-order').click(function() {
        saveOrder();
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

function saveOrder() {
    var order = [];
    $('.asset').each(function(i) {
        order[i] = $(this).attr('id');
    });
    order = JSON.stringify(order);
    $('#orderAsset').val(order);
}

function formatBytes(bytes,decimals) {
   if(bytes === 0) return '0 Byte';
   var k = 1000; // or 1024 for binary
   var dm = decimals + 1 || 3;
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
   var i = Math.floor(Math.log(bytes) / Math.log(k));
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
