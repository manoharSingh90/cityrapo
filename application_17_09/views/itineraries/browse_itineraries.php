<!-- Header start-->
<?php include('head.php'); ?>
<!-- Header end-->
<?php include('header.php');
	$hostSes  = $this->session->userdata('id');		
	?>
<main>
<br>
<br>
<div id="mainContent" class="container-fluid">
    <div class="pageSearch clearfix">
      <div class="itinerariesHead clearfix">
        <div class="itinerariesHead-left">
          <h3 class="col-form-label pt-0 pb-0 text-capitalize text-dark">Find Your Tour</h3>
          <ul class="form-row">
            <li class="form-group col-12 col-md-4 pt-4">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="checkbox" id="individualFilter" name="searchPrivate" class="custom-control-input" value="1"/>
                <label class="custom-control-label" for="individualFilter">Private</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="checkbox" id="groupFilter" name="searchGroup" class="custom-control-input" value="1"/>
                <label class="custom-control-label" for="groupFilter">Group</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="checkbox" id="familyFilter" name="searchFamily" class="custom-control-input" value="1"/>
                <label class="custom-control-label" for="familyFilter">Family</label>
              </div>
            </li>
            <li class="form-group col-12 col-md-4">
              <label class="col-form-sublabel">Select a city</label>
              <select class="form-control" id="cityid">
                <option value="">Select</option>
							<?php foreach($cityData as $data): ?>
								<option value="<?php echo $data->city_name;?>"><?php echo $data->city_name;?></option>
							<?php endforeach;?>
              </select>
            </li>
            <li class="form-group col-12 col-md-4">
              <label class="col-form-sublabel">Select a dates</label>
							<input id="dobDateInput"  type="text" class="form-control dateIcon rightSide" placeholder="Select a dates" autocomplete="off" onkeydown="return false"/>
							<a href="javascript:void(0);" id="clearDate" class="clearText" style="display:block;">clear</a>
              </li>
			  
			   
         <li class="form-group col-12 col-md-4">
         <label class="col-form-sublabel">Theme</label>
         <select class="form-control" id="themesid">
            <option value="">All</option>
			<?php 
				foreach($themesData as $data):
				?>
            <option value="<?php echo $data->id;?>"><?php echo $data->theme_name;?></option>
			<?php endforeach;?>
          </select>
      </li>
            <li class="form-group col-12 col-md-4">
                  <label class="col-form-sublabel">Host Type:</label>
                  <select class="form-control" id="hostType">
                      <option value="">All</option>
					  <?php 
						  if(!empty($hostTypeData)){
							  foreach($hostTypeData as $dataval):?>
							  <option value="<?php echo $dataval->id;?>"><?php echo $dataval->host_name;?></option>
							  <?php
							  endforeach;
							  }
						  ?>                      
                  </select>
          </li>
		  
            <li class="form-group col-12 col-md-4">
				
				<label class="col-form-sublabel">Language:</label>
                  <select class="form-control" id="itineraryLang">
                      <option value="">All</option>
					  <?php 
						  if(!empty($itineraryLang)){
							  foreach($itineraryLang as $lang):?>
							  <option value="<?php echo $lang->itinerary_language;?>"><?php echo $lang->itinerary_language;?></option>
							  <?php
							  endforeach;
							  }
						  ?>                      
                  </select>
          </li>
		  
          </ul>
        </div>
        <div class="itinerariesHead-right"> <a href="javascript:void(0);" class="btn btn-primary pr-3 pl-3" id="searchData">Search</a> </div>
      </div>
	   
    </div>
		<!--
		<div class="text-center mr-5 ml-5" >
      <div class="row">
        <div class="col-12 col-md-6"><img src="<?php echo base_url();?>assets/img/advt/ad_v1_backup.jpg" alt="advtSpace" /></div>
        <div class="col-12 col-md-6"><img src="<?php echo base_url();?>assets/img/advt/ad_v1_backup.jpg" alt="advtSpace" /></div>
      </div>
		</div>
							-->
       <ul class="nav justify-content-center nav-tabs homeTab mt-4 mb-1" role="tablist">
      <li class="nav-item"> <a class="nav-link active tabClick" href="javascript:void(0)" id="walk_data" data-val="1" data-active="<?php echo base_url();?>assets/img/icon/walk/walks_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/walk/walks_outline_blue.svg"><img src="<?php echo base_url();?>assets/img/icon/walk/walks_outline_red.svg" alt="walk" /> Walks</a> </li>
	   <li class="nav-item"> <a class="nav-link tabClick" href="javascript:void(0)" id="session_data" data-val="2" data-active="<?php echo base_url();?>assets/img/icon/sessions/sessions_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/sessions/sessions_outline_blue.svg"><img src="<?php echo base_url();?>assets/img/icon/sessions/sessions_outline_blue.svg" alt="sessions" /> Sessions</a> </li>
      <li class="nav-item"> <a class="nav-link tabClick" href="javascript:void(0)" id="experience_data" data-val="3" data-active="<?php echo base_url();?>assets/img/icon/experiences/experiences_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/experiences/experiences_outline_blue.svg"><img src="<?php echo base_url();?>assets/img/icon/experiences/experiences_outline_blue.svg" alt="experiences" /> Experiences</a> </li>
      <li class="nav-item"> <a class="nav-link tabClick" href="javascript:void(0)" id="meetup_data" data-val="4" data-active="<?php echo base_url();?>assets/img/icon/meetup/meetup_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/meetup/meetup_outline_blue.svg"><img src="<?php echo base_url();?>assets/img/icon/meetup/meetup_outline_blue.svg" alt="meetup" /> Meet-Ups</a> </li>
	  <li class="nav-item last-child" data-toggle="modal" data-target="#soonModal"> <a class="nav-link" href="javascript:void(0)" data-active="<?php echo base_url();?>assets/img/icon/monument/monument_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/monument/monument_outline_blue.svg" ><img src="<?php echo base_url();?>assets/img/icon/monument/monument_outline_blue.svg" alt="Monuments"><span>Monuments <small>Buy Tickets</small></span></a> </li>
     
    </ul>
    <div class="itinerariesFilter clearfix">
      <h4 class="font-weight-semibold"><span id="itinerary_count"></span> <span id="itinerary_name"></span></h4>
     
     </div>			  
    <div class="itinerariesGrid">
      <ul id="ajax_table"> 
      </ul>
	  <p class="text-center b-block text-uppercase text-light m-0 pt-2 pb-3 small" id="empty_data"></p>
	  
    <div class="text-center pt-3 pb-3"> <a href="#" class="btn btn-link text-default text-light pt-0 pb-0" id="load_more" data-val="0">Load More</a> </div>
    </div>
  </div>
  </main>
 <!-- Modal -->
