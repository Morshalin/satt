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
</ul>
