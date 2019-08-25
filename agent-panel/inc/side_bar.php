<ul class="nav nav-sidebar" data-nav-type="accordion">

  <!-- Main -->
  <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
  <li class="nav-item">
    <a href="<?php echo AGETN_URL; ?>" class="nav-link<?php active_page($data, 'dashboard'); ?>">
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
      <li class="nav-item"><a href="<?php echo AGETN_URL; ?>/software-status" class="nav-link<?php active_page($data, 'software-status'); ?>">Software Status</a></li>
      <li class="nav-item"><a href="<?php echo AGETN_URL; ?>/software-language" class="nav-link<?php active_page($data, 'software-language'); ?>">Software Language</a></li>
      <li class="nav-item"><a href="<?php echo AGETN_URL; ?>/software-details" class="nav-link<?php active_page($data, 'software-details'); ?>">Software Details</a></li>
      <li class="nav-item"><a href="<?php echo AGETN_URL; ?>/software-price" class="nav-link<?php active_page($data, 'software-price'); ?>">Software Price</a></li>
    </ul>
  </li>





</ul>
