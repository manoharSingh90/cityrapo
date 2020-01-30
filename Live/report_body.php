<div class="pageArea">
  <div class="pageHeader clearfix">
    <h2 class="float-left pageTitle"><span class="ml-2"><?= $title?></span></h2>
    <div class="float-right pageAction">
      <h3 class="userName">Hello <?php echo ucwords($this->session->userdata('name'));?></h3>
      | <a href="index.html" class="logoutBtn"><img src="assets/img/icons/logout_icon.png" alt="#" /></a> </div>
  </div>
  <div class="pageTabs mt-1 extrawWide">
    <ul>
      <li><a href="#" class="active">Users</a></li>
      <li><a href="#">Campaigns</a></li>
      <li><a href="#">Vending Machines</a></li>
    </ul>
  </div>
  <div class="createInfo">
    <div class="row pb-2 align-items-center">
      <div class="col-12 col-md-3">
        <label class="col-form-label-sm">Start Date</label>
        <input id="startDateInput" type="text" name="inputSdate" class="form-control dateIcon" />
      </div>
      <div class="col-12 col-md-3">
        <label class="col-form-label-sm ">End Date</label>
        <input id="endDateInput" type="text" name="inputEdate" class="form-control dateIcon" />
      </div>
      <div class="col-12 col-md-4 pt-4 text-center">
        <div class="custom-control custom-radio font-weight-bold d-inline-block">
          <input type="radio" class="custom-control-input rangeFilter" name="duration" value="Daily" id="ft-01">
          <label class="custom-control-label" for="ft-01">Daily</label>
        </div>
        <div class="custom-control custom-radio font-weight-bold d-inline-block ml-5 ">
          <input type="radio" class="custom-control-input rangeFilter" name="duration" value="Weekly" id="ft-02">
          <label class="custom-control-label" for="ft-02">Weekly</label>
        </div>
        <div class="custom-control custom-radio font-weight-bold d-inline-block ml-5">
          <input type="radio" class="custom-control-input rangeFilter" name="duration" checked="checked" value="Monthly" id="ft-03">
          <label class="custom-control-label" for="ft-03">Monthly</label>
        </div>
      </div>
      <div class="col-12 col-md-2 text-center">
        <button class="btn btn-primary text-uppercase mt-3" id="applyFilter">Apply</button>
      </div>
    </div>
  </div>
  <div class="row" id="page_body">
    <!-- ==========   Load report body      ================ -->
    <?php include('report_body');?>
  </div>
</div>

<!-- City MODAL -->
<div class="modal fade" id="cityModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title pt-1 text-primary">Cities (India)</h5>
        <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table>
          <thead>
            <tr>
              <th rowspan="2">Post Name</th>
              <th rowspan="2">Total Users</th>
              <th class="text-center" colspan="2">Male</th>
              <th class="text-center" colspan="2">Female</th>
            </tr>
            <tr>
              <th>in no. </th>
              <th>in %</th>
              <th>in no.</th>
              <th>in %</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="font-weight-bold">Delhi</td>
              <td>500</td>
              <td>2500</td>
              <td>50%</td>
              <td>2500</td>
              <td>90%</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Noida</td>
              <td>500</td>
              <td>1500</td>
              <td>50%</td>
              <td>2500</td>
              <td>90%</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Banglore</td>
              <td>500</td>
              <td>800</td>
              <td>20%</td>
              <td>2500</td>
              <td>60%</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Mumbai</td>
              <td>500</td>
              <td>8500</td>
              <td>60%</td>
              <td>2500</td>
              <td>30%</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-style" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- REVIEW RATING MODAL -->
<div class="modal fade" id="reviewRateModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title pt-1 text-primary">Live Campaigns-Reviews</h5>
        <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row pb-4">
          <div class="col-8">
            <h2 class="text-uppercase text-dark h6 font-weight-bold pb-0 m-0 pt-3 pl-1">Winter Special</h2>
            <small class="pl-1 d-block text-gray">Profiles-cummulative</small> </div>
          <div class="col-4">
            <div class="countStatus float-right">
              <div class="sampleCount  borderStyle">
                <ul>
                  <li><span>125</span><small>Total reviews</small></li>
                  <li><span>4.5</span><small>Avg. Rating</small></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <table>
          <thead>
            <tr>
              <th>UserName</th>
              <th>Review</th>
              <th>Rating</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="users_detail.html" class="user-link"><span><img src="assets/img/profile/sample_04.jpg" alt="#"></span> Johnathan Pine</a></td>
              <td><p class="limitText">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard...</p></td>
              <td>3.5</td>
              <td><a href="#" class="text-link">View Profile</a></td>
            </tr>
            <tr>
              <td><a href="users_detail.html" class="user-link"><span><img src="assets/img/profile/sample_04.jpg" alt="#"></span> Johnathan Pine</a></td>
              <td><p class="limitText">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard...</p></td>
              <td>3.5</td>
              <td><a href="#" class="text-link">View Profile</a></td>
            </tr>
          </tbody>
        </table>
        <div class="pt-4 pb-0 text-center"><a href="#" class="font-weight-bold text-link small text-uppercase">load more</a></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-style" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- REVIEW QUESTION MODAL -->
