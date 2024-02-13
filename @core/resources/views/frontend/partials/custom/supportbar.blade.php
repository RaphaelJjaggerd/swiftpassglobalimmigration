   <div class="topbar">
       <div class="topbar-inner">
           <div class="topbar-left">
               <div class="topbar-socials">
                   @foreach ($all_social_item as $data)
                       <a href="{{ $data->url }}" rel="canonical"><i class=" {{ $data->icon }}"></i></a>
                   @endforeach
                   {{-- <a href="#"><i class="fa-brands fa-twitter"></i></a>
                   <a href="#"><i class="fa-brands fa-facebook"></i></a>
                   <a href="#"><i class="fa-brands fa-instagram"></i></a>
                   <a href="#"><i class="fa-brands fa-tiktok"></i></a> --}}
               </div><!--topbar-socials-->

               <div class="topbar-info">
                   <ul>
                       @php
                           $all_icon_fields = filter_static_option_value('home_page_07_topbar_section_info_item_icon', $global_static_field_data);
                           $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                           $all_title_fields = filter_static_option_value('home_page_07_' . $user_select_lang_slug . '_topbar_section_info_item_title', $global_static_field_data);
                           $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                           $all_details_fields = filter_static_option_value('home_page_07_' . $user_select_lang_slug . '_topbar_section_info_item_details', $global_static_field_data);
                           $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields) : [];
                       @endphp
                       @foreach ($all_icon_fields as $icon)
                           {{-- <li class="industry-single-info-item">
                               <div class="icon">
                                   <i class="{{ $icon }}"></i>
                               </div>
                               <div class="content">
                                   <h4 class="title">{{ $all_title_fields[$loop->index] ?? '' }}</h4>
                                   <span class="details">{{ $all_details_fields[$loop->index] ?? '' }}</span>
                               </div>
                           </li> --}}
                           <li>
                               <div class="topbar-icon">
                                   <i class="{{ $icon }}"></i>
                               </div><!-- topbar-icon -->
                               <div class="topbar-text">
                                   <span>{{ $all_details_fields[$loop->index] ?? '' }}</span>
                               </div><!-- topbar-text -->
                           </li><!-- li -->
                       @endforeach

                       {{-- <li>
                           <div class="topbar-icon">
                               <i class="fa-solid fa-envelope"></i>
                           </div><!-- topbar-icon -->
                           <div class="topbar-text">
                               <a href="mailto:info@swiftpassglobalhub.com">info@swiftpassglobalhub.com</a>
                           </div><!-- topbar-text -->
                       </li><!-- li -->
                       <li>
                           <div class="topbar-icon">
                               <i class="fa-solid fa-clock"></i>
                           </div><!-- topbar-icon -->
                           <div class="topbar-text">
                               <span>Open Hours: Mon - Fri 8.00 am - 6.00 pm</span>
                           </div><!-- topbar-text -->
                       </li><!-- li --> --}}
                   </ul><!-- ul -->
               </div><!--topbar-info-->
           </div><!-- topbar-left -->
           <div class="topbar-right">
               <ul>
                   {{-- <li>
                       <i class="fa-solid fa-phone"></i>
                       <a href="tel:+254740081562" class="topbar-text">+254 740 081 562</a>
                   </li><!-- li --> --}}
                   @if (!empty(get_static_option('language_select_option')))
                       <li class="topbar-icon">
                           <i class="fa-solid fa-globe"></i>

                           <select id="langchange" class="topbar-text">
                               @foreach ($all_language as $lang)
                                   <option @if ($user_select_lang_slug == $lang->slug) selected @endif value="{{ $lang->slug }}"
                                       class="lang-option">
                                       {{ explode('(', $lang->name)[0] ?? $lang->name }}</option>
                               @endforeach
                           </select>
                       </li>
                   @endif
                   <!-- <li><a href="department-details.html">Council</a></li>
            <li><a href="departments.html">Government</a></li>
            <li><a href="contact.html">Complaints</a></li> -->
               </ul><!-- ul -->
           </div><!--topbar-right-->
       </div><!-- topbar-inner -->
   </div><!--topbar-->
