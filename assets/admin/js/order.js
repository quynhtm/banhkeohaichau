$(document).ready(function() {

});
var Order = {
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
}