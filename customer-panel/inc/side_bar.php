<ul class="nav nav-sidebar" data-nav-type="accordion">

  <!-- Main -->
  <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
  <li class="nav-item">
    <a href="<?php echo CUSTOMER_URL; ?>" class="nav-link<?php active_page($data, 'dashboard'); ?>">
      <i class="icon-home4"></i>
      <span>
        Dashboard
      </span>
    </a>
  </li>



  <?php $nav_items_section_2 = ['available_product', 'pending-product','confirm-product']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_2, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-cart"></i> <span>Our Products</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_2, $data['page_index']) ? 'style="display: block;"' : ''; ?>>

      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/available_product" class="nav-link<?php active_page($data, 'available_product'); ?>">Available Products</a></li>

      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/pending_product" class="nav-link<?php active_page($data, 'pending_product'); ?>">Pending Orders</a></li>

      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/confirm_product" class="nav-link<?php active_page($data, 'confirm_product'); ?>">Confirmed Orders</a></li>

    </ul>
  </li>

    <?php $nav_items_section_3 = ['available_services']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_3, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-hand"></i> <span>Our Services</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_3, $data['page_index']) ? 'style="display: block;"' : ''; ?>>

      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/available_services" class="nav-link<?php active_page($data, 'available_services'); ?>">Available Services</a></li>

    </ul>
  </li>


  <?php $nav_items_section_5 = ['message-with-agent', 'message-with-admin']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_5, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-envelope"></i> <span>Messaging</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_5, $data['page_index']) ? 'style="display: block;"' : ''; ?>>

      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/message-with-agent" class="nav-link<?php active_page($data, 'message-with-agent'); ?>">With Agent</a></li>

      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/message-with-admin" class="nav-link<?php active_page($data, 'message-with-admin'); ?>">With SATT IT</a></li>

    </ul>
  </li>



</ul>
