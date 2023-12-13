$(function () {
    //fancyfileuplod
    $('#demo').FancyFileUpload({
        params: {
            action: 'fileuploader'
        },
        maxfilesize: 10000000
    });
});