<div class="modal fade" id="soonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
  
      <div class="modal-body"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <img src="<?php echo base_url();?>assets/img/Monument_Ticket_v2.jpg" alt="#">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
  <?php require('footer.php');?>
 <?php include('foot.php'); ?> 
 
<script>
activeUrl = '<?php echo $this->uri->segment(3);?>';
//alert(activeUrl)	
var itineraryCount = 0;
$(document).ready(function(){
	var serviceId = $('.homeTab').find('.active').data('val'); 
	
	  if(serviceId==1){
		  $('#itinerary_name').html('Walks');
		   $('#ajax_table').removeAttr('class');
		  }
	  if(serviceId==2){
		  $('#itinerary_name').html('Sessions');
		  $('#ajax_table').removeAttr('class');
		  $('#ajax_table').addClass('sessionsGrid');
		  }
	 if(serviceId==3){
	   $('#itinerary_name').html('Experiences');
	   	  $('#ajax_table').removeAttr('class');
		  $('#ajax_table').addClass('experiencesGrid');
	  }
	 if(serviceId==4){
	  $('#itinerary_name').html('Meet-Ups');
	  	  $('#ajax_table').removeAttr('class');
		  $('#ajax_table').addClass('meetupsGrid');
	  }
	   	  
	    getItinerary(0,serviceId);

        $("#load_more").click(function(e){
            e.preventDefault();
            var page = $(this).data('val');
			var flag = true;
			var serviceId = $('.homeTab').find('.active').data('val');			
            getItinerary(page,serviceId,flag);
        });       
    });	
	
  
//==================== Walk Services js ===============//
$('.homeTab .nav-link').on('click',function(){
	$(this).addClass('active');
	$(this).parent('li').siblings().find('a').removeClass('active');
	
});	

