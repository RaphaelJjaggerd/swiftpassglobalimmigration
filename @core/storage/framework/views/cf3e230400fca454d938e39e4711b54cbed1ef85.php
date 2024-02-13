<?php $__env->startSection('section'); ?>
    <?php if(count($package_orders) > 0): ?>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th><?php echo e(__('ID')); ?></th>
                    <th><?php echo e(__('Service Name')); ?></th>
                    <th><?php echo e(__('Price')); ?></th>
                    <th><?php echo e(__('Service Status')); ?></th>
                    <th><?php echo e(__('Date')); ?></th>
                    
                    
                    <th><?php echo e(__('First Payment Status')); ?></th>
                    <th><?php echo e(__('Second Payment Status')); ?></th>

                </tr>

            </thead>
            <tbody>
                <?php $__currentLoopData = $package_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>#<?php echo e($data->id); ?></td>
                        <td><?php echo e($data->package_name); ?></td>
                        <td> <?php echo e(amount_with_currency_symbol($data->package_price)); ?></td>
                        <td>
                            <?php if($data->status == 'pending'): ?>
                                <span
                                    class="alert alert-warning text-capitalize alert-sm alert-small"><?php echo e(__($data->status)); ?></span>
                            <?php elseif($data->status == 'cancel'): ?>
                                <span
                                    class="alert alert-danger text-capitalize alert-sm alert-small"><?php echo e(__($data->status)); ?></span>
                            <?php elseif($data->status == 'in_progress'): ?>
                                <span
                                    class="alert alert-info text-capitalize alert-sm alert-small"><?php echo e(str_replace('_', ' ', __($data->status))); ?></span>
                            <?php else: ?>
                                <span
                                    class="alert alert-success text-capitalize alert-sm alert-small"><?php echo e(__($data->status)); ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e(date_format($data->created_at, 'd / m /  Y')); ?></td>
                        

                        <?php if(!empty(optional($data->paymentLog)->manual_payment_attachment)): ?>
                            <td>
                                <a class="btn btn-warning mt-2 btn-xs mb-3"
                                    href="<?php echo e(url('assets/uploads/attachment/' . optional($data->paymentLog)->manual_payment_attachment) ?? ''); ?>"
                                    target="_blank">
                                    <?php echo e(__('View Bank Attachment')); ?>

                                </a>
                            </td>
                        <?php endif; ?>

                        <td>
                            <?php if($data->payment_status == 'pending' && $data->status != 'cancel'): ?>
                                <span
                                    class="alert alert-warning text-capitalize alert-sm"><?php echo e($data->payment_status); ?></span>
                                <a href="<?php echo e(route('frontend.order.confirm', $data->id)); ?>"
                                    class="small-btn btn-boxed"><?php echo e(__('Pay Now')); ?></a>
                                <form action="<?php echo e(route('user.dashboard.package.order.cancel')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="order_id" value="<?php echo e($data->id); ?>">
                                    <button type="submit"
                                        class="btn-boxed-danger  margin-top-10"><?php echo e(__('Cancel')); ?></button>
                                </form>
                            <?php else: ?>
                                <span class="alert alert-success text-capitalize alert-sm"
                                    style="display: inline-block"><?php echo e($data->payment_status); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($data->status == 'approved' && $data->payment_status_2 == 'pending' && $data->status != 'cancel'): ?>
                                <span
                                    class="alert alert-warning text-capitalize alert-sm"><?php echo e($data->payment_status_2); ?></span>
                                <a href="<?php echo e(route('frontend.order.confirm', $data->id)); ?>"
                                    class="small-btn btn-boxed"><?php echo e(__('Pay Now')); ?></a>
                                <form action="<?php echo e(route('user.dashboard.package.order.cancel')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="order_id" value="<?php echo e($data->id); ?>">
                                    <button type="submit"
                                        class="btn-boxed-danger  margin-top-10"><?php echo e(__('Cancel')); ?></button>
                                </form>
                            <?php elseif($data->package_payment_type == 'single' && $data->status != 'cancel'): ?>
                                <span class="alert alert-warning text-capitalize alert-sm" style="display: inline-block">Not
                                    Applicable</span>
                            <?php elseif($data->payment_status_2 == 'complete' && $data->status != 'cancel'): ?>
                                <span class="alert alert-success text-capitalize alert-sm"
                                    style="display: inline-block"><?php echo e($data->payment_status_2); ?></span>
                            <?php else: ?>
                                <span class="alert alert-warning text-capitalize alert-sm"
                                    style="display: inline-block">Await Approval
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            
        </table>

        


        <div class="blog-pagination">
            <?php echo e($package_orders->links()); ?>

        </div>
    <?php else: ?>
        <div class="alert alert-warning"><?php echo e(__('No Order Found')); ?></div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\.projects\Web\swiftpassimmigration\@core\resources\views/frontend/user/dashboard/package-order.blade.php ENDPATH**/ ?>