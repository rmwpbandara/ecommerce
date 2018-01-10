<html>

<head>
    <script src="/js/jquery-3.2.1/jquery-3.2.1.min.js"></script>

</head>

<body>
<form class="formData" >
    <label></label>
    <input name="testInput" type="text" class="test-class">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>

<button id="255" class="test">submit</button>

<script>
    $(".test").click(function(event){
        event.preventDefault();
        var id = $(this).attr("id");

        //console.log("a");

        var name = "";
        var value = "";
        var nameValueArr = [];
        $('input').each(function(i,e){

        });


        $.ajax({
            method: 'POST',
            url: '/postTest',

            data: {

            },
            success: function(msg){
                console.log("Returned "+msg);
            },
            error: function(msg){
                console.log("Error occurred!");
            }
        });
    });

</script>

</body>
</html>
