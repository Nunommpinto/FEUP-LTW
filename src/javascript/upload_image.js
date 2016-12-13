var numImages;      //used so that every image has a different class

$(document).ready(function () {
    numImages = 1;

    $("#btn_add_more").click(function () {
        deleteCanceledImages();

        var lastImage = $(".image" + numImages);
        if (lastImage.val()) {
            numImages++;

            var fileDiv = $("<div/>", {
                class: 'file_div' + numImages
            });

            var title = $("<input/>", {
                type: 'text',
                name: 'title' + numImages
            });

            var inputDiv = $("<input/>", {
                type: 'file',
                class: "image" + numImages,
                name: 'image[]'
            });

            $(this).before(fileDiv);
            $(".file_div" + numImages).append(title);
            $(".file_div" + numImages).append(inputDiv);
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