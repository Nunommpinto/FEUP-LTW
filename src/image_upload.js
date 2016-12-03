var photosComponent = $(".form-component #photo-component");
var photoComponent = photosComponent.children().first();

$(document).ready( function() {
    
})

photoComponent.on('click', function() {
    photoComponent.append(photoComponent);
});