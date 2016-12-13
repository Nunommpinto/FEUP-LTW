var numImages;

$(document).ready(function () {
    numImages = 1;

    $("#btn_add_more").click(function () {
        deleteCanceledImages();

        var lastImage = $(".image" + numImages);
        if (lastImage.val()) {
            numImages++;
            var fileDiv = $("<div/>", {
                id: 'file_div'
            });

            var inputDiv = $("<input/>", {
                type: 'file',
                class: "image" + numImages,
                name: 'image[]'
            });

            $(this).before(fileDiv.fadeIn('slow').append(inputDiv));
        } else
            alert("Can't");
    });
});

function deleteCanceledImages() {
    for(var i = 0; i < numImages; i++) {
        var image = $(".image" + i);
        if(!image.val())
            image.parent().remove();
    }
}