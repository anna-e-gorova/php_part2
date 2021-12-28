$(document).ready(function(){
    if ($('#promo').length > 0) {
        $('#content').removeAttr('id');
    }
});

function addToCart(goodId, userId) {
    $.ajax({
        url: 'serverCart.php', 
        type: 'POST', 
        data: {product: goodId,
                userId: userId}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
		}
    });
    alert("Товар добавлен");
};

var startFrom = 25;
function viewMore() {
        $.ajax({
            url: 'getGoodLimit.php',
            method: 'POST', 
            data: {"lastView" : startFrom},
            }).done(function(data){
            data = jQuery.parseJSON(data);
            if (data.length > 0) {
            $.each(data, function(index, data){
            $("#catGoods").append("<div class='shopUnit'><img src='images/goods/small/" + data.img + "'/><div class='shopUnitName'>" + data.name + "</div><div class='shopUnitShortDescription'>" +  data.description.substr(0, 200) + "</div><div class='shopUnitPrice'>Цена: " + data.price + "</div><a href='index.php?page=product&id=" + data.id + "' class='shopUnitMore'>Подробнее</a></div>");
            });
            startFrom += 25;
            }});
};

function delFromCart(goodId, userId) {
    $.ajax({
        url: 'serverCart.php', 
        type: 'POST', 
        data: {product: goodId,
                userId: userId,
                action: 'del'}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
		}
    });
    alert("Товар удален");
};

function createOrder(id) {
    $.ajax({
        url: 'createOrder.php', 
        type: 'POST', 
        data: {userId: id}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
		}
    });
    alert("Заказ оформлен");
};



