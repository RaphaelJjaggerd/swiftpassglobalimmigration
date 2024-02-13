<header class="header">
    <?php echo $__env->make('frontend.partials.custom.supportbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-menu sticky-header">
        <div class="main-menu-inner">
            <div class="main-menu-left">
                <div class="main-menu-logo">
                    <a href="index.html"><img src="assets/image/swiftpasslogo.png" alt="logo" width="40"></a>
                </div><!-- main-menu-logo -->
                <div class="navigation">
                    <ul class="main-menu-list list-unstyled">
                        
                        <li><a href="<?php echo e(url('/')); ?>">Home </a></li>

                        <li class="has-dropdown">
                            <a href="">Services</a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo e(route('frontend.service')); ?>">Services</a></li>
                                <li><a href="/service/cyber-security">Cyber Security</a></li>
                            </ul><!-- list-unstyled -->
                        </li><!-- has-dropdown -->

                        <li class="has-dropdown">
                            <a href="#">News</a>
                            <ul class="list-unstyled">
                                <li><a href="news.html">News</a></li>
                                <li><a href="news-details.html">News Details</a></li>
                            </ul><!-- list-unstyled -->
                        </li><!-- has-dropdown -->
                        <li><a href="about.html">About</a></li>

                        <li><a href="contact.html">Contact</a>
                        </li><!-- li -->
                    </ul><!-- main-menu-list -->
                </div><!-- navigation -->
            </div><!-- main-menu-left -->
            <div class="main-menu-right">
                <div class="mobile-menu-button mobile-nav-toggler">
                    <span></span>
                    <span></span>
                    <span></span>
                </div><!-- mobile-menu-button -->
                <div class="search-box">
                    <a href="#" class="search-toggler">
                        <i class="flaticon-search-interface-symbol"></i>
                    </a><!-- search-toggler -->
                </div><!-- search-box -->
                <?php if(auth()->check()): ?>
                    <?php
                        $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                    ?>
                    <li class="login-register"><a href="<?php echo e($route); ?>"><?php echo e(__('Dashboard')); ?></a>
                        <span>/</span>
                        <a href="<?php echo e(route('user.logout')); ?>"
                            onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>
                        <form id="userlogout-form" action="<?php echo e(route('user.logout')); ?>" method="POST"
                            style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                <?php else: ?>
                    <div class="main-menu-right-button">
                        <a href="<?php echo e(route('user.login')); ?>" class="btn btn-primary"><?php echo e(__('Login')); ?></a>
                    </div><!-- main-menu-right-button -->
                <?php endif; ?>

            </div><!-- main-menu-right -->
        </div><!-- main-menu-inner -->
    </div><!-- main-menu -->
</header><!--header-->
<?php /**PATH C:\Users\user\.projects\Web\nexelit-v3.5.3\@core\resources\views/frontend/partials/custom/navbar.blade.php ENDPATH**/ ?>