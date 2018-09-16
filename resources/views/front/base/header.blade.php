<header id="masthead" class="site-header" role="banner">
    <div class="custom-header">
        <div class="custom-header-media">
            <div id="wp-custom-header" class="wp-custom-header">
                <img src="img/back.jpg" 
                     width="1920" height="900"
                     alt="Zona thần kinh" 
                     sizes="100vw">
            </div>
        </div>

        <div class="site-branding">
            <div class="wrap">
                <div class="site-branding-text">
                    <h1 class="site-title"><a href="http://doctor-local.vn/" rel="home">Zona thần kinh</a></h1>

                    <p class="site-description">Phương pháp chữa trị</p>
                </div>
                <!-- .site-branding-text -->
            </div>
            <!-- .wrap -->
        </div>
        <!-- .site-branding -->
    </div>
    <!-- .custom-header -->

    <div class="navigation-top">
        <div class="wrap">
            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Top Menu">
                <button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
                    <svg class="icon icon-bars" aria-hidden="true" role="img">
                        <use href="#icon-bars" xlink:href="#icon-bars"></use>
                    </svg>
                    <svg class="icon icon-close" aria-hidden="true" role="img">
                        <use href="#icon-close" xlink:href="#icon-close"></use>
                    </svg>Menu </button>

                @include('front.base.menu')
                <a href="#content" class="menu-scroll-down">
                    <svg class="icon icon-arrow-right" aria-hidden="true" role="img">
                        <use href="#icon-arrow-right" xlink:href="#icon-arrow-right"></use>
                    </svg><span class="screen-reader-text">Scroll down to content</span></a>
            </nav>
            <!-- #site-navigation -->
        </div>
        <!-- .wrap -->
    </div>
    <!-- .navigation-top -->
</header>
