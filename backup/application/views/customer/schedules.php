<style type="text/css">
  td.fc-day {
      position: relative;
  }
  .schedule_count {
    background: #2196F3;
    display: inline-block;
    padding: 3px;
    position: absolute;
    bottom: 10px;
    right: 10px;
    color: #fff;
    font-weight: bold;
    border-radius: 5px;
  }
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.css" />
<script src="<?php echo base_url();?>assets/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/fullcalendar/gcal.js"></script>

<div class="container calendar--container">
    <p>Legend</p>
    <span style="width: 20px;height: 20px;margin:0 5px;background: white;display: inline-block;border:1px solid black;">&nbsp;</span> <small><b>White</b> - Valid date</small>
    <span style="width: 20px;height: 20px;margin:0 5px;background: gray;display: inline-block;">&nbsp;</span> <small><b>Gray</b> - Invalid Date</small>
    <!-- <span style="width: 20px;height: 20px;margin:0 5px;background: #FF9800;display: inline-block;">&nbsp;</span> <small><b>Orange</b> - Pending</small>
    <span style="width: 20px;height: 20px;margin:0 5px;background: #e91e63;display: inline-block;">&nbsp;</span> <small><b>Pink</b> - Team A</small>
    <span style="width: 20px;height: 20px;margin:0 5px;background: #2196f3;display: inline-block;">&nbsp;</span> <small><b>Blue</b> - Team B</small>
    <span style="width: 20px;height: 20px;margin:0 5px;background: #ffeb3b;display: inline-block;">&nbsp;</span> <small><b>Yellow</b> - Team C</small> -->
    
    <p style="margin-top: 10px;"><b>Note: </b></p>
    <ul>
        <li>1 to 3 events only per day</li>
        <li>Wedding event must be reserved 5 months before the event date.</li>
        <li>Other events must be reserved 2 months before the event date.</li>
    </ul>
    <div id="calendar"></div>
    <hr>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var base_url = "<?php echo base_url();?>";
    var user_login = "<?php echo $this->session->userdata('id')?>";
    $('#calendar').fullCalendar({
        allDay: true,
        dayRender: function (date, cell) {
            // cell.css("background-color", "#ccc");
            var selected_date = date.format();
            // var selected_date_add_two_months = date.add(2, 'months').format();
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 3; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
              dd = '0' + dd;
            }
            if (mm < 10) {
              mm = '0' + mm;
            }
            today_add_two_months = mm + '-' + dd + '-' + yyyy;
            var strtDt  = new Date(selected_date);
            var endDt  = new Date(today_add_two_months);

            if (endDt <= strtDt){
                //proceed  
                $.ajax({
                    url: base_url + 'calendar/check_date/',
                    dataType: 'json',
                    data: {date: date.unix()},
                    success: function(data) {
                        res = data.schedule_date_count;
                        if(res >= 3) {
                            cell.css("background-color", "#ccc");   
                            $(cell).addClass('disabled');
                        }
                    }
                });

                            $.ajax({
                url: base_url + 'calendar/get_schedule/',
                dataType: 'json',
                data: {date: date.format()},
                success: function(data) {
                    res = 3 - data.schedule_count;
                    if(res == 1) {
                      slot = 'slot';
                    } else {
                      slot = 'slots';
                    }
                    if(res <= 0) {
                      cell.append('<div class="schedule_count">No slots available.</div>');
                    } else {
                      cell.append('<div class="schedule_count">'+ res + ' ' + slot + ' available</div>');
                    }
                }
            });
            } else {
                //do not proceed
               cell.css("background-color", "#ccc");    
               $(cell).addClass('disabled');
            }

        },
      dayClick: function(date, jsEvent, view) {

        $.ajax({
            url: base_url + 'calendar/check_date/',
            dataType: 'json',
            data: {date: date.unix()},
            success: function(data) {
                res = data.schedule_date_count;
                if(res >= 3) {
                    alert('Reservation date is full at the moment. Please select other dates or contact the owner.');
                } else {
                    var selected_date = date.format();
                    // var selected_date_add_two_months = date.add(2, 'months').format();
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth() + 3; //January is 0!
                    var yyyy = today.getFullYear();
                    if (dd < 10) {
                      dd = '0' + dd;
                    }
                    if (mm < 10) {
                      mm = '0' + mm;
                    }
                    today_add_two_months = mm + '-' + dd + '-' + yyyy;
                    var strtDt  = new Date(selected_date);
                    var endDt  = new Date(today_add_two_months);

                    if(!user_login) {
                        if (window.confirm('You must be login first.')) {
                            window.location.href = base_url + 'user/login';
                        }
                    } else {
                        if (endDt <= strtDt){
                            //proceed  
                            window.location.href = base_url + 'reservation/details/' + selected_date;   
                        } else {
                            //do not proceed
                           alert('Reservation Date must be 2 months from date today.');
                        }
                    }
                }
            }
        });

        
      },

     //  eventSources: [
     //  {
     //     events: function(start, end, timezone, callback) {
     //         $.ajax({
     //         url: base_url + 'calendar/get_events',
     //         dataType: 'json',
     //         data: {
     //         start: start.unix(),
     //         end: end.unix()
     //         },
     //         success: function(msg) {
     //             var events = msg.events;
     //             callback(events);
     //         }
     //         });
     //     }
     //   },
     // ],
    });

    $('#calendar').fullCalendar('gotoDate', '<?php echo $goTodate;?>');

  });

</script>

<!-- <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      // put your options and callbacks here
    })
  });
</script>
$('#calendar').fullCalendar('gotoDate', '<?php echo $goTodate;?>');
 -->