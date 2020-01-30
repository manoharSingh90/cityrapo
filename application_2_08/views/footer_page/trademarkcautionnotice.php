<?php include('head.php');?>
<?php 
	$basedir = realpath(__DIR__);
	 $link_array = explode('/',$basedir);
     $page = end($link_array);
	if($page=='footer_page'){
		$path = str_replace('/footer_page','/itineraries',$basedir);
		}
	if(isset($loggedInUser)){
		include ($path.'/header.php');
		}
	else{
		include ('header.php');
		}
	
	?>
<main>
  <div class="staticPage">
    <div class="container text-dark font-regular">
      <h3 class="mt-5 mb-0">PUBLIC CAUTION NOTICE TRADEMARKS</h3>
      <p class="pt-3"><strong>City Explorers Private Limited</strong>, having registered oﬃce address at 206 Ashoka Apartments, Commercial Complex, Ranjeet Nagar, New Delhi – 110008, INDIA is one of the best known and most respected tourism delivery organizations in India, having a portfolio of brands owned by the company and its Directors carrying the business of, heritage walks, city sightseeing and experiential travel services, hereby brings to notice of the general public that it is the owner of the following trademarks</p>
      <table class="table-bordered table mt-3 mb-4">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Mark</th>
            <th>Class</th>
            <th>Trademark no.</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td></td>
            <td>39</td>
            <td>3770899</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>2</td>
            <td></td>
            <td>39</td>
            <td>2553097</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>3</td>
            <td></td>
            <td>39</td>
            <td>2606077</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>4</td>
            <td></td>
            <td>39</td>
            <td>3180350</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>5</td>
            <td>WALK LEADERS&reg;</td>
            <td>39</td>
            <td>3925731</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>6</td>
            <td>PHOTOWALKING&reg;</td>
            <td>41</td>
            <td>3679946</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>7</td>
            <td>DASTAN E DELHI&reg;</td>
            <td>39</td>
            <td>3695015</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>8</td>
            <td>SWACHH WALKS&reg;</td>
            <td>39</td>
            <td>3801498</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>9</td>
            <td>SPIRITED STORIES&reg;</td>
            <td>39</td>
            <td>3947110</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>10</td>
            <td>SPIRITED TALES&reg;</td>
            <td>39</td>
            <td>3947111</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>11</td>
            <td>STORYWALLAH&reg;</td>
            <td>39</td>
            <td>3925733</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>12</td>
            <td>EXPLORING THE CITY'S SOUL&reg;</td>
            <td>39</td>
            <td>4024991</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>13</td>
            <td>STORYTELLERS OF INDIA&reg;</td>
            <td>39</td>
            <td>3058477</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>14</td>
            <td>MONUMENT FRIENDS&reg;</td>
            <td>39</td>
            <td>3734644</td>
            <td>Registered</td>
          </tr>
        </tbody>
      </table>
      <p>These marks are being used extensively by City Explorers Private Limited in all major jurisdictions of the world including India.</p>
      <p>A tremendous amount of goodwill and reputation is associated with the <strong>City Explorers Private Limited</strong> marks and associated art work and theme and only <strong>City Explorers Private Limited</strong> has the sole right to permit use of the same. It has come to notice that various people, including some freelancers, purported bloggers, agencies, individuals in India are illegally and immorally using the <strong>City Explorers Private Limited</strong> marks or similar variations to promote and transmit their services over the internet, in particular through Social media sites, with a view of unlawfully taking advantage of <strong>City Explorers Private Limited</strong> name and reputation.</p>
      <p>The misuse of the well-known <strong>City Explorers Private Limited</strong> marks for these fake tours and walks is likely to cause deception and confusion and has a great potential to cause great harm to the public at large. <strong>City Explorers Private Limited</strong> taking serious notice of the unauthorized and illegal use of their marks and associated people, agencies and their digital proﬁles and IP has initiated legal action to put a stop to these practices. Be it known to all that stern legal actions will be taken against any person, ﬁrm or company found involved in using <strong>City Explorers Private Limited</strong> marks, associated IP, or illegally claiming to be associated with <strong>City Explorers Private Limited</strong> in any manner whatsoever, under all applicable civil and criminal laws, solely at the risk of such person as to cost and consequences. Such unscrupulous are hereby warned of a swift and stringent legal action for trademark infringement and passing off under the Trade Marks Act, 1999 and criminal action inter alia for counterfeiting, cheating and fraud.</p>
      <p>Members of the public having any knowledge /information of the above - mentioned trademarks been used by anyone other than City Explorers Private</p>
      <table class="table mt-4 mb-4">
        <tr>
          <td><a href="mailto:legal@cityexplorers.in">legal@cityexplorers.in</a><br>
            <strong>+91 858 880 8891</strong></td>
            <td></td>
          <td><strong>City Explorers Private Limited</strong><br>
            206, Ashoka Apts, Commercial Complex, Ranjeet Nagar, New Delhi - 110008 (INDIA)</td>
        </tr>
      </table>
    </div>
  </div>
</main>
<?php include('footer.php');?>

<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<!-- SCRIPT --> 
<?php include('foot.php');?>
<script type="text/javascript">
(function($) {
 
// TOGGLE
$(document).on('click', '.pledgeBar-head', function(e) {
    e.preventDefault();
			var $toggleBox = $(this).closest('.pledgeBar');
			var $toggleBody = $toggleBox.find('.pledgeBar-body');
			$(this).toggleClass('active');
			$toggleBody.slideToggle();
});

   

})(jQuery);
</script>
</body>
</html>
