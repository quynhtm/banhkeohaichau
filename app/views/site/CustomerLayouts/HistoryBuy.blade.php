<div class="container mb">
	<div class="post-page">
		<div class="content-post-info-user">
			<h1 class="title-head changeinfo">
				<span href="{{URL::route('customer.historyBuy')}}" title="Lịch sử mua hàng">Lịch sử mua hàng</a>
			</h1>
			@if(sizeof($data) > 0)
				<div class="span clearfix"> @if($total >0) Có tổng số <b>{{$total}}</b> đơn hàng @endif </div>
				<br>
				<table class="list-shop-cart-item ext">
					<tbody>
					<tr class="first">
						<th width="5%" class="text-center">STT</th>
						<th width="15%">Thông tin đơn hàng</th>
						<th width="8%" class="text-right">Phí ship</th>
						<th width="10%" class="text-right">Tổng tiền</th>
						<th width="25%" class="text-left">Thông tin khách hàng</th>
						<th width="6%" class="text-center">Ngày đặt</th>
						<th width="6%" class="text-center">Trạng thái</th>
						<th width="6%" class="text-center">Vận chuyển</th>
					</tr>
					@foreach ($data as $key => $item)
						<tr>
							<td class="text-center text-middle">{{ $stt + $key+1 }}</td>
							<td>
								Mã ĐH: <b>{{ $item->order_id }}</b>
								<br/>Mã SP: <b>{{ $item->order_product_id }}</b>
								<br/>Tổng SL: <b>{{ $item->order_total_buy }}</b> sp
							</td>
							<td class="text-right">
								<b class="red">{{ FunctionLib::numberFormat($item->order_money_ship) }} đ</b>
							</td>
							<td class="text-right">
								<b class="red">{{ FunctionLib::numberFormat($item->order_total_money) }} đ</b>
							</td>
							<td>
								@if($item->order_customer_name != '')N: <b>{{ $item->order_customer_name }}</b><br/>@endif
								@if($item->order_customer_phone != '')P: {{ $item->order_customer_phone }}<br/>@endif
								@if($item->order_customer_email != '')E: {{ $item->order_customer_email }}<br/>@endif
								@if($item->order_customer_address != '')Add: {{ $item->order_customer_address }}<br/>@endif
								@if($item->order_customer_note != '')<span class="red">**Ghi chú: {{ $item->order_customer_note }}</span>@endif
							</td>
							<td class="text-center text-middle">
								@if($item->order_type == CGlobal::order_type_site)
									<a href="javascript:void(0);" title="Đặt hàng online-{{$item->order_type}}">
										<i class="fa fa-shopping-cart fa-2x"></i>
									</a><br/>
								@endif
								@if($item->order_type == CGlobal::order_type_shop)
									<a href="javascript:void(0);" title="Đặt hàng từ shop-{{$item->order_type}}">
										<i class="fa fa-home fa-2x"></i>
									</a><br/>
								@endif
								{{ date ('H:i:s d-m-Y',$item->order_time_creater) }}
							</td>

							<!--Trạng thái-->
							<td class="text-center text-middle">
								@if($item->order_status == CGlobal::order_status_new)
									<a href="javascript:void(0);" title="Đơn hàng mới -{{$item->order_status}}">
										<img src="{{Config::get('config.WEB_ROOT')}}assets/admin/img/order/new.png">
									</a>
								@endif
								@if($item->order_status == CGlobal::order_status_confirm)
									<a href="javascript:void(0);" title="Đơn hàng đã xác nhận -{{$item->order_status}}">
										<img src="{{Config::get('config.WEB_ROOT')}}assets/admin/img/order/da-xac-nhan.png">
									</a>
								@endif
								@if($item->order_status == CGlobal::order_status_succes)
									<a href="javascript:void(0);" title="Đơn hàng hoàn thành -{{$item->order_status}}">
										<img src="{{Config::get('config.WEB_ROOT')}}assets/admin/img/order/hoan-thanh.png">
									</a>
								@endif
								@if($item->order_status == CGlobal::order_status_remove)
									<a href="javascript:void(0);" title="Đơn hàng hủy -{{$item->order_status}}">
										<img src="{{Config::get('config.WEB_ROOT')}}assets/admin/img/order/huy.png">
									</a>
								@endif
							</td>

							<!--Vận chuyển-->
							<td class="text-center text-middle">
								@if($item->order_is_cod == CGlobal::order_cod_chuagiao)
									<a href="javascript:void(0);" title="Chưa chuyển hàng -{{$item->order_is_cod}}">
										<img src="{{Config::get('config.WEB_ROOT')}}assets/admin/img/order/delivery_miss.png">
									</a>
								@endif
								@if($item->order_is_cod == CGlobal::order_cod_da_gan)
									<a href="javascript:void(0);" title="Đã gán cho COD -{{$item->order_is_cod}}">
										<img src="{{Config::get('config.WEB_ROOT')}}assets/admin/img/order/COD.png">
									</a>
									<br/>{{$item->order_user_shipper_name}}
								@endif
								@if($item->order_is_cod == CGlobal::order_cod_danggiao)
									<a href="javascript:void(0);" title="COD đang giao hàng -{{$item->order_is_cod}}">
										<img src="{{Config::get('config.WEB_ROOT')}}assets/admin/img/order/delivery_move.png">
									</a>
									<br/>{{$item->order_user_shipper_name}}
								@endif
								@if($item->order_is_cod == CGlobal::order_cod_da_giaohang)
									<a href="javascript:void(0);" title="COD đã giao hàng -{{$item->order_is_cod}} ">
										<img src="{{Config::get('config.WEB_ROOT')}}assets/admin/img/order/delivery_suss.png">
									</a>
									<br/>{{$item->order_user_shipper_name}}
								@endif
								@if($item->order_is_cod == CGlobal::order_cod_hoantra)
									<a href="javascript:void(0);" title="COD hoàn trả hàng-{{$item->order_is_cod}}">
										<img src="{{Config::get('config.WEB_ROOT')}}assets/admin/img/order/icon-delivery-cancel.png">
									</a>
									<br/>{{$item->order_user_shipper_name}}
								@endif
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="text-right">
					{{$paging}}
				</div>
			@else
				<div class="alert">
					Không có dữ liệu
				</div>
			@endif
		</div>
	</div>
</div>