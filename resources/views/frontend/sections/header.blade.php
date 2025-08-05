 <!-- preloader -->
        <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">x</div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="R.C." class="letters-loading">
                                R.C.
                            </span>
                           
                            <span data-text-preloader="L" class="letters-loading">
                                L
                            </span>
                            <span data-text-preloader="o" class="letters-loading">
                                o
                            </span>
                            <span data-text-preloader="g" class="letters-loading">
                                g
                            </span>
                            <span data-text-preloader="i" class="letters-loading">
                                i
                            </span>
                            <span data-text-preloader="s" class="letters-loading">
                                s
                            </span>
                            <span data-text-preloader="t" class="letters-loading">
                                t
                            </span>
                            <span data-text-preloader="i" class="letters-loading">
                                i
                            </span>
                            <span data-text-preloader="c" class="letters-loading">
                                c
                            </span>
                            <span data-text-preloader="s" class="letters-loading">
                                s
                            </span>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <!-- preloader end -->


        <!--Search Popup-->
        <div id="search-popup" class="search-popup">
            <div class="popup-inner">
                <div class="upper-box clearfix">
                    <figure class="logo-box pull-left"><a href="#"><img src="{{ asset('frontend/assets/images/logo-7.png') }}" alt="" style="max-width: 150px; height: auto;"></a></figure>
                    <div class="close-search pull-right"><i class="fa-solid fa-xmark"></i></div>
                </div>
                <div class="overlay-layer"></div>
                <div class="auto-container">
                    <div class="search-form">
                        <form method="post" action="https://st.ourhtmldemo.com/new/Machion/index.html">
                            <div class="form-group">
                                <fieldset>
                                    <input type="search" class="form-control" name="search-input" value="" placeholder="Type your keyword and hit" required >
                                    <button type="submit"><i class="flaticon-loupe"></i></button>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- main header -->
        <header class="main-header">
            <!-- header-top -->
            <div class="header-top">
                <div class="outer-container">
                    <ul class="social-links clearfix">
                        <li><h5>Social Connect</h5></li>
                        <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-square-twitter"></i></a></li>
                        <li><a href="#"><i class="fa-solid fa-basketball"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                    </ul>
                    <div class="text">
                        
                        <h5><a href="mailto:info@machino.com" style="color:inherit;;">Email : info@machino.com</a></h5>
                    </div>
                    <ul class="links-list clearfix">
                        <li><a href="tel:+919826000000">+91 9826000000</a></li>
                        <li>/</li>
                        <li><a href="tel:+919826000000">+91 9826000000</a></li>
                        
                    </ul>
                </div>
            </div>
            <!-- header-lower -->
            <div class="header-lower">
                <div class="outer-container">
                    <div class="outer-box">
                        <div class="menu-left-content">
                            <figure class="logo-box"><a href="#"><img src="{{ asset('frontend/assets/images/logo-7.png') }}" alt="" style="max-width: 100px; height: auto;"></a></figure>
                            {{-- <div class="search-box-outer search-toggler">
                                <h5><i class="flaticon-loupe"></i>Search</h5>
                            </div> --}}
                        </div>
                        <div class="menu-area clearfix">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li class="current dropdown"><a href="{{ route('frontend.home') }}">Home</a>
                                            
                                        </li>  
                                        <li class="dropdown"><a href="#">Overview</a>
                                            <ul>
                                                <li><a href="{{ route('frontend.about') }}">About</a></li>
                                                <li><a href="{{ route('frontend.team') }}">Team</a></li>
                                                <li><a href="{{ route('frontend.cmd') }}">CMD Message</a></li>                                           
                                                <li><a href="{{ route('frontend.certificate') }}">Certificates</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown"><a href="{{ route('frontend.service') }}">Services</a>
                                            <ul>
                                                <li><a href="#">Service 1</a></li>
                                                <li><a href="#">Service 2</a></li>
                                                <li><a href="#">Service 3</a></li>
                                                <li><a href="#">Service 4</a></li>
                                            </ul>
                                        </li> 
                                        <li class="dropdown"><a href="#">Investors</a>
                                            <ul>
                                                <li><a href="#">Investor 1</a></li>
                                                <li><a href="#">Investor 2</a></li>
                                                <li><a href="#">Investor 3</a></li>
                                            </ul>
                                        </li> 
                                        <li><a href="{{ route('frontend.blog') }}">Blog</a></li>  
                                        <li><a href="">Network</a></li>
                                        <li class="dropdown"><a href="#">Media</a>
                                            <ul>
                                                <li><a href="{{ route('frontend.press-coverage') }}">Press Coverage</a></li>
                                                <li><a href="{{ route('frontend.photo') }}">Photo Gallery</a></li>
                                                <li><a href="{{ route('frontend.video') }}">Video Gallery</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-right-content">
{{-- <ul class="option-list clearfix">
                                <li><a href="#"><i class="flaticon-user"></i></a></li>
                                <li><a href="#"><i class="flaticon-internet"></i></a></li>
                            </ul>
                            <div class="btn-box">
                                <div class="icon-box"><i class="flaticon-estimation"></i></div>
                                <a href="#">Get a quote<i class="flaticon-right-chevron"></i></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="outer-container">
                    <div class="outer-box">
                        <div class="menu-left-content">
                            <figure class="logo-box"><a href="#"><img src="{{ asset('frontend/assets/images/logo-7.png') }}" alt="" style="max-width: 100px; height: auto;"></a></figure>
                            
                        </div>
                        <div class="menu-area clearfix">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                        <div class="menu-right-content">
                            {{-- <ul class="option-list clearfix">
                                <li><a href="#"><i class="flaticon-user"></i></a></li>
                                <li><a href="#"><i class="flaticon-internet"></i></a></li>
                            </ul>
                            <div class="btn-box">
                                <div class="icon-box"><i class="flaticon-estimation"></i></div>
                                <a href="#">Get a quote<i class="flaticon-right-chevron"></i></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><a href="#"><img src="{{ asset('frontend/assets/images/logo-7.png') }}" alt="" title="" style="max-width: 100px; height: auto;"></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
                <div class="contact-info">
                    <h4>Contact Info</h4>
                    <ul>
                        <li>Chicago 12, Melborne City, USA</li>
                        <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                        <li><a href="mailto:info@example.com">info@example.com</a></li>
                    </ul>
                </div>
                <div class="social-links">
                    <ul class="clearfix">
                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                        <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                        <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                    </ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->