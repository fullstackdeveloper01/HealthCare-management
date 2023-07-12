<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if(isset($client)){ ?>
    <h4 class="customer-profile-group-heading"><?php echo _l('Property List'); ?></h4>
    <div class="clearfix"></div>
    <div class="mtop15">
        <table class="table dt-table scroll-responsive" data-order-col="2" data-order-type="desc">
            <thead>
                <tr>
                    <th>
                        <?php echo _l( 'Image'); ?>
                    </th>
                    <th>
                        <?php echo _l( 'Title'); ?>
                    </th>
                    <th>
                        <?php echo _l( 'Price'); ?>
                    </th>
                    <th>
                        <?php echo _l( 'Posted date'); ?>
                    </th>
                    <th>
                        <?php echo _l( 'Active date'); ?>
                    </th>
                    <th>
                        <?php echo _l( 'options'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //$propertyList = $this->db->order_by('id', 'desc')->get_where(db_prefix().'property', array('agent_id' => $client->userid))->result();
                    if($propertyList)
                    {
                        foreach($propertyList as $rrr)
                        {
                            $imgname = $this->db->get_where(db_prefix().'files', array('rel_id' => $rrr->id, 'rel_type' => "propertyimg"))->row('attachment_key');
                            ?>
                                <tr>
                                    <td>
                                        <img src="<?= site_url('download/file/taskattachment/'. $imgname); ?>" width="50px" height="50px">
                                    </td>
                                    <td>
                                        <?= $rrr->name; ?>
                                    </td>
                                    <td>
                                        <?= $rrr->price; ?>
                                    </td>
                                    <td>
                                        <?= _d($rrr->created_date); ?>
                                    </td>
                                    <td>
                                        <?= _d($rrr->active_date); ?>
                                    </td>
                                    <td>
                                        <?php
                                            $options = icon_btn('properties/editInfo/' . $rrr->id, 'pencil-square-o');
                                            echo $options .= icon_btn('properties/delete_properties/' . $rrr->id, 'remove', 'btn-danger _delete');
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
<?php } ?>