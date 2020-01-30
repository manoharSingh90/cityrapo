<?php 
	require_once('header.php');
	require_once('main_header.php');?>
<main>
  <div class="container-fluid">
    <div class="pageFormat">
      <div class="row filterCover">
        <div class="col-12 col-sm-4 pl-0">
          <input type="text" class="form-control mt-3" id="itinerarySearch" placeholder="Search for an itinerary"/>
        </div>
        <div class="col-12 col-sm-8">
          <div class="row">
            <div class="col">
              <label class="m-0 font-weight-semibold pt-3">Filter:</label>
            </div>
			<div class="col"><small class="text-muted d-block">Host Type:</small>
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
            </div>
            <div class="col"><small class="text-muted d-block">Status:</small>
             <select class="form-control" id="status" name="status">
                <option value="">All</option>
				<option value="1">New</option>
				<option value="2">Rejected</option>				
              </select>
            </div>
            <div class="col"><small class="text-muted d-block">City:</small>
              <select class="form-control" id="cities" name="city">
                <option value="">All</option>
				<?php 
					foreach($cityData as $cityval):
					echo '<option value="'.$cityval->city_name.'">'.$cityval->city_name.'</option>';
					endforeach;
					?>
              </select>
            </div>
            <div class="col"><small class="text-muted d-block">Services Type:</small>
              <!--<select class="form-control" id="serviceType" name="serviceType">               
				<option value="">All</option>
				<option value="Walk">Walk</option>
				<option value="Session">Session</option>
				<option value="Experience">Experience</option>
				<option value="Meet-Up">Meet-Up</option>
              </select>-->
			  <select class="form-control" id="serviceType" name="serviceType">               
				<option value="">All</option>
				<option value="1">Walk</option>
				<option value="2">Session</option>
				<option value="3">Experience</option>
				<option value="4">Meet-Up</option>
              </select>
            </div>
            <div class="col text-center">
              <button class="btn btn-link text-secondary mt-3" id="aplyFilter">Apply Filters</button>
            </div>
          </div>
        </div>
      </div>
      <div class="boxCover">
        <div class="cform-box">
          <ul class="nav nav-tabs cform-tab" role="tablist">
            <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>all_itineraries">All Itineraries</a> </li>
            <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>itineraries_request" id="notify">Requests
				<?php if($notifyData>0){?>
			 <b class="badge">
				<?php echo $notifyData;?></b>
			  <?php } ?>
				</a>			
			</li>
          </ul>
        </div>
        <table id="tableStyle" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Itinerary Name</th>
			  <th>Host Type</th>
              <th>Host Details</th>
              <th>Cities</th>
              <th>Services</th>
              <th>Status</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody id="itinerary_append_data">		 
             <?php $this->load->view('admin/itinerary_request_element');?>           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<?php require_once('main_footer.php');?>
<?php require_once('adminscript.php');?>

<script type="text/javascript">
(function($) {

	$('#tableStyle').DataTable({
		"paging":   false,
        "ordering": false,
        "info":     false,
		"searching": false
	});
//=========== notify alert js ===============//

/*$('a').on('click',function(){
$.ajax({
	type:'post',
	url:'<?php echo base_url();?>admin/notification',
	success:function(html){
		//alert(html);
		}
 });
});
*/

$('#aplyFilter').on('click',function(){	
	reloadSearch();
});
	
function reloadSearch(){
	  var searchVal = $('#itinerarySearch').val();
	  var status =   $('#status').val();
	  var cities = $('#cities option:selected').val();
	  var serviceType = $('#serviceType option:selected').val();
	  var hostType =   $('#hostType').val();
	  var proceed =true;	 
	   if(proceed){
		    $.ajax({
				  type:'post',
				  url:'<?php echo base_url()?>admin/itineraries_request',
				  data:{status:status,city:cities,serviceType:serviceType,searchVal:searchVal,hostType:hostType},
				  dataType : 'json',
				  success :function(response){
					        console.log(response);
							if(response.view!=='Empty data'){
							    $("#itinerary_append_data tr").remove();
								$('#itinerary_append_data').append(response.view);
								}
							else{
								$("#itinerary_append_data tr").remove();
								$('#itinerary_append_data').append('<tr><td>No Data Available.</td></tr>');
								}	
							}
				});
		   }
}

//=========== notify alert js ===============//

$(document).on('click', 'a',function(){	
$.ajax({
	type:'post',
	url:'<?php echo base_url();?>admin/itinerary_notification',
	success:function(html){
		 //alert(html);
		}
 });
});


})(jQuery);
</script>
<?php require_once('footer.php');?>

