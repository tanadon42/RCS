<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="index.html">
                            <!-- <img src="assets/images/logo.png" alt="" /> --><span>Recruitment System</span></a></div>
                    <?php if($_SESSION['UsRole'] == 1){ ?>
                        <li class="label">Main</li>
                        <li><a href="<?php echo base_url(); ?>Rcs_Controller/index"><i class="ti-home"></i> Dashboard </a></li>
                        <li class="label">Form</li>
                        <li><a href="<?php echo base_url(); ?>Rcs_Form_Controller/form"><i class="ti-pencil-alt"></i> Personnel Requisition Form </a></li>
                    <?php }else if($_SESSION['UsRole'] == 2){ ?>
                        <li class="label">Main</li>
                        <li><a href="<?php echo base_url(); ?>Rcs_Controller/index"><i class="ti-home"></i> Dashboard </a></li>
                        <li class="label">Form</li>
                        <li><a href="<?php echo base_url(); ?>Rcs_Form_Controller/form"><i class="ti-pencil-alt"></i> Personnel Requisition Form </a></li>
                        <li class="label">Approve</li>
                    <li><a href="<?php echo base_url(); ?>Rcs_Approve_Controller/index"><i class="ti-file"></i> Personnel Requisition Form </a></li>
                    <?php }else if($_SESSION['UsRole'] == 3){ ?>
                        <li class="label">Main</li>
                        <li><a href="<?php echo base_url(); ?>Rcs_Controller/index"><i class="ti-home"></i> Dashboard </a></li>
                        <li class="label">Form</li>
                        <li><a href="<?php echo base_url(); ?>Rcs_Form_Controller/form"><i class="ti-pencil-alt"></i> Personnel Requisition Form </a></li>
                        <li class="label">Approve</li>
                        <li><a href="<?php echo base_url(); ?>Rcs_Approve_Controller/index"><i class="ti-file"></i> Personnel Requisition Form </a></li>
                        <li class="label">Admin</li>
                        <li><a href="<?php echo base_url(); ?>Rcs_Admin_Controller/index"><i class="ti-bar-chart"></i> Dashboard </a></li>
                        <li><a href="<?php echo base_url(); ?>Rcs_Admin_Controller/approve"><i class="ti-stamp"></i> Approve </a></li>
                    <?php } ?>
                    <li class="label">Setting</li>
                    <li><a href="<?php echo base_url(); ?>Rcs_Login_Controller/logout"><i class="ti-power-off"></i> Logout </a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->