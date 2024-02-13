@extends('frontend.frontend-page-master')
@section('og-meta')
  <meta property="og:url" content="{{ route('frontend.services.single', $service_item->slug) }}" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="{{ $service_item->title }}" />
  {!! render_og_meta_image_by_attachment_id($service_item->image) !!}
@endsection
@section('page-meta-data')
  <meta name="description" content="{{ $service_item->meta_description }}">
  <meta name="tags" content="{{ $service_item->meta_tag }}">
  {!! render_og_meta_image_by_attachment_id($service_item->image) !!}
@endsection
@section('site-title')
  {{ $service_item->title }} - {{ get_static_option('service_page_' . $user_select_lang_slug . '_name') }}
@endsection
@section('page-title')
  {{ $service_item->title }}
@endsection
@section('content')
  <section class="service-details-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="service-details-image">
            {{-- <img src="assets/image/services/service-details-1.jpg" class="img-fluid" alt="img-146"> --}}
            <div class="thumb margin-bottom-40">
              {!! render_image_markup_by_attachment_id($service_item->image) !!}
            </div>
          </div><!-- service-details-image -->
          <div class="service-details-content-box">
            <h3 class="service-details-title">{{ $service_item->title }}</h3>
            <p> {!! iFrameFilterInSummernoteAndRender($service_item->description) !!}</p>

          </div><!-- service-details-content-box -->

          @if (!empty($price_plan))
            <div class="price-plan-wrapper margin-top-40">
              <div class="row">
                @foreach ($price_plan as $data)
                  <div class="col-lg-6">
                    <div class="single-price-plan-01 margin-bottom-20">
                      <div class="price-header">
                        <div class="name-box">
                          <h4 class="name">{{ $data->title }}</h4>
                        </div>
                        <div class="price-wrap">
                          <span class="price">{{ amount_with_currency_symbol($data->price) }}</span><span class="month">{{ $data->type }}</span>
                        </div>
                      </div>
                      <div class="price-body">
                        <ul>
                          @php
                            $features = explode("\n", $data->features);
                          @endphp
                          @foreach ($features as $item)
                            <li>{{ $item }}</li>
                          @endforeach
                        </ul>
                      </div>
                      <div class="btn-wrapper">
                        @php
                          $url = !empty($data->url_status) ? route('frontend.plan.order', ['id' => $data->id]) : $data->btn_url;
                        @endphp
                        <a href="{{ $url }}" class="boxed-btn">{{ $data->btn_text }}</a>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif
        </div><!-- col-lg-8 -->

        <div class="col-12 col-lg-4 col-xl-4">
          <div class="sidebar">
            <div class="widget-area">
              {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('service', ['column' => false]) !!}
            </div>
            <div class="sidebar-widget sidebar-widget-card">

              <div class="sidebar-widget-card-content">
                <h3><a href="/appointment">Book An Appoint </a>
                </h3>
                <a href="/appointment" class="btn btn-primary">
                  <span class="btn-text">Book Now <i class="fa-solid fa-circle-arrow-right"></i></span>
                </a>
              </div><!-- sidebar-widget-card-content -->
            </div><!-- sidebar-widget sidebar-widget-card -->
            {{-- <div class="sidebar-widget">
                            <div class="sidebar-widget-box-icon">
                                <i class="flaticon-pdf"></i>
                            </div><!-- sidebar-widget-box-icon -->
                            <div class="sidebar-widget-box-content">
                                <h3>Contract Aggreement Form <br> 2024 year</h3>
                                <a class="btn btn-primary"><span class="btn-text"> Download</span></a>


                            </div><!-- sidebar-widget-box-content -->
                        </div><!-- sidebar-widget sidebar-widget-box --> --}}

          </div><!--sidebar-->
        </div><!--col-12 col-lg-4 col-xl-4-->
      </div><!-- row -->
    </div><!-- container -->
  </section><!-- service-details-section -->

@endsection
