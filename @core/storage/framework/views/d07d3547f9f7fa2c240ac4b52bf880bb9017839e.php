<?php echo $__env->make('frontend.partials.custom.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page-wrapper">
  <?php echo $__env->yieldContent('content'); ?>
</div>
<?php echo $__env->make('frontend.partials.custom.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH C:\Users\user\.projects\Web\swiftpassglobalimmigration\@core\resources\views/frontend/frontend-master.blade.php ENDPATH**/ ?>