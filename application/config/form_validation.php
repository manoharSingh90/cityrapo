<?php

$config = [
	       "user_profile_rule" =>[
	       	                       [
	       	                       	'field'=>'first_name',
	       	                       	'lable'=>'First Name',
	       	                       	'rules'=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'last_name',
	       	                       	"lable"=>'Last Name',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       // [
	       	                       // 	"field"=>'mobile_number',
	       	                       // 	"lable"=>'Mobile Number',
	       	                       // 	"rules"=>'required|exact_length[10]'
	       	                       // ],
	       	                       [
	       	                       	"field"=>'email_id',
	       	                       	"lable"=>'Email Id',
	       	                       	"rules"=>'required|valid_email'
	       	                       ],
	       	                    //    // [
	       	                    //    // 	"field"=>'profile_pic',
	       	                    //    // 	"lable"=>'Profile Picture',
	       	                    //    // 	"rules"=>'required'
	       	                    //    // ],
	       	                        [
	       	                       	"field"=>'gender',
	       	                       	"lable"=>'Gender',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'nationality',
	       	                       	"lable"=>'Nationality',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'date_of_birth',
	       	                       	"lable"=>'Date Of Birth',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'description',
	       	                       	"lable"=>'Discription',
	       	                       	"rules"=>'required|max_length[2000]'
	       	                       ],
	       	                     /*  [
	       	                       	"field"=>'per_address_1',
	       	                       	"lable"=>'Permanent Address 1',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'per_address_2',
	       	                       	"lable"=>'Permanent Address 2',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'per_address_3',
	       	                       	"lable"=>'Permanent Address 3',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                        [
	       	                       	"field"=>'state',
	       	                       	"lable"=>'State',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                        [
	       	                       	"field"=>'city',
	       	                       	"lable"=>'City',
	       	                       	"rules"=>'required'
	       	                       ],*/
	       	                       //  [
	       	                       // 	"field"=>'pin_code',
	       	                       // 	"lable"=>'PIN Code',
	       	                       // 	"rules"=>'required|exact_length[6]'
	       	                       // ],
	       	                       // [
	       	                       // 	"field"=>'tmp_address_1',
	       	                       // 	"lable"=>'Temporary Address 1',
	       	                       // 	"rules"=>'required'
	       	                       // ],
	       	                       // [
	       	                       // 	"field"=>'tmp_address_2',
	       	                       // 	"lable"=>'Temporary Address 2',
	       	                       // 	"rules"=>'required'
	       	                       // ],
	       	                       // [
	       	                       // 	"field"=>'tmp_address_3',
	       	                       // 	"lable"=>'Temporary Address 3',
	       	                       // 	"rules"=>'required'
	       	                       // ],
	       	                       // [
	       	                       // 	"field"=>'tmp_state',
	       	                       // 	"lable"=>'Temporary State',
	       	                       // 	"rules"=>'required'
	       	                       // ],
	       	                       // [
	       	                       // 	"field"=>'tmp_city',
	       	                       // 	"lable"=>'Temporary City',
	       	                       // 	"rules"=>'required'
	       	                       // ],
	       	                       // [
	       	                       // 	"field"=>'tmp_pin_code',
	       	                       // 	"lable"=>'Temporary Pin Code',
	       	                       // 	"rules"=>'required|exact_length[6]'
	       	                       // ],
	       	                        /*[
	       	                       	"field"=>'associated_companies',
	       	                       	"lable"=>'Associated Companies',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'company_name',
	       	                       	"lable"=>'Company Name',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'company_address_1',
	       	                       	"lable"=>'Company Address 1',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'company_address_1',
	       	                       	"lable"=>'Company Address 2',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'company_state',
	       	                       	"lable"=>'Company State',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'company_city',
	       	                       	"lable"=>'Company City',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'company_pin_code',
	       	                       	"lable"=>'Company PIN Code',
	       	                       	"rules"=>'required|exact_length[6]'
	       	                       ],*/
	       	                       [
	       	                       	"field"=>'interest[]',
	       	                       	"lable"=>'Intereset ',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'services_offered[]',
	       	                       	"lable"=>'Services Offered ',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'preferred_cities[]',
	       	                       	"lable"=>'Preferred Cities ',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       // [
	       	                       // 	"field"=>'known_languages',
	       	                       // 	"lable"=>'Known Languages[] ',
	       	                       // 	"rules"=>'required'
	       	                       // ],
	       	                       [
	       	                       	"field"=>'preferred_languages',
	       	                       	"lable"=>'preferred_languages ',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'host_before',
	       	                       	"lable"=>'Host Before ',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       [
	       	                       	"field"=>'adhaar_number',
	       	                       	"lable"=>'Adhaar Number',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       // [
	       	                       // 	"field"=>'adhaar_number_doc',
	       	                       // 	"lable"=>'Adhaar Number Document',
	       	                       // 	"rules"=>'required'
	       	                       // ],
	       	                       [
	       	                       	"field"=>'pan_number',
	       	                       	"lable"=>'Pan Number',
	       	                       	"rules"=>'required'
	       	                       ],
	       	                       // [
	       	                       // 	"field"=>'pan_number_doc',
	       	                       // 	"lable"=>'Pan Number Document',
	       	                       // 	"rules"=>'required'
	       	                       // ],
	       	                      /* [
	       	                       	"field"=>'passport_number',
	       	                       	"lable"=>'Passport Number',
	       	                       	"rules"=>'required'
	       	                       ],*/
	       	                       // [
	       	                       // 	"field"=>'passport_number_doc',
	       	                       // 	"lable"=>'Passport Number Document',
	       	                       // 	"rules"=>'required'
	       	                       // ],
	       	                       /*[
	       	                       	"field"=>'license_guide_number',
	       	                       	"lable"=>'License Guide Number',
	       	                       	"rules"=>'required'
	       	                       ]*/
	       	                       // [
	       	                       // 	"field"=>'license_guide_number_doc',
	       	                       // 	"lable"=>'License Guide Number Document',
	       	                       // 	"rules"=>'required'
	       	                       // ]
	                             ]
	                         ]
          
?>