var image_selector = document.getElementById('selected_image');
var image_flag = document.getElementById('selected_image_flag');

$('.uploaded_imagen').on('click', function(event) {
    var selected = $(event.currentTarget).val();
    image_selector.value = selected;
    image_flag.value = selected;
});