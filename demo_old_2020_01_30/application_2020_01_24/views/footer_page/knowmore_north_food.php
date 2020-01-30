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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/north/banner.jpg')?>);">
    <h2>North India</h2>
  </div>
  <div class="clearfix">
    <div class="container clearfix">
      <div class="knowmoreData">
        <h3>Food</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/north/food.jpg')?>" alt="#"/> </div>
        <p>For every region in India climate plays a very important role in the culture of food of the region. North India has extreme climatic regions summers are really hot and winters are extremely cold. The region includes states like Jammu Kashmir, Himachal Pradesh, Uttrakhand, Uttar Pradesh, Punjab, Haryana and Rajasthan. This region also has the most fertile region of the Indian sub-continent. With a huge variety of seasonal fruits and vegetables available the region has developed a distinctive culture of food. </p>
        <p>The regions food and culture is also highly influenced by the central Asian invasions which happened with the course of time in the Mughlai and Kashmiri style of cooking. Northern Indian food is identified with the richness of the curries, the use of clarified butter and rich in spies and cream. There is abundance use of dry fruits and nuts in the gravies of North India.</p>
        <p>Every day food includes high usage of dairy products like milk, cream, cottage cheese, ghee and yoghurt. The food of North India can be easily segregated in the categories of the plain regions the hilly areas of Himalayas and Rajasthan. The Hilly areas due to scarce vegetation have high usage of pulses. Uttrakhand cuisine is one such example of that. </p>
        <p>The people of Uttrakhand use a variety of pulses in their daily life not only in the form dal but also grinding it and making rotis out of it. People of Uttrakhand are mostly vegetarian though sparse consumption of mutton is found in certain places. The food of Haryana and Punjab is highly influenced by the use of pulses in the form of rajma, chole soyabean seeds etc. The consumption of Butter Ghee and Milk is extremely high in these states. The other most prominent food is the use of wheet in various forms. </p>
        <p>The region of North India is the home to roti in different forms and shapes such as naan, roti, phulka, tandoori roti, romali roti and stuffed Parathas. These types are mostly common in the states of Punjab Haryana Delhi and Uttar Pradesh. In Rajasthan the cuisine is little different from the rest of the North. With very little vegetation the cuisine of Rajasthan is the reflection of their tough lifestyle of dessert. The use of maize, Bajra and ragi is very prominent in the state. The royals of Rajasthan have influenced the consumption of meat and their ways of cooking. The usage of ghee and consumption of dairy products however remains similar to the rest of the north.</p>
        <p>The state of Uttar Pradesh gives a blend of cuisine of the north and the east. The people of Uttar Pradesh are mostly vegetarian but the influence of the Mughals has given a twist in the flavors of Uttar Pradesh.  The cities of Awadh and Lucknow and the areas around it has a huge influence of Mughal cuisine of Delhi which includes high consumption of meat and Pilaf whereas the rest of the state are mostly vegetarian and has high consumption of seasonal vegetables. </p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="north_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="north_indian_culture"  class="activityBox">
          <h4>Culture</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/north/culture.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="north_indian_heritage"  class="activityBox">
          <h4>Heritage</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/north/heritage.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="north_indian_people"  class="activityBox">
          <h4>People</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/north/people.jpg')?>" alt="#"/> </a> </li>
      </ul>
    </div>
  </div>
</main>
<?php include('footer.php');?>

<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<?php include('foot.php');?>
</body>
</html>
