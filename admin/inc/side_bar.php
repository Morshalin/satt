<ul class="nav nav-sidebar" data-nav-type="accordion">

  <!-- Main -->
  <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
  <li class="nav-item">
    <a href="<?php echo ADMIN_URL; ?>" class="nav-link<?php active_page($data, 'dashboard'); ?>">
      <i class="icon-home4"></i>
      <span>
        Dashboard
      </span>
    </a>
  </li>




  <?php $nav_items_section_2 = ['software-status', 'software-language','software-details','software-price']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_2, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-hammer-wrench"></i> <span>Software Setup</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_2, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-status" class="nav-link<?php active_page($data, 'software-status'); ?>">Software Status</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-language" class="nav-link<?php active_page($data, 'software-language'); ?>">Software Language</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-details" class="nav-link<?php active_page($data, 'software-details'); ?>">Software Details</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-price" class="nav-link<?php active_page($data, 'software-price'); ?>">Software Price</a></li>
    </ul>
  </li>

  <?php $nav_items_section_3 = ['customer-details','customer-type', 'progressive-state','interested-services','Office_note','leav_us']; ?>

    <?php $promote_product = ['promote-product']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($promote_product, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-list"></i> <span>Promote Product</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($promote_product, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/promote-product" class="nav-link<?php active_page($data, 'promote-product'); ?>">Promote Product</a></li>
    </ul>
  </li>

  <?php $nav_items_section_3 = ['customer-details','customer-type', 'progressive-state','interested-services','business-type','Office_note','leav_us']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_3, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-user-tie"></i> <span>Customer</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_3, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/customerdetails" class="nav-link<?php active_page($data, 'customer-details'); ?>">Existing Customers</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/customertype" class="nav-link<?php active_page($data, 'customer-type'); ?>">Customer Reference</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/progressivestate" class="nav-link<?php active_page($data, 'progressive-state'); ?>">Progressive State</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/interestedservices" class="nav-link<?php active_page($data, 'interested-services'); ?>">Interested Service</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/leav_us" class="nav-link<?php active_page($data, 'leav_us'); ?>">Leave Reason</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/Office_note" class="nav-link<?php active_page($data, 'Office_note'); ?>">Office Notes</a></li>
    </ul>
  </li>






  <?php $nav_items_section_4 = ['message-with-customer', 'message-with-agent']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_3, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-envelope"></i> <span>Messaging</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_3, $data['page_index']) ? 'style="display: block;"' : ''; ?>>

      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/message-with-customer" class="nav-link<?php active_page($data, 'message-with-customer'); ?>">With Customer</a></li>

      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/message-with-agent" class="nav-link<?php active_page($data, 'message-with-agent'); ?>">With Agent</a></li>

    </ul>
  </li>





    <?php $nav_items_section_5 = ['developer']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_5, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-user-lock"></i> <span>Developer Setup</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_5, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/developer" class="nav-link<?php active_page($data, 'developer'); ?>">Developer Manage</a></li>
    </ul>
  </li>



    <?php $nav_items_section_agent = ['agent','Contact-by','Mange-agent','agent-gift']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_agent, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-users4"></i> <span>Agent</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_agent, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/agent" class="nav-link<?php active_page($data, 'Mange-agent'); ?>">Manage Agent</a></li>

      <li class="nav-item"><a href="../../agent/index.php" class="nav-link<?php active_page($data, 'agent'); ?>">Register New Agent</a></li>

      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/contact-by" class="nav-link<?php active_page($data, 'Contact-by'); ?>">Contact By</a></li>

      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/agent-gift" class="nav-link<?php active_page($data, 'agent-gift'); ?>">Add Gift</a></li>
    </ul>
  </li>

</ul>
