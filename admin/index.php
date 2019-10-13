<?php
  require_once '../config/config.php';
  //ajax();
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
  $data['element'] = ['modal' => 'lg'];
  $data['page_index'] = 'dashboard';
  $data['page_css'] = [];
  $data['page_js'] =  ['assets/js/admin/dashboard'];

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
if ($result) {
  $count = mysqli_num_rows($result);
}else{
  $count = 0;
}

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
                <div><a href="<?php echo ADMIN_URL; ?>/confirm-order/" class="btn btn-light text-dark ">View Orders <i class="icon-circle-right2"></i></a></div>
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
                <div><a href="<?php echo ADMIN_URL; ?>/delivered-order/" class="btn btn-light text-dark ">View Orders <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
          </div>


      <?php 
$query = "SELECT * FROM satt_order_products WHERE status = '0' AND roll = '1' ";
$result = $db->select($query);
if ($result) {
  # code...
  $count = mysqli_num_rows($result);
}else{
  $count = 0 ;
}

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
                <div><a href="<?php echo ADMIN_URL; ?>/cancel-order/" class="btn btn-light text-dark ">View Orders <i class="icon-circle-right2"></i></a></div>
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
                <div><a href="<?php echo ADMIN_URL; ?>/pending-graphics-order/" class="btn btn-light text-dark ">View Orders <i class="icon-circle-right2"></i></a></div>
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
                <div><a href="<?php echo ADMIN_URL; ?>/pending-graphics-order/" class="btn btn-light text-dark">View Orders <i class="icon-circle-right2"></i></a></div>
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
                <div><a href="<?php echo ADMIN_URL; ?>/deliverd-graphics-order/" class="btn btn-light text-dark ">View Orders <i class="icon-circle-right2"></i></a></div>
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
                <div><a href="<?php echo ADMIN_URL; ?>/cancel-graphics/" class="btn btn-light text-dark ">View Orders <i class="icon-circle-right2"></i></a></div>
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
                     <i class="icon-user-check
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/agent/" class="btn btn-light text-dark "> View List <i class="icon-circle-right2"></i></a></div>
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
                     <i class="icon-users4
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/add_user/" class="btn btn-light text-dark ">View List <i class="icon-circle-right2"></i></a></div>
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
                     <i class="icon-collaboration
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/developer/" class="btn btn-light text-dark ">View List <i class="icon-circle-right2"></i></a></div>
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
                     <i class="icon-users2
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div><a href="<?php echo ADMIN_URL; ?>/office_stuff/" class="btn btn-light text-dark ">View List <i class="icon-circle-right2"></i></a></div>
            </div>
        </div>
      </div>


