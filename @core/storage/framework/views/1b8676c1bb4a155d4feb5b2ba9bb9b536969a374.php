<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order Confirm')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-confirm-area">
                        <h4 class="title"><?php echo e(__('Order Details')); ?></h4>
                        <div class="enroll-form-wrapper">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                            <form action="<?php echo e(route('frontend.order.payment.form')); ?>" method="post"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php
                                    $custom_fields = unserialize($order_details->custom_fields);
                                    $payment_gateway = !empty($custom_fields['selected_payment_gateway']) ? $custom_fields['selected_payment_gateway'] : '';
                                    $name = auth()->check() ? auth()->user()->name : '';
                                    $email = auth()->check() ? auth()->user()->email : '';
                                ?>

                                <input type="hidden" name="order_id" value="<?php echo e($order_details->id); ?>">
                                <input type="hidden" name="payment_gateway" value="<?php echo e($payment_gateway); ?>">
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">

                                <div class="form-group coupon">
                                    <label for="coupon"><?php echo e(__('Have Coupon?')); ?></label>
                                    <input type="text" name="coupon" class="form-control"
                                        placeholder="<?php echo e(__('Coupon')); ?>">
                                    <span class="right spin-none" id="order_coupon_apply"><?php echo e(__('Apply')); ?><i
                                            class="fas fa-spinner fa-spin"></i></span>
                                </div>
                                <div class="coupon-msg-wrap"></div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <td><?php echo e(__('Your Name')); ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="name" value="<?php echo e($name); ?>"
                                                        class="form-control" placeholder="<?php echo e(__('Enter Your Name')); ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('Your Email')); ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="email" name="email" value="<?php echo e($email); ?>"
                                                        class="form-control" placeholder="<?php echo e(__('Enter Your Email')); ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('Service Name')); ?></td>
                                            <td><?php echo e($order_details->package_name); ?></td>
                                        </tr>
                                        <tr>
                                            <?php if($package_details->payment_type == 'phased' && $order_details->payment_status == 'pending'): ?>
                                                <td class="amounts-title"><?php echo e(__('Initial Payment')); ?></td>
                                            <?php elseif($package_details->payment_type == 'phased' && $order_details->payment_status == 'completed'): ?>
                                                <td class="amounts-title"><?php echo e(__('Final Payment')); ?></td>
                                            <?php else: ?>
                                                <td class="amounts-title"><?php echo e(__('Payment')); ?></td>
                                            <?php endif; ?>

                                            <td>
                                                <?php if($package_details->payment_type == 'phased'): ?>
                                                    <strong
                                                        class="price"><?php echo e(half_amount_with_currency_symbol($order_details->package_price)); ?></strong>
                                                <?php else: ?>
                                                    <strong
                                                        class="price"><?php echo e(amount_with_currency_symbol($order_details->package_price)); ?></strong>
                                                <?php endif; ?>

                                                <?php if(!check_currency_support_by_payment_gateway($payment_gateway)): ?>
                                                    <br>
                                                    <small><?php echo e(__('You will be charged in ' . get_charge_currency($payment_gateway) . ', you have to pay' . ' ')); ?>

                                                        <strong><?php echo e(get_charge_amount($order_details->package_price, $payment_gateway) . get_charge_currency($payment_gateway)); ?></strong></small>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('Payment Gateway')); ?></td>
                                            <td class="text-capitalize">
                                                <?php if($payment_gateway == 'manual_payment'): ?>
                                                    <?php echo e(get_static_option('site_manual_payment_name')); ?>

                                                <?php else: ?>
                                                    <?php echo e($payment_gateway); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php if($payment_gateway == 'manual_payment'): ?>
                                            <tr>

                                                <td>
                                                    <div class="form-group">
                                                        <?php if(!empty(get_static_option('manual_payment_gateway'))): ?>
                                                            <div class="label mb-2"><?php echo e(__('Attach your bank Document')); ?>

                                                            </div>
                                                            <input class="form-control btn btn-primary btn-sm pb-2"
                                                                type="file" name="manual_payment_attachment">
                                                            <span class="help-info mt-2"><?php echo get_manual_payment_description(); ?></span>
                                                        <?php endif; ?>

                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        <?php endif; ?>

                                    </table>
                                </div>
                                <div class="btn-wrapper">
                                    <button type="submit" class="submit-btn style-01"><?php echo e(__('Pay Now')); ?></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        (function() {
            "use strict";
            $(document).on('click', '#order_coupon_apply', function() {
                var order_id = $('input[name="order_id"]').val();
                var coupon = $('input[name="coupon"]').val();
                $(this).removeClass('spin-none');

                if (coupon == '') {
                    $('.coupon-msg-wrap').html('');
                    $('.coupon-msg-wrap').html('<span class="text-danger">' + '<?php echo e(__('enter coupon')); ?>' +
                        '</span>');
                    $(this).addClass('spin-none');
                    return;
                }

                $.ajax({
                    'type': 'post',
                    'url': "<?php echo e(route('frontend.course.apply.order.coupon')); ?>",
                    data: {
                        '_token': "<?php echo e(csrf_token()); ?>",
                        'order_id': order_id,
                        'coupon': coupon
                    },
                    success: function(data) {
                        $('#order_coupon_apply').addClass('spin-none');
                        $('.coupon-msg-wrap').html('');
                        $('.coupon-msg-wrap').html('<span class="text-' + data.status + '">' + data
                            .msg + '</span>');

                        if (data.status == 'success') {
                            var oldPrice = $('.price').text();
                            $('.price').html(
                                '<span class="discounted-amount" style="color: green;">' + data
                                .amount +
                                '</span><del class="del-old-price" style="color: #888; text-decoration: line-through; opacity: 0.6;">' +
                                oldPrice + '</del>');
                        }
                    }
                });
            });
        })(jQuery);
    </script>
    <?php if(
        !empty(get_static_option('site_google_captcha_v3_site_key')) &&
            !empty(get_static_option('site_google_captcha_status'))): ?>
        <script
            src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>">
        </script>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {
                    action: 'homepage'
                }).then(function(token) {
                    document.getElementById('gcaptcha_token').value = token;
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\.projects\Web\swiftpassimmigration\@core\resources\views/frontend/payment/order-confirm.blade.php ENDPATH**/ ?>