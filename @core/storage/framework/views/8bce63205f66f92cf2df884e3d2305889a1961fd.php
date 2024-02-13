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

  <?php echo render_favicon_by_id(filter_static_option_value('site_favicon', $global_static_field_data)); ?>

  <?php echo load_google_fonts(); ?>

  <link rel="canonical" href="<?php echo e(url()->current()); ?>">
  <link rel=preload href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>" as="style">
  <link rel=preload href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>" as="style">
  <link rel=preload href="<?php echo e(asset('assets/frontend/css/nexicon.css')); ?>" as="style">

  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/nexicon.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/owl.carousel.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/animate.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/magnific-popup.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style-two.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/helpers.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/responsive.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery.ihavecookies.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/toastr.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/slick.css')); ?>">
  <link href="<?php echo e(asset('assets/frontend/css/jquery.mb.YTPlayer.min.css')); ?>" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  

  
<?php /**PATH C:\Users\user\.projects\Web\swiftpassglobalimmigration\@core\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>