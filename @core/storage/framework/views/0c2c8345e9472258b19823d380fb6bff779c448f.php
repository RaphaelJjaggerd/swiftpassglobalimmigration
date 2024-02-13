   <div class="topbar">
       <div class="topbar-inner">
           <div class="topbar-left">
               <div class="topbar-socials">
                   <?php $__currentLoopData = $all_social_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <a href="<?php echo e($data->url); ?>" rel="canonical"><i class=" <?php echo e($data->icon); ?>"></i></a>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
               </div><!--topbar-socials-->

               <div class="topbar-info">
                   <ul>
                       <?php
                           $all_icon_fields = filter_static_option_value('home_page_07_topbar_section_info_item_icon', $global_static_field_data);
                           $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                           $all_title_fields = filter_static_option_value('home_page_07_' . $user_select_lang_slug . '_topbar_section_info_item_title', $global_static_field_data);
                           $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                           $all_details_fields = filter_static_option_value('home_page_07_' . $user_select_lang_slug . '_topbar_section_info_item_details', $global_static_field_data);
                           $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields) : [];
                       ?>
                       <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           
                           <li>
                               <div class="topbar-icon">
                                   <i class="<?php echo e($icon); ?>"></i>
                               </div><!-- topbar-icon -->
                               <div class="topbar-text">
                                   <span><?php echo e($all_details_fields[$loop->index] ?? ''); ?></span>
                               </div><!-- topbar-text -->
                           </li><!-- li -->
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                       
                   </ul><!-- ul -->
               </div><!--topbar-info-->
           </div><!-- topbar-left -->
           <div class="topbar-right">
               <ul>
                   
                   <?php if(!empty(get_static_option('language_select_option'))): ?>
                       <li class="topbar-icon">
                           <i class="fa-solid fa-globe"></i>

                           <select id="langchange" class="topbar-text">
                               <?php $__currentLoopData = $all_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <option <?php if($user_select_lang_slug == $lang->slug): ?> selected <?php endif; ?> value="<?php echo e($lang->slug); ?>"
                                       class="lang-option">
                                       <?php echo e(explode('(', $lang->name)[0] ?? $lang->name); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                       </li>
                   <?php endif; ?>
                   <!-- <li><a href="department-details.html">Council</a></li>
            <li><a href="departments.html">Government</a></li>
            <li><a href="contact.html">Complaints</a></li> -->
               </ul><!-- ul -->
           </div><!--topbar-right-->
       </div><!-- topbar-inner -->
   </div><!--topbar-->
<?php /**PATH C:\Users\user\.projects\Web\swiftpassimmigration\@core\resources\views/frontend/partials/custom/supportbar.blade.php ENDPATH**/ ?>