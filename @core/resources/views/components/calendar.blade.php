<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calendar</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
  <style>
    .calendar {
      height: 30rem;
      width: max-content;
      background-color: white;
      border-radius: 25px;
      overflow: hidden;
      padding: 35px 50px 0px 50px;
    }

    .calendar {
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    .calendar-header {
      background: #8089FE;
      display: flex;
      justify-content: space-between;
      border-radius: 7px;
      align-items: center;
      font-weight: 700;
      color: #ffffff;
      padding: 10px;
    }

    .calendar-body {
      padding: 10px;
    }

    .calendar-week-days {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      font-weight: 600;
      cursor: pointer;
      color: rgb(104, 104, 104);
    }

    .calendar-week-days div:hover {
      color: black;
      transform: scale(1.2);
      transition: all .2s ease-in-out;
    }

    .calendar-week-days div {
      display: grid;
      place-items: center;
      color: #6D67CF;
      height: 50px;
    }

    .calendar-days {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 2px;
      color: #0A0921;
    }

    .calendar-days div {
      width: 37px;
      height: 33px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 5px;
      position: relative;
      cursor: pointer;
      animation: to-top 1s forwards;
    }

    .month-picker {
      padding: 5px 10px;
      border-radius: 10px;
      cursor: pointer;
    }

    .year-picker {
      display: flex;
      align-items: center;
    }

    .year-change {
      height: 30px;
      width: 30px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      margin: 0px 10px;
      cursor: pointer;
    }

    .year-change:hover {
      background-color: #9796f0;
      transition: all .2s ease-in-out;
      transform: scale(1.12);
    }

    .calendar-footer {
      padding: 10px;
      display: flex;
      justify-content: flex-end;
      align-items: center;
    }

    #year:hover {
      cursor: pointer;
      transform: scale(1.2);
      transition: all 0.2 ease-in-out;
    }

    .calendar-days div span {
      position: absolute;
    }

    .calendar-days div:hover {
      transition: width 0.2s ease-in-out, height 0.2s ease-in-out;
      background-color: #fbc7d4;
      border-radius: 20%;
      color: #f8fbff;
    }

    .calendar-days div.current-date {
      color: #f8fbff;
      background-color: #9796f0;
      border-radius: 20%;
    }

    .month-list {
      position: relative;
      left: 0;
      top: -130px;
      background-color: #ebebeb;
      color: #151426;
      display: grid;
      grid-template-columns: repeat(3, auto);
      gap: 5px;
      border-radius: 20px;
    }

    .month-list>div {
      display: grid;
      place-content: center;
      margin: 5px 10px;
      transition: all 0.2s ease-in-out;
    }

    .month-list>div>div {
      border-radius: 15px;
      padding: 10px;
      cursor: pointer;
    }

    .month-list>div>div:hover {
      background-color: #9796f0;
      color: #f8fbff;
      transform: scale(0.9);
      transition: all 0.2s ease-in-out;
    }

    .month-list.show {
      visibility: visible;
      pointer-events: visible;
      transition: 0.6s ease-in-out;
      animation: to-left .71s forwards;
    }

    .month-list.hideonce {
      visibility: hidden;
    }

    .month-list.hide {
      animation: to-right 1s forwards;
      visibility: none;
      pointer-events: none;
    }

    .date-time-formate {
      height: 4rem;
      width: 100%;
      font-family: Dubai Light, Century Gothic;
      position: relative;
      display: flex;
      top: 50px;
      justify-content: center;
      align-items: center;
    }

    .day-text-formate {
      font-family: Microsoft JhengHei UI;
      font-size: 1.4rem;
      padding-right: 5%;
      border-right: 3px solid #9796f0;
    }

    .date-time-value {
      display: block;
      position: relative;
      text-align: center;
      padding-left: 5%;
    }

    .time-formate {
      font-size: 1.5rem;
    }

    .time-formate.hideTime {
      animation: hidetime 1.5s forwards;
    }

    .day-text-formate.hidetime {
      animation: hidetime 1.5s forwards;
    }

    .date-formate.hideTime {
      animation: hidetime 1.5s forwards;
    }

    .day-text-formate.showtime {
      animation: showtime 1s forwards;
    }

    .time-formate.showtime {
      animation: showtime 1s forwards;
    }

    .date-formate.showtime {
      animation: showtime 1s forwards;
    }

    /* @keyframes to-top {
      0% {
        transform: translateY(0);
        opacity: 0;
      }

      100% {
        transform: translateY(100%);
        opacity: 1;
      }
    } */

    @keyframes to-left {
      0% {
        transform: translatex(230%);
        opacity: 1;
      }

      100% {
        transform: translatex(0);
        opacity: 1;
      }
    }

    @keyframes to-right {
      10% {
        transform: translatex(0);
        opacity: 1;
      }

      100% {
        transform: translatex(-150%);
        opacity: 1;
      }
    }

    @keyframes showtime {
      0% {
        transform: translatex(250%);
        opacity: 1;
      }

      100% {
        transform: translatex(0%);
        opacity: 1;
      }
    }

    @keyframes hidetime {
      0% {
        transform: translatex(0%);
        opacity: 1;
      }

      100% {
        transform: translatex(-370%);
        opacity: 1;
      }
    }
  </style>
