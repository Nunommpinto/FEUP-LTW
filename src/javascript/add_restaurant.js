var form;
var name;
var description;
var submitBtn;

var necessaryTypes;

$(document).ready(function() {
    necessaryTypes = 1;
    form = $('#form-component');
    name = $('#form-component input[type="text"]')
    submitBtn = form.children('input[type="submit"]');
    //submitBtn.attr("disabled", false);
});

function checkAllTyped() {
    if($.trim(this.value) != "")
        necessaryTypes--;

    if(necessaryTypes == 0)
        submitBtn.attr("disabled", false);
}