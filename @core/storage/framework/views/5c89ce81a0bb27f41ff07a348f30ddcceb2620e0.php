  <?php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant', $global_static_field_data);
  ?>
  <!DOCTYPE html>
  <html lang="<?php echo e($user_select_lang_slug); ?>" dir="<?php echo e(get_user_lang_direction()); ?>">

  <head>
    <?php if(!empty(filter_static_option_value('site_google_analytics', $global_static_field_data))): ?>
      <?php echo get_static_option('site_google_analytics'); ?>

    <?php endif; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    
    <!-- google font -->
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- plugins css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-custom/vendor/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-custom/vendor/reey-font/stylesheet.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-custom/vendor/font-awesome/css/all.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-custom/vendor/animate/animate.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-custom/vendor/flaticon/css/flaticon_towngov.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-custom/vendor/owl-carousel/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-custom/vendor/swiper/swiper-bundle.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets-custom/vendor/youtube-popup/youtube-popup.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-custom/css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-custom/css/evo-calendar.css')); ?>">
    <script src="<?php echo e(asset('assets-custom/vendor/bootstrap/bootstrap.bundle.min.js')); ?>"></script>


    


    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/image/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo e(asset('assets-custom/image/favicons/site.webmanifest')); ?>">
    

    <?php echo render_favicon_by_id(filter_static_option_value('site_favicon', $global_static_field_data)); ?>

    <?php echo load_google_fonts(); ?>

    <link rel=preload href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>" as="style">
    <link rel=preload href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>" as="style">
    <link rel=preload href="<?php echo e(asset('assets/frontend/css/nexicon.css')); ?>" as="style">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery.ihavecookies.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/nexicon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>">
    
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">
    

    

    

    

    <?php echo $__env->yieldContent('style'); ?>
    <?php if(!empty(filter_static_option_value('site_rtl_enabled', $global_static_field_data)) || get_user_lang_direction() == 'rtl'): ?>
      <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/rtl.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/new_rtl.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->make('frontend.partials.og-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <script>
      var siteurl = "<?php echo e(url('/')); ?>"
    </script>

    <?php echo filter_static_option_value('site_third_party_tracking_code', $global_static_field_data); ?>


  </head>

  <body
    class="<?php echo e(request()->path()); ?> home_variant_<?php echo e($home_page_variant); ?> nexelit_version_<?php echo e(getenv('XGENIOUS_NEXELIT_VERSION')); ?> <?php echo e(filter_static_option_value('item_license_status', $global_static_field_data)); ?> apps_key_<?php echo e(filter_static_option_value('site_script_unique_key', $global_static_field_data)); ?> ">

    <?php echo filter_static_option_value('site_third_party_tracking_body_code', $global_static_field_data); ?>


    <?php echo $__env->make('frontend.partials.custom.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.search-popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\user\.projects\Web\swiftpassglobalimmigration\@core\resources\views/frontend/partials/custom/header.blade.php ENDPATH**/ ?>