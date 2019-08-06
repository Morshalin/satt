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



  <?php $nav_items_section_1 = ['course', 'venue','example']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_1, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Setup</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_1, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/course" class="nav-link<?php active_page($data, 'course'); ?>">Courses</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/venue" class="nav-link<?php active_page($data, 'venue'); ?>">Venues</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/example" class="nav-link<?php active_page($data, 'example'); ?>">example</a></li>
    </ul>
  </li>



  <?php $nav_items_section_2 = ['software-status', 'software-language','software-details']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_2, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Software Setup</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_2, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-status" class="nav-link<?php active_page($data, 'software-status'); ?>">Software Status</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-language" class="nav-link<?php active_page($data, 'software-language'); ?>">Software Language</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/software-details" class="nav-link<?php active_page($data, 'software-details'); ?>">Software Details</a></li>
    </ul>
  </li>

  <?php $nav_items_section_3 = ['customer-details','customer-type', 'progressive-state','interested-services','business-type','Office_note','leav_us']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_3, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Customer</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_3, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/customerdetails" class="nav-link<?php active_page($data, 'customer-details'); ?>">Customer Information</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/customertype" class="nav-link<?php active_page($data, 'customer-type'); ?>">Customer Reference</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/progressivestate" class="nav-link<?php active_page($data, 'progressive-state'); ?>">Progressive State</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/interestedservices" class="nav-link<?php active_page($data, 'interested-services'); ?>">Interested Service</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/business-type" class="nav-link<?php active_page($data, 'business-type'); ?>">Software Category</a></li>
       <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/Office_note" class="nav-link<?php active_page($data, 'Office_note'); ?>">Office Notes</a></li>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/leav_us" class="nav-link<?php active_page($data, 'leav_us'); ?>">Leave Reason</a></li>
    </ul>
  </li>



  <?php $nav_items_section_4 = ['message']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_4, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Messages</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_4, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/message" class="nav-link<?php active_page($data, 'customer-details'); ?>">Message manager</a></li>

 </ul>
</li>


    <?php $nav_items_section_5 = ['developer']; ?>
  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_5, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Developer Setup</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_2, $data['page_index']) ? 'style="display: block;"' : ''; ?>>
      <li class="nav-item"><a href="<?php echo ADMIN_URL; ?>/developer" class="nav-link<?php active_page($data, 'developer'); ?>">Developer Manage</a></li>
    </ul>
  </li>

</ul>
