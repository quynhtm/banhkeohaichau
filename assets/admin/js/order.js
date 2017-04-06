$(document).ready(function() {

});
var Order = {
    changeNumberBuy:function(productId){
        if(parseInt(productId) > 0){
            var number_buy = $('#sys_number_buy_'+productId).val()
            var product_price_sell = $('#sys_product_price_sell_'+productId).val();

            var total_product_price_sell = number_buy*product_price_sell;
            $('#sys_total_product_price_sell_'+productId).html(Order.numberFormat(total_product_price_sell) + 'đ');
            $('#total_product_price_sell_hiden_'+productId).val(total_product_price_sell);

            //hiển thị lại tổng tiền
            var tong_money = 0;
            $('input.total_product_price_sell_hiden').each(function() {
                tong_money = parseInt(tong_money) + parseInt($(this).val());
            });
            $('#sys_total_money').html(Order.numberFormat(tong_money) + 'đ');
        }
    },
    getInforProduct:function(){
        var order_product_id = $('#sys_order_product_id').val();
        if(order_product_id != ''){
            $('#sys_show_infor_cart').html('');
            jQuery.ajax({
                type: "get",
                url: WEB_ROOT + '/admin/managerOrder/getInforProduct',
                data: {order_product_id : order_product_id},
                dataType: 'json',
                success: function(res) {
                    if(res.intReturn === 1){
                        $('#sys_show_infor_cart').html(res.html);
                    }else{
                        alert(res.msg, 'Thông báo');
                    }
                }
            });
        }
    },
    numberFormat: function (number, decimals, dec_point, thousands_sep) {
        var n = number,
            prec = decimals;
        n = !isFinite(+n) ? 0 : +n;
        prec = !isFinite(+prec) ? 0 : Math.abs(prec);
        var sep = (typeof thousands_sep == "undefined") ? '.' : thousands_sep;
        var dec = (typeof dec_point == "undefined") ? ',' : dec_point;
        var s = (prec > 0) ? n.toFixed(prec) : Math.round(n).toFixed(prec);
        var abs = Math.abs(n).toFixed(prec);
        var _, i;
        if (abs >= 1000) {
            _ = abs.split(/\D/);
            i = _[0].length % 3 || 3;
            _[0] = s.slice(0, i + (n < 0)) + _[0].slice(i).replace(/(\d{3})/g, sep + '$1');
            s = _.join(dec);
        } else {
            s = s.replace(',', dec);
        }
        return s;
    },
}