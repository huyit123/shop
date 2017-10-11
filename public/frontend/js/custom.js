function addtocart(id) {
    var quantity = $('#quantityaddtocart').val();
    if (typeof quantity == 'undefined') {
        quantity = 1;
    }
    $.ajax({
        type: 'get',
        url: '/addtocart',
        data: {id: id, quantity: quantity},
        success: function (data) {
            $('#countcart').html(data);
            $.smallBox({
                title: "Thêm vào giỏ hàng thành công",
                content: "<i class='fa fa-clock-o'></i> <i>1 giây trước...</i>",
                color: "#5F895F",
                iconSmall: "fa fa-check bounce animated",
                timeout: 5000
            });
        },
    });
}

$('.quantity .plus').click(function () {
    var quantity = parseInt($(this).closest('.quantity').find('.qty').val());
    quantity += 1;
    $(this).closest('.quantity').find('.qty').val(quantity);
});
$('.quantity .minus').click(function () {
    var quantity = parseInt($(this).closest('.quantity').find('.qty').val());
    if (quantity != 1) {
        quantity -= 1;
        $(this).closest('.quantity').find('.qty').val(quantity);
    }
});
function updatetocart(el, id, status) {
    var submit = true;
    if (status == 'minus') {
        var value = $(el).closest('.buttons-add-minus').find('.qty').val();
        if (value == 1) {
            submit = false;
        }
    }
    if (submit) {
        $.ajax({
            type: 'get',
            url: '/cart/update',
            data: {id: id, status: status},
            success: function (data) {
                var cls = $(el).closest('.cart_item');
                cls.find('.subtotal-item .amount').html(data.item.subtotal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
                $('.tamtinh .amount').html(data.total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
                $('.tongtien strong').html(data.total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
                $('#countcart').html(data.count);

            },
        });
    }
}
$("#newsletter_forrm").submit(function (e) {
    e.preventDefault();
    var email = $(this).find('input[name="email"]').val();
    if ($(this).valid()) {
        $.ajax({
            type: 'post',
            url: '/newsletter',
            data: {email: email},
            success: function (data) {
                $('.msg-newsletter').css('display','block');
                $('.msg-newsletter').html(data);
            },
        });
    }

});