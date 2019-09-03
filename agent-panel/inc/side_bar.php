<ul class="nav nav-sidebar" data-nav-type="accordion">

  <!-- Main -->
  <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
  <li class="nav-item">
    <a href="<?php echo AGENT_URL; ?>" class="nav-link<?php active_page($data, 'dashboard'); ?>">
      <i class="icon-home4"></i>
      <span>
        Dashboard
      </span>
    </a>
  </li>


  

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/agents-customer" class="nav-link<?php active_page($data, 'agents-customer'); ?>"><i class="icon-users4"></i> Your Customer List</a></li>

  <?php $nav_items_section_2 = ['available-products', 'available_product', 'pending_product','confirm_product']; ?>

  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_2, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-cart5"></i> <span>Exiating Software Order And Confirmation</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_2, $data['page_index']) ? 'style="display: block;"' : ''; ?>>

    

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/available_product" class="nav-link<?php active_page($data, 'available_product'); ?>">Sell Avaiable Software</a></li>
      
      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/pending_product" class="nav-link<?php active_page($data, 'pending_product'); ?>">Pending Orders</a></li>
      
      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/confirm_product" class="nav-link<?php active_page($data, 'confirm_product'); ?>">Confirmed Orders</a></li>
    </ul>
  </li>





  <?php $nav_items_section_5 = ['order-new-software', 'pending-new-software','confirm-new-software','cancel-new-order','delivered-new-order']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_5, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-cart"></i> <span>New Software Order & Confirmation</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_5, $data['page_index']) ? 'style="display: block;"' : ''; ?>>

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/order-new-software" class="nav-link<?php active_page($data, 'order-new-software'); ?>">Order New Software</a></li>

      

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/pending-new-software" class="nav-link<?php active_page($data, 'pending-new-software'); ?>">Pending Orders</a></li>

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/confirm-new-software" class="nav-link<?php active_page($data, 'confirm-new-software'); ?>">Confirmed Orders</a></li>


      
      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/delivered-new-order" class="nav-link<?php active_page($data, 'delivered-new-order'); ?>">Delivered Orders</a></li>

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/cancel-new-order" class="nav-link<?php active_page($data, 'cancel-new-order'); ?>">Cancelled Orders</a></li>

    </ul>
  </li>



  <?php $nav_items_section_3 = ['message-with-customer', 'message-with-admin']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_3, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-envelope"></i> <span>Messaging</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_3, $data['page_index']) ? 'style="display: block;"' : ''; ?>>

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/message-with-customer" class="nav-link<?php active_page($data, 'message-with-customer'); ?>">With Customer</a></li>

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/message-with-admin" class="nav-link<?php active_page($data, 'message-with-admin'); ?>">With SATT IT</a></li>

    </ul>
  </li>

    <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/your-goals" class="nav-link<?php active_page($data, 'your-goals'); ?>"> <i class="icon-link2"></i> Your Goals</a></li>


    <li class="nav-item"><a href="<?php echo BASE_URL; ?>/AGENT" class="nav-link<?php active_page($data, 'agent-registration'); ?>"><i class="icon-user"></i>Add New Agent</a></li>


</ul>
