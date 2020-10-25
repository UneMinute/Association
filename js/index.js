feather.replace();

const positionControl = $('#position-form-control');

positionControl.not('.active').hide(0);

$('#office').change(function() {

    if($(this).is(":checked"))
        positionControl.show(300);
    else 
        positionControl.hide(300);
})