<?php
  require_once '../config/config.php';
  Session::checkSession('admin', ADMIN_URL);
  $goto = '';
  if (isset($_GET['goto'])) {
    $goto =  '?goto='.urlencode($_GET['goto']);
  }
  if (isset($_GET['action']) AND $_GET['action'] == 'logout') {
    Session::destroy('admin', $goto);
  }
  if (isset($_GET['action']) AND $_GET['action'] == 'lock') {
    Session::destroy('admin', BASE_URL.'/lock.php?goto='.$goto);
  }
  $data = array();
  $data['page_title'] = 'Admin Dashboard';
  $data['page_index'] = 'dashboard';
  $data['page_css'] = [];
  $data['page_js'] = [];
?>
<?php 
include_once 'inc/header.php'; ?>
<!-- /content area -->
<div class="content row">
  <div class="col-md-9">
    <legend class="text-uppercase font-size-sm font-weight-bold">Dashboard </legend>
      <div class="row ">
    <legend class="text-uppercase font-size-sm font-weight-bold text-center">Software Order Status </legend>
<?php 
$query = "SELECT * FROM satt_order_products WHERE status = '1' AND delivery_status = '0' ";
$result = $db->select($query);
$count = mysqli_num_rows($result);

$query1 = "SELECT * FROM new_product_order WHERE confirmation_status = '1' AND delivery_status = '0' AND cancel_status = '0'";
$result1 = $db->select($query1);
if ($result1) {
$count1 = mysqli_num_rows($result1);
}else{
  $count1 = 0;
}

$confirm_order = $count + $count1;

 ?>
           <div class="col-md-4">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Confirm order
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $confirm_order ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Pending Order" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-cart-add2
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/confirm-order/" class="btn btn-light text-dark ">See Confirm Orders <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
          </div>
<?php 
$query = "SELECT * FROM satt_order_products WHERE status = '1' AND delivery_status = '1' ";
$result = $db->select($query);
$count = mysqli_num_rows($result);

$query1 = "SELECT * FROM new_product_order WHERE confirmation_status = '1' AND delivery_status = '1' AND cancel_status = '0'";
$result1 = $db->select($query1);
if ($result1) {
$count1 = mysqli_num_rows($result1);
}else{
  $count1 = 0;
}

$deliver_order = $count + $count1;

 ?>
          <div class="col-md-4">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Deliver order
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $deliver_order ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Pending Order" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-database-check
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/delivered-order/" class="btn btn-light text-dark ">See Deliver Orders <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
          </div>


      <?php 
$query = "SELECT * FROM satt_order_products WHERE status = '0' AND roll = '1' ";
$result = $db->select($query);
$count = mysqli_num_rows($result);

$query1 = "SELECT * FROM new_product_order WHERE confirmation_status = '0' AND delivery_status = '0' AND cancel_status = '1'";
$result1 = $db->select($query1);
if ($result1) {
$count1 = mysqli_num_rows($result1);
}else{
  $count1 = 0;
}

$cancel_order = $count + $count1;

 ?>
          <div class="col-md-4">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Cancel order
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $cancel_order ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Pending Order" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-cancel-circle2
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/cancel-order/" class="btn btn-light text-dark ">See Cancel Orders <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
          </div>
         
    <legend class="text-uppercase font-size-sm font-weight-bold text-center">Graphics Order Status </legend>

<?php 
    $date = date('Y-m-d');
    $query = "SELECT * FROM graphics_info WHERE order_date = '$date' ";
    $result = $db->select($query);
    if ($result) {
      $count = mysqli_num_rows($result);
    }else{
      $count = 0;
    }
 ?>
          <div class="col-md-3">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Daily
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $count ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Pending Order" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-home5
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/pending-graphics-order/" class="btn btn-light text-dark ">See Orders <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
      </div>
<?php 
    $query = "SELECT * FROM graphics_info WHERE status = 'Pending' ";
    $result = $db->select($query);
    if ($result) {
      $count = mysqli_num_rows($result);
    }else{
      $count = 0;
    }
 ?>
          <div class="col-md-3">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Pending
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $count ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Pending Order" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-file-download
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/pending-graphics-order/" class="btn btn-light text-dark ">See Pending Orders <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
      </div>
