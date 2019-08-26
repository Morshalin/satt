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
    <a href="#" class="nav-link"><i class="icon-hammer-wrench"></i> <span>Our Products</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_2, $data['page_index']) ? 'style="display: block;"' : ''; ?>>

      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/available_product" class="nav-link<?php active_page($data, 'available_product'); ?>">Available Products</a></li>

      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/pending-product" class="nav-link<?php active_page($data, 'pending-product'); ?>">Pending Products</a></li>

      <li class="nav-item"><a href="<?php echo CUSTOMER_URL; ?>/confirm-product" class="nav-link<?php active_page($data, 'confirm-product'); ?>">Confirm Products</a></li>

    </ul>
  </li>



</ul>
