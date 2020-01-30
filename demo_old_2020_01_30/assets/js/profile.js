(function($) {
			    
	if(savemsg!=='' && savemsg=='success_save'){
			$('.loadingWrap').hide();
			  $('#profileSaveMsg').html('Your profile has been saved successfully!');
			  $('#profilesaveTitle').html('Success');
			 $('#saveModal').modal(); 
			}
   if(savemsg!=='' && savemsg=='save_error'){	          
			 $('.loadingWrap').hide();
			 $('#profileSaveMsg').html('Oops, something went wrong!, please try again');
			  $('#profilesaveTitle').html('Error');
			 $('#saveModal').modal(); 
			}
			
			
			
  $(document).on('click', '#save', function() {
	$('#profile_form').attr('action', 'save_profile');		
	$('.loadingWrap').show();
	$("#saveForm").trigger("click");
		    console.log("CLICK");

	//var state_id = $('#state option:selected').val();
        //var  state_ids = $('#company_state option:selected').val();
        //loadCity(state_id);
        // loadCompnyCity(state_ids);  
    });

    $("#done").click(function() {
		$('#profile_form').attr('action', 'done_profile');
		$('.loadingWrap').show();
		$("#profile_form").validate({
				errorElement: 'small',
				errorPlacement: function(error, element) {
						error.appendTo(element.closest(".placeVaild"));
					},
				invalidHandler: function() {
					$('.loadingWrap').hide();
					},
				submitHandler: function() {
					$(form).submit();
				}
			});
        $("#doneForm").trigger("click");

		// $('#profile_form').trigger('submit');
      /*  var mob = $('#mobile_number').val();
        var len = mob.length;
        if (len == '' || len == null) {
            $('#mob_error').show();
            return false;
        }

        var pin = $('#pin_code').val();
        var len = pin.length;
        if (len == '' || len == null) {
            $('#pin_code').show();
            return false;
        }
*/

    });
		


    // UPLOAD USER IMAGE
    function readURL() {
        //$('#userProfileImage').attr('src', '').hide();
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            $(reader).load(function(e) {
                $('#userProfileImage').attr('src', e.target.result);
                $('.userImagelabel').removeClass('active')
            });
            reader.readAsDataURL(this.files[0]);
        }
    }

    $('#userProfileImage').load(function(e) {
        $(this).show();
    });

    $('.userImagelabel').addClass('active');

    $('#userimageInput').change(readURL);

    $(document).on('click', '.userImageClear', function(e) {
        e.preventDefault();
        $('#userProfileImage').attr('src', '').hide();
        $(this).parent().parent().find('.vaildValue').prop('checked', false);
        $('.userImagelabel').addClass('active');
    });


    // SAME AS ABOVE
    $(document).on('change', '#sameAbove', function() {
        if ($(this).prop('checked') == true) {
            $('#temporaryAddress').hide().find('input, select').val('');
        } else {

            $('#temporaryAddress').show();
            $('#tmp_address_1').prop('required', true);
            $('#tmp_address_2').prop('required', true);
            $('#tmp_address_3').prop('required', false);
            $('#tmp_state').prop('required', true);
            $('#tmp_city').prop('required', true);
            $('#tmp_pin_code').prop('required', true);
        }

    });
    var tmp_field_val = $('#tmp_address_1').val();
    if (tmp_field_val != '') {
        $('#sameAbove').prop("checked", false);
        $('#temporaryAddress').show();
        //$("#myCheck"). prop("checked", false);
    }


    // DATE PICKER
   $('#date_of_birth').datepicker({
	 autoclose: true,
  toggleActive: true,
		format: 'dd/mm/yyyy',
  endDate: new Date(),
			icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			}
});

    //UPLOAD DOCUMENT
    $(document).on('change', '.uploadDoc', function(e) {
        var $this = $(this);
        var $box = $this.parent();
        var $boxicon = $box.find('.dragBox-icon');
        var $boxinfo = $box.find('.dragBox-info');
        var $fileinfo = $box.find('.infoShow');
        var $nameText = $fileinfo.find('p');
        var $sizeText = $fileinfo.find('small');
        var $spanText = $boxinfo.find('span');
        var fileName = e.target.files[0].name;
        var fileSize = e.target.files[0].size;
        var fileType = e.target.files[0].type;
        var filekb = Math.round((fileSize / 1024));
        var fileExtension = ['jpeg', 'jpg', 'pdf', 'exl'];
        var exe = $this.val().split('.').pop().toLowerCase();

        if ($.inArray(exe, fileExtension) == -1) {
            alert("Only formats are allowed : " + fileExtension.join(', '));
            $this.val('');
        } else {
            if (exe == 'pdf') {
                $boxicon.find('img').attr('src', 'assets/img/icon/filepng.svg');
            }
            if (exe == 'jpg' || exe == 'jpeg') {
                $boxicon.find('img').attr('src', 'assets/img/icon/filejpg.svg');
            }
            if (exe == 'exl') {
                $boxicon.find('img').attr('src', 'assets/img/icon/fileexl.svg');
            }
            $nameText.html(fileName);
            $sizeText.html(+filekb + ' kb');
            $spanText.hide();
            $box.addClass('active');
            $fileinfo.show();
        }
    });

    $(document).on('click', '.clearDargbox', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $box = $this.parents('.dragBox');
        var $fileinfo = $box.find('.infoShow');
        var $boxinfo = $box.find('.dragBox-info');
        var $spanText = $boxinfo.find('span');
        var $vCheck = $box.parent().find('.checkValue');
		var $vCheckbox = $vCheck.next('input');
        $fileinfo.hide();
        $spanText.show();
        $box.removeClass('active');
        $box.find('.uploadDoc').val('');
		$vCheck.val('');
        $vCheckbox.prop('checked', false);
        $box.find('img').attr('src', 'assets/img/icon/file.svg');
    });

    // MASK 
    $('#adhaar_number').mask('0000 0000 0000');
    $('#pan_number').mask('AAAAAAAAAA');
    $('#passport_number').mask('AAAAAAAA');
    $('#license_guide_number').mask('000000000000');
    $('#gst_pin').mask('AAAAAAAAAA');


    // MODAL ADD MORE
    //$('#doneModal').modal();

    $('#knownLanguagesModal').on('show.bs.modal', function(event) {
        $(this).find('input').val('');
    });

    /*$('body').scrollspy({
        target: '#spyBar',
        offset: 140
    });*/


    // SAVE and Done Form action and tigger define
    $('.addmore').on('click', function() {
        var newLang = $('#moreLang').val();
        //alert(newLang);
        if (newLang != '') {
            $('#knownLangTags').before('<li><label class="tagBox active"><input type="checkbox" checked name="know_languages[]" value="' + newLang + '" />' + newLang + '</label></li>');
        }

        if (newLang == '') {
            $('#moreLang').focus();
        } else {
            $('#knownLanguagesModal').modal('hide');
        }


    });
    // ACTIVE CHECKBOX
    $(document).on('change', '.tagBox input:not([readonly])', function() {

        if ($(this).prop('checked') == true) {
            $(this).parent().addClass('active');
        } else {
            $(this).parent().removeClass('active');
        }
    });


    $('.checkValue').each(function() {
        var $this = $(this);
        var $vCheck = $this.next('.vaildValue');
        if (!$(this).val() == '') {
            $vCheck.prop('checked', true);
        } else {
            $vCheck.prop('checked', false);

        }
    });

    $(document).on('change', '.fileInput', function(e) {
        var $this = $(this);
        var $vCheck = $this.next().next('.vaildValue');
        if (this.files && this.files[0]) {
            $vCheck.prop('checked', true);
        } else {
            $vCheck.prop('checked', false);
        }
    });

})(jQuery);