<?php 
    $query = "SELECT * FROM graphics_info WHERE status = 'Delivered' ";
    $result = $db->select($query);
    if ($result) {
      $count = mysqli_num_rows($result);
    }else{
      $count = 0;
    }
 ?>
          <div class="col-md-3">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Deliver
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $count ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Deliver Order" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-database-check
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/deliverd-graphics-order/" class="btn btn-light text-dark ">See Deliver Orders <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
      </div>
<?php 
    $query = "SELECT * FROM graphics_info WHERE status = 'Cancelled' ";
    $result = $db->select($query);
    if ($result) {
      $count = mysqli_num_rows($result);
    }else{
      $count = 0;
    }
 ?>
          <div class="col-md-3">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Cancel
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $count ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Cancel Order" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-cancel-circle2
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/cancel-graphics/" class="btn btn-light text-dark ">See Cancel Orders <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
      </div>


          <legend class="text-uppercase font-size-sm font-weight-bold text-center">Office Section </legend>

<?php 
    $query = "SELECT * FROM agent_list WHERE status = 'Active' ";
    $result = $db->select($query);
    if ($result) {
      $count = mysqli_num_rows($result);
    }else{
      $count = 0;
    }
 ?>
          <div class="col-md-3">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Agent
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $count ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Active Agent" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-cancel-circle2
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/agent/" class="btn btn-light text-dark ">See Active Agent <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
      </div>

  <?php 
    $query = "SELECT * FROM users WHERE status = '1' ";
    $result = $db->select($query);
    if ($result) {
      $count = mysqli_num_rows($result);
    }else{
      $count = 0;
    }
 ?>
          <div class="col-md-3">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Users
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $count ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Ststem Users" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-cancel-circle2
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/add_user/" class="btn btn-light text-dark ">See All Users <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
      </div>
  <?php 
    $query = "SELECT * FROM developer WHERE status = '1' ";
    $result = $db->select($query);
    if ($result) {
      $count = mysqli_num_rows($result);
    }else{
      $count = 0;
    }
 ?>
          <div class="col-md-3">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-1"></i>Developer</button>
                <button type="button" class="btn btn-light" id="spinner-light-6"><?php echo $count ?></button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Total Developer" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-cancel-circle2
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/developer/" class="btn btn-light text-dark ">See All Developer <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
      </div>
<?php 
    $query = "SELECT * FROM office_stuff WHERE status = '1' ";
    $result = $db->select($query);
    if ($result) {
      $count = mysqli_num_rows($result);
    }else{
      $count = 0;
    }
 ?>
          <div class="col-md-3">
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                Stuff
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  <?php echo $count ?>
                </button>
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" title="Total Stuff" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-cancel-circle2
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/office_stuff/" class="btn btn-light text-dark ">See All Stuff <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
      </div>
</div>
  </div>
  <div class="col-md-3" style="border-left: 3px solid #26A69A">
  <legend class="text-uppercase font-size-sm font-weight-bold">Notification </legend>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas reiciendis, non quis iste dolore nesciunt accusamus delectus sint quaerat similique id debitis optio enim quam quidem hic, asperiores culpa fuga distinctio. Minima nemo doloribus distinctio, adipisci voluptatem voluptate odit dignissimos sed totam porro error nisi necessitatibus sapiente sunt praesentium placeat, repudiandae veritatis optio, vero quaerat. Voluptate totam itaque minus repellat officiis, quae omnis tempora quidem. Velit sint itaque rem saepe aspernatur soluta eum vitae ipsa incidunt iure aliquid quidem cupiditate nemo maxime recusandae adipisci cumque dicta autem placeat, neque qui, laboriosam nesciunt eos voluptate in? Quas dignissimos consectetur voluptate dolorum.
  </div>
</div>

<!-- /content area -->
<?php include_once 'inc/footer.php'; ?>
</body>
</html>
