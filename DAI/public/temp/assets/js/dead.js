var axios = require('axios');

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode > 9))
        return false;

    return true;
}

function posting() {
    alert('you clicked');
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

    axios.post('/api/guess', toSubmit
    ).then(function (response) {
        report = response.data[0][0];
        console.log(report);
    }).catch(function (error){
        console.log(error);
    })


}