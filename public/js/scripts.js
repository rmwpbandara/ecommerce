/**
 * Created by Wasantha on 12/7/2017.
 */
//-------------------------------------------------------------------------open navigation menu
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
//-------------------------------------------------------------------------close navigation menu
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
//-------------------------------------------------------------------------checkbox in sell page
$('#local-shipping-checkbox').change(function () {
    $("#shippingLocal").prop("disabled", $(this).is(':checked'));
});
$('#international-shipping-checkbox').change(function () {
    $("#shippingInternational").prop("disabled", $(this).is(':checked'));
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



///////////////////////////--------cart-----------------/////////////////////////



//-------------------------------------------------------------------------add to cart
$(".add-to-cart").click(function (event) {
    event.preventDefault();
    var authId = $(this).attr("data-auth-id");
    var cartArray = shoppingCart.listCart();

    //alert(authId);
    var shippingCost = 0;
    var sameSeller = 0;

    if (authId == 0) {
        window.location = "/login";
    }
    else {
        var name = $(this).attr("data-name");
        var price = Number($(this).attr("data-price"));
        var productId = Number($(this).attr("data-product-id"));
        var authCountry = $(this).attr("data-auth-country");
        var sellerCountry = $(this).attr("data-seller-country");
        var imageUrl = $(this).attr("data-image");
        var sellerId = $(this).attr("data-seller-id");

        for(var i in cartArray){
            if(cartArray[i].sellerId==sellerId){
                sameSeller =1;
                //alert(sameSeller);
            }
        }

        if ((authCountry == sellerCountry)&&(sameSeller==0)) {
            var localShippingCost = $(this).attr("data-shipping-local");
            shippingCost = localShippingCost;

            //alert('local cost:'+shippingCost);
        }
        else if(sameSeller==0){
            var internationalShippingCost = $(this).attr("data-shipping-international");
            shippingCost = internationalShippingCost;
            //alert('international cost:'+shippingCost);
        }

        var element = $(this).closest('span');
        var productOrderQty = Number(element.children('input').attr('value'));

        if (productOrderQty == null || productOrderQty == undefined || productOrderQty == 0) {
            alert("Enter Quantity . .");
        }

        else {
            shoppingCart.addItemToCart(name, price, productOrderQty, productId, shippingCost,imageUrl,sellerId);
            displayCart();

            //console.log(element);
            changeBtnCart(element);
            $(this).remove();
        }
    }
    //console.log("addItemToCart:", name, price, productId,shippingCost);
});

//-------------------------------------------------------------------------change quantity onchange
$('.item-qty').bind('keyup change', function () {
    var id = this.id;
    var value = this.value;
    var element = document.getElementById(id);
    element.removeAttribute("value");
    element.setAttribute("value", value);
});

//-------------------------------------------------------------------------change cart button added to the cart
function changeBtnCart(element) {
    element.children('input').prop('disabled', true);
    element.children('.modify-cart').show().html('Go to Cart');
}

//-------------------------------------------------------------------------lord cart after onclick go to cart button
$(".modify-cart").click(function (event) {
    window.location = "/mycart";
});

//-------------------------------------------------------------------------clear cart data
$("#clear-cart").click(function (event) {
    shoppingCart.clearCart();
    displayCart();
    //clearData();
});

//-------------------------------------------------------------------------display cart
function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    for (var i in cartArray) {
        output += "<span class='col-md-12'><span class='col-sm-2'><img style='max-height: 50px;max-width: 60px;' src='images/product-images/front-images/"+ cartArray[i].imageUrl+"'></span>"
            +"<span class='col-sm-2 cart-product-name'>" + cartArray[i].name + "</span>"
            + " <input class='item-count col-sm-1' type='number' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "' >"
            + " <button class='plus-item col-sm-1' data-name='" + cartArray[i].name + "'><i class='glyphicon glyphicon-plus-sign'></i></button>"
            + " <button class='subtract-item col-sm-1' data-name='" + cartArray[i].name + "'><i class='glyphicon glyphicon-minus-sign'></i></button>"
            + " <span class='col-sm-2 cart-product-price'> " + cartArray[i].price + "</span>"
            + "<span class='col-sm-2 cart-product-total'>" + cartArray[i].total + "</span>"
            + " <button class='delete-item col-sm-1 cart-product-delete' data-product-id='" + cartArray[i].productId + "' data-name='" + cartArray[i].name + "'><i class='glyphicon glyphicon-remove-sign'></i></button></span>";
    }

    $(".item-qty").html(shoppingCart.countCart());
    $("#show-cart").html(output);
    $("#count-cart").html(shoppingCart.countCart());
    $("#total-cart").html(shoppingCart.totalCart());

    //shipping calculate
    var totalCart = Math.floor(shoppingCart.totalCart());
    var totalShippingCost = Math.floor(shoppingCart.totalCartShipping());
    var orderTotal = totalCart + totalShippingCost;

    $("#shipping-value").html(totalShippingCost.toFixed(2));
    $("#order-total").html(orderTotal.toFixed(2));
}

//-------------------------------------------------------------------------delete cart item
$("#show-cart").on("click", ".delete-item", function (event) {
    var name = $(this).attr("data-name");
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
});

//-------------------------------------------------------------------------subtract cart items
$("#show-cart").on("click", ".subtract-item", function (event) {
    var name = $(this).attr("data-name");
    shoppingCart.removeItemFromCart(name);
    displayCart();
});

//-------------------------------------------------------------------------plus cart items
$("#show-cart").on("click", ".plus-item", function (event) {
    var name = $(this).attr("data-name");
    shoppingCart.addItemToCart(name, 0, 1);
    displayCart();
});

//-------------------------------------------------------------------------count cart items
$("#show-cart").on("change", ".item-count", function (event) {
    var name = $(this).attr("data-name");
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();
});

displayCart();


//////////////////////////////---------favourite----------//////////////////////////////



//-------------------------------------------------------------------------favourite add and view
function addToFavourite(element) {
    console.log(element.getAttribute('id'));

    var authId = element.getAttribute('data-auth-id');

    if (authId == 0) {
        window.location = "/login";
    }
    else {
        var productId = element.getAttribute("data-product-id");
        console.log('data :', authId, productId);

        $.ajax({
            type: 'POST',
            url: '/savefavourite',
            data: {
                "_token": $('#token').val(),
                "productId": productId,
                "authId": authId
            },
            success: function (data) {
                console.log(data);
            },
            error: function (reject) {
                console.log(reject);
            }
        });

        element.removeAttribute('onclick');
        element.setAttribute("onclick", "viewFavourite()");

        element.firstElementChild.removeAttribute('class');
        element.firstElementChild.setAttribute("class", "glyphicon glyphicon-heart");
        element.firstElementChild.setAttribute("title", "View Favourites");
        element.style.color = "orangered";
    }
}

function viewFavourite() {
    window.location = "/viewfavourite";
}

function removeFromFavourite(element){

    var authId = element.getAttribute('data-auth-id');
    var productId = element.getAttribute("data-product-id");
    //console.log('data :', authId, productId);

    $.ajax({
        type: 'POST',
        url: '/removeFavourite',
        data: {
            "_token": $('#token').val(),
            "productId": productId,
            "authId": authId
        },
        success: function (data) {
            console.log(data);
        },
        error: function (reject) {
            console.log(reject);
        }
    });

    element.closest(".element-outline").remove();
}


//-------------------------------------------------------------------------my account scripts
$(document).ready(function() {
    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
        // $(".tab").addClass("active"); // instead of this do the below
        $(this).removeClass("btn-default").addClass("btn-primary");
    });
});




