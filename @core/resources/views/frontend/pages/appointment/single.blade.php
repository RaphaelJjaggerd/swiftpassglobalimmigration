@extends('frontend.frontend-page-master')

<style>
  .hero {
    width: 100%;
    height: auto;
    background: linear-gradient(45deg, #83B8D7, #BAA6FD);
    display: grid;
  }

  #calendar {

    width: 90%;
    margin: 40px auto;
  }
</style>
@php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($item->image, 'full', false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
@endphp

@section('og-meta')
  <meta property="og:url" content="{{ route('frontend.appointment.single', [optional($item->lang_front)->slug ?? __('untitled'), $item->id]) }}" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="{{ optional($item->lang_front)->title }}" />
  <meta property="og:image" content="{{ $post_img }}" />
@endsection
@section('page-meta-data')
  <meta name="description" content="{{ optional($item->lang_front)->meta_description }}">
  <meta name="tags" content="{{ optional($item->lang_front)->meta_tag }}">
@endsection
@section('site-title')
  {{ optional($item->lang_front)->title }}
@endsection
@section('page-title')
  {{ optional($item->lang_front)->title }}
@endsection
@section('content')

  <section class="blog-details-content-area padding-top-100 padding-bottom-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="appointment-details-item">
            <div class="top-part">
              <div class="thumb">
                {!! render_image_markup_by_attachment_id($item->image, 'full') !!}
              </div>
              <div class="content">
                @if (optional($item->lang_front)->designation)
                  <span class="designation">{{ optional($item->lang_front)->designation }}</span>
                @endif
                <h2 class="title">{{ optional($item->lang_front)->title }}</h2>
                <div class="short-description">{!! iFrameFilterInSummernoteAndRender(optional($item->lang_front)->short_description) !!}</div>
                @if (optional($item->lang_front)->location)
                  <div class="location"><i class="fas fa-map-marked-alt"></i>
                    {{ optional($item->lang_front)->location }}</div>
                @endif
                <div class="price-wrap">
                  <h4 class="price">{{ __('Virtual Fee') }}:
                    <span>{{ amount_with_currency_symbol(50) }} <small>min</small> </span>
                    <small></small>
                  </h4>
                </div>
                <div class="price-wrap">
                  <h4 class="price">{{ __('On Premise Fee') }}:
                    <span>{{ amount_with_currency_symbol($item->price) }} <small>min</small> </span>
                  </h4>
                </div>

                <small>Disclaimer: Prices may vary depending on your location</small>



                {{-- <div class="social-share-wrap">
                                    <ul class="social-share">
                                        {!! single_post_share(
                                            route('frontend.appointment.single', [optional($item->lang_front)->slug ?? __('untitled'), $item->id]),
                                            optional($item->lang_front)->title,
                                            get_attachment_url_by_id($item->image, 'full'),
                                        ) !!}
                                    </ul>
                                </div> --}}
              </div>
            </div>
            <div class="bottom-part">
              <x-error-msg />
              <x-flash-msg />
              <nav>
                <div class="nav nav-tabs" role="tablist">

                  <a class="nav-link active" data-toggle="tab" href="#nav-booking" role="tab" aria-selected="true">{{ get_static_option('appointment_single_' . $user_select_lang_slug . '_booking_tab_title') }}</a>
                  {{-- <a class="nav-link" data-toggle="tab" href="#nav-feedback" role="tab"
                                        aria-selected="false">{{ get_static_option('appointment_single_' . $user_select_lang_slug . '_feedback_tab_title') }}</a> --}}
                </div>
              </nav>
              <div class="tab-content">

                <div class="tab-pane fade show active" id="nav-booking" role="tabpanel">
                  @if ($item->appointment_status === 'yes')
                    <div class="booking-wrap">
                      {{-- calendar goes here --}}
                      <div id="calendar"></div>

                    </div>
                    {{-- calendar goes here --}}

                    <div class="right-part">
                      <div class="form-wrapper">

                        <div class="billing-details-wrapper">
                          <div class="order-tab-wrap">
                            <nav>
                              <div class="nav nav-tabs" role="tablist">
                                @if (!auth()->guard('web')->check())
                                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-selected="true"><i class="fas fa-user"></i></a>
                                @endif
                                <a class="nav-item nav-link  @if (auth()->check()) active @else disabled @endif" disabled id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-address-book"></i></a>
                              </div>
                            </nav>
                            <div class="tab-content">
                              @if (!auth()->guard('web')->check())
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                  @if (get_static_option('disable_guest_mode_for_appointment_module'))
                                    <div class="checkout-type margin-bottom-30  @if (auth()->guard('web')->check()) d-none @endif ">
                                      <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="guest_logout" name="checkout_type">
                                        <label class="custom-control-label" for="guest_logout">{{ __('Guest Order') }}</label>
                                      </div>
                                    </div>
                                  @endif
                                  @if (!auth()->guard('web')->check())
                                    @include('frontend.partials.ajax-login-form')
                                  @else
                                    <div class="alert alert-success">
                                      {{ __('Your Are Logged In As') }}
                                      {{ auth()->guard('web')->user()->name }}
                                    </div>
                                  @endif
                                  @if (!auth()->guard('web')->check())
                                    <div class="next-step">
                                      <button class="next-step-btn btn-boxed" style="display: none" type="button">{{ __('Next Step') }}</button>
                                    </div>
                                  @endif
                                </div>
                              @endif
                              <div class="tab-pane fade @if (auth()->guard('web')->check()) show active @endif" id="nav-profile" role="tabpanel">

                                <h3 class="title">
                                  {{ get_static_option('appointment_single_' . $user_select_lang_slug . '_appointment_booking_information_text') }}
                                </h3>
                                <form action="{{ route('frontend.appointment.booking') }}" method="post" class="appointment-booking-form" id="appointment-booking-form" enctype="multipart/form-data">
                                  @csrf
                                  <div class="error-message"></div>
                                  <input type="hidden" name="booking_date">
                                  <input type="hidden" name="booking_time_id">
                                  <input type="hidden" name="appointment_id" value="{{ $item->id }}">

                                  <div class="form-group">
                                    <label for="location">Select Appointment Type:</label>
                                    <select name="appointment_type" id="appointment_type">
                                      <option value="virtual">Virtual</option>
                                      <option value="on_premise">On Premise</option>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <input type="text" name="coupon" class="form-control" placeholder="{{ __('Coupon') }}">
                                  </div>
                                  {{-- @if (session('type') && session('msg'))
                                      <div class="alert alert-{{ session('type') }}">
                                        {{ session('msg') }}
                                      </div>
                                    @endif --}}

                                  <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ auth()->guard('web')->check() ? auth()->guard('web')->user()->name : '' }}">
                                  </div>
                                  <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ auth()->guard('web')->check() ? auth()->guard('web')->user()->email : '' }}">
                                  </div>
                                  {!! render_form_field_for_frontend(get_static_option('appointment_booking_page_form_fields')) !!}


                                  @if (!empty($item->price))
                                    {!! render_payment_gateway_for_form(false) !!}
                                    @if (!empty(get_static_option('manual_payment_gateway')))
                                      <div class="form-group manual_payment_transaction_field" @if (get_static_option('site_default_payment_gateway') === 'manual_payment') style="display: block;" @endif>
                                        <div class="label mb-2">
                                          {{ __('Attach your bank Document') }}
                                        </div>
                                        <input class="form-control btn btn-primary btn-sm pb-2 pt-2" type="file" name="manual_payment_attachment">
                                        <span class="help-info mt-2">{!! get_manual_payment_description() !!}</span>
                                      </div>
                                    @endif
                                  @endif
                                  <div class="button-wrap">
                                    <button type="submit" class="btn-boxed appointment appo_booking_btn">{{ get_static_option('appointment_single_' . $user_select_lang_slug . '_appointment_booking_button_text') }}
                                      <i class="fas fa-spinner fa-spin d-none"></i></button>
                                  </div>
                                </form>

                              </div>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>
                </div>
              @else
                <div class="alert alert-warning"> {{ __('Not Available') }}</div>
                @endif
              </div>
              <div class="tab-pane fade" id="nav-feedback" role="tabpanel">
                <div class="feedback-wrapper">
                  @if (auth()->guard('web')->check())
                    <div class="feedback-form-wrapper">
                      <h3 class="title">{{ __('Leave your feedback') }}</h3>
                      <form action="{{ route('frontend.appointment.review') }}" method="post" class="appointment-booking-form" id="appointment_rating_form">
                        @csrf
                        <div class="error-message"></div>
                        <input type="hidden" name="appointment_id" value="{{ $item->id }}">
                        <div class="form-group">
                          <label for="rating-empty-clearable2">{{ __('Ratings') }}</label>
                          <input type="number" name="ratings" id="rating-empty-clearable2" class="rating text-warning" />
                        </div>
                        <div class="form-group">
                          <label for="">{{ __('Message') }}</label>
                          <textarea name="message" cols="30" class="form-control" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn-boxed appointment" id="appointment_ratings">{{ __('Submit') }} <i class="fas fa-spinner fa-spin d-none"></i></button>
                      </form>
                    </div>
                  @else
                    @include('frontend.partials.ajax-login-form')
                  @endif
                  @if (count($item->reviews) > 0)
                    <div class="feedback-comment-list-wrap margin-top-40">
                      <h3 class="title">
                        {{ get_static_option('appointment_single_' . $user_select_lang_slug . '_appointment_booking_client_feedback_title') }}
                      </h3>
                      <ul class="feedback-list">
                        @foreach ($item->reviews as $data)
                          <li class="single-feedback-item">
                            <div class="content">
                              <h4 class="title">
                                {{ $data->user ? optional($data->user)->username : __('Anonymous') }}
                              </h4>
                              <div class="rating-wrap single">
                                @for ($i = 1; $i <= $data->ratings; $i++)
                                  <i class="fas fa-star"></i>
                                @endfor
                              </div>
                              <div class="description">{{ $data->message }}</div>
                            </div>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
