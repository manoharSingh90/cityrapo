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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/privacy/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text">
        <h2>Privacy</h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg pt-5 pb-5">
    <div class="container">
  <h3>PRIVACY POLICY</h3>
  <p>This Privacy Policy (&ldquo;<b>Policy</b>&rdquo;) applies to use of this website, application and/or use of our services. Any new features and/or services that are added to our current service at any point in the future shall also be subject to the terms set out in this Policy.</p>
  <h4>PURPOSE OF THIS POLICY</h4>
  <p>City Explorers Private Limited (from here on referred to as "<strong>CEPL</strong>", "<strong>we</strong>", "<strong>us</strong>" or "<strong>our</strong>") respects your need to understand how and why information is being collected, used, disclosed, transferred and stored. Thus, we have developed this Policy to familiarize you with our practices. This Policy sets out the way in which we process your information when you visit and use <a href="http://cityexplorers.in" target="_blank">www.cityexplorers.in</a> (the "<strong>website</strong>") our services and our application for mobile devices (the "<strong>application</strong>") in accordance with applicable data protection laws. It is important that you read this Policy together with any other policies we may provide on specific occasions when we are collecting or processing your personal data, so that you are fully aware of how and why we are using your personal data. This Policy supplements the other notices and is not intended to override them.</p>
  <h4>SCOPE</h4>
  <p>We provide this Policy to inform you of our policies and procedures regarding how we collect and process the personal data that we receive from users of this website, our services and our application. Personal data is any information that directly or indirectly identifies you. &lsquo;Directly&rsquo; could for example be through a name. &lsquo;Indirectly&rsquo; refers to the situation where you can still be identified without your name through or by combining other information.
    In regard to this Policy, the terms "<strong>using</strong>" and "<strong>processing</strong>" information include but are not limited to; the use of cookies; and the collection, storing, transfer, evaluation, deletion, disclosure, management, handling, modifying and use of personal data.<br />
    This Policy applies only to personal data that you provide to us via the website and the application. We reserve the right to update this Policy from time to time to reflect any changes to our services. We will do this by amending the Policy on the website and application. The changes will take effect automatically, as soon as they are posted on the website and application. In addition, we will notify all users by email if any material changes are made to the Policy, subject to the users&rsquo; acceptance to receive emails from us.<br />
    This Policy does not apply to any third-party website(s) and mobile app(s). You are requested to take note that information and privacy practices of our business partners, advertisers, sponsors or other sites to which we provide hyperlink(s), may be different from this Policy, Hence, it is recommended that you review the privacy policy of any such third parties before you interact with such interfaces.</p>
  <h4>PROCESSING OF PERSONAL DATA</h4>
  <p>We may process your personal data for the following purposes:</p>
  <p>Providing our services: CEPL might process your personal data to provide its services. <strong>For example</strong>, personal data is processed in order to set up your CEPL account, allow you to book an event/tour through, and submit reviews to this website, application or third-party widgets, digital promotion interfaces, for availing third party subscription services (based on whether the services availed are sponsored or non-sponsored). (It is advised that this above list of items mentioned is not exhaustive and is meant for illustrative purposes only). </p>
  <p>For this purpose, CEPL processes the following personal data: name, phone number, email address, home address, IP address, CEPL user account profile data. </p>
  <p>Customer service: CEPL is allowed to process personal data for this purpose because it is necessary for the legitimate interest of CEPL (or a third party), essentially to enable CEPL to adequately respond to questions and requests of users. </p>
  <p> Marketing (Direct): CEPL processes user&rsquo;s data for (direct) marketing purposes. This means that CEPL can contact customers to draw attention to our services. For this purpose, CEPL processes the following personal data: website behaviour, IP address, email address, postal address, phone number, online identifiers, booking information, location and account information. </p>
  <p>In addition to the above, we may also use your personal data for several reasons including but not limited to:</p>
  <p>
  <ul class="pb-3">
    <li>keep you informed of the transaction status;</li>
    <li>send you booking confirmations either via SMS or WhatsApp or any other messaging service;</li>
    <li>send you any updates or changes to your booking(s);</li>
    <li>allow our customer service to contact you, if necessary;</li>
    <li>confirm your reservations with respective Operator/s;</li>
    <li>customize the content of our website and mobile app;</li>
    <li>request for reviews of services or any other improvements;</li>
    <li>send you verification message(s) or email(s);</li>
    <li>validate/authenticate your account and to prevent any misuse or abuse;</li>
    <li>contact you on your birthday and anniversary to offer a special offer;</li>
    <li>send you important notices and communications regarding our Services availed or changes to the terms and conditions and/or policies; and send you payment reminders and/or travel vouchers.</li>
  </ul>
  <h4>DISCLOSURE OF DATA</h4>
  <p>It may be necessary for CEPL to disclose your personal data whether by law, possibly in the context of litigation, legal process and / or by request from public or governmental authorities within or outside of your country of residence. We may also disclose your personal information if we determine that disclosure is necessary or appropriate for purposes of law enforcement, national security or to prevent or stop any activity we may consider to be, or to pose a risk of being, illegal, unethical or legally actionable.</p>
  <h4>USE OF DATA FOR BOOKING</h4>
  <p>If you make a booking, CEPL will share the following information about you with the host: (i) your first and last name, and (ii) a link to your CEPL user account. When a booking is confirmed, we will also share your telephone number with the host. Under no circumstance is your billing information ever shared with a host.</p>
  <p>We may employ third party companies and/or individuals to help improve or facilitate our service, to provide the service on our behalf, to perform Platform-related services, including but not limited to: maintenance services, fraud detection services, database management, web analytics, monitoring and evaluation services. In this event, your information may be shared with the third party companies and/or individuals. However, your information will remain protected as per this Policy. </p>
  <h4>COLLECTION AND USE OF NON-PERSONAL DATA</h4>
  <p>Non-personal data is data which can never be used to identify an individual. We may collect information regarding customer activities on our various portals. This aggregated information shall be used by us in research, analysis, to improve and monitor our services and for various promotional schemes. Such non-personal data may be shared in aggregated, non-personal form with third party to enhance customer experience, products offering or services. </p>
  <h4>COOKIES</h4>
  <p>The website <a href="http://cityexplorers.in" target="_blank">www.cityexplorers.in</a> uses cookies. During use of this website/ application you will be prompted to accept all cookies. This data will be used for information, process of information &amp; pass of information to third party to help improve or facilitate our services, to provide service on our behalf, to perform website-related services, including but not limited to: maintenance services, fraud detection services, database management, web analytics, monitoring and evaluation services. If you have any questions about our cookie usage, please contact CEPL at <a href="mailto:legal@cityexplorers.in">legal@cityexplorers.in</a>. </p>
  <h4>YOUR RIGHTS AND HOW TO EXERCISE THEM</h4>
  <p>We respect the exercise of the rights you have in relation to the personal data we process or use. You can request access to or a copy of your personal data collected and processed by us. You may also request the rectification and removal of personal data or the restriction of the processing of your personal data. You also have the right to data portability. If you have an objection to use of your data under this Policy, please write to our privacy team at <a href="mailto:legal@cityexplorers.in">legal@cityexplorers.in</a>. To prevent misuse, we will ask you to identify yourself.</p>
  <h4>SECURITY</h4>
  <p>CEPL understands the serious implications of data security and we take extensive measures to make sure your data and information is secured. We take extensive technical, and legal measures to safeguard your personal data. The website/ application uses a reliable SSL Certificate to make sure your personal data is not misused in any manner whatsoever.</p>
  <p> In case there is any breach of security, CEPL will make all legally required disclosures concerning the breach and the confidentiality, or integrity of your unencrypted electronically stored "personal data" to you via email or via a posting it on the website and application without unreasonable delay in as far as it is consistent with any legitimate needs of law enforcement and any measures required to determine the scope of the breach and to safeguard the integrity of data. </p>
  <h4>APPLICABLE LAWS AND REGULATIONS</h4>
  <p>We ensure that your data and information shall be protected under the provisions of General Data Protection Regulation, Information Technology Act, 2000 and Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Data or Information) Rules, 2011 along with any amendments made to these acts, rules and regulations. </p>
  <h4>RETENTION PERIODS</h4>
  <p>We do not keep your personal data longer than necessary for the purpose of the processing. This includes, for example, the purposes of satisfying any legal, regulatory, accounting, reporting requirements, to carry out legal work, for the establishment or defence of legal claims.</p>
  <p>In some circumstances we may anonymise your personal data (so that it can no longer be associated with you) for research or statistical purposes in which case we may use this information indefinitely without further notice to you. </p>
  <h4>DATA PROTECTION</h4>
  <p>Under certain circumstances, you have rights under applicable data protection laws in relation to your personal data. It is our policy to respect your rights and we will act promptly and in accordance with any applicable law, rule or regulation relating to the processing of your personal data.</p>
  <p>Details of your rights under General Data Protection Regulation (&ldquo;GDPR&rdquo;) are set out below:</p>
  <ol class="pb-3 list-lower-alpha">
    <li>Right to be informed about how personal data is used &ndash; you have a right to be informed about how we will use and share your personal data. This explanation will be provided to you in a concise, transparent, intelligible and easily accessible format and will be written in clear and plain language;</li>
    <li>Right to access personal data &ndash; you have a right to obtain confirmation of whether we are processing your personal data, access to your personal data and information regarding how your personal data is being used by us;
      </p>
    <li>Right to have inaccurate personal data rectified &ndash; you have a right to have any inaccurate or incomplete personal data rectified. If we have disclosed the relevant personal data to any third parties, we will take reasonable steps to inform those third parties of the rectification where possible;</li>
    <li>Right to have personal data erased in certain circumstances &ndash; you have a right to request that certain personal data held by us is erased. This is also known as the right to be forgotten. This is not a blanket right to require all personal data to be deleted. We will consider each request carefully in accordance with the requirements of any laws relating to the processing of your personal data;</li>
    <li>Right to restrict processing of personal data in certain circumstances &ndash; you have a right to block the processing of your personal data in certain circumstances. This right arises if you are disputing the accuracy of personal data, if you have raised an objection to processing, if processing of personal data is unlawful and you oppose erasure and request restriction instead or if the personal data is no longer required by us but you require the personal data to be retained to establish, exercise or defend a legal claim;</li>
    <li>Right to data portability &ndash; under certain circumstances, you have the right to request to receive a copy of your personal data in a commonly used electronic format. This right only applies to personal data that you have provided to us (for example by completing a form or providing information through our website). Information about you which has been gathered by monitoring your behaviour will also be subject to the right to data portability. The right to data portability only applies if the processing is based on your consent or if the personal data must be processed for the performance of a contract and the processing is carried out by automated means (i.e. electronically);</li>
    <li>Right to object to processing of personal data in certain circumstances (including where personal data is used for marketing purposes) &ndash; you have a right to object to processing being carried out by us if (a) we are processing personal data based on legitimate interests or for the performance of a task in the public interest (including profiling), (b) if we are using personal data for direct marketing purposes, or (c) if information is being processed for scientific or historical research or statistical purposes. You will be informed that you have a right to object at the point of data collection and the right to object will be explicitly brought to your attention and be presented clearly and separately from any other information; and</li>
    <li>Right not to be subject to automated decisions where the decision produces a legal effect or a similarly significant effect &ndash; you have a right not to be subject to a decision which is based on automated processing where the decision will produce a legal effect or a similarly significant effect on you.</li>
  </ol>
  <p>You may exercise any of the above-mentioned rights by sending a request to us on our contact information as detailed below. You will not have to pay a fee to access your personal data (or to exercise any of the other rights). However, we may charge a reasonable fee if your request is clearly unfounded, repetitive or excessive. Alternatively, we may refuse to comply with your request in these circumstances.</p>
  <p>We may need to request specific information from you to help us confirm your identity and ensure your right to access your personal data (or to exercise any of your other rights). This is a security measure to ensure that personal data is not disclosed to any person who has no right to receive it. We may also contact you to ask you for further information in relation to your request to speed up our response.</p>
  <p>We try to respond to all legitimate requests within one month. Occasionally it may take us longer than one calendar month if your request is particularly complex or you have made a number of requests. In this case, we will notify you and keep you updated.</p>
  <h4>QUESTIONS OR COMPLAINTS</h4>
  <p>If you have any question or complaints about the processing of your personal data, write to us at <a href="mailto:legal@cityexplorers.in">legal@cityexplorers.in</a>. Our team will be happy to assist you.</p>
  <h4>CEPL CONTACT INFORMATION</h4>
  <p>Address: City Explorers Private Limited, 206, Ashoka Apartments, Commercial Complex, Ranjeet Nagar, New Delhi-110008, INDIA.<br />
    Email: <a href="mailto:help@cityexplorers.in">help@cityexplorers.in</a></p>
</div>
    
  </div>
</main>
<?php include('footer.php');?>
<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<?php include('foot.php');?>
</body>
</html>
