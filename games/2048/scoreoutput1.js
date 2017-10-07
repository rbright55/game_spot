var score = laurenScore;
var uid = "789";

$.ajax({
        type: "GET",
        url: "storescore.php?score="+score+"&uid="+uid
        
        });

