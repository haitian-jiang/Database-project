$(document).ready(function () {
    var InputCount=3;
    $("#AddMoreTextBox").click(function (e)
    {
        InputCount++;
        $("#InputsWrapper").append('<label></label><input type="text" name="news[]" id="news_' + InputCount + '" value="Text '+ InputCount +'"/><br/><br/>');
    });
});