</div>
  </div>



  
  <div class="col-md-3" style="border-left: 3px solid #26A69A">
  <legend class="text-uppercase font-size-sm font-weight-bold">Notification </legend>
    <div class="row">
       <legend class="text-uppercase font-size-sm font-weight-bold text-center">All Notification</legend>
        <?php 
        $date =  date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($date .' -1 day'));
        $next_date = date('Y-m-d', strtotime($date .' +1 day'));
        
          $query = "SELECT * FROM satt_next_contacted where (status = 0) AND (next_contact = '$next_date' or next_contact='$date' or next_contact='$prev_date')";
          $notices_result = $db->select($query);
          if ($notices_result) {  
            $overflow = 'scroll';
            $height = '300px';
            $display = 'block';

          }else{
            $overflow = 'hidden';
            $height = '0px';
            $display = 'none';
          }
        ?>
       <div class="col-sm-12" style="display: <?php echo $display;?>">
        <?php 

          if ($notices_result) {
            $notification = mysqli_num_rows($notices_result);
  
        ?>
        <legend class="text-uppercase font-size-sm  text-center">Customer Existing<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"><?php echo $notification; ?></span> </legend> <?php } ?>
        <div style="height: <?php echo $height;?>; overflow: <?php echo $overflow;?>">
        <?php

          $query = "SELECT cn.id, cn.admin_id, cn.customer_id, cn.next_contact, cn.note, c.name FROM satt_next_contacted cn inner join satt_customer_informations c on cn.customer_id = c.id where (cn.status = 0) AND (cn.next_contact = '$next_date' or cn.next_contact= '$date' or cn.next_contact='$prev_date')";
          $result = $db->select($query);
          if ($result) {
          while ($notice_data = $result->fetch_assoc()) {  ?>
        <div class="card" id="tr_<?php echo $notice_data['id']; ?>">
          <div class="card-body">
            <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
              <div>
                <h6><?php echo $notice_data['name']; ?></h6>
                <span class="text-muted"><?php echo $notice_data['next_contact']; ?></span>
                <p class="text-justify"><?php echo $fm->textShorten($notice_data['note'], 70); ?>

                <a href="" id="content_managment" data-url="<?php echo ADMIN_URL; ?>/next_contacted.php?customerdetails_id=<?php echo $notice_data['id']; ?>">Show</a>


                </p>
              </div>
            </div>
          </div>
        </div>
     <?php } } ?>
     </div>
    </div>

        <?php 
        $date =  date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($date .' -1 day'));
        $next_date = date('Y-m-d', strtotime($date .' +1 day'));
        
          $query = "SELECT * FROM satt_exter_next_contacted where (status = 0) AND (next_contact = '$next_date' or next_contact='$date' or next_contact='$prev_date')";
          $notices_result = $db->select($query);
          if ($notices_result) {  
            $overflow = 'scroll';
            $height = '300px';
            $display = 'block';

          }else{
            $overflow = 'hidden';
            $height = '0px';
            $display = 'none';
          }
        ?>
       <div class="col-sm-12" style="display: <?php echo $display;?>">
        <?php 

          if ($notices_result) {
            $notification = mysqli_num_rows($notices_result);
    
        ?>
        <legend class="text-uppercase font-size-sm  text-center">Customer IntroDuced<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"><?php echo $notification; ?></span> </legend> <?php } ?>
        <div style="height: <?php echo $height;?>; overflow: <?php echo $overflow;?>">
        <?php

          $query = "SELECT cn.id, cn.admin_id, cn.customer_id, cn.next_contact, cn.note, c.name FROM satt_next_contacted cn inner join satt_customer_informations c on cn.customer_id = c.id where (cn.status = 0) AND (cn.next_contact = '$next_date' or cn.next_contact= '$date' or cn.next_contact='$prev_date')";
          $result = $db->select($query);
          if ($result) {
          while ($notice_data = $result->fetch_assoc()) {  ?>
        <div class="card" id="tr_<?php echo $notice_data['id']; ?>">
          <div class="card-body">
            <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
              <div>
                <h6><?php echo $notice_data['name']; ?></h6>
                <span class="text-muted"><?php echo $notice_data['next_contact']; ?></span>
                <p class="text-justify"><?php echo $fm->textShorten($notice_data['note'], 70); ?>

                <a href="" id="content_managment" data-url="<?php echo ADMIN_URL; ?>/next_contacted_introduce.php?customerdetails_id=<?php echo $notice_data['id']; ?>">Show</a>


                </p>
              </div>
            </div>
          </div>
        </div>
     <?php } } ?>
     </div>
    </div>

<?php 


 $query = "SELECT * FROM satt_order_products where (msg_status = 0) AND (expected_delevery_date  = '$next_date' or expected_delevery_date = '$date' or expected_delevery_date ='$prev_date')";
          $notices_result = $db->select($query);

 if ($notices_result) {
            $overflow = 'scroll';
            $height = '300px';
            $display = 'block';

          }else{
            $overflow = 'hidden';
            $height = '0px';
            $display = 'none';
          }

 ?>

       <div class="col-sm-12 mt-3" style="display: <?php echo $display; ?>">
        <?php 
          $date =  date('Y-m-d');
          $prev_date = date('Y-m-d', strtotime($date .' -1 day'));
          $next_date = date('Y-m-d', strtotime($date .' +1 day'));

         
          if ($notices_result) {
            $notification = mysqli_num_rows($notices_result);
    
        ?>
        <legend class="text-uppercase font-size-sm  text-center">Existing Software Delivery<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"><?php echo $notification; ?></span> </legend> <?php } ?>
        <div style="height: <?php echo $height; ?>; overflow: <?php echo $overflow; ?>;">
        <?php

          $query = "SELECT cn.id, cn.customer_id, cn.expected_delevery_date, cn.product_name, c.name,c.number,c.email FROM satt_order_products cn inner join satt_customer_informations c on cn.customer_id = c.id where (cn.msg_status = 0) AND (cn.expected_delevery_date = '$next_date' or cn.expected_delevery_date= '$date' or cn.expected_delevery_date='$prev_date')";
          $delever_result = $db->select($query);
          if ($delever_result) {
          while ($delever_data = $delever_result->fetch_assoc()) {  ?>
        <div class="card" id="del_<?php echo $delever_data['id']; ?>">
          <div class="card-body">
            <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
              <div>
                <h6><?php echo $delever_data['name']; ?></h6>
                <span class="text-muted"><?php echo $delever_data['expected_delevery_date']; ?></span>
                <p class="text-justify"><?php echo $delever_data['product_name']; ?></p>

                <strong>
                  <a href="" class="del_notification" id="<?php echo $delever_data['id'];?>"  data-url="<?php echo ADMIN_URL; ?>/software_notification.php?soft_avaliable_id=<?php echo $delever_data['id']; ?>">Remove</a>
                </strong>

              </div>
            </div>
          </div>
        </div>
     <?php } } ?>
     </div>
    </div>



  <?php 
    $query = "SELECT * FROM new_product_order where (msg_status = 0) AND (expected_delevery_date  = '$next_date' or expected_delevery_date = '$date' or expected_delevery_date ='$prev_date')";
          $notices_result = $db->select($query);
          if ($notices_result) {
            $overflow = 'scroll';
            $height = '300px';
            $display = 'block';

          }else{
            $overflow = 'hidden';
            $height = '0px';
            $display = 'none';
          }

  ?>
       <div class="col-sm-12 mt-3" style="display: <?php echo $display; ?>">
        <?php 
          $date =  date('Y-m-d');
          $prev_date = date('Y-m-d', strtotime($date .' -1 day'));
          $next_date = date('Y-m-d', strtotime($date .' +1 day'));

          
          if ($notices_result) {
            $notification = mysqli_num_rows($notices_result);
    
        ?>
        <legend class="text-uppercase font-size-sm  text-center"> New Software Delivery <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"><?php echo $notification; ?></span> </legend> <?php } ?>
        <div style="height: <?php echo $height; ?>; overflow: <?php echo $overflow; ?>;">
        <?php

          $new_del_query = "SELECT np.id, np.customer_id, np.expected_delevery_date, np.expected_name_software, c.name FROM new_product_order np inner join satt_customer_informations c on np.customer_id = c.id where (np.msg_status = 0) AND (np.expected_delevery_date = '$next_date' or np.expected_delevery_date= '$date' or np.expected_delevery_date='$prev_date')";
          $new_delever_result = $db->select($new_del_query);
          if ($new_delever_result) {
          while ($new_delever_data = $new_delever_result->fetch_assoc()) {  ?>
        <div class="card" id="update_<?php echo $new_delever_data['id']; ?>">
          <div class="card-body">
            <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
              <div>
                <h6><?php echo $new_delever_data['name']; ?></h6>
                <span class="text-muted"><?php echo $new_delever_data['expected_delevery_date']; ?></span>
                <p class="text-justify"><?php echo $new_delever_data['expected_name_software']; ?></p>
                <strong>
                  <a href=""  class="update_notification" id="<?php echo $new_delever_data['id'];?>"  data-url="<?php echo ADMIN_URL; ?>/software_notification.php?soft_id=<?php echo $new_delever_data['id']; ?>">Remove</a>
                </strong>
              </div>
            </div>
          </div>
        </div>
     <?php } } ?>
     </div>
    </div>




    </div>
  </div>
</div>

<!-- /content area -->
<?php include_once 'inc/footer.php'; ?>

<script type="text/javascript">

  $(document).on("click",".del_notification",function(e){
    e.preventDefault();
    if (confirm("Are You Sure To Remove Notification?")) {
    var url = $(this).data('url');
    var id = '#del_'+$(this).attr('id');
    
    $.ajax({
      url:url,
      type:'post',
      dataType:'text',
      success:function(data){
        $(id).remove();
      }
    });
    }
    
  });

  $(document).on("click",".update_notification",function(e){
    e.preventDefault();
    if (confirm("Are You Sure To Remove Notification?")) {
    var url = $(this).data('url');
    var id = '#update_'+$(this).attr('id');
    
    $.ajax({
      url:url,
      type:'post',
      dataType:'text',
      success:function(data){
        $(id).remove();
      }
    });
    }
    
    
  });
</script>
</body>
</html>
