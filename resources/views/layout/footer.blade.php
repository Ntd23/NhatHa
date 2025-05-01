<footer class="footer footer-dark">
  {{-- <div class="cta bg-image bg-dark pt-4 pb-5 mb-0" style="background-image: url(assets/images/demos/demo-10/bg-2.jpg);">
    <div class="container" style="background:rgb(24, 23, 23);">
      <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8 col-lg-6">
          <div class="cta-heading text-center">
            <h3 class="cta-title text-white">Subscribe for Our Newsletter</h3>
            <p class="cta-desc text-white">and receive <span class="font-weight-normal">$20 coupon</span> for first
              shopping</p>
          </div>

          <form action="#">
            <div class="input-group input-group-round">
              <input type="email" class="form-control form-control-white" placeholder="Enter your Email Address"
                aria-label="Email Adress" required>
              <div class="input-group-append">
                <button class="btn btn-white" type="submit"><span>Subscribe</span><i
                    class="icon-long-arrow-right"></i></button>
              </div><!-- .End .input-group-append -->
            </div><!-- .End .input-group -->
          </form>
        </div><!-- End .col-sm-10 col-md-8 col-lg-6 -->
      </div>
    </div>
  </div> --}}
  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="widget widget-about">
            <img src="{{url($getSystemSettingApp->getLogo())}}" class="footer-logo" alt="Footer Logo" width="105"
              height="25">
            <p>{{$getSystemSettingApp->footer_description}}</p>

            <div class="social-icons">
						@if(!empty($getSystemSettingApp->fb_link))
              <a href="{{url($getSystemSettingApp->fb_link)}}" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
						@endif
						@if(!empty($getSystemSettingApp->ig_link))
              <a href="{{url($getSystemSettingApp->ig_link)}}" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
						@endif
						@if(!empty($getSystemSettingApp->ytb_link))
              <a href="{{url($getSystemSettingApp->ytb_link)}}" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
						@endif
            </div><!-- End .soial-icons -->
          </div><!-- End .widget about-widget -->
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="widget">
            <h4 class="widget-title">Useful Links</h4>

            <ul class="widget-list">
              <li><a href="about.html">About Molla</a></li>
              <li><a href="#">How to shop on Molla</a></li>
              <li><a href="faq.html">FAQ</a></li>
              <li><a href="{{route('front.contact')}}">Contact</a></li>
              <li><a href="login.html">Log in</a></li>
            </ul>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="widget">
            <h4 class="widget-title">Customer Service</h4>

            <ul class="widget-list">
              <li><a href="#">Payment Methods</a></li>
              <li><a href="#">Money-back guarantee!</a></li>
              <li><a href="#">Returns</a></li>
              <li><a href="#">Shipping</a></li>
              <li><a href="#">Terms and conditions</a></li>
              <li><a href="#">Privacy Policy</a></li>
            </ul>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="widget">
            <h4 class="widget-title">Tài khoản của tôi</h4>
            <ul class="widget-list">
              <li><a href="{{route('front.cart')}}">Giỏ hàng</a></li>
              <li><a href="{{route('front.checkout')}}">Theo giõi đơn hàng</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <p class="footer-copyright">Copyright © {{date('Y')}} {{$getSystemSettingApp->website_name}}. All Rights Reserved.</p>
      <figure class="footer-payments">
        <img src="{{url($getSystemSettingApp->getFooterPaymentIcon())}}" alt="Payment methods" width="272" height="20">
      </figure>
    </div>
  </div>
</footer>
