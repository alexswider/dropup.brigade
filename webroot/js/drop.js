var dropper;
var results;
var count = 0;

$(document).ready(function() {
    droper();
    $('#save-order').click(function() {
        saveOrder();
    });
});

function saveOrder() {
    var order = [];
    $('.asset').each(function(i) {
        order[i] = $(this).attr('id');
    });
    order = JSON.stringify(order);
    $('#orderAsset').val(order);
}

function droper() {
    if (typeof window.FileReader === 'undefined')
        alert('File API & FileReader not supported');

    dropper = document.getElementById("dropzone");
    results = document.getElementById("dropzone");

    dropper.ondragover = function () { dropper.className = 'hover'; return false; };
    dropper.ondragend = function () { dropper.className = ''; return false; };
    dropper.ondragleave = function () {dropper.className = ''; return false; };
    dropper.ondrop = function (e) {
        e.preventDefault();
        var files = [].slice.call(e.dataTransfer.files);
        files.forEach(function (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                fileLoaded(file.name, event.target.result);
            };
            reader.readAsDataURL(file);
            dropper.className = '';
        });
        return false;
      };
}
    
function fileLoaded(filename, dataUri) {
    
    results.innerHTML = '';
    $('#new-asset > #info').slideDown('slow');

    if(/^data:image/.test(dataUri)) {
        if(count > 0) {
            results.innerHTML = "<p>Multi images: " + parseInt(count + 1) +"</p>";
        } else {
            results.style.height = 'auto';
            var img = document.createElement("img");
            img.src = dataUri;
            results.appendChild(img);
        }
        $('#images-' + count).val(dataUri)
            .after('<input type="hidden" name="images[' + ++count + ']" id="images-' + count + '">');
    } else {
        var name = document.createElement("p");
        name.innerHTML = filename;
        results.appendChild(name);
        $('#base64').val(dataUri);
        var split = filename.split(/\.|x/g);
        $('#width').val(split[0]);
        $('#height').val(split[1]);
    }
}