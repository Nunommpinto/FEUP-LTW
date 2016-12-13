var numImages;

$(document).ready(function () {
    numImages = 1;

    $("#btn_add_more").click(function () {
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
        } else {
            alert("Can't");
            console.info(numImages);
        }
    });
});