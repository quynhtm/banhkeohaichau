<div class="container">
	<div class="post-page">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<h1 class="title-head cat"><a href="{{URL::route('site.pageContact')}}" title="Liên hệ">Liên hệ</a></h1>
			<div class="view-item-post">
				@if($messages != '')
					{{ $messages }}
				@endif

				{{Form::open(array('method' => 'POST', 'id'=>'formSendContact', 'class'=>'formSendContact', 'name'=>'txtForm'))}}
				<div class="form-group">
					<label class="control-label">Họ và tên<span>(*)</span></label>
					<input id="txtName" name="txtName" class="form-control" type="text">
				</div>
				<div class="form-group">
					<label class="control-label">Số điện thoại<span>(*)</span></label>
					<input id="txtMobile" name="txtMobile" class="form-control" type="text">
				</div>
				<div class="form-group">
					<label class="control-label">Email</label>
					<input id="txtEmail" name="txtEmail" class="form-control" type="text">
				</div>
				<div class="form-group">
					<label class="control-label">Nội dung<span>(*)</span></label>
					<textarea id="txtMessage" name="txtMessage" class="form-control" rows="5"></textarea>
				</div>
				<div class="form-group">
					<label class="control-label labelInputCaptchar">Xác nhận<span>(*)</span></label>
					<input type="text" id="securityCode" name="captcha" maxlength="255" class="txtInputCaptchar"/>
					<img id="imageCaptchar" src="{{URL::route('site.home')}}/captcha?rand=<?php echo rand();?>" class="imageCaptchar">
					<a href="javascript:void(0)" class="iconRefreh" onclick="SITE.refreshCaptcha();" title="Mã an toàn mới"></a>
				</div>
				<div class="form-group">
					<button type="submit" id="submitContact" class="btn btn-primary btn-ext">Gửi đi</button>
				</div>
				{{Form::close()}}
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="list-item-block addressContact">
				<div class="title-box-right">Địa chỉ và sơ đồ đường đi</div>
				<div class="address-contact">{{$info}}</div>
				<div class="address-contact">
					@if($arrInfo->info_img != '')
						<img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arrInfo->info_id, $arrInfo->info_img, 550, 0, '', true, true);}}" alt="">
					@else
					<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry&key=AIzaSyA-WIHdfuGBuWUCglOx2-yUB9oU_0498PU&language=vi"></script>
					{{FunctionLib::site_js('lib/map/maps.js', CGlobal::$POS_END);}}
					<div id="mapCanvas" style="width:500px; height:320px; overflow: hidden; border-radius:3px;"></div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>