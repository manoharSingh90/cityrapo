<?php 
	require_once('header.php');
	require_once('main_header.php');
	$ses = $this->session->userdata('adminSes');
	if(!isset($ses)){
		 redirect('admin/login');
		}
	?>
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
            <!-- <div class="col"><small class="text-muted d-block">Status:</small>
             <select class="form-control" id="status" name="status">
                <option value="">All</option>
				<option value="1">New</option>
				<option value="2">Rejected</option>				
              </select>
            </div>-->
            <div class="col"><small class="text-muted d-block">City:</small>
            <select class="form-control" id="city">
                <option value="">All</option>
				<?php 
					foreach($cityData as $cityval):
					echo '<option value="'.$cityval->city_name.'">'.$cityval->city_name.'</option>';
					endforeach;
					?>
              </select>
            </div>
            <div class="col"><small class="text-muted d-block">Services Type:</small>
             <select class="form-control" id="serviceType">
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
         <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>translator_all_itineraries">All Itineraries</a> </li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>translator_reqitineraries">Requests </a> </li>
          </ul>
                <div class="flyRight">
            <button class="btn btn-primary text-uppercase btn-sm">Download</button>
          </div>
        </div>
        <table id="tableStyle" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Itinerary Name</th>
              <th>Host Details</th>
              <th>Cities</th>
              <th>Services</th>
			  <th>Status</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody id="itineries_append_data">		  
              <?php $this->load->view('admin/translator_allitinerary_element');?>          
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

//=========== host searching js Start on 6-02-2019 ===========//
$('#aplyFilter').on('click',function(){	
	reloadSearch();
});

function reloadSearch(){
	  var itinerarySearch = $('#itinerarySearch').val();
	  //var hostType =   $('#hostType').val();
	  var cities = $('#city option:selected').val();
	  var serviceType = $('#serviceType option:selected').val();
	  var proceed =true;	  
	   if(proceed){
		    $.ajax({
				  type:'post',
				  url:'<?php echo base_url()?>admin/translator_all_itineraries',
				  data:{city:cities,serviceType:serviceType,itinerarySearch:itinerarySearch},
				  dataType : 'json',
				  success :function(response){
					        console.log(response);
							if(response.view!=='Empty data'){
							    $("#itineries_append_data tr").remove();
								$('#itineries_append_data').append(response.view);
								}
							else{
								$("#itineries_append_data tr").remove();
								$('#itineries_append_data').append('<tr><td>No Data Available.</td></tr>');
								}	
							}
				});
		   }
}	

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
})(jQuery);
</script>
<?php require_once('footer.php');?>

	