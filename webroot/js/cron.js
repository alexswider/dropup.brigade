function getLog() {
    $.ajax({
        url: 'log.txt',
        dataType: 'text',
        success: function(text) {
            $("#logs").text(text);
            setTimeout(getLog, 3000); // refresh every 3 seconds
        }
    });
}

getLog();