</head>

<body>
  <div class="contianer">
    <div class="calendar">
      <div class="calendar-header">
        <span class="month-picker" id="month-picker"> May </span>
        <div class="year-picker" id="year-picker">
          <span class="year-change" id="pre-year">
            <pre><</pre>
          </span>
          <span id="year">2020 </span>
          <span class="year-change" id="next-year">
            <pre>></pre>
          </span>
        </div>
      </div>

      <div class="calendar-body">
        <div class="calendar-week-days">
          <div>Sun</div>
          <div>Mon</div>
          <div>Tue</div>
          <div>Wed</div>
          <div>Thu</div>
          <div>Fri</div>
          <div>Sat</div>
        </div>
        <div class="calendar-days">
        </div>
      </div>
      <div class="calendar-footer">
      </div>
      <div class="date-time-formate">
        <div class="day-text-formate">TODAY</div>
        <div class="date-time-value">
          <div class="time-formate">01:41:20</div>
          <div class="date-formate">03 - march - 2022</div>
        </div>
      </div>
      <div class="month-list"></div>
    </div>
  </div>
</body>

<script>
  const isLeapYear = (year) => {
    return (
      (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) ||
      (year % 100 === 0 && year % 400 === 0)
    );
  };
  const getFebDays = (year) => {
    return isLeapYear(year) ? 29 : 28;
  };
  let calendar = document.querySelector('.calendar');
  const month_names = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
  ];
  let month_picker = document.querySelector('#month-picker');
  const dayTextFormate = document.querySelector('.day-text-formate');
  const timeFormate = document.querySelector('.time-formate');
  const dateFormate = document.querySelector('.date-formate');

  month_picker.onclick = () => {
    month_list.classList.remove('hideonce');
    month_list.classList.remove('hide');
    month_list.classList.add('show');
    dayTextFormate.classList.remove('showtime');
    dayTextFormate.classList.add('hidetime');
    timeFormate.classList.remove('showtime');
    timeFormate.classList.add('hideTime');
    dateFormate.classList.remove('showtime');
    dateFormate.classList.add('hideTime');
  };

  const generateCalendar = (month, year) => {
    let calendar_days = document.querySelector('.calendar-days');
    calendar_days.innerHTML = '';
    let calendar_header_year = document.querySelector('#year');
    let days_of_month = [
      31,
      getFebDays(year),
      31,
      30,
      31,
      30,
      31,
      31,
      30,
      31,
      30,
      31,
    ];

    let currentDate = new Date();

    month_picker.innerHTML = month_names[month];

    calendar_header_year.innerHTML = year;

    let first_day = new Date(year, month);


    for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {

      let day = document.createElement('div');

      if (i >= first_day.getDay()) {
        day.innerHTML = i - first_day.getDay() + 1;

        if (i - first_day.getDay() + 1 === currentDate.getDate() &&
          year === currentDate.getFullYear() &&
          month === currentDate.getMonth()
        ) {
          day.classList.add('current-date');
        }
      }
      calendar_days.appendChild(day);
    }
  };

  let month_list = calendar.querySelector('.month-list');
  month_names.forEach((e, index) => {
    let month = document.createElement('div');
    month.innerHTML = `<div>${e}</div>`;

    month_list.append(month);
    month.onclick = () => {
      currentMonth.value = index;
      generateCalendar(currentMonth.value, currentYear.value);
      month_list.classList.replace('show', 'hide');
      dayTextFormate.classList.remove('hideTime');
      dayTextFormate.classList.add('showtime');
      timeFormate.classList.remove('hideTime');
      timeFormate.classList.add('showtime');
      dateFormate.classList.remove('hideTime');
      dateFormate.classList.add('showtime');
    };
  });

  (function() {
    month_list.classList.add('hideonce');
  })();
  document.querySelector('#pre-year').onclick = () => {
    --currentYear.value;
    generateCalendar(currentMonth.value, currentYear.value);
  };
  document.querySelector('#next-year').onclick = () => {
    ++currentYear.value;
    generateCalendar(currentMonth.value, currentYear.value);
  };

  let currentDate = new Date();
  let currentMonth = {
    value: currentDate.getMonth()
  };
  let currentYear = {
    value: currentDate.getFullYear()
  };
  generateCalendar(currentMonth.value, currentYear.value);

  const todayShowTime = document.querySelector('.time-formate');
  const todayShowDate = document.querySelector('.date-formate');

  const currshowDate = new Date();
  const showCurrentDateOption = {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    weekday: 'long',
  };
  const currentDateFormate = new Intl.DateTimeFormat(
    'en-US',
    showCurrentDateOption
  ).format(currshowDate);
  todayShowDate.textContent = currentDateFormate;
  setInterval(() => {
    const timer = new Date();
    const option = {
      hour: 'numeric',
      minute: 'numeric',
      second: 'numeric',
    };
    const formateTimer = new Intl.DateTimeFormat('en-us', option).format(timer);
    let time = `${`${timer.getHours()}`.padStart(
      2,
      '0'
    )}:${`${timer.getMinutes()}`.padStart(
      2,
      '0'
    )}: ${`${timer.getSeconds()}`.padStart(2, '0')}`;
    todayShowTime.textContent = formateTimer;
  }, 1000);
