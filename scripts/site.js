$(document).ready(function(){
    if ($('#promo').length > 0) {
        $('#content').removeAttr('id');
    }
    $("#buttonA").click(function(event){
        event.preventDefault();
    });

    $(".modalWindow").click(function(){
        var img = $(this);
      var src = img.attr('src');
      src = src.replace("small", "big");
      $("body").append("<div class='popup'>"+
                       "<div class='popup_bg'></div>"+
                       "<img src='"+src+"' class='popup_img' />"+
                       "</div>"); 
      $(".popup").fadeIn(800);
      $(".popup_bg").click(function(){  
          $(".popup").fadeOut(800);
          setTimeout(function() {
            $(".popup").remove();
          }, 800);
      });
  });
});

function refreshCart(userId) {
    $.ajax({
        url: 'index.php?c=Ajax&act=refreshCart',
        method: 'POST', 
        data: {userId: userId},
        success: function(data){
            $("#cart").replaceWith(data);
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