<div class="modal fade" id="reviewQusModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title pt-1 text-primary">Review Question Distribution</h5>
        <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row pb-4">
          <div class="col-8">
            <h2 class="text-uppercase text-dark h6 font-weight-bold pb-0 m-0 pt-3 pl-1">Winter Takes All</h2>
            <small class="pl-1 d-block text-gray">Male Profiles-cummulative</small>
            <h3 class="small font-weight-bold text-dark m-0 pt-3  pl-1">Question-Do you like the packaging of the product? </h3>
            <h3 class="small font-weight-bold text-dark m-0 pt-1  pl-1">Answer-Yes</h3>
          </div>
          <div class="col-4">
            <div class="countStatus float-right">
              <div class="sampleCount  borderStyle">
                <ul>
                  <li><span>125</span><small>Total Users</small></li>
                  <li><span>45%</span><small>User %</small></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <table>
          <thead>
            <tr>
              <th>UserName</th>
              <th>Age Group</th>
              <th>Joined On</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="users_detail.html" class="user-link"><span><img src="assets/img/profile/sample_01.jpg" alt="#"></span>John Die</a></td>
              <td>25-30 </td>
              <td>12 Feb 2022</td>
              <td><a href="#" class="text-link">View Profile</a></td>
            </tr>
            <tr>
              <td><a href="users_detail.html" class="user-link"><span><img src="assets/img/profile/sample_01.jpg" alt="#"></span>John Die</a></td>
              <td>25-30 </td>
              <td>12 Feb 2022</td>
              <td><a href="#" class="text-link">View Profile</a></td>
            </tr>
          </tbody>
        </table>
        <div class="pt-4 pb-0 text-center"><a href="#" class="font-weight-bold text-link small text-uppercase">load more</a></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-style" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPT --> 

<script type="text/javascript">
        (function($) {
            'use strict';

            // DATE PICKER
            var dateTime = new Date();
            dateTime = moment(dateTime).format('DD-MM-YYYY');
            //$('#endDateInput').attr('data-date', dateTime);

            $('#startDateInput').dateRangePicker({
                format: 'DD-MM-YYYY',
                autoClose: true,
                singleDate: true,
                showTopbar: false,
                singleMonth: true,
                selectForward: true,
                setValue: function(s) {
                    if (!$(this).attr('readonly') && !$(this).is(':disabled') && s != $(this).val()) {
                        $(this).val(s);
                        $('#endDateInput').attr('data-date', s).val('');
                    }
                },
                startDate: dateTime
            });

            $(document).on('focus', '#endDateInput', function(e) {
                var defaultDate = $(this).val();
                var startDate = $(this).attr('data-date');
                if (startDate == '') {
                    var startDate = $(this).attr('data-date', dateTime);
                } else {
                    var startDate = $(this).attr('data-date');
                }
                $(this).dateRangePicker({
                    format: 'DD-MM-YYYY',
                    autoClose: true,
                    singleDate: true,
                    showTopbar: false,
                    singleMonth: true,
                    selectBackward: true,
                    startDate: startDate
                });
            });
            
            $('.rangeFilter').on('click',function() {
              if ($("input[type='radio'][name='duration']").is(':checked')) {
                 $('#startDateInput').val('');
                 $('#endDateInput').val('');
              }
            });

            $('#startDateInput,#endDateInput').on('click',function() {
              $("input[type='radio'][name='duration']").prop("checked", false);
          });



          $(document).on('click','#applyFilter',function(){
            //alert('lolo');
            var flag = 0;
            var stDate = $('#startDateInput').val();
            var edDate = $('#endDateInput').val();
            if ($("input[type='radio'][name='duration']").is(':checked')) {
              var filterRange = $("input[type='radio'][name='duration']:checked").val();
            }else{
              var filterRange='-';
            }
            
            if((stDate=='') && (filterRange=='-')) {
              flag = 1;
            }

            if(flag==0) {
              $.ajax({  
                    type: "POST",  
                    url:  "<?php echo base_url(); ?>" + "report",  
                    data: {stDate:stDate,edDate:edDate,range:filterRange},  
                    cache: false,  
                    success: function(result){  
                        if(result.type=="success"){  
                          $('#page_body').remove();
                          $("#page_body").html('');
                          //$("#page_body").append(result.view);
                          console.log(result);
                          
                        }  
                        else  
                            jQuery("div#err_msg").show();  
                            jQuery("div#msg").html(result);  
                    }  
                }); 
            }
          })


        })(jQuery);
    </script> 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
