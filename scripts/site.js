$(document).ready(function(){
    if ($('#promo').length > 0) {
        $('#content').removeAttr('id');
    }
    $("#buttonA").click(function(event){
        event.preventDefault();
    });
});

function refreshCart(userId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=refreshCart',
        method: 'POST', 
        data: {userId: userId},
        success: function(data){
            $("#cart").replaceWith("<div id='cart'>"+data+"</div>");
        }
    }); 
};

function addToCart(goodId, userId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=addToCart', 
        type: 'POST', 
        data: {goodId: goodId,
                userId: userId}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
		}
    });
    alert("Товар добавлен");
    refreshCart(userId);
};

function viewMore() {
    let lastView = $("#catGoods .shopUnit").last().attr('data-id');
    $.ajax({
        url: 'index.php?c=Ajax&act=moreGoods',
        method: 'POST', 
        data: {lastView: lastView},
        success: function(data){
            $("#catGoods").append(data);
        }
    }); 
};

function galary(goodId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=galary',
        method: 'POST', 
        data: {goodId: goodId},
        success: function(data){
            $("body").append("<div class='popup'>"+
            "<div class='popup_bg'></div>"+"<div class='popup_img'>"+data+"<div>"+
            "</div>");
            $(".modalWindow").click(function(){
              $('.bigImg').remove();  
              var img = $(this);
              var src = img.attr('src');
              src = src.replace("small", "big");
              $(".popup_img").append("<img src='"+src+"' class='bigImg'/>");
            }); 
            $(".popup").fadeIn(800);
            $(".popup_bg").click(function(){  
                $(".popup").fadeOut(800);
                setTimeout(function() {
                  $(".popup").remove();
                }, 800);
            });

        }
    }); 
};

function delFromCart(goodId, userId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=delFromCart', 
        type: 'POST', 
        data: {goodId: goodId,
                userId: userId}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
		}
    });
    alert("Товар удален");
    refreshCart(userId);
};

function cleanCart(userId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=cleanCart', 
        type: 'POST', 
        data: {userId: userId}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
		}
    });
    alert("Товары удалены");
    refreshCart(userId);
};

function createOrder(userId) {
    if (!userId){
        window.location.href = 'index.php?c=User&act=auth';
    } else {
        $.ajax({
            url: 'index.php?c=Ajax&act=createOrder', 
            type: 'POST', 
            data: {userId: userId}, 
            error: function (req, text, error) {
                alert('Ошибка!' + text + ' | ' + error);
		    }
        });
        alert("Заказ оформлен");
    }
};

function delOrder(orderId) {
        $.ajax({
            url: 'index.php?c=Ajax&act=delOrder', 
            type: 'POST', 
            data: {orderId: orderId}, 
            error: function (req, text, error) {
                alert('Ошибка!' + text + ' | ' + error);
		    }
        });
        alert("Заказ удален");
};

function changeStatusOrder(orderId) {
    let newStatus = $("#"+orderId+" > td > select").val();
    $.ajax({
        url: 'index.php?c=Ajax&act=changeStatusOrder', 
        type: 'POST', 
        data: {orderId: orderId,
            newStatus: newStatus}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
        }
    });
    $("#"+orderId+" > td > #orderStatus").text(newStatus);
    alert("Статус изменен");
};


function delRating(ratingId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=delRating', 
        type: 'POST', 
        data: {ratingId: ratingId}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
        }
    });
    alert("Отзыв удален");
};

function changeStatusRating(ratingId) {
let newStatus = $("#"+ratingId+" > td > select").val();
$.ajax({
    url: 'index.php?c=Ajax&act=changeStatusRating', 
    type: 'POST', 
    data: {ratingId: ratingId,
        newStatus: newStatus}, 
    error: function (req, text, error) {
        alert('Ошибка!' + text + ' | ' + error);
    }
});
$("#"+ratingId+" > td > #active").text(newStatus);
alert("Статус изменен");
};

function changeStatusGood(goodId) {
    let newStatus = $("#"+goodId+" > td > select").val();
    $.ajax({
        url: 'index.php?c=Ajax&act=changeStatusGood', 
        type: 'POST', 
        data: {goodId: goodId,
            newStatus: newStatus}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
        }
    });
    $("#"+goodId+" > td > #active").text(newStatus);
    alert("Статус изменен");
};

function delUser(userId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=delUser', 
        type: 'POST', 
        data: {userId: userId}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
        }
    });
    alert("Пользователь удален");
};

function changeStatusUser(userId) {
let newStatus = $("#"+userId+" > td > #selectStatus").val();
$.ajax({
    url: 'index.php?c=Ajax&act=changeStatusUser', 
    type: 'POST', 
    data: {userId: userId,
        newStatus: newStatus}, 
    error: function (req, text, error) {
        alert('Ошибка!' + text + ' | ' + error);
    }
});
$("#"+userId+" > td > #active").text(newStatus);
alert("Статус изменен");
};

function changeGroupUser(userId) {
    let newGroup = $("#"+userId+" > td > #selectGroup").val();
    $.ajax({
        url: 'index.php?c=Ajax&act=changeGroupUser', 
        type: 'POST', 
        data: {userId: userId,
            newGroup: newGroup}, 
        error: function (req, text, error) {
            alert('Ошибка!' + text + ' | ' + error);
        }
    });
    $("#"+userId+" > td > #group").text(newGroup);
    alert("Группа изменена");
};