<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- <div class="panel_s section-heading section-tickets">
  <div class="panel-body">
    <h4 class="no-margin section-text"><?php echo _l('clients_tickets_heading'); ?></h4>
  </div>
</div> -->
<div class="container mt-5">
  <div class="white-box mt-5">
    <div class="clearfix">
      <div class="clearfix"><br>
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-success pull-left no-mtop tickets-summary-heading m-0">Incident List</h4>
            <!-- <a href="<?php echo site_url('clients/open_ticket'); ?>" class="btn btn-info new-ticket pull-right">
          <?php echo _l('clients_ticket_open_subject'); ?>
        </a> -->
            <div class="clearfix"></div>
            <hr />
          </div>
          
        </div>
        <div class="clearfix"></div>
        <!-- <hr /> -->
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12">
              <table class="table dt-table table-tickets custom-table-2 dt-inline dataTable" data-order-col="7" data-order-type="desc" id="DataTables_Table_0">

                <thead>

                  <tr>
                    <th width="10%" class="th-ticket-number">Ticket #</th>

                    <th class="th-ticket-subject">Employee Name</th>
                    <th class="th-ticket-subject">Client Name</th>
                    <th class="th-ticket-priority"><?php echo _l('view_date'); ?> / Time</th>
                     <th class="th-ticket-status"><?php echo _l('leads_dt_status'); ?></th>
                    <th class="th-ticket-last-reply">Last Reply</th>

                  
                </tr>
                </thead>

                <tbody>

                   <?php foreach($incidents as $incident){ ?>
                  
                    <tr class="">

                      <td data-order="<?php echo $incident->id; ?>">

                        <a href="<?php echo site_url('incident/edit/'.$incident->id); ?>">

                          # <?php echo $incident->id; ?>
                        </a>

                      </td>

                      <td>

                          <?php echo clientname($incident->userid); ?>
                       </td>
                       <td>

                           <?php echo clientname($incident->client_id); ?>
                      </td>

                      <td>

                        <?php echo date('d-m-Y h:i:s A', strtotime($incident->created_date));?>

                      </td>
  

                      <td>

                        <span class="btn btn-xs text-white" style="background:#ff2d42">

                          Open</span>

                        </td>

                        <td data-order="">

                          No Reply
                       </td>

                       
                    </tr> 

                  <?php } ?>
                </tbody>

              </table>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>