<?php
  use Illuminate\Support\Str;
?>

<?php echo $__env->make('frontend.partials.custom.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="main-slider">
  <div class="main-slider-swiper owl-carousel owl-theme">
    <?php $__currentLoopData = $all_header_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="item">
        <div class="item-slider-bg" <?php echo render_background_image_markup_by_attachment_id($data->image); ?>></div>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content">
                <?php if(!empty($data->subtitle)): ?>
                  <div class="slider-tagline"><?php echo e($data->subtitle); ?></div>
                <?php endif; ?>
                <?php if(!empty($data->title)): ?>
                  <h1 class="section-title"><?php echo e($data->title); ?>

                    <br>
                    <?php if(!empty($data->description)): ?>
                      <?php echo e($data->description); ?>

                    <?php endif; ?>
                  </h1>
                <?php endif; ?>
                <?php if(!empty($data->btn_01_status)): ?>
                  <a href="<?php echo e($data->btn_01_url); ?>" class="btn btn-primary"><?php echo e($data->btn_01_text); ?>

                  </a>
                <?php endif; ?>

              </div><!-- slider-content -->
            </div><!-- col-md-12 -->
          </div><!-- row -->
        </div><!-- container -->
      </div><!--item-->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </div><!-- main-slider-swiper -->
</section><!--main-slider-->
<section class="department-section">
  <div class="container">
    <div class="department-section-inner">
      <div class="row row-gutter-y-40">
        <?php $__currentLoopData = $all_key_features->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-xl-2 col-lg-4 col-md-6">
            <div class="department-card style-0<?php echo e($key + 1); ?>">
              <div class="department-card-icon">
                <a href="departments.html"><i class="<?php echo e($data->icon); ?>"></i></a>
              </div><!-- department-card-icon -->
              <div class="department-card-content">
                <h5><a href="department-details.html"><?php echo e($data->title); ?></a></h5>
              </div><!-- department-card-content -->
            </div><!--department-card-->
          </div><!--col-xl-2 col-lg-4 col-md-6-->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div><!-- row -->
    </div><!--department-section-inner-->
  </div><!-- container -->

</section>

<section class="about-section">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6">
        <div class="about-image">
          <div class="about-image-inner img-one">
            
            
            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('about_page_image_one', $static_field_data)); ?>


            <div class="sign-text">SwiftPass Global</div><!-- sign-text -->
            <div class="about-image-caption">
              <div class="about-image-caption-inner">
                <span class="about-caption-number">5</span>
                <span class="about-caption-text">Years of<br>experience</span>
              </div><!-- about-image-caption-inner -->
            </div><!--about-image-caption-->
          </div><!--about-image-inner img-one-->
          <div class="about-image-inner img-two">
            <img src="<?php echo e(asset('assets-custom/image/shapes/about-3.jpg')); ?>" class="floated-image" alt="img-3">
            
            
            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('about_page_image_two', $static_field_data)); ?>


          </div><!--about-image-inner img-two-->
        </div><!--about-image-->
      </div><!--col-lg-6-->
      <div class="col-lg-6">
        <div class="about-inner">
          <div class="section-title-box">
            <div class="section-tagline">Our introductions</div><!-- section-tagline -->
            <h2 class="section-title">
              <?php echo e(filter_static_option_value('home_page_01_' . $user_select_lang_slug . '_about_us_title', $static_field_data)); ?>


            </h2>
            <p>
              <?php echo e(filter_static_option_value('home_page_01_' . $user_select_lang_slug . '_about_us_description', $static_field_data)); ?>


            </p>
          </div><!-- section-title-box -->

          <div class="about-author-box">
            <div class="about-author-image">

              <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home_page_02_about_us_signature_image', $static_field_data)); ?>

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
            <img src="<?php echo e(asset('assets-custom/image/shapes/arrow.png')); ?>" alt="img-6">
          </div><!-- service-arrow-image -->
        </div><!--section-title-box-->
      </div><!--col-lg-6-->
      <div class="col-lg-5">
        <div class="service-card">
          
          <ul class="list-unstyled">
            <?php $__currentLoopData = $all_service->chunk(3)->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <a href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"><?php echo e($data->title); ?>

                    <i class="fa-solid fa-chevron-right"></i>
                  </a>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul><!-- list-unstyled -->
          <div class="service-button">
            <a href="/services" class="btn btn-primary">View All</a>
          </div><!-- service-button -->
        </div><!--service-card-->
      </div><!--col-lg-5-->
    </div><!-- row -->
  </div><!-- container -->
