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


//checkbox

$('#local-shipping-checkbox').change(function(){
    $("#shippingLocal").prop("disabled",$(this).is(':checked'));
});

$('#international-shipping-checkbox').change(function(){
    $("#shippingInternational").prop("disabled",$(this).is(':checked'));
});


//-------------------------------------------------------------------------price filter slider

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


//-------------------------------------------------------------------------------------add to cart
$(".add-to-cart").click(function(event){
    event.preventDefault();
    var authId = $(this).attr("data-auth-id");
    //alert(authId);
    var shippingCost=0;

    if(authId==0){
        window.location = "/login";
    }
    else{
        var name = $(this).attr("data-name");
        var price = Number($(this).attr("data-price"));
        var productId = Number($(this).attr("data-product-id"));
        var authCountry = $(this).attr("data-auth-country");
        var sellerCountry = $(this).attr("data-seller-country");
        if(authCountry==sellerCountry){
            var localShippingCost = $(this).attr("data-shipping-local");
            shippingCost = localShippingCost;
        }
        else{
            var internationalShippingCost = $(this).attr("data-shipping-international");
            shippingCost = internationalShippingCost;
        }

        var element =$(this).closest('span');
        var productOrderQty = Number(element.children('input').attr('value'));

        if(productOrderQty==null||productOrderQty==undefined||productOrderQty==0){
            alert("Enter Quantity . .");
        }

        else{
            shoppingCart.addItemToCart(name, price, productOrderQty, productId,shippingCost);
            displayCart();
            changeBtn(element);
            $(this).remove();
        }
    }
    //console.log("addItemToCart:", name, price, productId,shippingCost);
});


$('.item-qty').bind('keyup change', function() {
    var id = this.id;
    var value = this.value;
    var element = document.getElementById(id);
    element.removeAttribute("value");
    element.setAttribute("value",value);
});

function changeBtn(element){
    element.children('input').remove();
    element.children('.modify-cart').show().html('Modify Cart');
}


$(".modify-cart").click(function(event){
    window.location = "/mycart";
});


$("#clear-cart").click(function(event){
    shoppingCart.clearCart();
    displayCart();
    //clearData();
});


function displayCart() {
    var cartArray = shoppingCart.listCart();
    //console.log('cartArray=',cartArray);
    var output = "";

    for (var i in cartArray) {
        output += "<span class='col-sm-3 cart-product-name'>"+cartArray[i].name+"</span>"
            +" <input class='item-count col-sm-2' type='number' data-name='" +cartArray[i].name +"' value='"+cartArray[i].count+"' >"
            +" <button class='plus-item col-sm-1' data-name='" +cartArray[i].name+"'><i class='glyphicon glyphicon-plus-sign'></i></button>"
            +" <button class='subtract-item col-sm-1' data-name='" +cartArray[i].name+"'><i class='glyphicon glyphicon-minus-sign'></i></button>"
            +" <span class='col-sm-2 cart-product-price'> "+cartArray[i].price+"</span>"
            +"<span class='col-sm-2 cart-product-total'>"+cartArray[i].total+"</span>"
            +" <button class='delete-item col-sm-1 cart-product-delete' data-product-id='" +cartArray[i].productId+"' data-name='" +cartArray[i].name+"'><i class='glyphicon glyphicon-remove-sign'></i></button>";

    }


    $(".item-qty").html(shoppingCart.countCart());

    $("#show-cart").html(output);
    $("#count-cart").html( shoppingCart.countCart() );
    $("#total-cart").html( shoppingCart.totalCart() );

    //shipping calculate
    var totalCart = Math.floor(shoppingCart.totalCart());
    var totalShippingCost = Math.floor(shoppingCart.totalCartShipping());
    var orderTotal = totalCart+totalShippingCost;

    $("#shipping-value").html(totalShippingCost.toFixed(2));
    $("#order-total").html(orderTotal.toFixed(2));
}



$("#show-cart").on("click", ".delete-item", function(event){
    var name = $(this).attr("data-name");
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
});

$("#show-cart").on("click", ".subtract-item", function(event){
    var name = $(this).attr("data-name");
    shoppingCart.removeItemFromCart(name);
    displayCart();
});

$("#show-cart").on("click", ".plus-item", function(event){
    var name = $(this).attr("data-name");
    shoppingCart.addItemToCart(name, 0, 1);
    displayCart();
});

$("#show-cart").on("change", ".item-count", function(event){
    var name = $(this).attr("data-name");
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();
});

displayCart();





//Favorite button


//-------------------------------------------------------------------------------------add to cart
$(".add-to-favorite-btn").click(function(event){
    event.preventDefault();
    var authId = $(this).attr("data-auth-id");
    if(authId==0){
        window.location = "/login";
    }
    else{
        var productId = Number($(this).attr("data-product-id"));
        alert(productId);
    }
});



















//default loading home content
//$.get(
//    "welcome",
//    function (data) {
//        $("#content").html(data);
//    }
//);

//loading content after onclick
//$(document).ready(function() {
//    $('.links').on('click', function(){
//        var id = $(this).attr('id');
//
//        //remove active class
//        $('a').removeClass('active');
//        $(this).addClass('active');
//
//        //load content page
//        $.get(
//            id,
//            function (data) {
//                $("#content").html(data);
//            }
//        );
//    });
//});


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