</script>

</html>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarBody = document.querySelector('#calendar tbody');
    var availableTimesDiv = document.getElementById('availableTimes');
    var bookingDates = []; // Array to store booking dates

    // Function to fetch booking dates and update the calendar
    function updateCalendar() {
      // Here, you would fetch booking dates from the backend
      // For simplicity, let's assume booking dates are hardcoded here
      bookingDates = ['2024-02-14', '2024-02-15', '2024-02-20'];

      // Clear existing calendar
      calendarBody.innerHTML = '';

      // Generate calendar days
      var date = new Date();
      date.setDate(1); // Set date to the first day of the month
      while (date.getDay() !== 0) {
        date.setDate(date.getDate() - 1); // Move date to previous Sunday
      }
      var today = new Date(); // Get today's date
      while (date.getMonth() === today.getMonth() || date.getMonth() === today.getMonth() - 1) {
        var row = document.createElement('tr');
        for (var i = 0; i < 7; i++) {
          var cell = document.createElement('td');
          cell.textContent = date.getDate();
          if (date.getMonth() === today.getMonth()) {
            if (bookingDates.includes(date.toISOString().split('T')[0])) {
              cell.classList.add('available');
            } else {
              cell.classList.add('inactive');
            }
          } else {
            cell.classList.add('inactive');
          }
          row.appendChild(cell);
          date.setDate(date.getDate() + 1); // Move to the next day
        }
        calendarBody.appendChild(row);
      }
    }

    // Function to display available times for the selected date
    function displayAvailableTimes(date) {
      // Here, you would fetch available times for the selected date from the backend
      // For simplicity, let's assume available times are hardcoded here
      var availableTimes = ['09:00 AM', '10:00 AM', '11:00 AM', '02:00 PM', '03:00 PM'];

      // Display available times
      availableTimesDiv.innerHTML = '';
      availableTimesDiv.innerHTML = '<h3>Available Times for ' + date + '</h3>';
      availableTimesDiv.innerHTML += '<ul>';
      availableTimes.forEach(function(time) {
        availableTimesDiv.innerHTML += '<li>' + time + '</li>';
      });
      availableTimesDiv.innerHTML += '</ul>';
    }

    // Event listener for clicking on calendar cells
    calendarBody.addEventListener('click', function(event) {
      var target = event.target;
      if (target.tagName === 'TD' && target.classList.contains('available')) {
        // Reset previously selected date cell
        var selectedCell = calendarBody.querySelector('.selected');
        if (selectedCell) {
          selectedCell.classList.remove('selected');
        }
        // Highlight selected date cell
        target.classList.add('selected');
        // Update selected date
        var date = target.textContent + '-' + (new Date().getMonth() + 1) + '-' + new Date().getFullYear();
        // Display available times for the selected date
        displayAvailableTimes(date);
      }
    });

    // Initialize calendar
    updateCalendar();
  });
</script>

<div class="left-part">
  <div class="date-time-block">
    <h4 class="title">{{ __('Available On') }}
      <time>{{ date('F Y') }}</time>
    </h4>
    <ul class="time-slot date">

      <li data-date="{{ date('d-m-Y') }}">{{ date('d/m/Y') }}</li>
      @for ($i = 1; $i < 30; $i++)
        <li data-date="{{ date('d-m-Y', strtotime('+' . $i . ' day')) }}">
          {{ date('d/m/Y', strtotime('+' . $i . ' day')) }}</li>
      @endfor
    </ul>
  </div>
  <div class="date-time-block">
    <h4 class="title">{{ __('Availability On') }} <time class="time_slog_date">{{ date('D, d F, Y') }}</time></h4>
    <p class="alert alert-warning " id="time_slot_warning">
      {{ __('select date first') }}</p>
    <ul class="time-slot time" id="time_slot_wrapper">
      {{-- @foreach ($item->booking_time_ids as $time)
                                                        <li data-id="{{$time['id']}}">{{$time['time']}}</li>
                                                    @endforeach  --}}
    </ul>
  </div>
</div>
