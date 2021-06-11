$(document).ready(function () {
    $("#AddMoreTextBox").click(function ()
    {
        $("#InputsWrapper").append('<label></label><input type="text" name="news[]" id="news_' + InputCount + '" value="Text '+ InputCount +'"/><br/><br/>');
    });
});