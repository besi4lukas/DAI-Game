
var game_id = parseInt(document.getElementById("game_id").value) ;
var idnumber = parseInt(document.getElementById("idnumber").value) ;
$.post("/projectx/dai/public/api/player",
    {
        "game_id": game_id
    } )
    .done(function (response) {
        report = response;
        console.log(report);
        console.log(idnumber);
        button = document.getElementById("coin")
        is_your_turn = (idnumber == report);
        button.disabled = !(is_your_turn);
        if (is_your_turn){
            button.innerText = "Guess";
            button.style.backgroundColor = "red";
        } else {
            button.innerText = "Waiting";
            button.style.backgroundColor = "gray";
        }
    }).fail(function (error){
    console.log(error);
});


function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode > 9))
        return false;

    return true;
}

function posting() {

    var number = document.getElementById("number1").value + document.getElementById("number2").value + document.getElementById("number3").value;
    var idnumber = parseInt(document.getElementById("idnumber").value) ;
    var game_id = parseInt(document.getElementById("game_id").value) ;
    var report = 2;

    toSubmit = {
        "player_id": idnumber,
        "game_id": game_id,
        "number": number
    }

    console.log(toSubmit);

    $.post("/projectx/dai/public/api/guess",
           toSubmit )
    .done(function (response) {
           report = response;
           console.log(report);
    }).fail(function (error){
            console.log(error);
    });

}