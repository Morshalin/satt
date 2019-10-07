<?php
  require_once '../../config/config.php';
  ajax();
?>

<!-- Login form -->
<form class="form-validate-jquery" action="<?php echo ADMIN_URL; ?>/office-expenses/ajax.php" id="content_form" method="post">
  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Create New Invoice <span class="text-danger">*</span> <small>  Fields Are Required </small></legend>

    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
                <label for="invoice_no" class="col-form-label">Invoice Id </label>
                <input type="text" class="form-control" id="invoice_no" name="invoice_no" readonly="" value="<?php echo('S-'.substr(uniqid('', true), -3).substr(number_format(time() * rand(),0,'',''),0,2)) ?>">
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
                <label for="invoice_type" class="col-form-label">Invoice Type </label>
                <select name="invoice_type" id="invoice_type" required="" class="form-control">
                    <option value="">Select Inoice Type</option>
                    <option value="Expense">Expense</option>
                    <option value="Income">Income</option>
                </select>
        </div>
            </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Type Name" required autofocus value="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="designation" class="col-form-label">Designation <span class="text-danger">*</span></label>
                <input type="text" name="designation" id="designation" class="form-control" placeholder="Type Designation" required autofocus value="">
            </div>
</div>
        <div class="col-md-6">

            <div class="form-group">
                <label for="phone" class="col-form-label">Mobile </label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Type Phone Number"  autofocus value="">
            </div>
</div>
<div class="col-md-6">

            <div class="form-group">
                <label for="date" class="col-form-label">Invoice Date <span class="text-danger">*</span></label>
                <input type="text" name="date" id="date" class="form-control date" placeholder="Select Start Date" required autofocus value="">
                <input type="hidden" name="total" class="form-control total" value="">
            </div>
</div>
</div>



        <div class="form-group bg-success" style="padding-bottom: 5px;margin-top: 30px">

          <div class="col-md-6 control-label" for="inputDefault"  style="text-align: left; color: #fff;font-size: 20px">
            Add Invoice Details
          </div>
        </div>

        <table class="table" class="">

          <thead>
            <tr>
              <th style="text-align: center;">Description</th>
              <th style="text-align: center;">Purpose</th>
              <th style="text-align: center;">Amount</th>
              <th><button type="button" class="btn btn-success" id="add_more"><i class="icon-stack-plus"></i></button></th>
            </tr>
          </thead>
          <tbody id="invoice_details">

            <tr>
              <td><input type="text" class="form-control main_products_name description"  name="description[]" required=""></td>
              <td><input type="text" class="form-control main_category perpose" name="perpose[]" required="" ></td>
              <td><input type="number" min="0" step="1" class="form-control main_quantity amount" required id="amount" name="amount[]"  ></td>
              <td><button type="button" class="btn btn-danger remove_button"><i class="icon-cross3"></i></button></td>

            </tr>
          </tbody>
          <tfoot>
              <tr>
              <th class="text-danger text-right" colspan="2">Total :</th>
              <th  class="text-danger text-center"><span class="total" id="total">00</span> <span>/=</span></th>
            </tr>
          </tfoot>

        </table>

    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            <button type="submit" name="create" class="btn btn-primary ml-31" id="submit">Submit</button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">Submiting <img src="<?php echo BASE_URL; ?>/assets/ajaxloader.gif"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
</form>
<!-- /login form -->
