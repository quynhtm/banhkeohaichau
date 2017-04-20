<div class="get-mail-post-new">
    <div class="container">
        <div class="wrap-get-mail">
            <div class="col-lg-4 col-md-4 col-sm-12">
                Đăng ký nhận thông tin từ Hải Châu
                <br><span>để nắm bắt giá cả thị trường bánh kẹo Việt Nam</span>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="box-get-mail">
                    <input name="keyword" class="keywordMail" placeholder="Nhập địa chỉ email để nhận thông tin từ HẢI CHÂU" type="text">
                    <button type="submit" class="btn-mail">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-address">
    <div class="container">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="logo">
                <a href="{{URL::route('site.home')}}"></a>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="connect-us">
                <div class="title-connect">Follow  US</div>
                <div class="list-item-social">
                    <a class="bg ic icon-fb" href="{{CGlobal::linkFanpageFacebook}}" target="blank" rel="CGlobal">F</a>
                    <a class="bg ic icon-g" href="">G</a>
                    <a class="bg ic icon-i" href="">I</a>
                    <a class="bg ic icon-y" href="">Y</a>
                    <a class="bg ic icon-t" href="">T</a>
                    <a class="bg ic icon-p" href="">P</a>
                </div>
                <div class="title-connect">THÔNG TIN LIÊN HỆ</div>
                <div class="bg address-connect">{{$address}}</div>
                <div class="bg phone-connect">{{$phone}}</div>
            </div>
        </div>
    </div>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58f87870f7bbaa72709c7460/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->