<?php
require_once '../../config/config.php';
ajax();
Session::checkSession('admin', ADMIN_URL . '/office-expense', 'office-expense');
if (isset($_GET['office_expense_id'])) {
    $office_expense_id = $_GET['office_expense_id'];
    $query = "SELECT * FROM office_expense WHERE id='$office_expense_id'";
    $result = $db->select($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $date = $row['date'];
        $date = date("d-M-Y", strtotime($date));
    } else {
        http_response_code(500);
        die(json_encode(['message' => 'Invoice Not Found']));
    }

} else {
    http_response_code(500);
    die(json_encode(['message' => 'UnAthorized']));
}

?>

<!-- Login form -->
   <fieldset class="mb-3" id="print_table">

        <div class="row">
        
        <div class="col-lg-12">
          <!-- <div class="col-lg-4"></div> -->
            <div class="row">
                    <b class="col-md-4">Invoice Type :</b>
                    <h6 class="col-md-8 text-right"><?php echo ucwords($row['invoice_type']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Invoice No :</b>
                    <h6 class="col-md-8 text-right"><?php echo $row['invoice_id']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Name :</b>
                    <h6 class="col-md-8 text-right"><?php echo ucwords($row['name']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Designation :</b>
                    <h6 class="col-md-8 text-right"><?php echo ucwords($row['designation']); ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Phone No :</b>
                    <h6 class="col-md-8 text-right"><?php echo $row['phone']; ?></h6>
            </div>
            <div class="row">
                    <b class="col-md-4">Date :</b>
                    <h6 class="col-md-8 text-right"><?php echo $date; ?></h6>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <hr>
    <legend class="text-uppercase text-center font-size-m font-weight-bold">Invoice History (<?php echo date('d-M-Y'); ?>)</legend>
            <div class="table-responsive">
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Description</th>
                      <th scope="col">Purpose</th>
                      <th scope="col">Amount(Tk)</th>
                    </tr>
                  </thead>
                  <tbody>
<?php 
$query1 = "SELECT * FROM office_expense_info WHERE office_expense_id='$office_expense_id'";
    $result1 = $db->select($query1);
    if ($result1) {
        $i = 0;
        while ($row1 = $result1->fetch_assoc()) { 
            $i++;
            ?>
                    <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td><?php echo ucwords($row1['description']); ?></td>
                      <td><?php echo ucwords($row1['perpose']); ?></td>
                      <td><?php echo $row1['amount']; ?></td>
                    </tr>
    <?php   } } ?>
                   <tr>
                      <th colspan="3" class="text-right" >Total Cost :</th>
                      <th colspan="1" ><?php echo $row['total']; ?> /=</th>
                    </tr>
                  
                  </tbody>
                </table>
            </div>
        </div>
    </div>

<div class="text-righ">
    
    <a class=" text-light btn-success btn" onclick="printContent('print_table')"><i class="icon-printer"></i> Print</span> </a>
</div> 

</fieldset>
<!-- /login form -->
<!-- Display the countdown timer in an element -->

<script type="text/javascript">
    
    function printContent(el){
      var a = document.body.innerHTML;
      var b = document.getElementById(el).innerHTML;
      document.body.innerHTML = b;
      window.print();
      document.body.innerHTML = a;
      
    return window.location.reload(true);

    }

  </script>

