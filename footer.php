<?php
/**
 * Created by PhpStorm.
 * User: xemss
 * Date: 26.01.2017
 * Time: 13:38
 */
?>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>

$(".toggleForm").click(function () {
    $("#logIn").toggle();
    $("#signUp").toggle();
});

$("#textarea").on('change keyup paste', function() {
    // your code here
    alert ("change");

    // didn't work at all
//    .ajax({
//        url: "updatedatabase.php",
//        type:  'POST',
//        data: {
//            content: $("#textarea").val()
//        }
//    })
//        .done(function(msg) {
////            console.log("success");
//             alert ("change" + msg);
//
//        })
//        .fail(function() {
////            console.log("error");
//            alert ("change");
//        })
//        .always(function() {
////            console.log("complete");
//            alert ("change");
//        });
//});

    $.ajax({

        url: "updatedatabase.php",
        type: "GET",
        success: function (data) {
//            alert("success");
//            console.log(data);

        }
    })
});

</script>

</body>
</html>
