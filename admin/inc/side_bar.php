<ul class="nav nav-sidebar" data-nav-type="accordion">

  <!-- Main -->
  <li class="nav-item">
    <a href="<?php echo ADMIN_URL; ?>" class="nav-link<?php active_page($data, 'dashboard'); ?>">
      <i class="icon-home4"></i>
      <span>
        Dashboard
      </span>
    </a>
  </li>


<?php if (permission_check('Software_Setup')) { ?>

  <?php $nav_items_section_1 = ['software-status', 'software-language','software-details','software-price']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_1, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-hammer-wrench"></i> <span>Software Setup</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_1, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
<?php if (permission_check('Software_Status')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-status" class="nav-link<?php active_page($data, 'software-status'); ?>">Software Status</a></li>
<?php } if (permission_check('Software_Language')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-language" class="nav-link<?php active_page($data, 'software-language'); ?>">Software Language</a></li>
<?php } if (permission_check('Software_List')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-details" class="nav-link<?php active_page($data, 'software-details'); ?>">Software List</a></li>
<?php } if (permission_check('Software_Price')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-price" class="nav-link<?php active_page($data, 'software-price'); ?>">Software Price</a></li>
<?php } ?>
    </ul>
  </li>

<?php if (permission_check('System_Users')) { ?>
  <li class="nav-item">
    <a href="<?php echo ADMIN_URL; ?>/add_users" class="nav-link<?php active_page($data, 'add_users'); ?>"><i  class="icon-user-tie"></i> <span>System Users</span></a>
  </li>
  <?php } ?>

<?php } if (permission_check('Promote_Product')) { ?>

  <?php $promote_product = ['promote-product']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($promote_product, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-list"></i> <span>Promote Product</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($promote_product, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/promote-product" class="nav-link<?php active_page($data, 'promote-product'); ?>">Promote Product</a></li>
    </ul>
  </li>

<?php } if (permission_check('Existing_Software')) { ?>

    <?php $order_and_confirm = ['new_order_form_available','pending-order', 'confirm-order','cancel-order','delivered-order']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($order_and_confirm, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-cart-add2"></i> <span>Existing Software Order & Confirmation</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($order_and_confirm, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
<?php if (permission_check('Existing_Software_New_Orders')) { ?>    
    <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/new_order_form_available" class="nav-link<?php active_page($data, 'new_order_form_available'); ?>">New Orders</a></li>
<?php } if (permission_check('Existing_Software_Pending_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/pending-order" class="nav-link<?php active_page($data, 'pending-order'); ?>">Pending Orders</a></li>
<?php } if (permission_check('Existing_Software_Confirm_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/confirm-order" class="nav-link<?php active_page($data, 'confirm-order'); ?>">Confirm Orders</a></li>
<?php } if (permission_check('Existing_Software_Delivered_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/delivered-order" class="nav-link<?php active_page($data, 'delivered-order'); ?>">Delivered Orders</a></li>
<?php } if (permission_check('Existing_Software_Cancelled_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/cancel-order" class="nav-link<?php active_page($data, 'cancel-order'); ?>">Canceled Orders</a></li>
<?php } ?>
    </ul>
  </li>

<?php } if (permission_check('New_Software')) { ?>


  <?php $nav_items_section_10 = ['new_orders','order-new-software', 'pending-new-software','confirm-new-software','cancel-new-order','delivered-new-order']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_10, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-cart"></i> <span>New Software Order & Confirmation</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_10, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
<?php if (permission_check('New_Software_New_Orders')) { ?>    
       <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/new_orders" class="nav-link<?php active_page($data, 'new_orders'); ?>">New Orders</a></li>
<?php } if (permission_check('New_Software_Pending_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/pending-new-software" class="nav-link<?php active_page($data, 'pending-new-software'); ?>">Pending Orders</a></li>
<?php } if (permission_check('New_Software_Confirmd_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/confirm-new-software" class="nav-link<?php active_page($data, 'confirm-new-software'); ?>">Confirmed Orders</a></li>
<?php } if (permission_check('New_Software_Delivered_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/delivered-new-order" class="nav-link<?php active_page($data, 'delivered-new-order'); ?>">Delivered Orders</a></li>
<?php } if (permission_check('New_Software_Cancelled_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/cancel-new-order" class="nav-link<?php active_page($data, 'cancel-new-order'); ?>">Canceled Orders</a></li>
<?php } ?>
    </ul>
  </li>

<?php } if (permission_check('Graphics_Details')) { ?>

  <?php $nav_items_section_15 = ['add-graphics-order', 'unpaid-delivered-graphics','pending-graphics-order','paid-delivered-graphics', 'cancel-graphics']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_15, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-camera"></i> <span>Graphics Details</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_15, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
    
<?php if (permission_check('Graphics_Add_Order')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/add-graphics-order" class="nav-link<?php active_page($data, 'add-graphics-order'); ?>">Add New Order</a></li>
<?php } if (permission_check('Graphic_Pending_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/pending-graphics-order" class="nav-link<?php active_page($data, 'pending-graphics-order'); ?>">Pending Orders</a></li>
<?php } if (permission_check('Graphics_Unpaid_Delivered_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/unpaid-delivered-graphics" class="nav-link<?php active_page($data, 'unpaid-delivered-graphics'); ?>">Unpaid But Delivered</a></li>
<?php } if (permission_check('Graphics_Paid_Delivered_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/paid-delivered-graphics" class="nav-link<?php active_page($data, 'paid-delivered-graphics'); ?>">Paid & Delivered</a></li>
<?php } if (permission_check('Graphics_Cancelled_Orders')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/cancel-graphics" class="nav-link<?php active_page($data, 'cancel-graphics'); ?>">Cancelled Orders</a></li>
<?php } ?>
    </ul>
  </li>

<?php } if (permission_check('Customer')) { ?>

  <?php $nav_items_section_3 = ['customer-details','customer-type', 'progressive-state','interested-services','Office_note','leav_us']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_3, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-user-tie"></i> <span>Customer</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_3, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
<?php  if (permission_check('Existing_Customers')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/customerdetails" class="nav-link<?php active_page($data, 'customer-details'); ?>">Existing Customers</a></li>
<?php } if (permission_check('Customer_Types')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/customertype" class="nav-link<?php active_page($data, 'customer-type'); ?>">Customer Type</a></li>
<?php } if (permission_check('Progressive_State')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/progressivestate" class="nav-link<?php active_page($data, 'progressive-state'); ?>">Progressive State</a></li>
<?php } if (permission_check('Interested_Service')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/interestedservices" class="nav-link<?php active_page($data, 'interested-services'); ?>">Interested Service</a></li>
<?php } if (permission_check('Leave_Reason')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/leav_us" class="nav-link<?php active_page($data, 'leav_us'); ?>">Leave Reason</a></li>
<?php } if (permission_check('Introduced_Customers')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/Office_note" class="nav-link<?php active_page($data, 'Office_note'); ?>">Introduced Customers</a></li>
<?php } ?>
    </ul>
  </li>


<?php } if (permission_check('Messaging')) { ?>

  <?php $nav_items_section_4 = ['message-with-customer', 'message-with-agent']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_4, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-envelope"></i> <span>Messaging</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_4, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
<?php if (permission_check('Message_With_Customer')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/message-with-customer" class="nav-link<?php active_page($data, 'message-with-customer'); ?>">With Customer</a></li>
<?php } if (permission_check('Message_With_Agent')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/message-with-agent" class="nav-link<?php active_page($data, 'message-with-agent'); ?>">With Agent</a></li>
<?php } ?>
    </ul>
  </li>


<?php } if (permission_check('Message_Note')) { ?>




<?php $nav_items_section_2 = ['message','message-type']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_2, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-envelop4"></i> <span>Message Note</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_2, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
<?php if (permission_check('All_Message')) { ?>      
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/message" class="nav-link<?php active_page($data, 'message'); ?>">All message</a></li>
<?php } if (permission_check('Message_Type')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/message_type" class="nav-link<?php active_page($data, 'message-type'); ?>">Message type</a></li>
<?php } ?>
 </ul>
</li>

<?php } if (permission_check('Office_Stuff')) { ?>

    <?php $nav_items_section_5 = ['developer','office_stuff']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_5, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-user-lock"></i> <span>Office Stuff</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_5, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
<?php if (permission_check('Developer_List')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/developer" class="nav-link<?php active_page($data, 'developer'); ?>">Software Developer List</a></li>
  <?php } if (permission_check('Office_Stuff_List')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/office_stuff" class="nav-link<?php active_page($data, 'office_stuff'); ?>">Office Stuff List</a></li>
<?php } ?>
    </ul>
  </li>

<?php } if (permission_check('Agent')) { ?>

    <?php $nav_items_section_agent = ['agent','Contact-by','Mange-agent','agent-gift']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_agent, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-users4"></i> <span>Agent</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_agent, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
<?php } if (permission_check('Agent_List')) { ?>      
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/agent" class="nav-link<?php active_page($data, 'Mange-agent'); ?>">Agent List</a></li>
<?php } if (permission_check('Regeister_New_Agent')) { ?>
      <li class="nav-item"><a href="../../agent/index.php" class="nav-link<?php active_page($data, 'agent'); ?>">Register New Agent</a></li>
<?php } if (permission_check('Add_Gift')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/contact-by" class="nav-link<?php active_page($data, 'Contact-by'); ?>">Contact By</a></li>
<?php } if (permission_check('Contact_By')) { ?>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/agent-gift" class="nav-link<?php active_page($data, 'agent-gift'); ?>">Add Gift</a></li>
<?php } ?>
    </ul>
  </li>

<?php if (permission_check('Role')) { ?>

    <li class="nav-item">
    <a href="<?php echo ADMIN_URL; ?>/role" class="nav-link<?php active_page($data, 'role'); ?>">
      <i class="icon-accessibility2"></i>
      <span>
        Role
      </span>
    </a>
  </li>

<?php }  ?>

</ul>
