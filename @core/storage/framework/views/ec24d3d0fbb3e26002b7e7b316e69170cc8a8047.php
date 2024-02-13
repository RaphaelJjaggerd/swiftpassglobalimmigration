<div class="department-two-card">
    <div class="department-two-imgbox">
        <div class="department-two-img">
            
            <?php echo render_image_markup_by_attachment_id($service->image); ?>

            <a href="<?php echo e(route('frontend.services.single', $service->slug)); ?>"></a>
        </div><!-- department-two-img -->
        <div class="department-two-img-icon">
            <a href="<?php echo e(route('frontend.services.single', $service->slug)); ?>"><i class="<?php echo e($service->icon); ?>"></i></a>
        </div><!-- department-two-img-icon -->
    </div><!-- department-two-imgbox -->
    <div class="department-two-content">
        <h4><a href=<?php echo e(route('frontend.services.single', $service->slug)); ?>"><?php echo e($service->title); ?></a></h4>
        <p><?php echo e($service->excerpt); ?></p>
        <div class="department-two-button">
            <a href="<?php echo e(route('frontend.services.single', $service->slug)); ?>"><i
                    class="fa-solid fa-arrow-right-long"></i>
                <span>Read More</span></a>
        </div><!-- department-two-button -->
    </div><!-- department-two-content -->
</div><!--department-two-card-->
<?php /**PATH C:\Users\user\.projects\Web\swiftpassglobalimmigration\@core\resources\views/components/frontend/service/grid.blade.php ENDPATH**/ ?>