@php
  use Illuminate\Support\Str;
@endphp
{{-- @include('frontend.partials.homesupportbar') --}}
@include('frontend.partials.custom.navbar')

<section class="main-slider">
  <div class="main-slider-swiper owl-carousel owl-theme">
    @foreach ($all_header_slider as $data)
      <div class="item">
        <div class="item-slider-bg" {!! render_background_image_markup_by_attachment_id($data->image) !!}></div>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content">
                @if (!empty($data->subtitle))
                  <div class="slider-tagline">{{ $data->subtitle }}</div>
                @endif
                @if (!empty($data->title))
                  <h1 class="section-title">{{ $data->title }}
                    <br>
                    @if (!empty($data->description))
                      {{ $data->description }}
                    @endif
                  </h1>
                @endif
                @if (!empty($data->btn_01_status))
                  <a href="{{ $data->btn_01_url }}" class="btn btn-primary">{{ $data->btn_01_text }}
                  </a>
                @endif

              </div><!-- slider-content -->
            </div><!-- col-md-12 -->
          </div><!-- row -->
        </div><!-- container -->
      </div><!--item-->
    @endforeach

  </div><!-- main-slider-swiper -->
</section><!--main-slider-->
{{-- <section class="department-section">
  <div class="container">
    <div class="department-section-inner">
      <div class="row row-gutter-y-40">
        @foreach ($all_key_features->take(6) as $key => $data)
          <div class="col-xl-2 col-lg-4 col-md-6">
            <div class="department-card style-0{{ $key + 1 }}">
              <div class="department-card-icon">
                <a href="departments.html"><i class="{{ $data->icon }}"></i></a>
              </div><!-- department-card-icon -->
              <div class="department-card-content">
                <h5><a href="department-details.html">{{ $data->title }}</a></h5>
              </div><!-- department-card-content -->
            </div><!--department-card-->
          </div><!--col-xl-2 col-lg-4 col-md-6-->
        @endforeach

      </div><!-- row -->
    </div><!--department-section-inner-->
  </div><!-- container -->

</section> --}}

<section class="department-section">
  <div class="container">
    <div class="department-section-inner">
      <div class="row row-gutter-y-40">
        <div class="col-xl-2 col-lg-4 col-md-6">
          <div class="department-card">
            <div class="department-card-icon">
              <a href="/service"><i class="flaticon-bank"></i></a>
            </div><!-- department-card-icon -->
            <div class="department-card-content">
              <h5><a href="/service">Permanent Residency </a></h5>
            </div><!-- department-card-content -->
          </div><!--department-card-->
        </div><!--col-xl-2 col-lg-4 col-md-6-->
        <div class="col-xl-2 col-lg-4 col-md-6">
          <div class="department-card">
            <div class="department-card-icon">
              <a href="/service"><i class="flaticon-briefcase"></i></a>
            </div><!-- department-card-icon -->
            <div class="department-card-content">
              <h5><a href="/service">Jobs & Employment</a></h5>
            </div><!-- department-card-content -->
          </div><!--department-card-->
        </div><!--col-xl-2 col-lg-4 col-md-6-->
        <div class="col-xl-2 col-lg-4 col-md-6">
          <div class="department-card">
            <div class="department-card-icon">
              <a href="/service"><i class="flaticon-businessman"></i></a>
            </div><!-- department-card-icon -->
            <div class="department-card-content">
              <h5><a href="/service">Business & Industry</a></h5>
            </div><!-- department-card-content -->
          </div><!--department-card-->
        </div><!--col-xl-2 col-lg-4 col-md-6-->
        <div class="col-xl-2 col-lg-4 col-md-6">
          <div class="department-card">
            <div class="department-card-icon">
              <a href="/service"><i class="flaticon-art"></i></a>
            </div><!-- department-card-icon -->
            <div class="department-card-content">
              <h5><a href="/service">Visitation & Tourism</a></h5>
            </div><!-- department-card-content -->
          </div><!--department-card-->
        </div><!--col-xl-2 col-lg-4 col-md-6-->
        <div class="col-xl-2 col-lg-4 col-md-6">
          <div class="department-card">
            <div class="department-card-icon">
              <a href="/service"><i class="flaticon-education"></i></a>
            </div><!-- department-card-icon -->
            <div class="department-card-content">
              <h5><a href="/service">Academic Education</a></h5>
            </div><!-- department-card-content -->
          </div><!--department-card-->
        </div><!--col-xl-2 col-lg-4 col-md-6-->
        <div class="col-xl-2 col-lg-4 col-md-6">
          <div class="department-card">
            <div class="department-card-icon">
              <a href="/service"><i class="flaticon-balance"></i></a>
            </div><!-- department-card-icon -->
            <div class="department-card-content">
              <h5><a href="/service">Consultation Assesments </a></h5>
            </div><!-- department-card-content -->
          </div><!--department-card-->
        </div><!--col-xl-2 col-lg-4 col-md-6-->
      </div><!-- row -->
    </div><!--department-section-inner-->
  </div><!-- container -->