var getItinerary = function(page,serviceId,flag){
        $("#loader").show();
        $.ajax({
            url:"<?php echo base_url() ?>itineraries/fetchBrowse_Itinerary",
            type:'GET',
			dataType: "json",
            data: {page:page,serviceId:serviceId}
        }).done(function(response){
		 console.log(response);
		 if(response.view!=='Empty data'){
		 var loadMoreCount = $('#load_more').data('val')+1;		 
		 var loadCount = response.iterator.length;
		 itineraryCount = parseInt(itineraryCount)+parseInt(loadCount);
		 var load_count = response.iterator.length;
		 
		 /*if(loadMoreCount==''){
			  load_count = loadCount;
			 }
		 else{
			  load_count = parseInt(loadCount)+parseInt(loadMoreCount+1);
			 }*/
		  $("#empty_data").html('');	 
		 } 
		 if(response.view!=='Empty data'){
		    //$("#ajax_table li").remove();
            $("#ajax_table").append(response.view);
            $("#loader").hide();
            $('#load_more').data('val', ($('#load_more').data('val')+1));
			$('#itinerary_count').html(itineraryCount);
			$("#empty_data").html('');
            //scroll();
		 }
		 if(response.view=='Empty data'){
		   if(flag==true){
			   $("#empty_data").html('');
			  }
			else{
				$("#empty_data").html('No Data Available.');
				}  
		  $('#load_more').hide();
		  $('#itinerary_count').html();
		 }
        });
    };

$('.tabClick').on('click',function(){
   serviceId = $(this).data('val');   
    var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();	
	var themesid = $('#themesid option:selected').val();
	var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	var proceed = true;	
	
	 if(proceed){
		  search_browse_itineraries(serviceId,privateType,groupType,familyType,cityid,date,themesid,hostType,itineraryLang);
		 }
	if(serviceId==1){	    
		serviceName = 'walk';
		}
	else if(serviceId==2){	    
		serviceName = 'session';
		}
	else if(serviceId==3){	   
		serviceName = 'experience';
		}
	else if(serviceId==4){	    
		serviceName = 'meetup';
		}
	  $('#itinerary_name').html(serviceName);	
	  history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'itineraries/browse_itineraries/'+serviceName);
    
  });
  
function search_browse_itineraries(serviceId,privateType,groupType,familyType,cityid,date,themesid,hostType,itineraryLang){	
	$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>itineraries/servicetab_browse_search',
			 data:{serviceId:serviceId,privateType:privateType,groupType:groupType,cityid:cityid,date:date,themesid:themesid,familyType:familyType,hostType:hostType,itineraryLang:itineraryLang},
			 dataType:'json',
			 success:function(html){
			 console.log(html);
			 itineraryCount = 0;
			  var loadCount = html.iterator.length			  
		      itineraryCount = parseInt(itineraryCount)+parseInt(loadCount);		      
			 if(html.view!=='Empty data'){
			    $("#ajax_table li").remove();
				$("#empty_data").html('');
			    $("#ajax_table").append(html.view);
				$('#itinerary_count').html(itineraryCount);
				$("#empty_data").html('');
				 }
			else{
			    $("#ajax_table li").remove();				
			    $("#empty_data").html('No Data Available.');	
			    $("#load_more").hide();
				$('#itinerary_count').html('0');
			   }			
			}
		});
		
}
//============== Searching data js ==========================//
$('#searchData').on('click',function(){
	var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
	var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	var proceed = true;	
	if(serviceId==1){
		var serviceName = 'walk';		
		}
    if(serviceId==2){
		var serviceName = 'session';
		}
   if(serviceId==3){
		var serviceName = 'experience';
		}
  if(serviceId==4){
		var serviceName = 'meetup';
		}
	$('#itinerary_name').html(serviceName);
	
	if(proceed){
	/*history.pushState({isMine:true},'home |User','<?php echo base_url()?>home?service_name='+serviceName+'&service_id='+serviceId+'&private_type='+privateType+'&group_type='+groupType+'&family_type='+familyType+'&cityid='+cityid+'&date='+date+'&themesid='+themesid);*/
		$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>itineraries/servicetab_browse_search',
			 data:{serviceId:serviceId,privateType:privateType,groupType:groupType,cityid:cityid,date:date,themesid:themesid,familyType:familyType,hostType:hostType,itineraryLang:itineraryLang},
			 dataType:'json',
			 success:function(html){
			 console.log(html);
			   if(html.view!=='Empty data'){
			    $("#ajax_table li").remove();
				$("#empty_data").html('');
			    $("#ajax_table").append(html.view);				
				 }
			else{
			    $("#ajax_table li").remove();				
			    $("#empty_data").html('No Data Available.');	
			    $("#load_more").hide();
			   }
		     }
			});
		}
});

