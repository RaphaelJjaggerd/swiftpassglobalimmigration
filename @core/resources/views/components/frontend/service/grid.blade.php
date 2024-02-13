<div class="department-two-card">
    <div class="department-two-imgbox">
        <div class="department-two-img">
            {{-- <img src="assets/image/department/department-5.jpg" class="img-fluid" alt="img-150"> --}}
            {!! render_image_markup_by_attachment_id($service->image) !!}
            <a href="{{ route('frontend.services.single', $service->slug) }}"></a>
        </div><!-- department-two-img -->
        <div class="department-two-img-icon">
            <a href="{{ route('frontend.services.single', $service->slug) }}"><i class="{{ $service->icon }}"></i></a>
        </div><!-- department-two-img-icon -->
    </div><!-- department-two-imgbox -->
    <div class="department-two-content">
        <h4><a href={{ route('frontend.services.single', $service->slug) }}">{{ $service->title }}</a></h4>
        <p>{{ $service->excerpt }}</p>
        <div class="department-two-button">
            <a href="{{ route('frontend.services.single', $service->slug) }}"><i
                    class="fa-solid fa-arrow-right-long"></i>
                <span>Read More</span></a>
        </div><!-- department-two-button -->
    </div><!-- department-two-content -->
</div><!--department-two-card-->