</section><!--department-section-->

<section class="about-section">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6">
        <div class="about-image">
          <div class="about-image-inner img-one">
            {{-- 301 x 565 --}}
            {{-- <img src="{{ asset('assets-custom/image/gallery/about-1.jpg') }}" class="img-fluid"
                            alt="img-2"> --}}
            {!! render_image_markup_by_attachment_id(filter_static_option_value('about_page_image_one', $static_field_data)) !!}

            <div class="sign-text">SwiftPass Global</div><!-- sign-text -->
            <div class="about-image-caption">
              <div class="about-image-caption-inner">
                <span class="about-caption-number">5+</span>
                <span class="about-caption-text">Years of<br>experience</span>
              </div><!-- about-image-caption-inner -->
            </div><!--about-image-caption-->
          </div><!--about-image-inner img-one-->
          <div class="about-image-inner img-two">
            <img src="{{ asset('assets-custom/image/shapes/about-3.jpg') }}" class="floated-image" alt="img-3">
            {{-- 240 x 566 --}}
            {{-- <img src="{{ asset('assets-custom/image/gallery/about-2.jpg') }}" class="img-fluid"
                            alt="img-4"> --}}
            {!! render_image_markup_by_attachment_id(filter_static_option_value('about_page_image_two', $static_field_data)) !!}

          </div><!--about-image-inner img-two-->
        </div><!--about-image-->
      </div><!--col-lg-6-->
      <div class="col-lg-6">
        <div class="about-inner">
          <div class="section-title-box">
            <div class="section-tagline">Our introductions</div><!-- section-tagline -->
            <h2 class="section-title">
              {{ filter_static_option_value('home_page_01_' . $user_select_lang_slug . '_about_us_title', $static_field_data) }}

            </h2>
            <p>
              {{ filter_static_option_value('home_page_01_' . $user_select_lang_slug . '_about_us_description', $static_field_data) }}

            </p>
          </div><!-- section-title-box -->

          <div class="about-author-box">
            <div class="about-author-image">

              {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_02_about_us_signature_image', $static_field_data)) !!}
            </div><!-- about-author-image -->
            <div class="about-author-box-meta">
              <h5>Mr. Duncan Wandera</h5>
              <span>Founder & C.E.O</span>
            </div><!-- about-author-box-meta -->
          </div><!--about-author-box-->
        </div><!-- about-inner -->
      </div><!--col-lg-6-->
    </div><!-- row -->
  </div><!-- container -->
</section><!--about-section-->

<section class="service-section">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6">
        <div class="section-title-box">
          <div class="section-tagline">Visa Services</div><!-- section-tagline -->
          <h2 class="section-title text-white">Explore our Online <br> Visa Services <br> & Resources</h2>
          <div class="section-text">
            <p></p>
          </div><!-- section-text -->
          <div class="service-arrow-image">
            <img src="{{ asset('assets-custom/image/shapes/arrow.png') }}" alt="img-6">
          </div><!-- service-arrow-image -->
        </div><!--section-title-box-->
      </div><!--col-lg-6-->
      <div class="col-lg-5">
        <div class="service-card">
          {{-- <div class="service-card-video">
            <a href="{{ filter_static_option_value('home_page_01_' . $user_select_lang_slug . '_about_us_video_url', $static_field_data) }}" class="video-popup">
              <i class="fa fa-play"></i>
            </a><!-- video-popup -->
          </div><!-- service-card-video --> --}}
          <ul class="list-unstyled">
            @foreach ($all_service->chunk(3)->take(2) as $row)
              @foreach ($row as $key => $data)
                <li>
                  <a href="{{ route('frontend.services.single', $data->slug) }}">{{ $data->title }}
                    <i class="fa-solid fa-chevron-right"></i>
                  </a>
                </li>
              @endforeach
            @endforeach
          </ul><!-- list-unstyled -->
          <div class="service-button">
            <a href="/service" class="btn btn-primary">View All</a>
          </div><!-- service-button -->
        </div><!--service-card-->
      </div><!--col-lg-5-->
    </div><!-- row -->
  </div><!-- container -->
</section><!--service-section-->

<section class="funfact-section">
  <div class="container">
    <div class="row">
      @foreach ($all_counterup as $data)
        <div class="col-xl-3 col-md-6">
          <div class="funfact-counter-item">
            <div class="funfact-counter-box">
              <div class="funfact-counter-icon">
                <i class="{{ $data->icon }}"></i>
              </div><!-- funfact-counter-icon -->
              <div class="funfact-counter-number">
                <h3 class="counter-number">{{ $data->number }}</h3>
                <span class="funfact-counter-number-postfix">{{ $data->extra_text }}</span>
              </div><!-- funfact-counter-number -->
            </div><!-- funfact-counter-box -->
            <p class="funfact-text">{{ $data->title }}<br></p>
          </div><!--funfact-counter-item-->
        </div><!--col-xl-3 col-md-6-->
      @endforeach
    </div><!-- row -->
  </div><!-- container -->
</section><!-- /.funfact-section -->

<section class="testimonial-section">
  <div class="container">
    <div class="testimonial-name">TESTIMONIALS</div>
    <div class="testimonial-slider">
      <div class="swiper testimonial-reviews">
        <div class="swiper-wrapper">
          @foreach ($all_testimonial->take(3) as $data)
            <div class="swiper-slide">
              <div class="testimonial-content">
                <div class="testimonial-ratings">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div><!-- testimonial-ratings -->
                <div class="testimonial-text">
                  {{ $data->description }}
                </div><!-- testimonial-text -->
                <div class="testimonial-thumb-card">
                  <h5>{{ $data->name }}</h5>
                  <span>{{ $data->designation }}</span>
                </div><!-- testimonial-thumb-card -->
              </div><!--testimonial-content-->
            </div><!--swiper-slide-->
          @endforeach
        </div><!-- swiper-wrapper -->
        <div class="swiper-pagination"></div>
      </div><!--swiper testimonial-reviews-->
      <div class="testimonial-thumb">
        <div class="swiper-wrapper">
          @foreach ($all_testimonial->take(3) as $data)
            <div class="swiper-slide">
              {!! render_image_markup_by_attachment_id($data->image) !!}
              <i class="fa-solid fa-quote-left"></i>
            </div><!-- swiper-slide -->
          @endforeach
        </div><!--swiper-wrapper-->
      </div><!--testimonial-thumb-->
    </div><!--testimonial-slider-->
  </div><!-- container -->
</section><!--testimonial-section-->


<section class="blog-section">
  <div class="container">
    <div class="blog-box">
      <div class="section-title-box text-center">
        <div class="section-tagline">DIRECT FROM THE BLOG POSTS</div>
        <h2 class="section-title">Checkout Latest News <br>and Articles</h2>
      </div><!-- section-title-box -->
    </div><!--blog-box-->
    <div class="row row-gutter-y-155">
      @foreach ($all_blog->take(3) as $data)
        <div class="col-lg-4">
          <div class="blog-card">
            <div class="blog-card-image">
              {!! render_image_markup_by_attachment_id($data->image) !!}
              <a href="{{ route('frontend.blog.single', $data->slug) }}"></a>
            </div><!-- blog-card-image -->
            <div class="blog-card-date">
              <a href="#">{{ date_format($data->created_at, 'd M Y') }}</a>
            </div><!-- blog-card-date -->
            <div class="blog-card-content">
              <div class="blog-card-meta">
                <span class="author">
                  by<a href="#">{{ $data->author }}</a>
                </span><!-- author -->
                <span class="comment">
                  <a href="#"> </a>
                </span><!-- comment -->
              </div><!-- blog-card-meta -->
              <h4>
                <a href="{{ route('frontend.blog.single', $data->slug) }}">
                  {{ Str::limit($data->title, $limit = 35, $end = '...') }}
                </a>
              </h4>
              {{-- <p> {{ Str::limit($data->excerpt, $limit = 50, $end = '...') }}</p> --}}
            </div><!-- blog-card-content -->
          </div><!-- blog-card -->
        </div><!-- col-lg-4 -->
        @if ($loop->iteration == 3)
        @break
      @endif
    @endforeach
  </div><!-- row -->
</div><!-- container -->
</section><!-- blog-section -->

<section class="client-section">
<h5 class="client-text">Our partners & suppoters</h5>
<div class="container">
  <div class="client-carousel owl-carousel owl-theme">
    @foreach ($all_brand_logo as $data)
      <div class="item">
        {!! render_image_markup_by_attachment_id($data->image) !!}
      </div><!--item-->
    @endforeach

  </div><!--client-carousel owl-carousel owl-theme-->
</div><!--container-->
</section><!--client-section-->

{{-- <section class="cta-five-section">
<div class="container">
    <div class="cta-five-card">
        <div class="cta-five-card-icon">
            <i class="flaticon-file"></i>
        </div><!-- cta-five-card-icon -->
        <div class="cta-five-content">
            <h4>Download Recent Documents</h4>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority<br> have suffered in
                some form, by injected humour words.</p>
        </div><!-- cta-five-content -->
        <div class="cta-five-button">
            <a href="#" class="btn btn-primary">Download Files</a>
        </div><!-- cta-five-button -->
        <div class="cta-five-img">
            <i class="flaticon-file"></i>
        </div><!-- cta-five-img -->
    </div><!--cta-five-card-->
</div><!-- container -->
</section><!--cta-five-section--> --}}


<section class="cta-two-section">
<div class="container">
  <div class="cta-two-section-inner ">
    <div class="row">
      <div class="col-xl-5">
        <div class="cta-two-title">
          <div class="cta-two-card-icon">
            <i class="flaticon-envelope-2"></i>
          </div><!-- cta-two-card-icon -->
          <div class="cta-two-card-content">
            <p>Stay Connected</p>
            <h3>Join Our Newsletter</h3>
          </div><!-- cta-two-card-content -->
        </div><!--cta-two-title-->
      </div><!--col-xl-5-->
      <div class="col-xl-7">
        <form action="{{ route('frontend.subscribe.newsletter') }}" class="container  cta-two-form" method="post">
          @csrf
          <div class="cta-two-form-group">
            <input type="email" id="email" class="input-text" placeholder="Email address" name="email" required>
          </div><!-- cta-two-card-form -->
          <button class="btn btn-primary ">Subscribe</button>
        </form><!-- cta-two-form -->
      </div><!-- col-xl-7-->
    </div><!-- row -->
  </div><!-- cta-two-section-inner -->
</div><!-- container -->
</section><!--cta-two-section-->

{{-- <section class="newsletter-area home-21 home-21-section-bg padding-top-50 padding-bottom-50">
<div class="newsletter-shape">
    {!! render_image_markup_by_attachment_id(
        filter_static_option_value('home_21_newsletter_section_shape_image', $static_field_data),
    ) !!}
</div>
<div class="container container-three">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="newsletter-wrapper center-text">
                <div class="section-title-21">
                    <span class="subtitle color-light mb-3">
                        {{ filter_static_option_value('home_21_newsletter_section_' . $user_select_lang_slug . '_subtitle', $static_field_data) }}
                    </span>
                    <h2 class="title">
                        @php
                            $header_title = filter_static_option_value('home_21_newsletter_section_' . $user_select_lang_slug . '_title', $static_field_data);
                            $header_title = str_replace(['{shape}', '{/shape}'], ['<span class="section-shape">', '</span>'], $header_title);
                        @endphp
                        {!! $header_title !!}
                    </h2>
                </div>
                <div class="newsletter-widget">
                    <div class="form-message-show"></div>
                    <div class="newsletter-form-wrap">
                        <form action="{{ route('frontend.subscribe.newsletter') }}"
                            class="newsletter-form mt-4 mt-lg-5">
                            <div class="single-input">
                                <input class="form--control" type="email" name="email"
                                    placeholder="{{ filter_static_option_value('home_21_newsletter_section_' . $user_select_lang_slug . '_placeholder_text', $static_field_data) }} ">
                            </div>
                            <button class="newsletter-btn submit-btn" type="submit"> <i
                                    class="fas fa-arrow-right"></i> </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section> --}}

{{-- @include('frontend.partials.contact-section') --}}