//============== themes selection searching js ================//
/*$('#themesid').on('change',function(){
    var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
	var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	var proceed = true;
	if(proceed){	
		$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>itineraries/servicetab_browse_search',
			 data:{serviceId:serviceId,privateType:privateType,groupType:groupType,cityid:cityid,date:date,themesid:themesid,familyType:familyType,hostType:hostType,itineraryLang:itineraryLang},
			 dataType:'json',
			 success:function(html){
			 console.log(html);
			   if(html.view!=='Empty data'){
			    $("#ajax_table li").remove();
				$("#empty_data").html('');
			    $("#ajax_table").append(html.view);				
				 }
			else{
			    $("#ajax_table li").remove();				
			    $("#empty_data").html('No Data Available.');	
			    $("#load_more").hide();
			   }
		    }
			});
		}
});*/

//============== Host Type selection searching js ================//
/*$('#hostType').on('change',function(){
    var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
	var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	var proceed = true;
	if(proceed){	
		$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>itineraries/servicetab_browse_search',
			 data:{serviceId:serviceId,privateType:privateType,groupType:groupType,cityid:cityid,date:date,themesid:themesid,familyType:familyType,hostType:hostType,itineraryLang:itineraryLang},
			 dataType:'json',
			 success:function(html){
			 console.log(html);
			   if(html.view!=='Empty data'){
			    $("#ajax_table li").remove();
				$("#empty_data").html('');
			    $("#ajax_table").append(html.view);				
				 }
			else{
			    $("#ajax_table li").remove();				
			    $("#empty_data").html('No Data Available.');	
			    $("#load_more").hide();
			   }
		    }
			});
		}
});*/

//======== Search by Itinerary languages function Start on 1 may 2019 by robin =========//
/*$('#itineraryLang').on('change',function(){
        var privateType = $('input[name="searchPrivate"]:checked').val();
		var groupType = $('input[name="searchGroup"]:checked').val();
		var familyType = $('input[name="searchFamily"]:checked').val();
		var cityid = $('#cityid option:selected').val();
		var date = $('#dobDateInput').val();
		var serviceId = $('.homeTab').find('.active').data('val');
		var themesid = $('#themesid option:selected').val();
		var hostType = $('#hostType option:selected').val();
		var itineraryLang = $('#itineraryLang option:selected').val();
		var proceed = true;
        if(proceed){	
		$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>itineraries/servicetab_browse_search',
			 data:{serviceId:serviceId,privateType:privateType,groupType:groupType,cityid:cityid,date:date,themesid:themesid,familyType:familyType,hostType:hostType,itineraryLang:itineraryLang},
			 dataType:'json',
			 success:function(html){
			 console.log(html);
			   if(html.view!=='Empty data'){
			    $("#ajax_table li").remove();
				$("#empty_data").html('');
			    $("#ajax_table").append(html.view);				
				 }
			else{
			    $("#ajax_table li").remove();				
			    $("#empty_data").html('No Data Available.');	
			    $("#load_more").hide();
			   }
		    }
			});
		}
    });*/
//======== Search by language function END:: ============//


// DATE PICKER
// DATE PICKER
$('#dobDateInput').dateRangePicker({
    format: 'DD-MM-YYYY',
    autoClose: true,
    singleDate: true,
    showTopbar: false,
    singleMonth: true,
    selectForward: true,
    startDate: new Date()
})



$(document).on('click', '#clearDate', function(e) {
    e.stopPropagation();
    //$(this).hide();
    $('#dobDateInput').data('dateRangePicker').clear();
});

$(document).on('click', '.homeTab li a', function(e) {
    e.stopPropagation();
    $('.homeTab li a').each(function() {
					    var $defaultURL = $(this).attr('data-default');
        $(this).find('img').attr('src', $defaultURL);
        console.log($(this).attr('data-default'))
    });
    var $this = $(this);
    var $thisImage = $this.find('img');
    var $activeURL = $this.attr('data-active');
    var $defaultURL = $this.attr('data-default');
    var $listItem = $(this).closest('li');
    var $listSiblings = $listItem.siblings();
    var $itemAnchor = $listSiblings.find('a');
    $thisImage.attr('src', $activeURL);
    $itemAnchor.removeClass('active');
    $(this).addClass('active');
});
</script> 