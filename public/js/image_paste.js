var uploaded_image = document.getElementById('uploaded_image');
var selected_image = document.getElementById('selected_image');
const open_button = document.getElementById('selecter_open');
uploaded_image.disabled = true;
selected_image.disabled = true;
open_button.disabled = true;

var selected_image_flag = document.getElementById('selected_image_flag');

$('.uploaded_image').on('click', function(event) {
    var selected = $(event.currentTarget).val();
    selected_image.value = selected;
    selected_image_flag.value = selected;
});

var radios = document.forms["inputus"].elements["i-radio"];
var checked_radio = "";
for (var i = 0; i < radios.length; i++) {
    radios[i].onclick = radioClicked;
    if (radios[i].checked){
        switch (radios[i].value){
            case "upload":
                uploaded_image.disabled = false;
                selected_image.disabled = true;
                open_button.disabled = true;
                break;
            case "select":
                uploaded_image.disabled = true;
                selected_image.disabled = false;
                open_button.disabled = false;
                break;
        }
    }
}

function radioClicked(){    
    switch (this.value){
        case "upload":
            uploaded_image.disabled = false;
            selected_image.disabled = true;
            open_button.disabled = true;
            break;
        case "select":
            uploaded_image.disabled = true;
            selected_image.disabled = false;
            open_button.disabled = false;
            break;
    }
}