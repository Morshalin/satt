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


  <?php $nav_items_section_3 = ['customer-details','customer-type', 'progressive-state','interested-services','Office_note','leav_us']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_3, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-user-tie"></i> <span>Customer</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_3, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/customerdetails" class="nav-link<?php active_page($data, 'customer-details'); ?>">Existing Customers</a></li>
      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/customertype" class="nav-link<?php active_page($data, 'customer-type'); ?>">Customer Reference</a></li>
      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/progressivestate" class="nav-link<?php active_page($data, 'progressive-state'); ?>">Progressive State</a></li>
      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/interestedservices" class="nav-link<?php active_page($data, 'interested-services'); ?>">Interested Service</a></li>
      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/leav_us" class="nav-link<?php active_page($data, 'leav_us'); ?>">Leave Reason</a></li>
      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/Office_note" class="nav-link<?php active_page($data, 'Office_note'); ?>">Office Notes</a></li>
    </ul>
  </li>









</ul>