<script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Users', 'Numbers'],
                ['Male', <?= $male_users?>],
                ['Female', <?= $female_users?>]

            ]);

            var options = {
                tooltip: {
                    isHtml: true
                },
                colors: ['#bf1f81', '#80024f'],
                pieSliceText: 'none',
                pieHole: 0.6,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                legend: {
                    position: "none",
                    alignment: 'center',
                    textStyle: {
                        color: 'black',
                        fontSize: 10
                    }
                },

            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script> 
<script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Profile Completion", "Male", "Female"],
                ["10% ", 100, 200],
                ["20% ", 56, 55],
                ["30% ", 55, 45],
                ["40% ", 56, 500],
                ["50% ", 60, 600],
                ["60% ", 100, 200],
                ["70% ", 36, 60],
                ["80% ", 24, 700],
                ["90% ", 100, 200],
                ["100% ", 100, 200],
            ]);

            var view = new google.visualization.DataView(data);
            var options = {
                tooltip: {
                    isHtml: true
                },
                colors: ['#e4a33a'],
                chartArea: {
                    left: 50,
                    top: 20,
                    width: '88%',
                    height: '80%'
                },
                bar: {
                    groupWidth: "40%"
                },
                isStacked: true,
                legend: {
                    position: "none"
                },
                hAxis: {
                    title: 'Profile Completion (in %)',
                    minValue: 0,
                    slantedText: false,
                    textStyle: {
                        color: '#888',
                        fontSize: 10
                    }
                },
                vAxis: {
                    title: 'No. of people',
                    baselineColor: '#666',
                    gridlines: {
                        color: '#f9f9f9',
                        count: 8
                    },
                    textStyle: {
                        color: '#888',
                        fontSize: 10
                    }
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("profilechart"));
            chart.draw(view, options);
        }
    </script> 
<script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Days", "Sample Redeemed", "Promos Redeemed", "Reviews Given", "Shares", "Comments & likes", "Brand Pages Viewed", "Campaigns Viewed"],
                ["Mon", 100, 200, 266, 255, 345, 266, 489],
                ["Tue", 56, 55, 215, 255, 345, 266, 256],
                ["Wed", 55, 45, 266, 255, 345, 266, 456],
                ["Thu", 56, 500, 321, 255, 326, 266, 856],
                ["Fri", 60, 600, 266, 741, 345, 555, 489],
                ["Sat", 100, 147, 456, 255, 345, 266, 123],
                ["Sun", 36, 60, 125, 425, 345, 144, 489],
            ]);

            var view = new google.visualization.DataView(data);
            var options = {
                tooltip: {
                    isHtml: true
                },
                colors: ['#69003b', '#ff701a', '#eb4e00', '#c38625', '#ee219b', '#ff9d00', '#ac0bbb'],
                chartArea: {
                    left: 50,
                    top: 20,
                    width: '88%',
                    height: '80%'
                },
                lineWidth: 2,
                pointSize: 5,
                legend: {
                    position: "none"
                },
                hAxis: {
                    title: 'Days',
                    minValue: 0,
                    slantedText: false,
                    textStyle: {
                        color: '#888',
                        fontSize: 10
                    }
                },
                vAxis: {
                    title: 'No. of people',
                    baselineColor: '#666',
                    gridlines: {
                        color: '#f9f9f9',
                        count: 8
                    },
                    textStyle: {
                        color: '#888',
                        fontSize: 10
                    }
                }
            };
            var chart = new google.visualization.LineChart(document.getElementById("linechart"));
            chart.draw(view, options);
        }
    </script>

<style type="text/css">
        .google-visualization-tooltip {
            padding: 4px 8px !important;
            border-radius: 6px;
            background-color: #e3e3e1;
            border: none !important;
        }
        
        .google-visualization-tooltip>ul>li>span {
            color: #444 !important;
            font-size: .75rem !important;
        }
        
        .google-visualization-tooltip-item-list,
        .google-visualization-tooltip-item {
            padding: 0px !important;
            margin: 0px !important;
        }
    </style>