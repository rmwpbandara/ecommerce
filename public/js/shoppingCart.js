// ***************************************************
// Shopping Cart functions

var shoppingCart = (function () {
    // Private methods and properties
    var cart = [];

    function Item(name, price, count,productId,shippingCost) {
        this.name = name
        this.price = price
        this.count = count
        this.productId = productId
        this.shippingCost = shippingCost
    }

    function saveCart() {
        localStorage.setItem("shoppingCart", JSON.stringify(cart));
    }

    function loadCart() {
        cart = JSON.parse(localStorage.getItem("shoppingCart"));
        if (cart === null) {
            cart = []
        }
    }

    loadCart();



    // Public methods and properties
    var obj = {};

    obj.addItemToCart = function (name, price, count, productId,shippingCost) {
        for (var i in cart) {
            if (cart[i].name === name) {
                cart[i].count += count;
                saveCart();
                return;
            }
        }

        console.log("addItemToCart:", name, price, count, productId,shippingCost);

        var item = new Item(name, price, count, productId,shippingCost);
        cart.push(item);
        saveCart();

        //console.log(cart);
    };

    //console.log(cart);


    obj.setCountForItem = function (name, count) {
        for (var i in cart) {
            if (cart[i].name === name) {
                cart[i].count = count;
                break;
            }
        }
        saveCart();
    };


    obj.removeItemFromCart = function (name) { // Removes one item
        for (var i in cart) {
            if (cart[i].name === name) { // "3" === 3 false
                cart[i].count--; // cart[i].count --
                if (cart[i].count === 0) {
                    cart.splice(i, 1);
                }
                break;
            }
        }
        saveCart();
    };


    obj.removeItemFromCartAll = function (name) { // removes all item name
        for (var i in cart) {
            if (cart[i].name === name) {
                cart.splice(i, 1);
                break;
            }
        }
        saveCart();
    };

    obj.clearCart = function () {
        cart = [];
        saveCart();
    }


    obj.countCart = function () { // -> return total count
        var totalCount = 0;
        for (var i in cart) {
            totalCount += cart[i].count;
        }

        return totalCount;
    };

    obj.totalCart = function () { // -> return total cost
        var totalCost = 0;
        for (var i in cart) {
            totalCost += cart[i].price * cart[i].count;
        }
        return totalCost.toFixed(2);
    };

//calculate total shipping cost------------------------------------------------
    obj.totalCartShipping = function () { // -> return total shipping
        var totalCostShipping = 0;
        for (var i in cart) {
            totalCostShipping = Math.floor(totalCostShipping)+Math.floor(cart[i].shippingCost) ;
        }
        //alert(totalCostShipping);
        return totalCostShipping;
    };



    obj.listCart = function () { // -> array of Items
        var cartCopy = [];
        //console.log("Listing cart:",cart);
        for (var i in cart) {
            //console.log(i);
            var item = cart[i];
            var itemCopy = {};
            for (var p in item) {
                itemCopy[p] = item[p];
            }
            itemCopy.total = (item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy);
        }
        //
        //console.log('cartCopy is : ');
        //console.log(cartCopy);
        return cartCopy;


    };

    // ----------------------------
    return obj;
})();




