@if(isset($inforProduct) && !empty($inforProduct))
    <table class="table table-bordered table-hover">
        <tr style="background-color: #c0a16b">
            <th width="2%" class="text-center text-middle">STT</th>
            <th width="5%" class="text-center text-middle">ID SP</th>
            <th width="35%">Sản phẩm</th>
            <th width="20%">Danh mục</th>
            <th width="10%" class="text-right">Giá bán</th>
            <th width="5%" class="text-center text-middle">SL</th>
            <th width="10%" class="text-right">Tổng tiền</th>
        </tr>
        <?php $total_product = 0; $total_money = 0;?>
        @foreach($inforProduct as $k=> $product)
            <tr>
                <td class="text-center text-middle">{{$k+1}}</td>
                <td class="text-center text-middle">{{$product->product_id}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->category_name}}</td>
                <td class="text-right"><b>{{FunctionLib::numberFormat($product->product_price_sell)}} đ</b></td>
                <td class="text-center text-middle">
                    <div><input type="text" class="form-control input-sm" id="sys_number_buy" name="number_buy" placeholder="Mã sản phẩm: 1,2,3" value="1"></div>
                </td>
                <td class="text-right"><b class="red">{{FunctionLib::numberFormat($product->product_price_sell*1)}} đ</b></td>
                <?php
                $total_product = $total_product + 1;
                $total_money = $total_money + ($product->product_price_sell*1);
                ?>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" class="text-right"><b>Tổng số lượng hàng:</b></td>
            <td colspan="2" class="text-left"><b>{{FunctionLib::numberFormat($total_product)}}</b></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right"><b>Tổng tiền:</b></td>
            <td colspan="2" class="text-left"><b class="red">{{FunctionLib::numberFormat($total_money)}} đ</b></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right"><b>Tiền ship:</b></td>
            <td colspan="2" class="text-left">
                <div><input type="text" class="form-control input-sm" id="sys_order_money_ship" name="order_money_ship" value="15.000"></div>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-right"><b>Tổng tiền thanh toán:</b></td>
            <td colspan="2" class="text-left"><b class="red" style="font-size: 18px">{{FunctionLib::numberFormat($total_money+15000)}} đ</b></td>
        </tr>
    </table>
@endif