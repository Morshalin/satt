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




  <?php $nav_items_section_1 = ['agents-customer', 'add-agents-customer']; ?>

  <li class="nav-item nav-item-submenu<?php echo nav_item_open($nav_items_section_1, $data['page_index']) ?>">
    <a href="#" class="nav-link"><i class="icon-hammer-wrench"></i> <span>Customers</span></a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php echo nav_item_open($nav_items_section_1, $data['page_index']) ? 'style="display: block;"' : ''; ?>>

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/agents-customer" class="nav-link<?php active_page($data, 'agents-customer'); ?>">Your Customer List</a></li>

      <li class="nav-item"><a href="<?php echo AGENT_URL; ?>/add-agents-customer" class="nav-link<?php active_page($data, 'add-agents-customer'); ?>">Add New Customer</a></li>

    </ul>


  </li>
    <li class="nav-item"><a href="<?php echo BASE_URL; ?>/AGENT" class="nav-link<?php active_page($data, 'agent-registration'); ?>">Add New Agent</a></li>





</ul>
