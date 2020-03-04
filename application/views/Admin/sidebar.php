

    <div id="sidebar" class="sidebar responsive ace-save-state" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true">
        <script type="text/javascript">
            try {
                ace.settings.loadState('sidebar')
            } catch (e) {
            }
        </script>
        <ul class="nav nav-list" style="top: 0px;">
            <li class="">
                <a href="<?php echo base_url(); ?>Admin">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>
                <b class="arrow"></b>
            </li>

             <li class="">
                <a href="<?php echo base_url(); ?>Client/" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> Clients </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>Client/">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Client
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url(); ?>Client/list_client">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Client
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="Inventory" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Inventory </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>Inventory/">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Inventory
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url(); ?>Inventory/list_inventory">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Inventory
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="Inventory" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Billing </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>Billing/">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Bill
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url(); ?>Billing/list_bill">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Bill
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="Inventory" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Service Category </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>Servicecategory/">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Service Category
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url(); ?>Servicecategory/list_servicecategory">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Service Categorys
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="Inventory" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Brand </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>Brand/">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Brand
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url(); ?>Brand/list_brand">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Brand
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="Inventory" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Customer </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>Customer/">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Customer
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url(); ?>Customer/list_customer">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Customer
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="Inventory" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Partner </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>Partner/">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Partner
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url(); ?>Partner/list_partner">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Partner
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>