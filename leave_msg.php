<div class="leaveMessage"> <a href="" class="msgLink"><b><img src="<?= base_url('assets/img/icon/mail.svg')?>" alt="mail"></b><span>Leave a message</span></a>
  <div class="messageForm">
    <div id="alert-msg">
  
    </div>
    <div id='loadingmessage' class="loaderBox">
        <span><img src="<?= base_url('assets/img/loader.svg')?>"/></span>  
      </div><br>
    
      <?= form_open('',["id"=>"leave_msg","onsubmit"=>"leaveMsg(); return false;"]);?>
      <h2 class="text-secondary">Leave a message</h2>
      <ul class="form-row">
        <li class="form-group col-12">
          <label class="col-form-sublabel">Full Name</label>
          <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" required/>
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Email" required/>
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Phone</label>
          <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone" minlength="10" maxlength="14" required/>
          <small id="mob_num_error" style="display:none; margin-bottom: .625rem; font-size: 11px; color:red; margin-top: -12px;">Contact Number should be minimum  10 digit</small>

        </li>
        <li class="form-group col-12">
          <textarea class="form-control" id ="msg" name="msg" onkeyup="countChar(this)" placeholder="Write your message (max. 400 chartacters)" maxlength="400" required></textarea>
          <small class="text-muted">Total characters left: <span id="charNum">0</span> characters. </small>
        </li>

        <li class="form-group col-12 text-right">
          <?= form_submit(['name'=>'submit','id'=>'send_leave_msg','value'=>'Send','class'=>'btn btn-primary','type'=>'submit']) ?>
          <!-- <button class="btn btn-primary">Send</button> -->
        </li>
      </ul>

      <?php form_close()?>
    
  </div>
</div>
