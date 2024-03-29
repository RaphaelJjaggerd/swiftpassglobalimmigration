<section class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="footer-widget-logo">
            
            <?php if(!empty(filter_static_option_value('site_white_logo', $global_static_field_data))): ?>
              <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_white_logo', $global_static_field_data)); ?>

            <?php else: ?>
              <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)); ?>

            <?php endif; ?>
          </div><!-- footer-widget-logo -->
          <div class="footer-widget-text">
            <p>Your trusted partner for seamless visa solutions , with 24/7 support ensuring visa success
              and peace of
              mind.</p>
          </div><!-- footer-widget-text -->
          <div class="footer-widget-socials">
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
          </div><!-- footer-widget-socials -->
        </div><!--col-lg-4-->
        <div class="col-lg-3">
          <div class="footer-widget">
            <div class="footer-widget-explore">
              <h4 class="footer-widget-title">Explore</h4>
              <ul class="list-unstyled">
                <li><a href="department-details.html">News</a></li>
                <li><a href="service-details.html">Careers</a></li>
                <li><a href="event-details.html">Partner With us</a></li>

              </ul><!-- list-unstyled -->
            </div><!-- footer-widget-explore -->
          </div><!--footer-widget-->
        </div><!--col-lg-3-->
        <div class="col-lg-2">
          <div class="footer-widget">
            <div class="footer-widget-department">
              <h4 class="footer-widget-title">Services</h4>
              <ul class="list-unstyled">
                <li><a href="department-details.html">Work Visas </a></li>
                <li><a href="department-details.html">Student Visas </a></li>
                <li><a href="department-details.html">Tourism Visas </a></li>
                <li><a href="department-details.html">View All <span>-></span></a> </li>

              </ul><!-- list-unstyled -->
            </div><!-- footer-widget-department -->
          </div><!--footer-widget-->
        </div><!--col-lg-2-->
        <div class="col-lg-3">
          <div class="footer-widget">
            <div class="footer-widget-contact">
              <h4 class="footer-widget-title">Contact</h4>
              <p>Krishna Center, 2nd Floor, Woodvale Groove, Westlands<br>Nairobi. Kenya</p>
            </div><!-- footer-widget-contact -->
            <div class="footer-widget-contact-list">
              <i class="fa-solid fa-envelope"></i>
              <div class="footer-widget-contact-item">
                <a href="mailto:info@swiftpassglobalhub.com">info@swiftpassglobalimmigration.com</a>
              </div><!-- footer-widget-contact-item -->
            </div><!-- footer-widget-contact-list -->
            <div class="footer-widget-contact-list">
              <i class="fa-solid fa-phone"></i>
              <div class="footer-widget-contact-item">
                <a href="tel:+254-740-081-562">+254 740 081 562</a>
              </div><!-- footer-widget-contact-item -->
            </div><!-- footer-widget-contact-list -->
          </div><!--footer-widget-->
        </div><!--col-lg-3-->
      </div><!-- row -->
    </div><!-- container -->
  </div><!--footer-inner-->
  <div class="bottom-footer">
    <div class="conatiner">
      <p>© Copyright 2024 SwiftPass Global Immigration</p> <br>

    </div><!-- container -->
  </div><!--bottom-footer-->
</section><!--footer-->
<div class="mobile-nav-wrapper">
  <div class="mobile-nav-overlay mobile-nav-toggler"></div><!-- mobile-nav-overlay -->
  <div class="mobile-nav-content">
    <a href="#" class="mobile-nav-close mobile-nav-toggler">
      <span></span>
      <span></span>
    </a><!-- mobile-nav-close -->
    <div class="logo-box">
      <a href="index.html"><img src="assets/image/logo-light.png" width="160" height="40" alt="26"></a>
    </div><!-- logo-box -->
    <div class="mobile-nav-container"></div><!-- mobile-nav-container -->
    <ul class="mobile-nav-contact list-unstyled">
      <li>
        <i class="fa-solid fa-phone"></i>
        <a href="tel:+254740081562">+254 740 081 562</a>
      </li><!-- li -->
      <li>
        <i class="fa-solid fa-envelope"></i>
        <a href="mailto:info@swiftpassglobalhub.com">info@swiftpassglobalimmigration.com</a>
      </li><!-- li -->
      <li>
        <i class="fa-solid fa-map-marker-alt"></i>
        Krishna Center, 2nd Floor, Woodvale Groove, Westlands <br> Nairobi. Kenya
      </li><!-- li -->
    </ul><!-- mobile-nav-contact -->
    <ul class="mobile-nav-social list-unstyled">
      <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
      <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
      <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
      <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
    </ul><!-- mobile-nav-social -->
  </div><!-- mobile-nav-content -->
</div><!--mobile-nav-wrapper-->
<div class="search-popup">
  <div class="search-popup-overlay search-toggler"></div><!-- search-popup-overlay -->
  <div class="search-popup-content">
    <form action="#">
      <label for="search" class="sr-only">search here</label><!-- sr-only -->
      <input type="text" id="search" placeholder="Search Here...">
      <button type="submit" aria-label="search submit" class="search-btn">
        <span><i class="flaticon-search-interface-symbol"></i></span>
      </button><!-- search-btn -->
    </form><!-- form -->
  </div><!-- search-popup-content -->
</div><!-- search-popup -->
<?php echo $__env->make('frontend.partials.popup-structure', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<a href="#" class="scroll-to-top scroll-to-target" data-target="html"><i class="fa-solid fa-arrow-up"></i></a>

<!-- plugins js -->
<script src="<?php echo e(asset('assets-custom/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets-custom/vendor/bootstrap/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets-custom/vendor/swiper/swiper-bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets-custom/vendor/owl-carousel/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets-custom/vendor/waypoints/jquery.waypoints.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets-custom/vendor/counter-up/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets-custom/vendor/youtube-popup/youtube-popup.jquery.js')); ?>"></script>
<script src="<?php echo e(asset('assets-custom/vendor/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets-custom/js/theme.js')); ?>"></script>


<!-- load all script -->

<script src="<?php echo e(asset('assets/frontend/js/dynamic-script.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/imagesloaded.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/isotope.pkgd.min.js')); ?>"></script>



<script src="<?php echo e(asset('assets/frontend/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jQuery.rProgressbar.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/frontend/js/jquery.nicescroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/slick.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>

<?php if(\Route::currentRouteName() === 'frontend.products'): ?>
  <script src="<?php echo e(asset('assets/frontend/js/jquery-ui.js')); ?>"></script>
<?php endif; ?>

<?php if(request()->routeIs('homepage') || request()->routeIs('frontend.homepage.demo')): ?>
  <?php echo $__env->make('frontend.partials.popup-jspart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('frontend.partials.gdpr-cookie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('frontend.partials.twakto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.google-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.inline-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.product-ajax-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('scripts'); ?>



</body>

</html>
<?php /**PATH C:\Users\user\.projects\Web\swiftpassimmigration\@core\resources\views/frontend/partials/custom/footer.blade.php ENDPATH**/ ?>