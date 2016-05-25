    <div class="single">  
        <?php echo $this->session->flashdata('pesan'); ?>
	   
       <div class="contact_top">
	     <div class="col-sm-12">
	   	   <address class="addr">
                <p class="secondary3">PT. Arthabuana Margausaha Finance</p>
                <dl>
                    <dt>Jl. Guntur No. 45, Setiabudi, Jakarta Selatan 12980</dt>
                </dl>
                <dl>
                    <dt>Telephone:</dt>
                    <dd>
                        (021) 83784355
                    </dd>
                </dl>
                <dl>
                    <dt>FAX:</dt>
                    <dd>
                        (021) 83784353
                    </dd>
                </dl>
           </address>
          </div>
       </div>





	   <div class="content_bottom">
	   	 <h3>Contact Form</h3>
	   	   <?php echo form_open('kontak/simpanpesan'); ?>
			<div class="contact_box1">
             	<input type="hidden" name="<?= $fieldname ?>" value="<?= $fieldvalue ?>">
                <input type="text" class="text" name="nama" value="" placeholder="Name">
			 	<input type="text" class="text" name="email" value="" placeholder="Email" style="margin-left:6%">
			</div>
			<div class="text_1">
               <textarea placeholder="Message" name="pesan"></textarea>
            </div>
            <div class="form-submit1 form_but1">
	           <input name="submit" type="submit" value="Submit"><br>
	        </div>
			<div class="clearfix"></div>
           <?php echo form_close(); ?>
	   </div>
    </div>