//----------------------------------------------------------------------------change cart button in existing in cart

getAllElements();

function getAllElements(){
    var cartArray = shoppingCart.listCart();
    $.each(cartArray,function(i,e){
        $('#add-to-cart-btn-'+ e.productId).remove();
        $('#modify-cart-id-'+ e.productId).show().html('Go to Cart');
        $('#data-qty-'+ e.productId).val(e.count).prop('disabled', true);
    });
}


//----------------------------------------------------------------------------

function changeSubscribeBtn(element) {

    var sellerId = element.getAttribute("data-seller-id");
    var authId = element.getAttribute("data-auth-id");

    if(authId==0){
        window.location = "/login";
    }

    else {
        if(sellerId==authId){
            alert("you Subscribe Your Product");
        }
        else{

            $.ajax({
                type: 'POST',
                url: '/saveSubscribe',
                data: {
                    "_token": $('#token').val(),
                    "sellerId": sellerId,
                    "authId": authId
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (reject) {
                    console.log(reject);
                }
            });


            element.classList.remove('btn-danger');
            element.innerHTML = "Subscribed";
            element.removeAttribute('onclick');
            element.setAttribute("onclick", "changeSubscribedBtn(this)");
    }

    }
}

function changeSubscribedBtn(element){

    var sellerId = element.getAttribute("data-seller-id");
    var authId = element.getAttribute("data-auth-id");


    $.ajax({
        type: 'POST',
        url: '/saveSubscribe',
        data: {
            "_token": $('#token').val(),
            "sellerId": sellerId,
            "authId": authId
        },
        success: function (data) {
            console.log(data);
        },
        error: function (reject) {
            console.log(reject);
        }
    });

        element.classList.add('btn-danger');
        element.innerHTML = "Subscribe";
        element.removeAttribute('onclick');
        element.setAttribute("onclick", "changeSubscribeBtn(this)");
}


