/**
 * Created by Wasantha on 12/7/2017.
 */
//open navigation menu
function openNav() {
    document.getElementById("mySidenav").style.width = "16%";
    document.getElementById("main").style.marginLeft = "16%";

    var iconSide = document.getElementById("iconSide");
    iconSide.classList.remove("glyphicon-chevron-right");
    iconSide.classList.add('glyphicon-chevron-left');

    var element = document.getElementById("icon");
    element.removeAttribute("onclick");
    element.setAttribute("onclick", 'closeNav()');
}
//close navigation menu
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";

    var iconSide = document.getElementById("iconSide");
    iconSide.classList.remove("glyphicon-chevron-left");
    iconSide.classList.add('glyphicon-chevron-right');

    var element = document.getElementById("icon");
    element.removeAttribute("onclick");
    element.setAttribute("onclick", 'openNav()');


}


//price filter slider

$(function () {

    var slider = document.getElementById('slider-range');

    noUiSlider.create(slider, {
        start: [0, 50000],
        connect: false,
        range: {
            'min': [0, 0.5],
            '10%': [5, 1],
            '50%': [100, 5],
            '60%': [1000, 50],
            '75%': [5000, 50],
            '90%': [12000, 10000],
            'max': [50000]
        }
    });


    var snapValues = [
        document.getElementById('slider-snap-value-lower'),
        document.getElementById('slider-snap-value-upper'),
        document.getElementById('lower-range'),
        document.getElementById('upper-range')
    ];

    slider.noUiSlider.on('update', function (values, handle) {
        snapValues[0].innerHTML = values[0];
        snapValues[1].innerHTML = values[1];
        snapValues[2].value = values[0];
        snapValues[3].value = values[1];
    });
});

//default loading home content
$.get(
    "welcome",
    function (data) {
        $("#content").html(data);
    }
);

//loading content after onclick
$(document).ready(function() {
    $('.links').on('click', function(){
        var id = $(this).attr('id');

        //remove active class
        $('a').removeClass('active');
        $(this).addClass('active');

        //load content page
        $.get(
            id,
            function (data) {
                $("#content").html(data);
            }
        );
    });
});


//post products data

//$(document).on('click', '#addProductBtn', function() {
//    var form = $('#saveProduct')[0];
//    var data = new FormData(form);
//
//    console.log(data);
//    $.ajax({
//        method: 'POST',
//        url: '/addproduct',
//        enctype :"multipart/form-data",
//        processData : false,
//
//
//        data: data,
//
//        //mimeType: "multipart/form-data",
//
//        success: function(msg){
//            console.log("Returned "+msg);
//        },
//        error: function(msg){
//            console.log("Error occurred!"+msg);
//        }
//    });
//});

