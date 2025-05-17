<footer class="footer footer-light">
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <!-- About Section -->
                    <div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0 text-center text-lg-left">
                        <div class="widget widget-about">
                            <img src="{{ url($getSystemSettingApp->getLogo()) }}" class="footer-logo" alt="Footer Logo" width="180" height="40">
                            <p class="mb-4 text-dark">{{ $getSystemSettingApp->footer_description }}</p>
                            <div class="social-icons">
                                @if (!empty($getSystemSettingApp->fb_link))
                                    <a href="{{ url($getSystemSettingApp->fb_link) }}" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                @endif
                                @if (!empty($getSystemSettingApp->ig_link))
                                    <a href="{{ url($getSystemSettingApp->ig_link) }}" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                @endif
                                @if (!empty($getSystemSettingApp->ytb_link))
                                    <a href="{{ url($getSystemSettingApp->ytb_link) }}" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Useful Links -->
                    <div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0 text-center text-lg-left">
                        <div class="widget">
                            <h4 class="widget-title">Useful Links</h4>
                            <ul class="widget-list">
                                @php
                                    $pages = \App\Models\Page::getRecord();
                                    $count = 0;
                                @endphp
                                @foreach ($pages as $page)
                                    @if ($count >= 4)
                                        @break
                                    @else
                                        <li>
                                            <a href="{{ url($page->slug) }}">{{ $page->title }}</a>
                                        </li>
                                        @php
                                            $count++;
                                        @endphp
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Customer Service -->
                    <div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0 text-center text-lg-left">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4>
                            <ul class="widget-list">
                                @php
                                    $pages = \App\Models\Page::getRecord();
                                    $count = 0;
                                @endphp
                                @foreach ($pages as $page)
                                    @if ($count < 4)
                                        @php
                                            $count++;
                                        @endphp
                                        @continue
                                    @else
                                        <li>
                                            <a href="{{ url($page->slug) }}">{{ $page->title }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- My Account -->
                    <div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0 text-center text-lg-left">
                        <div class="widget">
                            <h4 class="widget-title">Tài khoản của tôi</h4>
                            <ul class="widget-list">
                                <li><a href="{{ route('front.cart') }}">Giỏ hàng</a></li>
                                <li><a href="{{ route('front.checkout') }}">Theo dõi đơn hàng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-8 text-right">
                        <p class="footer-copyright">Copyright © {{ date('Y') }} {{ $getSystemSettingApp->website_name }}. All Rights Reserved.</p>
                    </div>
                    <div class="col-4 text-right">
                        <figure class="footer-payments">
                            <img src="{{ url($getSystemSettingApp->getFooterPaymentIcon()) }}" alt="Payment methods" width="200" height="20">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </footer>
