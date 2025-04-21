@extends('app')
@section('css')
@endsection
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">{{ $meta_title }}</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $meta_title }}</li>
            </ol>
        </div>
    </nav>
    @php
    $user = Auth::user();
    @endphp
    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <form id="SubmitForm" method="post">
								{{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Thông tin giao hàng</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Họ *</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ !empty($user->last_name) ? $user->last_name : '' }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Tên *</label>
                                    <input type="text" class="form-control" name="first_name" value="{{ !empty($user->first_name) ? $user->first_name : '' }}" required>
                                </div>
                            </div>
                            <label>Công ty (Không bắt buộc)</label>
                            <input type="text" class="form-control" name="company_name" value="{{ !empty($user->company_name) ? $user->company_name : '' }}">

                            <label>Quốc gia*</label>
                            <input type="text" class="form-control" name="country" value="{{ !empty($user->country) ? $user->country : '' }}" required>

                            <label>Địa chỉ (Số nhà, Đường / Văn phòng, Chung cư) *</label>
                            <input type="text" class="form-control" name="address_one" value="{{ !empty($user->address_one) ? $user->address_one : '' }}" required>
                            <input type="text" class="form-control" name="address_two" value="{{ !empty($user->address_two) ? $user->address_two : '' }}" required>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Tỉnh/Thành Phố *</label>
                                    <input type="text" class="form-control" name="city" value="{{ !empty($user->city) ? $user->city : '' }}" required>
                                </div>

                                <div class="col-sm-6">
                                    <label>Quận / Huyện *</label>
                                    <input type="text" class="form-control" name="district" value="{{ !empty($user->district) ? $user->district : '' }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Mã bưu điện (Không bắt buộc)</label>
                                    <input type="text" class="form-control" name="postcode" value="{{ !empty($user->postcode) ? $user->postcode : '' }}" required>
                                </div>

                                <div class="col-sm-6">
                                    <label>Điện thoại *</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ !empty($user->phone) ? $user->phone : '' }}" required>
                                </div>
                            </div>

                            <label>Địa chỉ email *</label>
                            <input type="email" class="form-control" name="email" required>
                            @if (empty(Auth::check()))
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_create" class="custom-control-input createAccount" id="checkout-create-acc">
                                <label class="custom-control-label" for="checkout-create-acc">Tạo tài khoản?</label>
                            </div><!-- End .custom-checkbox -->
                            <div id="showPassword" style="display: none;">
                                <label>Mật khẩu *</label>
                                <input type="text" name="password" id="inputPassword" class="form-control">
                            </div>
                            @endif
                            <label>Ghi chú (Không bắt buộc)</label>
                            <textarea class="form-control" cols="30" rows="4" name="notes"></textarea>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Đơn hàng của tôi</h3><!-- End .summary-title -->
                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::getContent() as $key => $cart)
                                        @php
                                        $getCartProduct = App\Models\Product::getSingle($cart->id);
                                        @endphp
                                        <tr>
                                            <td style="font-size: larger;"><a href="{{ $getCartProduct->slug }}">{{ $getCartProduct->title }}</a></td>
                                            <td style="font-size: larger;">@money($cart->price * $cart->quantity)</td>
                                        </tr>
                                        @endforeach
                                        <tr class="summary-subtotal">
                                            <td style="font-size: larger;">Giá tiền:</td>
                                            <td style="font-size: larger;">@money(Cart::getSubTotal())</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr>
                                            <td colspan="2">
                                                <div class="cart-discount">
                                                    <div class="input-group">
                                                        <input type="text" id="getDiscountCode" name="discount_code" class="form-control" placeholder="Mã giảm giá">
                                                        <div class="input-group-append">
                                                            <button type="button" id="ApplyDiscount" class="btn btn-primary" style="height: 40px;">
                                                                <i class="icon-long-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: larger;">Giảm :</td>
                                            <td style="font-size: larger;"><span id="getDiscountAmount">0</span>VND</td>
                                        </tr>
                                        <tr class="summary-shipping">
                                            <td style="font-size: larger;">Phương thức giao hàng</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        @foreach ($getShipping as $shipping)
                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="shipping" value="{{$shipping->id}}" id="free-shipping{{$shipping->id}}" data-price="{{!empty($shipping->price) ? $shipping->price : 0}}" class="custom-control-input getShippingCharge">
                                                    <label for="free-shipping{{$shipping->id}}" class="custom-control-label">{{$shipping->name}}</label>
                                                </div>
                                            </td>
                                            <td>
                                                @if(!empty($shipping->price))@money($shipping->price) @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="summary-subtotal">
                                            <td>Tổng:</td>
                                            <td style="font-size: larger;"><span id="getPayableTotal">@money(Cart::getSubTotal())</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="getShippingCharge" value="0">
                                <input type="hidden" id="PayableTotal" value="{{Cart::getSubTotal()}}">
                                <div class="accordion-summary" id="accordion-payment">
                                    @if(!empty($getPaymentSetting->is_cash_delivery))
                                    <div class="custom-control custom-radio mt-0">
                                        <input type="radio" name="payment_method" value="cash" id="CashOnDelivery" class="custom-control-input">
                                        <label for="CashOnDelivery" class="custom-control-label">Thanh toán khi nhận hàng</label>
                                    </div>
                                    @endif
                                    @if(!empty($getPaymentSetting->is_stripe))
                                    <div class="custom-control custom-radio mt-0">
                                        <input type="radio" name="payment_method" value="stripe" id="CreditCard" class="custom-control-input">
                                        <label for="CreditCard" class="custom-control-label">Stripe</label>
                                    </div>
                                    @endif
                                </div><!-- End .accordion -->

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button><br><br>
                                <img src="{{ url('assets/images/payments-summary.png') }}">
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div>
                </form>
            </div>
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main>
@endsection

@section('script')
<script>
$('body').delegate('.createAccount','change', function() {
	if(this.checked) {
		$('#showPassword').show()
		$('#inputPassword').prop('required',true)
	}else{
		$('#showPassword').hide()
		$('#inputPassword').prop('required',false)
	}
})
$('body').delegate('.getShippingCharge','change',function() {
	var price= $(this).attr('data-price')
	var total= $('#PayableTotal').val()
	$('#getShippingCharge').html(price)
	var final_total= parseFloat(price) +parseFloat(total)
	$('#getPayableTotal').html(final_total.toFixed())
})
$('body').delegate('#ApplyDiscount','click',function() {
	var discount_code= $('#getDiscountCode').val()
	$.ajax({
		type: 'POST',
		url: '{{route('front.appy_discount_code')}}',
		data: {
			'_token':'{{csrf_token()}}',
			discount_code: discount_code
		},
		dataType: 'json',
		success: function(data) {
			$('#getDiscountAmount').html(data.discount_amount)
			var shipping= $('#getShippingCharge').val()
			var final_total=parseFloat(shipping)+parseFloat(data.payable_total)
			$('#getPayableTotal').html(final_total.toFixed().toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }))
			$('#PayableTotal').val(data.payable_total)
			if(data.status==false) alert(data.message)
		},
		error: function() {}
	})
})
$('body').delegate('#SubmitForm','submit',function(e) {
	e.preventDefault()
	$.ajax({
		type: 'POST',
		url: '{{route('front.place_order')}}',
		data: new FormData(this),
		processData: false,
		contentType: false,
		dataType:'json',
		success: function(data) {
			if(data.status==false){
				alert(data.message)
			}else {
				window.location.href=data.redirect
			}
		},
		error:function(data) {}
	})
})

</script>
@endsection
