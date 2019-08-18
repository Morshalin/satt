<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/message/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold"> <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Message type <span class="text-danger">*</span></label>
                <!-- <textarea type="text" name="message_type" id="message_type" class="form-control" placeholder="Customer Reference" required autofocus rows="5" cols="80">  </textarea> -->
                <select type="text" name="message_type" id="message_type" class="form-control">
                  <?php
                  $result = $db->select("SELECT * FROM satt_message_type");

                        $result_check = mysqli_num_rows($result);
                        if( $result_check > 0 ){
                          while ($row = mysqli_fetch_assoc($result)) {
                              ?>
                              <option value="<?php echo $row['type']; ?>"> <?php echo $row['type']; ?> </option>
                              <?php
                          }
                        }
                 ?>
                </select>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Customer question <span class="text-danger">*</span></label>
                <textarea type="text" name="customer_question" id="customer_question" class="form-control" placeholder="Customer Reference" required autofocus rows="5" cols="80">  </textarea>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Our reply <span class="text-danger">*</span></label>
                <textarea type="text" name="our_reply" id="our_reply" class="form-control" placeholder="Customer Reference" required autofocus rows="5" cols="80">  </textarea>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Software information <span class="text-danger">*</span></label>
                <textarea type="text" name="software_information" id="software_information" class="form-control" placeholder="Customer Reference" required autofocus rows="5" cols="80">  </textarea>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Contact details <span class="text-danger">*</span></label>
                <textarea type="text" name="contact_details" id="contact_details" class="form-control" placeholder="Customer Reference" required autofocus rows="5" cols="80">  </textarea>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="type" class="col-form-label">Introduction message <span class="text-danger">*</span></label>
                <textarea type="text" name="introduction_message" id="introduction_message" class="form-control" placeholder="Customer Reference" required autofocus rows="5" cols="80">  </textarea>
            </div>
        </div>
    </div>

    <div class="text-right">
      <button type="submit" name="create" class="btn btn-success ml-31 mr-2 px-5" id="submit">Add message</button>
      <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
      <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
		</div>


</fieldset>
</form>
<!-- /login form -->
