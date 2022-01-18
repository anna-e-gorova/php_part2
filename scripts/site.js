$(document).ready(function(){
    if ($('#promo').length > 0) {
        $('#content').removeAttr('id');
    }
});

function addToCart(goodId, userId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=addToCart', 
        type: 'POST', 
        data: {product: goodId,
                userId: userId}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
		}
    });
    alert("Товар добавлен");
};

function viewMore() {
    let lastView = $("#catGoods .shopUnit").last().attr('data-id');
    $.ajax({
        url: 'index.php?c=Ajax&act=moreGoods',
        method: 'POST', 
        data: {"lastView" : lastView},
        success: function(data){
            $("#catGoods").append(data);
        }}); 
};

function delFromCart(goodId, userId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=delFromCart', 
        type: 'POST', 
        data: {product: goodId,
                userId: userId}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
		}
    });
    alert("Товар удален");
};

function createOrder(id) {
    $.ajax({
        url: 'index.php?c=Ajax&act=createOrder', 
        type: 'POST', 
        data: {userId: id}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
		}
    });
    alert("Заказ оформлен");
};



