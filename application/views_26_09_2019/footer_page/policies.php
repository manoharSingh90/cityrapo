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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/policies/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text">
        <h2>Policies</h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg pt-5 pb-5">
    <div class="container"> `
      <h3>TERMS OF USE</h3>
      <h4>WEBSITE OPERATOR</h4>
      <p><strong>City Explorers Private Limited</strong> (hereinafter referred to as &ldquo;<strong>CEPL</strong>&rdquo;) offers its services such as booking of, providing and/or facilitating walks, tours, adventures, food tours, water activities, and such other similar travel and experience related services (&ldquo;<strong>Services</strong>&rdquo;) on and through this website at <a href="www.cityexplorers.in" target="_blank">www.cityexplorers.in</a> along with its related sub-site/s, mobile and software application/s, social media platforms and/or cloud media (hereinafter collectively referred to as the &ldquo;<strong>Website</strong>&rdquo;).</p>
      <p>Service Information: The Website is designed to provide the Users access to information, about the Services entailing experiences regarding local destinations, such as, walks, tours, adventures, food tours, water activities, and such other similar travel and experience related services and to provide local experience creators (which may hereafter be referred to collectively as &ldquo;<strong>Operators</strong>&rdquo;) for the rendering of these aforementioned Services via a platform easily accessible and navigable providing the Users such information.</p>
      <p>Use of this Website is subject to these general terms and conditions (&ldquo;<strong>Terms of Use</strong>&rdquo;).</p>
      <p>The Website is published and maintained by City Explorer Private Limited, a company incorporated and existing in accordance with the laws of India. This page sets forth the terms and conditions under which CEPL provide the information on this Website, as well as the terms and conditions broadly governing your use of the Website. The user of the Website (hereinafter referred to as &ldquo;<strong>User/s</strong>&rdquo;) shall be a natural or legal person and deemed to have read, understood and expressly accepted these Terms of Use. All rights and liabilities of the User with respect to any transaction, Services or engagement with CEPL shall be restricted to the scope of the CEPL Terms.</p>
      <p>In order to access the Website through a mobile data network, roaming data network and other internet service networks and/or providers, data charges and other rates may apply.</p>
      <p>In availing the Services through the Website, you confirm that you are an adult of at least 18 years of age or have parental guidance and/or supervision while using the Website.</p>
      <p><strong><u>IF YOU DO NOT ACCEPT THESE TERMS OF USE, DO NOT CONTINUE TO USE OR ACCESS THIS WEBSITE OR ANY OTHER CONSTITUENT OF THE WEBSITE.</u></strong></p>
      <p><em>CEPL reserves the right, at its sole discretion, to change, modify, add or remove portions of these Terms of Use, at any time. It is your responsibility to check these Terms of Use periodically for changes. Your continued use if the Website following the posting of changes shall deemed to mean acceptance of the amended Terms of Use.</em></p>
      <p><em>As long as you comply with these Terms of Use, CEPL grants you a personal, non-exclusive, non-transferrable, limited license to enter and use this Website. You agree not to interrupt or attempt to interrupt the operation of this Website in any way. </em></p>
      <h4>ADDITIONAL TERMS</h4>
      <p>In addition to these Terms of Use, there are certain Terms of Service, specific to the Services rendered/proposed to be rendered by CEPL through its Operators registered with CEPL. For a User that wishes to engage with CEPL as an Operator for providing Service/s to Travelers shall also be required to accept certain Terms of Operations specific to the operations proposed to be run by the Operator for and on behalf of CEPL. Such Terms of Operations shall be provided / updated by CEPL to the Operators from time to time, which, along with any other terms, conditions, policies and amendments thereof, issued by CEPL and accepted by the Operators (all collectively referred to as the &ldquo;<strong>CEPL Operations Terms</strong>&rdquo;), shall govern the operations to be run by the Operators for and on behalf of CEPL for all intents and purposes, and shall be binding on the Operator. These Terms of Use, the Terms of Operations and any other agreement, policy or disclaimer that may be required to be executed or accepted by the Operators for the rendition of operations by them shall be complimentary to each other and in the event of a conflict, the Terms of Operations shall prevail.</p>
      <p>The Users shall be responsible for ensuring compliance with the CEPL Terms or CEPL Operations Terms, as the case may be, and any other terms, guidelines or operating rules and policies provided by CEPL.</p>
      <p>It is hereby clarified that creation of itineraries is the sole responsibility of the Operators and CEPL shall not be liable for any change, delays, negligence on part of the Operators with respect to the same. Further, with respect to the Operators, it is clarified that listing of services to be rendered by the Operators on the Website shall also entail a cost and the Operator/s agree to making requisite payments in favour of CEPL as and when sought in accordance with the rates/prices that the Operator shall be informed about prior to the said listing</p>
      <p>Further, with respect to users availing Services on and from the Website, a Terms of Service shall be provided / updated by CEPL to said Users availing Services (&ldquo;Travelers&rdquo;) from time to time, which, along with any other terms, conditions, policies and amendments thereof, issued by CEPL and accepted by the Travelers (all collectively referred to as the &ldquo;CEPL Terms&rdquo;), shall govern the provision of Service(s) by CEPL for all intents and purposes, and shall be binding on the Traveler. It is further clarified that on availing or booking or cancelling of the Services, you agree to pay the relevant consideration to CEPL in the manner specified at the time of booking/availing of the Services. In cases where a refund is sought by a User, CEPL shall make the relevant refunds as per its Cancellation and Refund Policy which can be accessed in the policies page of the website.  It is clarified that cancellation charges for any third party services booked on the Website shall be borne by the Traveler. These Terms of Use, the Terms of Service and any other agreement, policy or disclaimer that may be required to be executed or accepted by the Travelers for the provision of Services to them shall be complimentary to each other and in the event of a conflict, the Terms of Service shall prevail. The Traveler shall be required to read and accept the relevant Terms of Service for the service/ product availed by the Traveler.</p>
      <p>Through the Website, CEPL provides tools that enable the Users to arrange physical events (&quot;<strong>Sessions and Meetups</strong>&rdquo;&quot;) at venues that include, but are not limited to, private enterprises (such as coffee shops and bars, hotels, convention centers, public parks, and private homes). CEPL does not supervise these events and are not involved with the actions of any individuals at these events. CEPL also does not have any control or authority over the identity or actions of the individuals who are present at said events, and CEPL requests their Users to exercise caution and good judgment when attending Sessions and Meetups. By agreeing to or actually attending a Sessions and Meetup, you are responsible for your own safety. CEPL is and shall not be involved in the transportation to and from the venue, your interactions with other members, or the actions of any individuals at the events. By attending an event you take full responsibility for your own safety and well-being.</p>      <p>In the event a User sends an e-mail(s), text message(s) or communicates with CEPL in any way or form, the User shall be deemed to have initiated communication with CEPL and given his/her/its agreement to allow CEPL to initiate communication with the User in a variety of ways, such as via e-mail, in-app push notices, or by posting notices and messages on the Website. The User may unsubscribe from e-mail communications by sending an email at <a href="mailto:help@cityexplorers.in">help@cityexplorers.in</a></p>
      <p>Upon usage of the Website, the User consents to receive electronic/ telephonic communications from CEPL as further described in our Privacy Policy. It shall be assumed that the User has read, understood and agreed all the terms contained in our In the spirit of full disclosure, CEPL receives no payment for our recommendations of any products or services on this site except when explicitly mentioned in the post (&ldquo;Sponsored posting&rdquo;). Some advertisers that appear on this site may pay fees to CEPL when a visitor clicks through their advertisements.</p>
      <p>You represent and warrant that (i) your use of the Website will be in strict accordance with the CEPL Privacy Policy, with this Agreement and with all applicable laws and regulations (including without limitation any local laws or regulations in your country, state, city, or other governmental area, regarding online conduct and acceptable content, and including all applicable laws regarding the transmission of technical data exported from the country in which you reside) and (ii) your use of the Website will not infringe or misappropriate the intellectual property rights of any third party. </p>
      <h4>CONTENT</h4>
      <p>All text, graphics, user interfaces, visual interfaces, photographs, trademarks, logos, sounds, music, artwork and computer code (collectively, &ldquo;<strong>Content</strong>&rdquo;), including but not limited to the design, structure, selection, coordination, expression, &ldquo;look and feel&rdquo; and arrangement of such Content, contained on the Website is owned, controlled or licensed by or to CEPL, and is protected by trade dress, copyright, patent and trademark laws, and various other intellectual property rights and unfair competition laws.</p>
      <p>Except as expressly provided in these Terms of Use, no part of the Website and no Content may be copied, reproduced, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted or distributed in any way (including &ldquo;<strong>mirroring</strong>&rdquo;) to any other computer, server, website or other medium for publication or distribution or for any commercial enterprise, without CEPL&rsquo; express prior written consent.</p>
      <p>As CEPL asks others to respect its intellectual property rights, it respects the intellectual property rights of others. If you believe that material located on or linked to violates your copyright, you are encouraged to notify CEPL in accordance with CEPL&rsquo;s Digital Millennium Copyright Act (&ldquo;DMCA&rdquo;) Policy. CEPL will respond to all such notices, including as required or appropriate by removing the infringing material or disabling all links to the infringing material. CEPL will terminate a visitor&rsquo;s access to and use of the Website if, under appropriate circumstances, the visitor is determined to be a repeat infringer of the copyrights or other intellectual property rights of CEPL or others. In the case of such termination, CEPL will have no obligation to provide a refund of any amounts previously paid to CEPL.</p>
      <p>You may use information about the Services purposely made available by CEPL for downloading from the Website, provided that you (1) not remove any proprietary notice language in all copies of such documents, (2) use such information only for your personal, non-commercial informational purpose and do not copy or post such information on any networked computer or broadcast it in any media, (3) make no modifications to any such information, and (4) not make any additional representations or warranties relating to such documents.</p>
      <p>You agree not to use any device, software or routine to interfere or attempt to interfere with the proper working of the Website or any transaction being conducted on the Website, or with any other person&rsquo;s use of the Website. You may (i) not permit any third party to copy, adapt, reverse engineer, decompile, disassemble, modify, adapt or make error corrections to the Website in whole or in part; (ii) not rent, lease, sub-license, loan, translate, merge, adapt or modify the Website or any associated documentation and/or (iii) not disassemble, de-compile, reverse engineer or create derivative works based on the whole or any part of the Website nor attempt to do any such things. You may not use the Website or any Content for any purpose that is unlawful or prohibited by these Terms of Use, or to solicit the performance of any illegal activity or other activity which infringes the rights of CEPL or others.</p>
      <p>You may only use this Website to make legitimate reservations or purchases or run operations for and on behalf of CEPL, as the case may be, and shall not use this Website for any other purposes, including without limitation, to make any speculative, false or fraudulent reservation or any reservation in anticipation of demand, any comments colored with or having an inclination towards a particular religions, region, nation, group or class of people. Any Content copied from the Website must be accompanied by acknowledgement of ownership of the IP of the relevant extract. Except with our express written permission, distribution or commercial exploitation of any of the Content of our Website is prohibited. You are further prohibited from posting or transmitting any unlawful, threatening, libelous, defamatory, obscene, indecent, inflammatory, pornographic or profane material or any material that could constitute or encourage acts or omissions that would amount to a criminal offense or attempt to commit a criminal offense, or give rise to civil liability, or otherwise violate any law. In addition, you are prohibited from posting or transmitting any information which (a) infringes the rights of others or violates their privacy or publicity rights, (b) is protected by patent, copyright, trademark or other proprietary right, unless with the express written permission of the owner of such right, (c) contains a virus, bug, worm or other harmful item or program that may damage, detrimentally interfere with, surreptitiously intercept and/or expropriate any system, data or important information, (d) create any liability for us or cause us to lose (fully or partially) the services of our internet service providers or other suppliers, or (e) is used to unlawfully collude against another person in restraint of trade or competition. You shall be solely liable for any damages resulting from any infringement of copyright, trademark, or other proprietary right, or any other harm resulting from your use of this Website.</p>
      <p>CEPL has not reviewed, and cannot review, all of the material, including computer software, posted to the Website, and cannot therefore be responsible for that material&rsquo;s content, use or effects. By operating the Website, CEPL does not represent or imply that it endorses the material there posted, or that it believes such material to be accurate, useful or non-harmful. You are responsible for taking precautions as necessary to protect yourself and your computer systems from viruses, worms, Trojan horses, and other harmful or destructive content. The Website may contain content that is offensive, indecent, or otherwise objectionable, as well as content containing technical inaccuracies, typographical mistakes, and other errors. The Website may also contain material that violates the privacy or publicity rights, or infringes the intellectual property and other proprietary rights, of third parties, or the downloading, copying or use of which is subject to additional terms and conditions, stated or unstated. CEPL disclaims any responsibility for any harm resulting from the use by visitors of the Website, or from any downloading by those visitors of content there posted.</p>
      <p>CEPL may terminate your access to all or any part of the Website at any time, with or without cause, with or without notice, effective immediately. If you wish to terminate this Agreement, you may simply discontinue using the Website.</p>
      <h4>DISCLAIMERS</h4>
      <p>CEPL DOES NOT PROMISE THAT THE WEBSITE OR ANY CONTENT, SERVICE OR FEATURE OF THE WEBSITE WILL BE ERROR-FREE OR UNINTERRUPTED, OR THAT ANY DEFECTS WILL BE CORRECTED, OR THAT YOUR USE OF THE WEBSITE WILL PROVIDE SPECIFIC RESULTS. THE WEBSITE AND ITS CONTENT ARE DELIVERED ON AN &ldquo;AS-IS&rdquo; AND &ldquo;AS-AVAILABLE&rdquo; BASIS. ALL INFORMATION PROVIDED ON THE WEBSITE IS SUBJECT TO CHANGE WITHOUT NOTICE. CEPL CANNOT ENSURE THAT ANY FILES OR OTHER DATA YOU DOWNLOAD FROM THE WEBSITE WILL BE FREE OF VIRUSES OR CONTAMINATION OR DESTRUCTIVE FEATURES. CEPL DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING ANY WARRANTIES OF ACCURACY, NON-INFRINGEMENT, MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. CEPL DISCLAIMS ANY AND ALL LIABILITY FOR THE ACTS, OMISSIONS AND CONDUCT OF ANY THIRD PARTIES IN CONNECTION WITH OR RELATED TO YOUR USE OF THE WEBSITE AND/OR ANY CEPL SERVICES. YOU ASSUME TOTAL RESPONSIBILITY FOR YOUR USE OF THE WEBSITE AND ANY LINKED WEBSITES. YOUR SOLE REMEDY AGAINST CEPL FOR DISSATISFACTION WITH THE WEBSITE OR ANY CONTENT IS TO STOP USING THE WEBSITE OR ANY SUCH CONTENT. THIS LIMITATION OF RELIEF IS A PART OF THE BARGAIN BETWEEN CEPL AND THE USERS.</p>
      <p>The above disclaimer applies to any damages, liability or injuries caused by any failure of performance, error, omission, interruption, deletion, defect, delay in operation or transmission, computer virus, communication line failure, theft or destruction of or unauthorized access to, alteration of, or use, whether for breach of contract, tort, negligence or any other cause of action.</p>
      <p>CEPL reserves the right to do any of the following, at any time, without notice: (1) to modify, suspend or terminate operation of or access to the Website, or any portion of the Website, for any reason; (2) to modify or change the Website, or any portion of the Website, and any applicable policies or terms; and (3) to interrupt the operation of the Website, or any portion of the Website, as necessary to perform routine or non-routine maintenance, error correction, or other changes.</p>
      <h4>NO OFFER</h4>
      <p>The information on this Website is for general informational purposes only and does not constitute an offer binding on either party. Binding agreements with Travelers as well as Operators for availing Services and rendering operations, respectively, are available on the Website and the Travelers or Operators, as the case may be shall be required to register themselves on the Website to get access to these binding agreements. Registration of a Traveler or an Operator shall be subject to the acceptance of the same by CEPL and it shall have and continue to have sole and complete discretion in this regard.</p>
      <h4>LIMITATION OF LIABILITY</h4>
      <p>Except where prohibited by law, in no event will CEPL be liable to you for any indirect, consequential, exemplary, incidental or punitive damages, including lost profits, even if CEPL has been advised of the possibility of such damages. CEPL excludes its liability, and that of its agents and independent contractors, and its and their employees and officers, for damages relating to your access to (or inability to access) the Website, or to any errors or omissions, or the results obtained from the use, of the Website, whatever the legal basis of such liability would be.  If, notwithstanding the other provisions of these Terms of Use, CEPL is found to be liable to you for any damage or loss which arises out of or is in any way connected with your use of the Website or any Content, CEPL&rsquo;s liability shall in no event exceed the total of any fees with respect to any Service or feature of or on the Website paid in the 2 days (48 Hours) prior to the date of the initial claim made against CEPL.</p>
      <h4>INDEMNITY</h4>
      <p>You agree to indemnify and hold CEPL, its officers, directors, shareholders, predecessors, successors in interest, employees, agents, subsidiaries and affiliates, harmless from any demands, loss, liability, claims or expenses (including attorneys&rsquo; fees), made against CEPL by any third party due to or arising out of or in connection with your use of the Website.</p>
      <h4>VIOLATION OF THESE TERMS OF USE</h4>
      <p>CEPL may disclose any information we have about you (including your identity) if we determine that such disclosure is necessary in connection with any investigation or complaint regarding your use of the Website, or to identify, contact or bring legal action against someone who may be causing injury to or interference with (either intentionally or unintentionally) CEPL&rsquo; rights or property, or the rights or property of visitors to or users of the Website, including CEPL customers. CEPL reserves the right at all times to disclose any information that CEPL deems necessary to comply with any applicable law, regulation, legal process or governmental request. CEPL may also disclose your information when CEPL determines that applicable law requires or permits such disclosure, including exchanging information with other companies and organizations for fraud protection purposes.</p>
      <p>You agree that CEPL may, in its sole discretion and without prior notice, terminate your access to the Website and/or block your future access to the Website if we determine that you have violated these Terms of Use or other agreements or guidelines which may be associated with your use of the Website.</p>
      <p>You agree that CEPL may, in its sole discretion and without prior notice, terminate your access to the Website, for cause, which includes (but is not limited to) (1) requests by law enforcement or other government agencies, (2) a request by you (self-initiated account deletions), (3) discontinuance or material modification of the Website or any service offered on or through the Website, or (4) unexpected technical issues or problems.</p>
      <h4>INTELLECTUAL PROPERTY RIGHTS</h4>
      <p>As between you and CEPL, the Website is and remains protected by copyright and/or any other intellectual property rights. You acquire no rights through use of this Website in regard to any names, trade names, trademarks, and distinctive signs of any nature published on the Website. You may access and view the Website, but not incorporate it into other websites, application or any other digital media Website, and not copy, present, license, publish, download, upload, send or make it perceptible in any other way without our prior written consent.</p>
      <p>The following are the registered trademarks, trade names, logos and other intellectual properties owned by CEPL:</p>
      <table border="1" cellspacing="4" cellpadding="4" width="100%" class="mb-3 table">
        <thead bgcolor="#002060" style="color:#fff;">
          <tr>
            <th>Mark</th>
            <th>Registration Number</th>
            <th>Class</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>MONUMENT FRIENDS</td>
            <td>3734644</td>
            <td>41</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>WALK ICONS</td>
            <td>3870623</td>
            <td>39</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>WALK LEADERS</td>
            <td>3925731</td>
            <td>39</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>CITY MAVERICKS</td>
            <td>3180350</td>
            <td>39</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>FOODTHEORIST</td>
            <td>3375620</td>
            <td>43</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>STORYWALLAH</td>
            <td>3925733</td>
            <td>39</td>
            <td>Registered</td>
          </tr>
          <tr>
            <td>CITY EXPLORERS</td>
            <td>3770899</td>
            <td>39</td>
            <td>Registered</td>
          </tr>
        </tbody>
      </table>
      <p>This Agreement does not transfer from CEPL to you any CEPL or third-party intellectual property, and all right, title and interest in and to such property will remain (as between the parties) solely with City Explorers. City Explorers, the City Explorers logo, and all other trademarks, service marks, graphics and logos used in connection with WordPress.com, or the Website are trademarks or registered trademarks of City Explorers or City Explorers&rsquo; licensors/licensees. Other trademarks, service marks, graphics and logos used in connection with the Website may be the trademarks of other third parties. Your use of the Website grants you no right or license to reproduce or otherwise use any City Explorers or third-party trademarks.</p>
      <h4>APPLICABLE LAW AND JURISDICTION</h4>
      <p>These Terms of Use shall be governed by the Laws of India. Further, the Courts of New Delhi, India shall have exclusive jurisdiction is relation to matters arising out of or in connection with the Terms of Use.</p>
      <h4>FEEDBACK</h4>
      <p>Please feel free to write to us at <a href="mailto:help@cityexplorers.in">help@cityexplorers.in</a> </p>

  <h3 class="pt-5">PRIVACY POLICY</h3>
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
<?php include('leave_msg.php')?>
<!-- SCRIPT -->
<?php include('foot.php');?>
<script type="text/javascript">
(function($) {

// TOGGLE DATA
$(document).on('click','.toggleText', function(e){
	e.preventDefault();
	$(this).toggleClass('active').next('.textFold').slideToggle();
});
	
})(jQuery);
</script>
</body></html>