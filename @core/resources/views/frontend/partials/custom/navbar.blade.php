<style>
  /* Style The Dropdown Button */
  .dropbtn {
    height: 50px;
    width: 50px;
    background-color: #e0e0e0;
    color: #000;
    font-weight: bold;
    font: 100px;
    padding: 16px;
    font-size: 16px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
  }

  /* The container <div> - needed to position the dropdown content */
  .dropdown {
    position: relative;
    display: inline-block;
    margin-right: 40px;
  }

  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    right: 50%;
    z-index: 1000000;
    /* Position the dropdown content to the left side */

  }

  /* Links inside the dropdown */
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {
    background-color: #f1f1f1
  }

  /* Show the dropdown menu on hover */
  .dropdown:hover .dropdown-content {
    display: block;
  }

  /* Change the background color of the dropdown button when the dropdown content is shown */
  .dropdown:hover .dropbtn {
    background-color: #f0f0f0;
  }
</style>
<header class="header">
  @include('frontend.partials.custom.supportbar')
  <div class="main-menu sticky-header">
    <div class="main-menu-inner">
      <div class="main-menu-left">
        <div class="main-menu-logo">
          {{-- <a href="index.html"><img src="assets/image/swiftpasslogo.png" alt="logo" width="40"></a> --}}
          <a href="{{ url('/') }}"> {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)) !!}
          </a>
        </div><!-- main-menu-logo -->
        <div class="navigation">
          <ul class="main-menu-list list-unstyled">
            {!! render_frontend_menu($primary_menu) !!}
            {{-- <li><a href="{{ url('/') }}">Home </a></li>

                        <li class="has-dropdown">
                            <a href="">Services</a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('frontend.service') }}">Services</a></li>
                                <li><a href="/service/cyber-security">Cyber Security</a></li>
                            </ul><!-- list-unstyled -->
                        </li><!-- has-dropdown -->

                        <li class="has-dropdown">
                            <a href="#">News</a>
                            <ul class="list-unstyled">
                                <li><a href="news.html">News</a></li>
                                <li><a href="news-details.html">News Details</a></li>
                            </ul><!-- list-unstyled -->
                        </li><!-- has-dropdown -->
                        <li><a href="about.html">About</a></li>

                        <li><a href="contact.html">Contact</a>
                        </li><!-- li --> --}}
          </ul><!-- main-menu-list -->
        </div><!-- navigation -->
      </div><!-- main-menu-left -->
      <div class="main-menu-right">
        <div class="mobile-menu-button mobile-nav-toggler">
          <span></span>
          <span></span>
          <span></span>
        </div><!-- mobile-menu-button -->
        {{-- <div class="search-box">
          <a href="#" class="search-toggler">
            <i class="flaticon-search-interface-symbol"></i>
          </a><!-- search-toggler -->
        </div><!-- search-box --> --}}
        <!-- Example split danger button -->

        @if (auth()->check())
          @php
            $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
          @endphp
          <div class="dropdown">
            <button class="dropbtn">{{ auth()->user()->username[0] }}</button>
            <div class="dropdown-content">
              <a href="{{ $route }}">{{ __('Dashboard') }}</a>

              <a href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </div>

          {{-- <li class="login-register">
            <a href="{{ $route }}">{{ __('Dashboard') }}</a>

            <a href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li> --}}
        @else
          <div class="main-menu-right-button">
            <a href="{{ route('user.login') }}" class="btn btn-primary">{{ __('Login') }}</a>
          </div><!-- main-menu-right-button -->
        @endif

      </div><!-- main-menu-right -->
    </div><!-- main-menu-inner -->
  </div><!-- main-menu -->
</header><!--header-->
