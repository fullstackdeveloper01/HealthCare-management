<div class="col-md-3">
    <ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked customer-tabs" role="tablist">
        <?php
            if($article)
            {
                ?>
                    <li class="<?= ($page == 'info')?"active":""; ?> customer_tab_profile">
                        <a data-group="property" href="<?= base_url('admin/properties/editInfo/'.$article->id); ?>">
                            <i class="fa fa-user-circle menu-icon" aria-hidden="true"></i>
                            <?= _l('Information'); ?>
                        </a>
                    </li>
                    <li class="<?= ($page == 'img')?"active":""; ?> customer_tab_statement">
                        <a data-group="images" href="<?= base_url('admin/properties/images/'.$article->id); ?>">
                            <i class="fa fa-area-chart menu-icon" aria-hidden="true"></i>
                            <?= _l('Images'); ?>
                        </a>
                    </li>
                    <li class="hide <?= ($page == 'dis')?"active":""; ?> customer_tab_invoices">
                        <a data-group="documents" href="<?= base_url('admin/properties/distances/'.$article->id); ?>">
                            <i class="fa fa-file-text menu-icon" aria-hidden="true"></i>
                            <?= _l('Distances'); ?>
                        </a>
                    </li>
                    <li class="<?= ($page == 'doc')?"active":""; ?> customer_tab_invoices">
                        <a data-group="documents" href="<?= base_url('admin/properties/documents/'.$article->id); ?>">
                            <i class="fa fa-file-text menu-icon" aria-hidden="true"></i>
                            <?= _l('Documents'); ?>
                        </a>
                    </li>
                    <li class="<?= ($page == 'appointment')?"active":""; ?> customer_tab_payments">
                        <a data-group="propertylist" href="<?= base_url('admin/properties/appointments/'.$article->id); ?>">
                            <i class="fa fa-line-chart menu-icon" aria-hidden="true"></i>
                            <?= _l('Appointment'); ?>
                        </a>
                    </li>
                <?php
            }
            else
            {
                ?>
                    <li class="active customer_tab_profile">
                        <a data-group="property" href="<?= base_url('admin/properties/property'); ?>">
                            <i class="fa fa-user-circle menu-icon" aria-hidden="true"></i>
                            <?= _l('Information'); ?>
                        </a>
                    </li>
                    <li class="customer_tab_statement">
                        <a data-group="property" href="<?= base_url('admin/properties/property'); ?>">
                            <i class="fa fa-area-chart menu-icon" aria-hidden="true"></i>
                            <?= _l('Images'); ?>
                        </a>
                    </li>
                    <li class="hide customer_tab_invoices">
                        <a data-group="property" href="<?= base_url('admin/properties/property'); ?>">
                            <i class="fa fa-file-text menu-icon" aria-hidden="true"></i>
                            <?= _l('Distances'); ?>
                        </a>
                    </li>
                    <li class="customer_tab_invoices">
                        <a data-group="property" href="<?= base_url('admin/properties/property'); ?>">
                            <i class="fa fa-file-text menu-icon" aria-hidden="true"></i>
                            <?= _l('Documents'); ?>
                        </a>
                    </li>
                    <li class="customer_tab_payments">
                        <a data-group="property" href="<?= base_url('admin/properties/property'); ?>">
                            <i class="fa fa-line-chart menu-icon" aria-hidden="true"></i>
                            <?= _l('Appointment'); ?>
                        </a>
                    </li>
                <?php
            }
        ?>
                    
    </ul>
</div>