@endsection

@section('scripts')
  <script type="text/javascript" src="//use.fontawesome.com/5ac93d4ca8.js"></script>
  <script type="text/javascript" src="{{ asset('assets/frontend/js/bootstrap4-rating-input.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
  {{-- <script src='https://cdn.jsdelivr.net/npm/evo-calendar@1.1.3/evo-calendar/js/evo-calendar.min.js'></script> --}}
  <script type="text/javascript" src="{{ asset('assets-custom/js/evo-calendar.js') }}"></script>

  @include('frontend.partials.ajax-login-form-js')

  <script>
    $(document).ready(function() {
      $.ajax({
        url: "{{ route('frontend.appointment.booking.time.check') }}",
        type: 'post',
        data: {
          _token: '{{ csrf_token() }}',
          date: $(this).data('date'),
          appointment_id: '{{ $item->id }}'
        },
        success: function(data) {
          var calendarEvents = []; // Initialize calendarEvents array
          $.each(data.available_booking_dates, function(index, date) {
            console.log("Dates:" + date);
            $.each(data.available_booking_time, function(index, value) {
              calendarEvents.push({
                id: value.id,
                name: value.time, // Adjust these according to your data structure
                date: date, // Adjust these according to your data structure
                type: "holiday", // Adjust these according to your data structure
                color: '#63d867'
              });

            });
          });

          // Initialize evoCalendar with the updated calendarEvents array
          $('#calendar').evoCalendar({
            'todayHighlight': true,
            'sidebarDisplayDefault': false,
            'format': 'yyyy-mm-dd',
            calendarEvents: calendarEvents
          });

          $('#calendar').on('selectEvent', function(event, activeEvent) {
            $('input[name="booking_date"]').val(activeEvent.date);
            $('input[name="booking_time_id"]').val(activeEvent.id);

          });

          $('#calendar').on('selectDate', function(event, newDate, oldDate) {
            $('input[name="booking_date"]').val(newDate);
          });
        }
      });
    });
  </script>


  {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarBody = document.querySelector('#calendar tbody');
      var availableTimesDiv = document.getElementById('availableTimes');
      var currentMonthDisplay = document.getElementById('currentMonth');
      var backToCurrentBtn = document.getElementById('backToCurrentBtn');
      let bookingDates = []; // Array to store booking dates
      var currentMonth;
      var today = new Date();
      var prevMonthBtn = document.getElementById('prevMonthBtn');
      var nextMonthBtn = document.getElementById('nextMonthBtn');
      var bookingDateInput = document.querySelector('input[name="booking_date"]');
      var selectedCell = null;

      // Function to fetch booking dates from the backend
      function fetchBookingDates(appointmentId) {
        // Make a fetch request to your backend to fetch booking dates
        // Replace the URL with your actual endpoint

        fetch('/appointment-booking-date-check?appointment_id=' + appointmentId)
          .then(response => response.json())
          .then(data => {
            // Update bookingDates array with fetched data
            bookingDates = data.all_booking_dates;
            updateCalendar(); // Update the calendar with fetched booking dates
          })
          .catch(error => {
            console.error('Error fetching booking dates:', error);
          });

      }

      // Function to fetch booking dates and update the calendar
      function updateCalendar() {
        // Here, you would fetch booking dates from the backend
        const appointmentId = `{{ $item->id }}`;
        fetchBookingDates(appointmentId);

        // Clear existing calendar
        calendarBody.innerHTML = '';

        // Generate calendar days for the current month
        var date = new Date(currentMonth.getFullYear(), currentMonth.getMonth(), 1);
        while (date.getMonth() === currentMonth.getMonth()) {
          var row = document.createElement('tr');
          for (var i = 0; i < 7; i++) {
            var cell = document.createElement('td');
            cell.textContent = date.getDate();
            if (date.getMonth() === currentMonth.getMonth()) {
              // Adjust date format to match the booking dates
              var dateString = formatDate(date);
              if (bookingDates.includes(dateString)) {
                cell.classList.add('available');
                cell.dataset.date = dateString; // Store the date in dataset
                cell.addEventListener('click', function() {
                  // Remove border from previously selected cell
                  if (selectedCell !== null) {
                    selectedCell.classList.remove('selected');
                  }
                  // Add border to the clicked cell
                  this.classList.add('btn');
                  selectedCell = this;
                  // Update booking_date input field with selected date
                  bookingDateInput.value = this.dataset.date;
                  // Display loading message
                  availableTimesDiv.textContent = 'Loading Available Timesss...';
                  // Fetch available times for the selected date
                  fetchAvailableTimes(this.dataset.date);
                  availableTimesDiv.textContent = '';
                });
              } else {
                cell.classList.add('inactive');
              }
            } else {
              cell.classList.add('inactive');
            }
            // Highlight current day with a dot
            if (isSameDate(date, today)) {
              var dot = document.createElement('div');
              dot.classList.add('current-day-dot');
              var span = document.createElement('span');
              span.textContent = date.getDate(); // Display the date number
              dot.appendChild(span);
              cell.appendChild(dot);
            }
            row.appendChild(cell);
            date.setDate(date.getDate() + 1); // Move to the next day
          }
          calendarBody.appendChild(row);
        }

        // Update the current month display
        currentMonthDisplay.textContent = currentMonth.toLocaleString('en-US', {
          month: 'long',
          year: 'numeric'
        });

        // Toggle visibility of back-to-current button
        if (currentMonth.getFullYear() === today.getFullYear() && currentMonth.getMonth() === today.getMonth()) {
          backToCurrentBtn.style.display = 'none';
        } else {
          backToCurrentBtn.style.display = 'inline';
          backToCurrentBtn.textContent = 'Back to ' + today.toLocaleString('en-US', {
            month: 'long'
          });
        }

        // Disable previous month button if it's before the current month
        prevMonthBtn.disabled = isPreviousMonthBeforeCurrent();
      }

      // Function to check if the previous month is before the current month
      function isPreviousMonthBeforeCurrent() {
        var previousMonth = new Date(currentMonth);
        previousMonth.setMonth(previousMonth.getMonth() - 1);
        return (previousMonth.getFullYear() < today.getFullYear() ||
          (previousMonth.getFullYear() === today.getFullYear() && previousMonth.getMonth() < today.getMonth()));
      }

      // Function to format date as YYYY-MM-DD
      function formatDate(date) {
        var year = date.getFullYear();
        var month = (date.getMonth() + 1).toString().padStart(2, '0');
        var day = date.getDate().toString().padStart(2, '0');
        return year + '-' + month + '-' + day;
      }

      // Function to check if two dates are the same
      function isSameDate(date1, date2) {
        return date1.getFullYear() === date2.getFullYear() &&
          date1.getMonth() === date2.getMonth() &&
          date1.getDate() === date2.getDate();
      }

      // Function to fetch available times from the backend
      function fetchAvailableTimes(selectedDate) {
        // Make a fetch request to your backend to fetch available times
        // Replace the URL with your actual endpoint
        fetch('/appointment-booking-check', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token if needed
            },
            body: JSON.stringify({
              date: selectedDate,
              appointment_id: '{{ $item->id }}' // Pass the appointment ID
            })
          })
          .then(response => response.json())
          .then(data => {
            // Process the response and display available times
            $('#time_slot_wrapper').html('');
            $.each(data.available_booking_time, function(index, value) {
              if (value != false) {
                $('#time_slot_wrapper').append('<li data-id="' + value.id +
                  '">' + value.time + '</li>');
                $('#time_slot_warning').hide();
              } else {
                $('#time_slot_warning').text(
                  'no booking time available this date');
                $('#time_slot_warning').show();
              }
            });

          })
          .catch(error => {
            console.error('Error fetching available times:', error);
            availableTimesDiv.textContent = 'Error fetching available times';
          });
      }

      // Event listener for previous month button
      prevMonthBtn.addEventListener('click', function() {
        currentMonth.setMonth(currentMonth.getMonth() - 1);
        updateCalendar();
      });

      // Event listener for next month button
      nextMonthBtn.addEventListener('click', function() {
        currentMonth.setMonth(currentMonth.getMonth() + 1);
        updateCalendar();
      });

      // Event listener for back to current month button
      backToCurrentBtn.addEventListener('click', function() {
        currentMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        updateCalendar();
      });

      // Initialize calendar with the current month
      currentMonth = new Date(today.getFullYear(), today.getMonth(), 1);
      updateCalendar();
    });
  </script> --}}




  <script>
    (function($) {
      "use strict";

      $(document).on('change', '#guest_logout', function(e) {
        e.preventDefault();
        var infoTab = $('#nav-profile-tab');
        var nextBtn = $('.next-step-btn');
        if ($(this).is(':checked')) {
          $('.booking-wrap .login-form').hide();
          infoTab.attr('disabled', false).removeClass('disabled');
          nextBtn.show();

        } else {
          $('.login-form').show();
          infoTab.attr('disabled', true).addClass('disabled');
          nextBtn.hide();
        }
      });
      $(document).on('click', '.next-step-btn', function(e) {
        var infoTab = $('#nav-profile-tab');
        infoTab.attr('disabled', false).removeClass('disabled').addClass('active').siblings()
          .removeClass('active');
        $('#nav-profile').addClass('show active').siblings().removeClass('show active');
      });

      $(document).on('click', '.payment-gateway-wrapper > ul > li', function(e) {
        e.preventDefault();
        var gateway = $(this).data('gateway');
        var manual_gateway_tr = $('.manual_payment_transaction_field');
        $(this).addClass('selected').siblings().removeClass('selected');
        $('input[name="selected_payment_gateway"]').val(gateway);
        if (gateway === 'manual_payment') {
          manual_gateway_tr.show();
        } else {
          manual_gateway_tr.hide();
        }
      });

      $(document).on('click', '.time-slot.date li', function(e) {
        e.preventDefault();

        var date = $(this).data('date');
        date = date.split('-');
        var showDate = new Date(date[2] + '-' + date[1] + '-' + date[0]);
        $('.time_slog_date').text(showDate.toDateString());
        $(this).toggleClass('selected').siblings().removeClass('selected');
        $('input[name="booking_date"]').val($(this).data('date'));
        //frontend.appointment.booking.time.check
        $('#time_slot_warning').show();
        $('#time_slot_warning').text('Loading Available Times..');
        $('#time_slot_wrapper').html('');

        $.ajax({
          url: "{{ route('frontend.appointment.booking.time.check') }}",
          type: 'post',
          data: {
            _token: '{{ csrf_token() }}',
            date: $(this).data('date'),
            appointment_id: '{{ $item->id }}'
          },
          success: function(data) {
            console.log(data);
            console.log(data.appointment_id);
            $.each(data.available_booking_time, function(index, value) {
              if (value != false) {
                $('#time_slot_wrapper').append('<li data-id="' + value.id +
                  '">' + value.time + '</li>');
                $('#time_slot_warning').hide();
              } else {
                $('#time_slot_warning').text(
                  'no booking time available this date');
                $('#time_slot_warning').show();
              }
            });
            //append time slot for the current selected item
          }
        });
      });

      $(document).on('click', '.time-slot.time li', function(e) {
        e.preventDefault();
        $(this).addClass('selected').siblings().removeClass('selected');
        $('input[name="booking_time_id"]').val($(this).data('id'));
      });


      $(document).on('click', '#appointment_ratings', function(e) {
        e.preventDefault();
        var myForm = document.getElementById('appointment_rating_form');
        var formData = new FormData(myForm);

        $.ajax({
          type: "POST",
          url: "{{ route('frontend.appointment.review') }}",
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function() {
            $('#appointment_ratings').children('i').removeClass('d-none');
          },
          success: function(data) {
            var errMsgContainer = $('#appointment_rating_form').find('.error-message');
            $('#appointment_ratings').children('i').addClass('d-none');
            errMsgContainer.html('');
            errMsgContainer.append('<div class="alert alert-' + data.type + '">' + data
              .msg + '</div>');

          },
          error: function(data) {
            var error = data.responseJSON;
            var errMsgContainer = $('#appointment_rating_form').find('.error-message');
            errMsgContainer.html('');
            $.each(error.errors, function(index, value) {
              errMsgContainer.append('<span class="text-danger">' + value +
                '</span>');
            });
            $('#appointment_ratings').children('i').addClass('d-none');
          }
        });
      });
      //appo_booking_btn
    })(jQuery);
  </script>
@endsection