</section><!--service-section-->

<section class="funfact-section">
  <div class="container">
    <div class="row">
      <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-md-6">
          <div class="funfact-counter-item">
            <div class="funfact-counter-box">
              <div class="funfact-counter-icon">
                <i class="<?php echo e($data->icon); ?>"></i>
              </div><!-- funfact-counter-icon -->
              <div class="funfact-counter-number">
                <h3 class="counter-number"><?php echo e($data->number); ?></h3>
                <span class="funfact-counter-number-postfix"><?php echo e($data->extra_text); ?></span>
              </div><!-- funfact-counter-number -->
            </div><!-- funfact-counter-box -->
            <p class="funfact-text"><?php echo e($data->title); ?><br></p>
          </div><!--funfact-counter-item-->
        </div><!--col-xl-3 col-md-6-->
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div><!-- row -->
  </div><!-- container -->
</section><!-- /.funfact-section -->

<section class="testimonial-section">
  <div class="container">
    <div class="testimonial-name">TESTIMONIALS</div>
    <div class="testimonial-slider">
      <div class="swiper testimonial-reviews">
        <div class="swiper-wrapper">
          <?php $__currentLoopData = $all_testimonial->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                  <?php echo e($data->description); ?>

                </div><!-- testimonial-text -->
                <div class="testimonial-thumb-card">
                  <h5><?php echo e($data->name); ?></h5>
                  <span><?php echo e($data->designation); ?></span>
                </div><!-- testimonial-thumb-card -->
              </div><!--testimonial-content-->
            </div><!--swiper-slide-->
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div><!-- swiper-wrapper -->
        <div class="swiper-pagination"></div>
      </div><!--swiper testimonial-reviews-->
      <div class="testimonial-thumb">
        <div class="swiper-wrapper">
          <?php $__currentLoopData = $all_testimonial->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
              <?php echo render_image_markup_by_attachment_id($data->image); ?>

              <i class="fa-solid fa-quote-left"></i>
            </div><!-- swiper-slide -->
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
      <?php $__currentLoopData = $all_blog->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4">
          <div class="blog-card">
            <div class="blog-card-image">
              <?php echo render_image_markup_by_attachment_id($data->image); ?>

              <a href="<?php echo e(route('frontend.blog.single', $data->slug)); ?>"></a>
            </div><!-- blog-card-image -->
            <div class="blog-card-date">
              <a href="#"><?php echo e(date_format($data->created_at, 'd M Y')); ?></a>
            </div><!-- blog-card-date -->
            <div class="blog-card-content">
              <div class="blog-card-meta">
                <span class="author">
                  by<a href="#"><?php echo e($data->author); ?></a>
                </span><!-- author -->
                <span class="comment">
                  <a href="#"> </a>
                </span><!-- comment -->
              </div><!-- blog-card-meta -->
              <h4>
                <a href="<?php echo e(route('frontend.blog.single', $data->slug)); ?>">
                  <?php echo e(Str::limit($data->title, $limit = 35, $end = '...')); ?>

                </a>
              </h4>
              
            </div><!-- blog-card-content -->
          </div><!-- blog-card -->
        </div><!-- col-lg-4 -->
        <?php if($loop->iteration == 3): ?>
        <?php break; ?>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div><!-- row -->
</div><!-- container -->
</section><!-- blog-section -->

<section class="client-section">
<h5 class="client-text">Our partners & suppoters</h5>
<div class="container">
  <div class="client-carousel owl-carousel owl-theme">
    <?php $__currentLoopData = $all_brand_logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="item">
        <?php echo render_image_markup_by_attachment_id($data->image); ?>

      </div><!--item-->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </div><!--client-carousel owl-carousel owl-theme-->
</div><!--container-->
</section><!--client-section-->




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
        <form action="<?php echo e(route('frontend.subscribe.newsletter')); ?>" class="container  cta-two-form" method="post">
          <?php echo csrf_field(); ?>
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




<?php /**PATH C:\Users\user\.projects\Web\swiftpassglobalimmigration-main\swiftpassglobalimmigration-main\@core\resources\views/frontend/home-pages/home-01.blade.php ENDPATH**/ ?>