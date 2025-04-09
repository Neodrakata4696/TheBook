var image_id_box = document.getElementById('selected_image');
var image_selector = document.getElementById('selected_image_path');
var image_flag = document.getElementById('selected_image_flag');

$('.uploaded_image_selector').on('click', function(event) {
    var image_id = $(event.target).attr('id');
    image_id_box.value = image_id;
    var selected = $(event.target).attr('alt');
    image_selector.value = selected;
    image_flag.value = selected;
});