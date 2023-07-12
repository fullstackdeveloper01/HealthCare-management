<style>
    .custom-input{width:29px;padding:9px;}
    .new-employee-form{ padding: 70px 0;}
    .card-body form .input-group-prepend .btn{height: calc(1.5em + .75rem + 0px);padding: 6px 19px;}
    ul {color: #636363;list-style:disc;margin-left:20px;font-weight: 400;}
    .mr-5{margin-right:5px;}
    .mr-2{margin-right:2px;}
    .inline-flex{display:inline-flex;}
    .mt-14{margin-top:14px;}
    .mt-15{margin-top:15px;}
    .card-header{margin-bottom:0px;}
    .card {position: relative;display: flex;flex-direction: columnmin-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0,0,0,.125);border-radius: .25rem;}
    .card-body {flex: 1 1 auto;min-height: 1px;padding: 1.25rem;}
    .table {width: 100%;margin-bottom: 1rem;color: #212529;}
    body {line-height: 24px;font-size: 14px;font-style: normal;}
    .form-check-inline {display: inline-flex;align-items: center;padding-left: 0;margin-right: .75rem;}
    label{font-weight:400;display: inline-block;}
    .input-group-addon {padding: 9px 24px 9px 14px;}
    p {font-size: 14px;font-weight: 400;line-height: 24px;color: #636363;margin-bottom: 15px;}
    ul{color: #636363;list-style: disc;margin-left: 20px;font-weight: 400;}
    .mb-5 {margin-bottom: 16px!important;}
    .inline-flex{display: inline-flex;}
    .mr-2, .mx-2 {margin-right: .5rem!important;}
    hr{margin-top:1rem;margin-bottom:1rem;}
    .btn-primary{background-color: #337ab7 !important;border-radius: 2px !important;border: 1px solid #2e6da4 !important;transition: 0.5s all ease;}
    .mr-10{margin-right:10px;}
    .table-left{float:left;width:50%;}
    .table-right{float:right;width:50%;}
    .section-B{float:none;width:100%;}
    @media print {
        .custom-input{width:29px;padding:9px;}
        .new-employee-form{padding: 10px 0!important;}
        /*table{margin-bottom:0px!important;}*/
        .banner-holder .vsat-banner-container{display:none!important;}
        .card{border:none!important;}
        .card-header{display:none;}
        .card-body{padding:0px;border:none!important;}
        .form-title th{
            background: #2480be !important;
            -webkit-print-color-adjust: economy;
            -webkit-print-color-adjust: exact;
            -webkit-print-color-adjust: inherit;
            -webkit-print-color-adjust: initial;
            -webkit-print-color-adjust: unset;
            border: 1px solid #2480be!important;
            font-weight:600;
            color:#ffffff;
        }
        .form-title h1{color:#000000!important; }
        input, textarea, select{border:none!important;}
        .input-group-addon{display:none;}
        #tawkchat-minified-box #round #tawkchat-status-text-container{display:none!important;}
        .subtitle{
            background-color: #eeeeee !important;
            -webkit-print-color-adjust: economy;
            -webkit-print-color-adjust: exact;
            -webkit-print-color-adjust: inherit;
            -webkit-print-color-adjust: initial;
            -webkit-print-color-adjust: unset;
            border: 1px solid #dee2e6!important;
            font-weight:600;
            color:#000000;
        }
        .btn-group {display:none!important;}
        iframe{display:none!important;opacity:0!important;visibility: hidden !important;}
        .logo-div{display:block!important;border:0!important;}
        /*.table td{padding:2px 20px!important;}*/
        .table input, .table textarea, .table select{padding:2px 2px!important;}
        label{margin-bottom:0px!important;}
        /*.table-responsive>.table-bordered {border: 0!important;}
        .table-bordered td{border:0!important;}*/
        select {
            border:0px!important;
            -webkit-appearance: none;
            -moz-appearance: none;
            text-indent: 1px;
            text-overflow: '';
        }
        .btn-primary{display:none!important;}
        .new-employee-form{margin-top:10px;}
        .section B{width:100%!important;float:none!important;}
        .bordered-input input{border:1px solid #eee!important;}
        .bordered-input select{border:0!important;}
        .table-left{float:none!important;width:100%!important;}
        .table-right{float:none!important;width:100%!important;}
        .table-responsive .table{table-layout:fixed!important;}
        .section-B .btn-default{background-color:#fff!important;border:0px!important;box-shadow:none!important;}
        .section-B .dropdown-toggle::after {content: none!important;}
        .table-left .btn-default{background-color:#fff!important;border:0px!important;box-shadow:none!important;}
        .table-left .dropdown-toggle::after {content: none!important;}
        .first-heading{background-color:#2480be!important;background:#2480be!important;}
        .first-heading th{background-color:#2480be!important;text-align:center!important;width:75%!important;font-weight: 600!important;color:#ffffff!important;border: 1px solid #2480be!important;font-size:18px!important;}
        .sub-heading th{background-color:#eee!important;font-size:16px!important;}

        .btn-row{display:none!important;}
    }
</style>

<div class="content-wrapper">
    <section class="new-employee-form" style="margin-top:50px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-12">
                    <div class="card card-primary">    
                        <div class="card-body">

                            <?php echo form_open_multipart('clients/editEmployeeForm/'.$employee_data->id.'/'.$employee_data->userid, array('autocomplete' => 'off')); ?>
                            <?php echo form_hidden('profile', true); ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="first-heading" style="background-color:#2480be!important;">
                                            <th colspan="12" style="text-align:center;width:75%;font-weight: 600;color:#ffffff;border: 1px solid #2480be;">New Employee Form</th>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee!important;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;background-color:#eee;">
                                                <h4>Employee Personal Details</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="8" style="vertical-align:middle;">
                                                <span>Are you referred by a Government or Private Job Agency/ Program:</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                               
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->referred_by == 'Yes') { echo 'checked'; }?>    class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->referred_by == 'No') { echo 'checked'; }?>   class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <span>If yes, program name and the agency name:</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <textarea readonly   class="form-control" row="2"><?= ($employee_data->referred_name!="null")?$employee_data->referred_name:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" style="vertical-align:middle;">
                                                <span>Do you have existing secondary employment with another company of similar nature:</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->existing_employment == 'Yes') { echo 'checked'; }?>    class="form-check-input" > Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->existing_employment == 'No') { echo 'checked'; }?>    class="form-check-input" > No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <span>If yes, company name:</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <textarea readonly  class="form-control" row="2"><?= ($employee_data->existing_company_name!="null")?$employee_data->existing_company_name:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Gender</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Male" <?php if($employee_data->pd_gender == 'Male') { echo 'checked'; }?>    class="form-check-input" > Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Female" <?php if($employee_data->pd_gender == 'Female') { echo 'checked'; }?>    class="form-check-input" > Female
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>DOB</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->pd_dob!="null")?$employee_data->pd_dob:''; ?>'  readonly  autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Surname</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->pd_surname!="null")?$employee_data->pd_surname:''; ?>' readonly class="form-control" placeholder="surname">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Home Phone</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->pd_phone!="null")?$employee_data->pd_phone:''; ?>' readonly class="form-control" placeholder="home phone">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Given Names</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->pd_name!="null")?$employee_data->pd_name:''; ?>' readonly class="form-control" placeholder="given names">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Mobile</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->pd_mobile!="null")?$employee_data->pd_mobile:''; ?>' readonly class="form-control" placeholder="mobile">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <span>Home Address</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <textarea row="5"  readonly class="form-control" placeholder="home address"><?= ($employee_data->pd_address!="null")?$employee_data->pd_address:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Suburb</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->pd_suburb!="null")?$employee_data->pd_suburb:''; ?>' readonly class="form-control" placeholder="suburb">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Postcode</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->pd_postcode!="null")?$employee_data->pd_postcode:''; ?>' readonly class="form-control" placeholder="postcode">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <span>Email Address For Pay Invoice</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <textarea row="5"  readonly class="form-control" placeholder="email address"><?= ($employee_data->pd_email!="null")?$employee_data->pd_email:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee!important;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Emergency Contact Details</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Name</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ecd_name!="null")?$employee_data->ecd_name:''; ?>' readonly class="form-control" placeholder="name">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Home Phone</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ecd_phone!="null")?$employee_data->ecd_phone:''; ?>' readonly class="form-control" placeholder="home phone">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <span>Home Address</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <textarea row="5"  readonly  class="form-control" placeholder="home address"><?= ($employee_data->ecd_address!="null")?$employee_data->ecd_address:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Mobile</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ecd_mobile!="null")?$employee_data->ecd_mobile:''; ?>' readonly class="form-control" placeholder="mobile">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Suburb</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ecd_suburb!="null")?$employee_data->ecd_suburb:''; ?>' readonly class="form-control" placeholder="suburb">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Postcode</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ecd_postcode!="null")?$employee_data->ecd_postcode:''; ?>' readonly class="form-control" placeholder="postcode">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <span>Relationship</span>
                                            </td>
                                            <td colspan="8"style="vertical-align:middle;">
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Parent" <?php if($employee_data->ecd_relationship == 'yes') { echo 'checked'; }?>    class="form-check-input" > Parent
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Sibling" <?php if($employee_data->ecd_relationship == 'Sibling') { echo 'checked'; }?>    class="form-check-input" > Sibling
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Spouse" <?php if($employee_data->ecd_relationship == 'Spouse') { echo 'checked'; }?>    class="form-check-input" > Spouse
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Child" <?php if($employee_data->ecd_relationship == 'Child') { echo 'checked'; }?>    class="form-check-input" > Child
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Friend" <?php if($employee_data->ecd_relationship == 'Friend') { echo 'checked'; }?>    class="form-check-input" > Friend
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Other" <?php if($employee_data->ecd_relationship == 'Other') { echo 'checked'; }?>    class="form-check-input" > Other
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Employee Banking Details</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Bank</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ebd_bank!="null")?$employee_data->ebd_bank:''; ?>' readonly class="form-control" placeholder="bank">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Branch</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ebd_branch!="null")?$employee_data->ebd_branch:''; ?>' readonly class="form-control" placeholder="branch">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Account Name</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ebd_account_name!="null")?$employee_data->ebd_account_name:''; ?>' readonly class="form-control" placeholder="account name">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>BSB</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;   ">
                                                <input  type="text" value='<?= ($employee_data->ebd_bsb!="null")?$employee_data->ebd_bsb:''; ?>' readonly class="form-control" placeholder="bsb">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Account No.</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ebd_account_no!="null")?$employee_data->ebd_account_no:''; ?>' readonly class="form-control" placeholder="account number">
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Employee Fitness For Work</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <span>Do you have currently or have in the past any injury or illness which may affect your ability to undertake the role you will be employed to undertake.</span>
                                                <span>This includes injury or illness which may be exacerbated by tasks involving but not limited to lifting, bending, twisting and stretching.</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label" for="radio5">
                                                        <input type="radio" disabled  value="Yes" <?php if($employee_data->efw_injury == 'Yes') { echo 'checked'; }?>    class="form-check-input"  style="vertical-align:middle;" > Yes
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label" for="radio6">
                                                        <input type="radio" disabled  value="No" <?php if($employee_data->efw_injury == 'No') { echo 'checked'; }?>    class="form-check-input"    style="vertical-align:middle;"> No
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <span>If yes, please give further details:</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <textarea readonly class="form-control" row="2"><?= ($employee_data->efw_detail!="null")?$employee_data->efw_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <span>Caring Approach reserves the right to refer an employee to a Doctor or allied health professional of their choice for an assessment if deemed required. </span>
                                                <span>I hereby declare that the information provided is true and correct. I also understand that any wilful dishonesty may render for refusal of this application or immediate termination of employment. </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Signature</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                               
                                                <?php if($employee_data->efw_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->efw_signature!="null")?$employee_data->efw_signature:''; ?>">
                                                <?php } if($employee_data->efw_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->efw_signature_base!="null")?$employee_data->efw_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <span>Date</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->efw_date!="null")?$employee_data->efw_date:''; ?>'  readonly  autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Completed By</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <strong>Status:</strong>
                                            </td>
                                            <td colspan="8" style="vertical-align:middle;">
                                                <strong>Casual</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Manager's Name</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->cb_name!="null")?$employee_data->cb_name:''; ?>' name="cb_name" required class="form-control" placeholder="Manager's Name">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Date</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input  required class="form-control" placeholder="Date" value='<?= ($employee_data->cb_date!="null")?$employee_data->cb_date:''; ?>' name="cb_date" readonly  id="cb_date"  autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Position</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  required  type="text" value='<?= ($employee_data->cb_position!="null")?$employee_data->cb_position:''; ?>' name="cb_position"   class="form-control" placeholder="Position">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Qualifications</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input   required type="text" value='<?= ($employee_data->cb_qualifications!="null")?$employee_data->cb_qualifications:''; ?>' name="cb_qualifications"  class="form-control" placeholder="Qualifications">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Pay Point</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  required  type="text" value='<?= ($employee_data->cb_pay_point!="null")?$employee_data->cb_pay_point:''; ?>' name="cb_pay_point"  class="form-control" placeholder="Pay Point">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Start Date</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input required  class="form-control" placeholder="Date" value='<?= ($employee_data->cb_start_date!="null")?$employee_data->cb_start_date:''; ?>' name="cb_start_date"  readonly id="cb_start_date"  autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee!important;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Employee Payroll Deductions Form</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5>1. Police Check Payment Via Payroll Deduction</h5>
                                                <p>"Consent to Obtain Personal Information" form must be completed and signed during Orientation. The Police Check costs $44.00 and will be deducted from your <strong>first pay.</strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5>2. Uniform Payment Via Payroll Deduction</h5>
                                                <p>This facility is available to assist employees in purchasing a uniform. The total purchase amount will be deducted over consecutive pays in equal amounts not greater than $25 per pay period commencing from your <strong>second pay</strong> until fully deducted.</p>
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Uniform Costs</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <p>Uniforms are purchased through Caring Approach and deductions are made through payroll for these purchases. The final cost and design of the uniform is to be confirmed. </p>
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Circle Uniform Required: Nursing Shift</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                Women's
                                            </td>
                                            <?php $cur_women=json_decode($employee_data->cur_women); ?>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[0]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[1]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[2]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[3]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[4]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[5]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[6]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[7]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[8]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_women[9]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                Quantity
                                            </td>
                                            <?php $cur_wquantity=json_decode($employee_data->cur_wquantity); ?>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[0]; ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[1] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[2] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[3] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[4] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[5] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[6] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[7] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[8] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_wquantity[9] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                Men's
                                            </td>
                                            <?php $cur_men=json_decode($employee_data->cur_men); ?>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_men[0] ?>' readonly placeholder="S" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_men[1] ?>' readonly placeholder="M" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_men[2] ?>' readonly placeholder="L" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_men[3] ?>' readonly placeholder="XL" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_men[4] ?>' readonly placeholder="2XL" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_men[5] ?>' readonly placeholder="3Xl" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_men[6] ?>' readonly placeholder="4XL" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_men[7] ?>' readonly placeholder="5XL" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;"></td>
                                            <td style="vertical-align:middle;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                Quantity
                                            </td>
                                            <?php $cur_mquantity=json_decode($employee_data->cur_mquantity); ?>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_mquantity[0] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_mquantity[1] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_mquantity[2] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_mquantity[3] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_mquantity[4] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_mquantity[5] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_mquantity[6] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <input  type="text" value='<?= $cur_mquantity[7] ?>' readonly placeholder="---" class="form-control">
                                            </td>
                                            <td style="vertical-align:middle;"></td>
                                            <td style="vertical-align:middle;"></td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Conditions </h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <p>All amounts relating to police check, uniform payments must be fully deducted within 3 months of commencing employment. If your employment with Caring Approach is terminated prior to the total amounts being fully deducted, the balance owing will be deducted from your final pay. No extensions or special conditions will be allowed and no interest will be charged.</p>
                                                <p>Please sign below that you have read and agree to comply with the above police check, security tag and uniform payment conditions. </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                Employee Name
                                            </td>
                                            <td style="vertical-align:middle;" colspan="4">
                                                <input  type="text" value='<?= ($employee_data->c_emp_name!="null")?$employee_data->c_emp_name:''; ?>' readonly placeholder="Employee Name" class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                Signature
                                            </td>
                                            <td style="vertical-align:middle;" colspan="4">
                                                
                                                <?php if($employee_data->c_emp_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->c_emp_signature!="null")?$employee_data->c_emp_signature:''; ?>">
                                                <?php } if($employee_data->c_emp_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->c_emp_signature_base!="null")?$employee_data->c_emp_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <!-- <tr> -->
                                        <!--     <td colspan="2" style="vertical-align:middle;">
                                                Witnessed by
                                            </td>
                                            <td style="vertical-align:middle;" colspan="4">
                                                <input  type="text" value='<?= ($employee_data->c_wit_name!="null")?$employee_data->c_wit_name:''; ?>' readonly placeholder="Witnessed By" class="form-control">
                                            </td> -->
                                            <!-- <td colspan="2" style="vertical-align:middle;">
                                                Signature
                                            </td>
                                            <td style="vertical-align:middle;" colspan="4">
                                                
                                                <?php if($employee_data->c_wit_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->c_wit_signature!="null")?$employee_data->c_wit_signature:''; ?>">
                                                <?php } if($employee_data->c_wit_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->c_wit_signature_base!="null")?$employee_data->c_wit_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;"></td>
                                            <td style="vertical-align:middle;" colspan="4"></td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                Date
                                            </td>
                                            <td style="vertical-align:middle;" colspan="4">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date" value='<?= ($employee_data->c_date!="null")?$employee_data->c_date:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Office Use Only</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;"></td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Date
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Initial
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Police Check Processed On Line
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class="date input-group p-0">
                                                    <input required  class="form-control " placeholder="Date" value='<?= ($employee_data->processed_line_date!="null")?$employee_data->processed_line_date:''; ?>' name="processed_line_date"  readonly id="processed_line_date"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  required  type="text" value='<?= ($employee_data->processed_line_initial!="null")?$employee_data->processed_line_initial:''; ?>' name="processed_line_initial" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Police Check Received
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input  required class="form-control" placeholder="Date" value='<?= ($employee_data->police_check_received_date!="null")?$employee_data->police_check_received_date:''; ?>' name="police_check_received_date"  readonly id="police_check_received_date"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input   required type="text" value='<?= ($employee_data->police_check_received_initial!="null")?$employee_data->police_check_received_initial:''; ?>' name="police_check_received_initial" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Discloseable outcomes
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input  required class="form-control" placeholder="Date" value='<?= ($employee_data->discloseable_outcomes_date!="null")?$employee_data->discloseable_outcomes_date:''; ?>' name="discloseable_outcomes_date"  readonly id="discloseable_outcomes_date"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  required  type="text" value='<?= ($employee_data->discloseable_outcomes_initial!="null")?$employee_data->discloseable_outcomes_initial:''; ?>' name="discloseable_outcomes_initial"  class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Fully deducted from payroll 
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input required  class="form-control" placeholder="Date" value='<?= ($employee_data->fully_deducted_date!="null")?$employee_data->fully_deducted_date:''; ?>' name="fully_deducted_date"  readonly id="fully_deducted_date"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  required  type="text" value='<?= ($employee_data->fully_deducted_initial!="null")?$employee_data->fully_deducted_initial:''; ?>' name="fully_deducted_initial"  class="form-control">
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Uniform Ordered 
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input required  class="form-control" placeholder="Date" value='<?= ($employee_data->uniform_ordered_date!="null")?$employee_data->uniform_ordered_date:''; ?>' name="uniform_ordered_date"  readonly id="uniform_ordered_date"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  required  type="text" value='<?= ($employee_data->uniform_ordered_initial!="null")?$employee_data->uniform_ordered_initial:''; ?>' name="uniform_ordered_initial"  class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Uniform Received 
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input required  class="form-control" placeholder="Date" value='<?= ($employee_data->cost_uniform_date!="null")?$employee_data->cost_uniform_date:''; ?>' name="cost_uniform_date"  readonly id="cost_uniform_date"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  required  type="text" value='<?= ($employee_data->cost_uniform_initial!="null")?$employee_data->cost_uniform_initial:''; ?>' name="cost_uniform_initial"  class="form-control">
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Total Cost of Uniform 
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input required  class="form-control" placeholder="Date" value='<?= ($employee_data->total_cost_uniform!="null")?$employee_data->total_cost_uniform:''; ?>' name="total_cost_uniform"  readonly id="total_cost_uniform"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  required  type="text" value='<?= ($employee_data->total_cost_uniform_initial!="null")?$employee_data->total_cost_uniform_initial:''; ?>' name="total_cost_uniform_initial"  class="form-control">
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Fully deducted from payroll 
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input  required class="form-control" placeholder="Date" value='<?= ($employee_data->fully_deducted_pay_date!="null")?$employee_data->fully_deducted_pay_date:''; ?>' name="fully_deducted_pay_date"  readonly id="fully_deducted_pay_date"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  required  type="text" value='<?= ($employee_data->fully_deducted_pay_initial!="null")?$employee_data->fully_deducted_pay_initial:''; ?>' name="fully_deducted_pay_initial"  class="form-control">
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                POLICE CHECK
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input required  class="form-control" placeholder="Date" value='<?= getDateDMYOnly($contact_data->police_start_date); ?>' name="police_start_date" id="police_start_date"  readonly autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                 WWCC/WWVP 
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input required  class="form-control" placeholder="Date" value='<?= getDateDMYOnly($contact_data->wwcc_start_date); ?>' name="wwcc_start_date"  readonly id="wwcc_start_date"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                First Aid
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input  required class="form-control" placeholder="Date" value='<?= getDateDMYOnly($contact_data->firstaid_start_date); ?>' name="firstaid_start_date"  readonly id="firstaid_start_date"   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>s     
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Employee Id Check</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5>Original Documents Worth 100 Points Must Be Provided</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="font-weight: 600;vertical-align:middle;">
                                                Name
                                            </td>
                                            <td colspan="8" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->eic_name!="null")?$employee_data->eic_name:''; ?>' readonly class="form-control" placeholder="Name">
                                            </td>
                                        </tr>

                                            <?php
                                                $employee_id = json_decode($employee_data->employee_id);
                                                 ?>
                                        <tr>
                                            <td colspan="4" style="font-weight: 600;vertical-align:middle;">
                                                Document
                                            </td>
                                            <td colspan="4" style="font-weight: 600;vertical-align:middle;">
                                                Point value
                                            </td>
                                            <td colspan="4" style="font-weight: 600;vertical-align:middle;">
                                                Supplied
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 1 — Passport (Aust or International)
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                70 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                               <input type="checkbox" disabled <?= (in_array('Passport', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 1 — Birth Certificate
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                70 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Birth Certificate', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 1 — Aust Citizenship Certificate
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                70 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Aust Citizenship Certificate', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <strong>(You can use only 1 item from section 1)</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 4 — Aust Drivers Lic
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                40 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Aust Drivers Lic', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 4 — Pension Card
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                40 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Pension Card', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 4 — Working With Children ID
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                40 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Working With Children ID', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 4 — Student ID From Tertiary Institution
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                40 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Student ID From Tertiary Institution', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <strong>(In this Section, only one piece is 40 points and additional are 25 points & must contain either a photograph or signature for comparison) </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 6 — Land Rates Notice
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Land Rates Notice', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 6 — Water Rates Notice
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Water Rates Notice', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 8 — Proof of Age Care
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Proof of Age Care', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 8 — Superannuation Statement
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Superannuation Statement', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 8 — Tax Declaration
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Tax Declaration', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 8 — Credit Card
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Credit Card', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 8 — Medicare Card
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Medicare Card', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 8 — Utility Bill/s (Gas/Electricity/Telephone) 
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points each
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Utility Bill/s', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 8 — Marriage Certificate (for Maiden name verification)
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points each
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Marriage Certificate', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 9 — Landlord/Agent for rental  
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points each
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Landlord/Agent for rental', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                Section 9 — Electoral Roll
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                25 points each
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input type="checkbox" disabled <?= (in_array('Electoral Roll', $employee_id) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <p>The information contained in this document is current as at October 2008 in accordance with the Financial Transaction Reports Act 1988. This document should only be used as a guide. It is the responsibility of the person conducting the identification check to Ensure point weight calculation is in accordance with the Act.</p>
                                                <p style="color:#000; font-weight:500;">100 point ID check completed and copies on file:</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                                Manager Signature
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <?php if($employee_data->eic_signature!=''){ ?>
                                                    <img width="100px" class="aaa" src="<?= ($employee_data->eic_signature!="null")?$employee_data->eic_signature:''; ?>">
                                                <?php } if($employee_data->eic_signature_base!=''){ ?>
                                                    <img width="100px" class="bbb" src="<?= ($employee_data->eic_signature_base!="null")?$employee_data->eic_signature_base:''; ?>">
                                                <?php } ?>

                                                <div class="signature-pad--body">
                                                    <canvas id="signature" height="130" width="550"></canvas>
                                                </div>
                                                    <input type="text" style="width:1px; height:1px; border:0px;" tabindex="-1" name="eic_signature_base" id="signatureInput">
                                                <div class="dispay-block">
                                                  <button type="button" class="btn btn-default btn-xs clear" tabindex="-1" data-action="clear"><?php echo _l('clear'); ?></button>
                                                  <button type="button" class="btn btn-default btn-xs" tabindex="-1" data-action="undo"><?php echo _l('undo'); ?></button>
                                                </div> OR
                                                <input type="file" extension="png,jpg,jpeg" accept=".png,.jpg,.jpeg"  name="eic_signature" class="form-control" id="eic_signature" placeholder="Upload" />
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                Date
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->eic_date!="null")?$employee_data->eic_date:''; ?>'  readonly name="eic_date"  id="eic_date"  autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Minimum Proof Of Identity Requirements For Police Check and WWCC I WWVP Apply I Renewal</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5 style="color:#000;font-weight:500;">ONE of the following documents will be accepted: </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Australian Birth certificate" <?php if($employee_data->mppc_document == 'Australian Birth certificate') { echo 'checked'; }?>     class="form-check-input"> Australian Birth certificate
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Australian Passport" <?php if($employee_data->mppc_document == 'Australian Passport') { echo 'checked'; }?>     class="form-check-input"> Australian Passport
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value=" Australian Visa" <?php if($employee_data->mppc_document == ' Australian Visa') { echo 'checked'; }?>     class="form-check-input"> Australian Visa 
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Citizenship certificate" <?php if($employee_data->mppc_document == 'Citizenship certificate') { echo 'checked'; }?>     class="form-check-input"> Citizenship certificate  
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                        <tr style="background-color:#eee;">
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5 style="color:#000;font-weight:500;">ONE of the following documents will be accepted: </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Australian drivers license" <?php if($employee_data->mppc_document2 == 'Australian drivers license') { echo 'checked'; }?>     class="form-check-input"> Australian drivers' license
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Overseas Passport" <?php if($employee_data->mppc_document2 == 'Overseas Passport') { echo 'checked'; }?>     class="form-check-input"> Overseas Passport
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Proof of age/Photo ID" <?php if($employee_data->mppc_document2 == 'Proof of age/Photo ID') { echo 'checked'; }?>     class="form-check-input"> Proof of age/Photo ID  
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                        
                                        <?php
                                        $mppc_document_multi = json_decode($employee_data->mppc_document_multi);
                                         ?>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <div class="form-check-inline">
                                                    <label for="checkbox10" class="form-check-label">
                                                        <input type="checkbox" disabled <?= (in_array('Centrelink or Veterans affairs', $mppc_document_multi) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> Centrelink or Veterans affairs
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label for="checkbox11" class="form-check-label">
                                                        <input type="checkbox"  disabled <?= (in_array('Medicare', $mppc_document_multi) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> Medicare
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label for="checkbox11" class="form-check-label">
                                                        <input type="checkbox" disabled <?= (in_array('TAFE, College or Uni ID', $mppc_document_multi) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> TAFE, College or Uni ID 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label for="checkbox10" class="form-check-label">
                                                        <input type="checkbox"  disabled <?= (in_array('Academic Transcript', $mppc_document_multi) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> Academic Transcript
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label for="checkbox11" class="form-check-label">
                                                        <input type="checkbox"  disabled <?= (in_array('Credit or Account Card', $mppc_document_multi) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> Credit or Account Card
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label for="checkbox11" class="form-check-label">
                                                        <input type="checkbox"  disabled <?= (in_array('Bank Statement', $mppc_document_multi) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> Bank Statement 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label for="checkbox10" class="form-check-label">
                                                        <input type="checkbox"  disabled <?= (in_array('Phone Bill / Utility bill', $mppc_document_multi) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> Phone Bill / Utility bill
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label for="checkbox11" class="form-check-label">
                                                        <input type="checkbox"  disabled <?= (in_array('Rates notes', $mppc_document_multi) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> Rates notes
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label for="checkbox11" class="form-check-label">
                                                        <input type="checkbox"  disabled <?= (in_array('Security guard or Crowd Control photo license', $mppc_document_multi) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> Security guard or Crowd Control photo license 
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="background-color:#eee;">
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5 style="color:#000;font-weight:500;">Following document will need to be provided: </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" disabled  value="Yes" <?php if($employee_data->mppc_picture_hold == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Picture of Holding one of the above picture ID.
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <p>I give the authority to Caring Approach to apply/renew Police check and VVVVCC/VVIAA/P on behalf of myself, in accordance with company policies. I also do understand that cost will be deducted from my fortnightly pay if/when required. </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align: middle;">
                                                Print Name
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->mppc_name!="null")?$employee_data->mppc_name:''; ?>' readonly class="form-control" placeholder="Print Name">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                Signature
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                               
                                                <?php if($employee_data->mppc_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->mppc_signature!="null")?$employee_data->mppc_signature:''; ?>">
                                                <?php } if($employee_data->mppc_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->mppc_signature_base!="null")?$employee_data->mppc_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                Date
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->mppc_date!="null")?$employee_data->mppc_date:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Choice Of Superannuation Fund - Standard Choice Form</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="8" style="font-weight: 600;vertical-align:middle;">
                                                <h5 style="color:#000;font-weight:500;">I request that all my future superannuation contributions be paid to </h5>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                            <!--                                                 <div class="form-check">
                                                    <label for="checkbox" class="form-check-label">
                                                        <input type="checkbox" name="checkbox" id="checkbox" value="checkbox" class="form-check-input" style="vertical-align: middle;"> HESTA — My Employer's Nominated Superannuation Fund 
                                                    </label>
                                                </div> -->
                                                <?php
                                                $superannuation_fund = json_decode($employee_data->superannuation_fund);
                                                 ?>
                                                <div class="form-check">
                                                    <label for="checkbox" class="form-check-label">
                                                        <input type="checkbox" disabled <?= (in_array('Existing HESTA Member', $superannuation_fund) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;"> Existing HESTA Member — Complete Section 1 & 4 
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label for="checkbox" class="form-check-label">
                                                        <input type="checkbox" disabled <?= (in_array('New HESTA Member', $superannuation_fund) ? 'checked' : '');?>  class="form-check-input" style="vertical-align: middle;">  New HESTA Member — complete section 4 & attached New Member Form 
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label for="checkbox" class="form-check-label">
                                                        <input  type="checkbox" disabled <?= (in_array('My Own Choice Of Superannuation Fund', $superannuation_fund) ? 'checked' : '');?> class="form-check-input" style="vertical-align: middle;"> My Own Choice Of Superannuation Fund — Complete Section 3 & 4 & Provide Documentation  
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <ul>
                                                    <li>
                                                        If you don't make a choice, your employer's super contributions will be paid into a fund chosen by your employer. Your employer is not liable for the performance of the super fund you choose or the employer fund they choose on your behalf.
                                                    </li>
                                                    <li>
                                                        Any money you have in existing funds will remain there unless you transfer it (or roll it over) to another fund. Your employer can not do this for you.
                                                    </li>
                                                    <li>
                                                        This form and all documentation must be returned within 1 week of commencing employment to ensure that all contributions are paid to your chosen fund.
                                                    </li>
                                                    <li>
                                                        The deadline for returning all documentation is 2 months from date of employment. Until all documentation is received contributions will made to your employers nominated super fund.
                                                    </li>
                                                    <li>
                                                        Your employer does not have to accept your choice of fund if you have not provided the appropriate documents. 
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5 style="font-weight: 600;">1. Existing HESTA Member</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <span>Member No</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->hesta_member_no!="null")?$employee_data->hesta_member_no:''; ?>' readonly class="form-control" placeholder="Member No">
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <span>DOB</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->hesta_dob!="null")?$employee_data->hesta_dob:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>A/c No</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->hesta_ac_no!="null")?$employee_data->hesta_ac_no:''; ?>' readonly class="form-control" placeholder="Account No">
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <span>BSB</span>
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->hesta_bsb!="null")?$employee_data->hesta_bsb:''; ?>' readonly class="form-control" placeholder="BSB">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5 style="font-weight: 600;">2. Employer Choosen Fund</h5>
                                                <p style="color:#333333;">If the employee does not choose a different super fund, super contributions will be paid to the following super fund on behalf of this employee:</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <span>Fund Name</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ecf_name!="null")?$employee_data->ecf_name:''; ?>' readonly class="form-control" placeholder="Hesta Super Fund">
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <span>Super Product No.</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ecf_pro_no!="null")?$employee_data->ecf_pro_no:''; ?>' readonly class="form-control" placeholder="HST0100AU">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Telephone</span>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ecf_telephone!="null")?$employee_data->ecf_telephone:''; ?>' readonly class="form-control" placeholder="1800 813 327">
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <span>Website</span>
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ecf_website!="null")?$employee_data->ecf_website:''; ?>' readonly class="form-control" placeholder="www.hesta.com.au">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5 style="font-weight: 600;">3. My Chosen Superannuation Fund</h5>
                                                <p style="color:#333333;">You only need to complete this section if you are choosing a fund that is different to your employer's nominated fund.</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Fund Name</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->csf_name!="null")?$employee_data->csf_name:''; ?>' readonly class="form-control" placeholder="Fund Name">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Fund ABN</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->csf_abn!="null")?$employee_data->csf_abn:''; ?>' readonly class="form-control" placeholder="Fund ABN">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Fund Address</span>
                                            </td>
                                            <td colspan="10" style="vertical-align:middle;">
                                                <textarea readonly class="form-control" rows="3" placeholder="Fund Address"><?= ($employee_data->csf_address!="null")?$employee_data->csf_address:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Phone No.</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->csf_phone!="null")?$employee_data->csf_phone:''; ?>' readonly class="form-control" placeholder="Phone No.">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Membership No.</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->csf_mem_no!="null")?$employee_data->csf_mem_no:''; ?>' readonly class="form-control" placeholder="Memebership No.">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Account No.</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->csf_ac_no!="null")?$employee_data->csf_ac_no:''; ?>' readonly class="form-control" placeholder="Account No.">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Account Name</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->csf_ac_name!="null")?$employee_data->csf_ac_name:''; ?>' readonly class="form-control" placeholder="Account Name">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>Product No.</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->csf_pro_no!="null")?$employee_data->csf_pro_no:''; ?>' readonly class="form-control" placeholder="Product No.">
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <span>BSB</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->csf_bsb!="null")?$employee_data->csf_bsb:''; ?>' readonly class="form-control" placeholder="BSB">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5 style="font-weight: 600;">Documentation Required</h5>
                                                <p style="color:#333333;">Documentation Required You must provide the following documentation within 2 months of commencing employment: </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <p>a) A letter from the trustee stating that this is a complying fund or retirement savings account (rsA) or, for a self-managed superannuation fund, a copy of documentation from the tax office confirming the fund is regulated</p>
                                                <p>b) Written evidence from the fund stating that they will accept contributions from my employer, and</p>
                                                <p>c) Details about how my employer can make contributions to this fund.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h5 style="font-weight: 600;">4) Employee Details</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <span>Name</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->ed_name!="null")?$employee_data->ed_name:''; ?>' readonly class="form-control" placeholder="Name">
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <span>Signature</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                
                                                <?php if($employee_data->ed_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->ed_signature!="null")?$employee_data->ed_signature:''; ?>">
                                                <?php } if($employee_data->ed_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->ed_signature_base!="null")?$employee_data->ed_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                <span>Date</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->ed_date!="null")?$employee_data->ed_date:''; ?>'  readonly  autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Statutory Declaration</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5 style="color:#000;font-weight:500;">Commonwealth of Australia Statutory Declarations Act 1959</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <span>Name</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <span>Address</span>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <span>Occupation</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align:middle;text-align: center;">
                                                <span>I</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input class="form-control" placeholder="Name" value='<?= ($employee_data->sd_name!="null")?$employee_data->sd_name:''; ?>'  readonly >
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;text-align: center;">
                                                <span>Of</span>
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <textarea readonly class="form-control" row="2" placeholder="Address"><?= ($employee_data->sd_address!="null")?$employee_data->sd_address:''; ?></textarea>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <input class="form-control"  value='<?= ($employee_data->sd_occupation!="null")?$employee_data->sd_occupation:''; ?>'  readonly  placeholder="Occupation">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <p>make the following declaration under the Statutory Declarations Act 1959; </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <h5>1) I declare that (place a tick or cross in applicable box)</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                                $i_declare1 = json_decode($employee_data->i_declare1);
                                                 ?>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <div class="form-check">
                                                    <label for="checkbox" class="form-check-label">
                                                        <input type="checkbox" disabled <?= (in_array('since turning 16 years of age. I have been a citizen or permanent resident of a country/countries other than Australia. (born overseas)', $i_declare1) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> since turning 16 years of age, I have been a citizen or permanent resident of a country/countries other than Australia; (born overseas) 
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label for="checkbox" class="form-check-label">
                                                        <input type="checkbox" disabled <?= (in_array('since turning 16 years of age. I have never been a citizen or permanent resident of a country/countries other than Australia. (born in Australia)', $i_declare1) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> since turning 16 years of age, I have never been a citizen or permanent resident of a country/countries other than Australia. (born in Australia)  
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <h5>2) I declare that I have never been</h5>
                                            </td>
                                        </tr>
                                            <?php
                                                $i_declare2 = json_decode($employee_data->i_declare2);
                                                 ?>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <div class="form-check">
                                                    <label for="checkbox" class="form-check-label">
                                                        <input type="checkbox" disabled <?= (in_array('convicted of murder or sexual assault', $i_declare2) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> convicted of murder or sexual assault
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label for="checkbox" class="form-check-label">
                                                        <input type="checkbox" disabled <?= (in_array('convicted of. and sentenced to imprisonment for. any other form of assault', $i_declare2) ? 'checked' : '');?>   class="form-check-input" style="vertical-align: middle;"> convicted of, and sentenced to imprisonment for, any other form of assault  
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <p>I understand that a person who intentionally makes a false statement in a statutory declaration is guilty of an offence under Section 11 of the Statutory Declarations Act 1959, and I believe that the statements in this declaration are true in every particular. </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <p>Declaration at Caring Approach</p>
                                                <p>PO Box 452, Wahroonga, NSW 2176 </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>Signature</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                
                                                <?php if($employee_data->id_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->id_signature!="null")?$employee_data->id_signature:''; ?>">
                                                <?php } if($employee_data->id_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->id_signature_base!="null")?$employee_data->id_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>Date</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->id_date!="null")?$employee_data->id_date:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <span>Witness by</span>                                           
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Name</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->id_wb_name!="null")?$employee_data->id_wb_name:''; ?>' readonly class="form-control" placeholder="Name">
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Signature</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                
                                                <?php if($employee_data->id_wb_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->id_wb_signature!="null")?$employee_data->id_wb_signature:''; ?>">
                                                <?php } if($employee_data->id_wb_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->id_wb_signature_base!="null")?$employee_data->id_wb_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Qualification</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->id_wb_qualification!="null")?$employee_data->id_wb_qualification:''; ?>' readonly class="form-control" placeholder="Qualification">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <span>Address</span>  
                                                <textarea readonly class="form-control" row="3" placeholder="Address"><?= ($employee_data->id_wb_address!="null")?$employee_data->id_wb_address:''; ?></textarea>                                         
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <p><strong>Note 1</strong> A person who intentionally makes a false statement in a statutory declaration is guilty of an offence, the punishment for which is imprisonment for a term of 4 years — see Section 11 of the Statutory Declarations Act 1959</p>
                                                <p><strong>Note 2</strong> Chapter 2 of the Criminal Code applies to all offences against the Statutory Declarations Act 1959 — see section 5A of the Statutory Declarations Act 1959</p>                                        
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Statutory Declaration</h4>
                                                <p>A saturatory declaration under the statutory Declarations Act 1959 may be made before - </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <h5>1) a person who is currently licensed or registered under a law to practise in one of the following occupations</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <ul>
                                                    <li>
                                                       <span> Chiropractor </span>
                                                    </li>
                                                    <li>
                                                        <span> Medical practitioner </span>
                                                    </li>
                                                    <li>
                                                        <span> Patent </span>
                                                    </li>
                                                    <li>
                                                        <span> Physiotherapist</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <ul>
                                                    <li>
                                                        <span> Dentist</span>
                                                    </li>
                                                    <li>
                                                        <span> Nurse</span>
                                                    </li>
                                                    <li>
                                                        <span>Pharmacist </span>
                                                    </li>
                                                    <li>
                                                        <span> Trademarks attorney</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <ul>
                                                    <li>
                                                        <span> Legal practitioner </span>
                                                    </li>
                                                    <li>
                                                        <span> Optometrist</span>
                                                    </li>
                                                    <li>
                                                        <span>Physiotherapist </span>
                                                    </li>
                                                    <li>
                                                        <span> Veterinary surgeon </span>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <h5>2) A person who is enrolled on the roll of the Supreme Court of a State or Territory, or the High Court of Australia, as a legal practitioner (however described); or</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <h5>3) A person who is in the following list:</h5>
                                                <p>Agent of the Australian Postal Corporation who is in charge of an office supplying postal services to the public Australian Consular Officer or Australian Diplomatic Officer (within the meaning of the Consular Fees Act 1955)</p>
                                                <ul>
                                                    <li>
                                                        <span> Bailiff </span>
                                                    </li>
                                                    <li>
                                                        <span> Bank officer with 5 or more continuous years of service </span>
                                                    </li>
                                                    <li>
                                                        <span> Building society officer with 5 or more years of continuous service </span>
                                                    </li>
                                                    <li>
                                                        <span> Chief executive officer of a Commonwealth court </span>
                                                    </li>
                                                    <li>
                                                        <span> Bailiff </span>
                                                    </li>
                                                    <li>
                                                        <span> Clerk of a court </span>
                                                    </li>
                                                    <li>
                                                        <span> Commissioner for Affidavits </span>
                                                    </li>
                                                    <li>
                                                        <span> Commissioner for Declarations </span>
                                                    </li>

                                                    <li>
                                                        <span> Credit union officer with 5 or more years of continuous service Employee of the Australian Trade Commission who is: </span>
                                                        <ul>
                                                            <li>
                                                                <span> (a) in a country or place outside Australia; and </span>
                                                            </li>
                                                            <li>
                                                                <span> (b) authorised under paragraph 3 (d) of the Consular Fees Act 1955; and </span>
                                                            </li>
                                                            <li>
                                                                <span> (c) exercising his or her function in that place Employee of the Commonwealth who is: </span>
                                                                <ul>
                                                                    <li>
                                                                        <span> (a) in a country or place outside Australia; and </span>
                                                                    </li>
                                                                    <li>
                                                                        <span> (b) authorised under paragraph 3 (c) of the Consular Fees Act 1955; and </span>
                                                                    </li>
                                                                    <li>
                                                                        <span> (c) exercising his or her function in that place Fellow of the National Tax Accountants' Association Finance company officer with 5 or more years of continuous service </span>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <span> Holder of a statutory office not specified in another item in this list </span>
                                                    </li>
                                                    <li>
                                                        <span> Judge of a court </span>
                                                    </li>
                                                    <li>
                                                        <span> Justice of the Peace </span>
                                                    </li>
                                                    <li>
                                                        <span> Magistrate </span>
                                                    </li>
                                                    <li>
                                                        <span> Marriage celebrant registered under Subdivision C of Division 1 of Part IV of the Marriage Act 1961 </span>
                                                    </li>
                                                    <li>
                                                        <span> Master of a court </span>
                                                    </li>
                                                    <li>
                                                        <span> Member of Chartered Secretaries Australia </span>
                                                    </li>

                                                    <li>
                                                        <span> Member of Engineers Australia, other than at the grade of student </span>
                                                    </li>
                                                    <li>
                                                        <span> Member of the Association of Taxation and Management Accountants </span>
                                                    </li>
                                                    <li>
                                                        <span> Member of the Australasian Institute of Mining and Metallurgy </span>
                                                    </li>
                                                    <li>
                                                        <span> Member of the Australian Defence Force who is </span>
                                                        <ul>
                                                            <li>
                                                                <span> (a) an officer; or </span>
                                                            </li>
                                                            <li>
                                                                <span> (b) a non-commissioned officer within the meaning of the Defence Force Discipline Act 1982 with 5 or more years of continuous service; or </span>
                                                            </li>
                                                            <li>
                                                                <span> (c) a warrant officer within the meaning of that Act </span>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <span> Member of the Institute of Chartered Accountants in Australia, the Australian Society of Certified Practising Accountants or the </span><br> 
                                                        <span> National Institute of Accountants </span><br> 
                                                        <span> Member of </span>
                                                        <ul>
                                                            <li>
                                                                <span> (a) the Parliament of the Commonwealth; or </span>
                                                            </li>
                                                            <li>
                                                                <span> (b) the Parliament of a State; or </span>
                                                            </li>
                                                            <li>
                                                                <span> (c) a Territory legislature; or </span>
                                                            </li>
                                                            <li>
                                                                <span> (d) a local government authority of a State or Territory </span>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <span> Minister of religion registered under Subdivision A of Division 1 of Part IV of the Marriage Act 1961 Notary public Permanent employee of the Australian Postal Corporation with 5 or more years of continuous service who is employed in an office supplying postal services to the public Permanent employee of </span>
                                                        <ul>
                                                            <li>
                                                                <span> (a) the Commonwealth or a Commonwealth authority; or </span>
                                                            </li>
                                                            <li>
                                                                <span> (b) a State or Territory or a State or Territory authority; or </span>
                                                            </li>
                                                            <li>
                                                                <span> (c) a local government authority; with 5 or more years of continuous service who is not specified in another item in this list </span>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <span> Person before whom a statutory declaration may be made under the law of the State or Territory in which the declaration is made </span><br> 
                                                        <span> Police </span><br> 
                                                        <span> officer Registrar, or Deputy Registrar, of a court </span> 
                                                        <span> Senior Executive Service employee of </span>
                                                        <ul>
                                                            <li>
                                                                <span> (a) the Commonwealth or a Commonwealth authority; or </span>
                                                            </li>
                                                            <li>
                                                                <span> (b) a State or Territory or a State or Territory authority Sheriff </span>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <span> Sheriffs officer </span><br> 
                                                        <span> Teacher employed on a full-time basis at a school or tertiary education institution </span> 
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Department of Immigration and Citizenship</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <h5>Authority To Obtain Details Of Work Rights Status</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <h5>Employee Details</h5>
                                                <small>(As specified in passport or other identity document) </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Family Name</span>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->dic_fname!="null")?$employee_data->dic_fname:''; ?>' readonly class="form-control" placeholder="Family Name">
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Given Name(s)</span>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->dic_gname!="null")?$employee_data->dic_gname:''; ?>' readonly class="form-control" placeholder="Given Name">
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Other Name(s)(eg maiden name)</span>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->dic_oname!="null")?$employee_data->dic_oname:''; ?>' readonly class="form-control" placeholder="Other Name">
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Date of Birth</span>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->dic_dob!="null")?$employee_data->dic_dob:''; ?>'  readonly class="form-control" placeholder="DOB">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Nationality</span>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->dic_nationality!="null")?$employee_data->dic_nationality:''; ?>' readonly class="form-control" placeholder="Nationality">
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Passport No.</span>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->dic_passport_no!="null")?$employee_data->dic_passport_no:''; ?>' readonly class="form-control" placeholder="Paasport No.">
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Visa No.</span>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->dic_visa!="null")?$employee_data->dic_visa:''; ?>' readonly class="form-control" placeholder="Visa No.">
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Visa Expiry Date</span>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->dic_visa_exp_date!="null")?$employee_data->dic_visa_exp_date:''; ?>'  readonly class="form-control" placeholder="Visa Expiry Date">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <p>I authorize the department to release the details of my work rights status (that is, my entitlement to work legally in Australia) to the employer/labour supplier named on this form. </p>
                                                <p>I understand that these details are held on departmental files and computer systems. I further understand that the employer/labour supplier will use this information for the purpose of establishing my legal entitlement to work in Australia, and for no other purpose. I also understand that I allow the release of my work rights for a period of three months from the date below. </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span>Signature</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                
                                                <?php if($employee_data->dic_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->dic_signature!="null")?$employee_data->dic_signature:''; ?>">
                                                <?php } if($employee_data->dic_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->dic_signature_base!="null")?$employee_data->dic_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span>Date</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->dic_date!="null")?$employee_data->dic_date:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <h5>Employee Details</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Business Name</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span style="background-color:#eee;padding:5px;">Caring Approach Pty Ltd</span>
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>ABN  </span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span style="background-color:#eee;padding:5px;">66166008368</span>
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Business Street Address</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span style="background-color:#eee;padding:5px;">507/90 George St , Hornsby, NSW 2077 </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Type of Business</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span style="background-color:#eee;padding:5px;">Home and Community Care</span>
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Name of Contact Person</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span style="background-color:#eee;padding:5px;">Dinushi Herath</span>
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Telephone</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span style="background-color:#eee;padding:5px;">02 8212 5659</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span>Email</span>
                                            </td>
                                            <td colspan="11" style="vertical-align: middle;">
                                                <span style="background-color:#eee;padding:5px;">admin@caringapproach.net</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <p>Note that the employee's work rights status will be sent directly to the fax number or email address given above. Please ensure that this number or email address is correct. </p><hr>
                                                <p style="color:#333;font-weight:500;">THE COMPLETED FORM SHOULD BE FAXED TO 1800 505 550</p><hr>
                                                <p>If all details match with our records, the department will endeavor to fax the employee's work right </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span style="color:#373b3e;">Business Name</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span style="color:#333;font-weight:600;">Caring Approach Pty Ltd</span>
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span style="color:#373b3e;">ABN  </span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span style="color:#333;font-weight:600;">66166008368</span>
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">
                                                <span style="color:#373b3e;">Business Street Address</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span style="color:#333;font-weight:600;">507/90 George St , Hornsby, NSW 2077 </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Staff Availability Form</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Staff Name</h5>
                                            </td>
                                            <td colspan="8" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->saf_name!="null")?$employee_data->saf_name:''; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Commitment</h5>
                                            </td>
                                            <td colspan="8" style="vertical-align: middle;">
                                                <input  type="text" value='<?= ($employee_data->saf_commitment!="null")?$employee_data->saf_commitment:''; ?>' readonly class="form-control" placeholder="Study/ Baby-sitting/ Work/ Other" disabled/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Day</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <h5>Morning</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <h5>Afternoon</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <h5>Evening</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <h5>Night</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;background-color: #eee;">
                                                <h5 style="text-align:center;">Week One</h5>
                                            </td>
                                        </tr>
                                        <?php 
                                            $saf_w1_saturday=json_decode($employee_data->saf_w1_saturday);     
                                            $saf_w1_sunday=json_decode($employee_data->saf_w1_sunday);     
                                            $saf_w1_monday=json_decode($employee_data->saf_w1_monday);     
                                            $saf_w1_tuesday=json_decode($employee_data->saf_w1_tuesday);     
                                            $saf_w1_wendesday=json_decode($employee_data->saf_w1_wendesday);     
                                            $saf_w1_thursday=json_decode($employee_data->saf_w1_thursday);     
                                            $saf_w1_friday=json_decode($employee_data->saf_w1_friday);     
                                            $saf_w2_saturday=json_decode($employee_data->saf_w2_saturday);     
                                            $saf_w2_sunday=json_decode($employee_data->saf_w2_sunday);     
                                            $saf_w2_monday=json_decode($employee_data->saf_w2_monday);     
                                            $saf_w2_tuesday=json_decode($employee_data->saf_w2_tuesday);     
                                            $saf_w2_wendesday=json_decode($employee_data->saf_w2_wendesday);     
                                            $saf_w2_thursday=json_decode($employee_data->saf_w2_thursday);     
                                            $saf_w2_friday=json_decode($employee_data->saf_w2_friday);     
                                        ?>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Saturday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_saturday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_saturday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_saturday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_saturday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Sunday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_sunday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_sunday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_sunday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_sunday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Monday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_monday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_monday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_monday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_monday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Tuesday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_tuesday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_tuesday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_tuesday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_tuesday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Wednesday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_wendesday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_wendesday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_wendesday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_wendesday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Thursday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_thursday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_thursday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_thursday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_thursday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Friday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_friday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_friday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_friday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w1_friday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;background-color: #eee;">
                                                <h5 style="text-align:center;">Week Two</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Saturday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_saturday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_saturday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_saturday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_saturday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Sunday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_sunday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_sunday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_sunday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_sunday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Monday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_monday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_monday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_monday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_monday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Tuesday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_tuesday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_tuesday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_tuesday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_tuesday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Wednesday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_wendesday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_wendesday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_wendesday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_wendesday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Thursday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_thursday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_thursday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_thursday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_thursday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <h5>Friday</h5>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_friday->morning; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_friday->afternoon; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_friday->evening; ?>' readonly class="form-control">
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <input  type="text" value='<?= $saf_w2_friday->night; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span>Staff Signature</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                
                                                <?php if($employee_data->saf_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->saf_signature!="null")?$employee_data->saf_signature:''; ?>">
                                                <?php } if($employee_data->saf_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->saf_signature_base!="null")?$employee_data->saf_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <span>Date</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->saf_date!="null")?$employee_data->saf_date:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter mb-0" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Tax File Declaration Number</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="font-weight: 500;vertical-align:middle;">
                                                <img src="<?= base_url() ?>assets/images/logo.svg" width="160" class="img-fluid">
                                            </td>
                                            <td colspan="6" style="vertical-align:middle;">
                                                <h4>Tax File Declaration Number</h4>
                                                <h5 style="font-weight: 500;color:#333;">This declaration is NOT an application for a tax file number.</h5>
                                                <p style="margin-bottom:3px;font-size:12px;line-height:10px;">Use a black or blue pen and print clearly in BLOCK LETTERS.</p>
                                                <p style="margin-bottom:3px;font-size:12px;line-height:10px;">Print X in the appropriate boxes.</p>
                                                <p style="margin-bottom:3px;font-size:12px;line-height:10px;">Read all the instructions including the privacy statement before you complete this declaration. </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group" id="taxscroll">
                                    <label>Tax File Upload</label>
                                    <input type="file" name="taxfile" id="taxfile" accept="application/pdf,application/msword" class="form-control">
                                    <span id="errorfiles"></span>
                                    <?php
                                        if (isset($employee_data->taxfile)&& $employee_data->taxfile!="") {
                                            echo '<a href="'.$employee_data->taxfile.'" target="_blank">View File</a>';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <!-- <div class="table-responsive table-left">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h4 style="color:#333;font-weight:500;font-size:16px;">Section A: To be completed by the PAYEE</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5 style="color:#333;font-weight:500;">1) What is your tax file number (TFN)? </h5>

                                                <?php $tfdn_no = str_split($employee_data->tfdn_no); ?>

                                                <div class="inline-flex mb-5 bordered-input">
                                                    <input  type="text" value='<?= $tfdn_no[0]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_no[1]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_no[2]; ?>' readonly class="form-control mr-5" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_no[3]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_no[4]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_no[5]; ?>' readonly class="form-control mr-5" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_no[6]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_no[7]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_no[8]; ?>' readonly class="form-control" maxlength="1">
                                                </div>
                                                
                                                    <div class="form-check">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_value == 'OR I have made a separate application/enquiry to the ATO for a new or existing TFN') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;">  OR I have made a separate application/enquiry to the ATO for a new or existing TFN.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->tfdn_value == 'OR I am claiming an exemption because I am under 18 years of age and do not earn enough to pay tax') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;">  OR I am claiming an exemption because I am under 18 years of age and do not earn enough to pay tax.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->tfdn_value == 'OR I am claiming an exemption because I am in receipt of a pension, benefit, or allowance') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;">  OR I am claiming an exemption because I am in receipt of a pension, benefit, or allowance.
                                                        </label>
                                                    </div>
                                                
                                                <p style="border: 1px dashed #ffffff;padding: 10px;background-color: #0d75bc;color: #fff;border-radius: 0px;margin-top: 5px;">For more information, see question 1 on page 2 of the instructions. </p>
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;">2) What is your name? </h5> 
                                                <form class="inline-flex">
                                                    <label class="mr-2">Title :</label>
                                                    <div class="form-check mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled  value="Mr" <?php if($employee_data->tfdn_title == 'Mr') { echo 'checked'; }?>    class="form-check-input" style="vertical-align: middle;"> Mr.
                                                        </label>
                                                    </div>
                                                    <div class="form-check mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled  value="Mrs" <?php if($employee_data->tfdn_title == 'Mrs') { echo 'checked'; }?>   class="form-check-input" style="vertical-align: middle;"> Mrs.
                                                        </label>
                                                    </div>
                                                    <div class="form-check mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled  value="Miss" <?php if($employee_data->tfdn_title == 'Miss') { echo 'checked'; }?>  class="form-check-input" style="vertical-align: middle;"> Miss
                                                        </label>
                                                    </div>
                                                    <div class="form-check mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled  value="Ms" <?php if($employee_data->tfdn_title == 'Ms') { echo 'checked'; }?>    class="form-check-input" style="vertical-align: middle;"> Ms
                                                        </label>
                                                    </div>
                                                
                                                <?php 
                                                    $tfdn_sname = str_split($employee_data->tfdn_sname); 
                                                    $tfdn_fname  = str_split($employee_data->tfdn_fname); 
                                                    $tfdn_oname = str_split($employee_data->tfdn_oname); 
                                                    $tfdn_cname = str_split($employee_data->tfdn_cname); 
                                                    $tfdn_address = str_split($employee_data->tfdn_address); 
                                                    // $tfdn_address = str_split($employee_data->tfdn_address); 
                                                    $tfdn_suburb = str_split($employee_data->tfdn_suburb); 
                                                    $p_abn = str_split($employee_data->p_abn); 
                                                    $p_branchno = str_split($employee_data->p_branchno); 
                                                    $p_lname = str_split($employee_data->p_lname); 
                                                    // $p_lname 2= str_split($employee_data->p_lname)2; 
                                                    // $p_lname 4= str_split($employee_data->p_lname)4; 
                                                    $p_address = str_split($employee_data->p_address); 
                                                    // $p_address 2= str_split($employee_data->p_address)2; 
                                                    $p_suburb = str_split($employee_data->p_suburb); 
                                                    $p_contact_person = str_split($employee_data->p_contact_person); 
                                                    $p_bphone_number = str_split($employee_data->p_bphone_number); 
                                                ?>
                                                <label>Surname or family name :</label>
                                                <div class="inline-flex mb-5 bordered-input">
                                                    <input  type="text" value='<?= $tfdn_sname[0]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_sname[1]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[2]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[3]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[4]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[5]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[6]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[7]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[8]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[9]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_sname[10]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[11]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[12]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[13]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[14]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[15]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[16]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[17]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[18]; ?>' readonly class="form-control custom-input  mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_sname[19]; ?>' readonly class="form-control custom-input " maxlength="1">
                                                </div>
                                                <label>First given name :</label>
                                                <div class="inline-flex mb-5 bordered-input">
                                                    <input  type="text" value='<?= $tfdn_fname[0]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_fname[1]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[2]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[3]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[4]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[5]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[6]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[7]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[8]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[9]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_fname[10]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[11]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[12]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[13]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[14]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[15]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[16]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[17]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[18]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_fname[19]; ?>' readonly class="form-control custom-input" maxlength="1">
                                                </div>
                                                <label>Other given names :</label>
                                                <div class="inline-flex mb-5 bordered-input">
                                                    <input  type="text" value='<?= $tfdn_oname[0]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_oname[1]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[2]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[3]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[4]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[5]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[6]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[7]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[8]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[9]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_oname[10]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[11]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[12]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[13]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[14]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[15]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[16]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[17]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[18]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_oname[19]; ?>' readonly class="form-control custom-input" maxlength="1">
                                                </div>
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;">3) If you have changed your name since you last dealt with the ATO, provide your previous family name.  </h5> 
                                                <div class="inline-flex mb-5 bordered-input">
                                                    <input  type="text" value='<?= $tfdn_cname[0]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_cname[1]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[2]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[3]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[4]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[5]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[6]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[7]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[8]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[9]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_cname[10]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[11]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[12]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[13]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[14]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[15]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[16]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[17]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[18]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_cname[19]; ?>' readonly class="form-control custom-input " maxlength="1">
                                                </div>
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;">4) What is your date of birth?</h5> 
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->tfdn_dob!="null")?$employee_data->tfdn_dob:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;">5) What is your home address in Australia? </h5> 
                                                <div class="inline-flex mb-5 bordered-input">
                                                    <input  type="text" value='<?= $tfdn_address[0]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_address[1]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[2]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[3]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[4]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[5]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[6]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[7]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[8]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[9]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_address[10]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[11]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[12]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[13]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[14]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[15]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[16]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[17]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[18]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[19]; ?>' readonly class="form-control custom-input" maxlength="1">
                                                </div>
                                                <div class="inline-flex mb-5 bordered-input">
                                                    <input  type="text" value='<?= $tfdn_address[20]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_address[21]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[22]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[23]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[24]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[25]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[26]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[27]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[28]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[29]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_address[30]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[31]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[32]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[33]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[34]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[35]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[36]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[37]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_address[38]; ?>' readonly class="form-control custom-input mr-2" maxlength="3">
                                                    <input  type="text" value='<?= $tfdn_address[39]; ?>' readonly class="form-control custom-input" maxlength="1">
                                                </div>
                                                <label>Suburb/town/local</label>
                                                <div class="inline-flex mb-5 bordered-input">
                                                    <input  type="text" value='<?= $tfdn_suburb[0]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_suburb[1]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[2]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[3]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[4]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[5]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[6]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[7]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[8]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[9]; ?>' readonly class="form-control custom-input mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $tfdn_suburb[10]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[11]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[12]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[13]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[14]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[15]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[16]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[17]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[18]; ?>' readonly class="form-control custom-input mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $tfdn_suburb[19]; ?>' readonly class="form-control custom-input " maxlength="1">
                                                </div>
                                                <label class="mt-14">State/territory</label>
                                                <?php $state_list =$this->db->get_where(db_prefix().'state', array('is_active' => 1))->result();  ?>
                                                <select class="form-control">
                                                    <?php
                                                    if ($state_list) {
                                                        foreach ($state_list as $rrr) {
                                                    ?>
                                                           <option <?php if($employee_data->tfdn_state == $rrr->name){ echo "selected"; } ?> ><?= $rrr->name; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label class="mt-15">Postcode</label>
                                                <input  type="text" value='<?= ($employee_data->tfdn_postcode!="null")?$employee_data->tfdn_postcode:''; ?>' readonly class="form-control" >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive table-right">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr>
                                            <td colspan="5" style="vertical-align:middle;">
                                                <h5 style="color:#333;font-weight:500;">6) On what basis are you paid? <small>(Select only one.) </small></h5> 
                                                <form class="inline-flex">
                                                    <div class="form-check mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_paid == 'Full-time employment') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Full-time employment
                                                        </label>
                                                    </div>
                                                    <div class="form-check mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_paid == 'Part-time employment') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Part-time employment
                                                        </label>
                                                    </div>
                                                    <div class="form-check mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_paid == 'Labour hire') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Labour hire
                                                        </label>
                                                    </div>
                                                    <div class="form-check mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_paid == 'Superannuation or annuity income stream') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Superannuation or annuity income stream 
                                                        </label>
                                                    </div>
                                                    <div class="form-check mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled  <?php if($employee_data->tfdn_paid == 'Casual employment') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Casual employment 
                                                        </label>
                                                    </div>
                                                
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;">7) Are you an Australian resident for tax purposes? <small>(visit ato.gov.au/residency to check) </small></h5> 
                                                <form class="inline-flex">
                                                    <div class="form-check-inline mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled value="Yes" <?php if($employee_data->tfdn_australian_resident == 'Yes') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->tfdn_australian_resident == 'No') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> No
                                                        </label>
                                                    </div>
                                                
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;">8) Do you want to claim the tax-free threshold from this payer? </h5>
                                                <p>Only claim the tax-free threshold from one payer at a time, unless your total income from all sources for the financial year will be less than the tax-free threshold. </p> 
                                                <form class="inline-flex">
                                                    <div class="form-check-inline mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_claim_tax == 'Yes') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_claim_tax == 'No') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> No
                                                        </label>
                                                    </div>
                                                
                                                <p><small>Only claim the tax-free threshold from one payer at a time, unless your total income from all sources for the financial year will be less than the tax-free threshold. </small></p>
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;">9) Do you want to claim the seniors and pensioners tax offset by reducing the amount withheld from payments made to you?</h5>
                                                <p>Withholding declaration (NAT 3093), but only if you are claiming the tax-free threshold from this payer. If you have more than one payer, see page 3 of the instructions.  </p> 
                                                <form class="inline-flex">
                                                    <div class="form-check-inline mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_pensioners_tax == 'Yes') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled <?php if($employee_data->tfdn_pensioners_tax == 'No') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> No
                                                        </label>
                                                    </div>
                                                
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;">10) Do you want to claim a zone, overseas forces or invalid and invalid carer tax offset by reducing the amount withheld from payments made to you?</h5>
                                                <p>Complete a Withholding declaration (NAT 3093).</p> 
                                                <form class="inline-flex">
                                                    <div class="form-check-inline mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_claim_zone == 'Yes') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_claim_zone == 'No') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> No
                                                        </label>
                                                    </div>
                                                
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;">11) (a) Do you have a Higher Education Loan Program (HELP), Student Start-up Loan (SSL) or Trade Support Loan (TSL) debt?</h5>
                                                <p>Your payer will withhold additional amounts to cover any compulsory repayment that may be raised on your notice of assessment.</p> 
                                                <form class="inline-flex">
                                                    <div class="form-check-inline mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_he_loan == 'Yes') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled <?php if($employee_data->tfdn_he_loan == 'No') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> No
                                                        </label>
                                                    </div>
                                                
                                                <h5 style="color:#333;font-weight:500;">(b) Do you have a Financial Supplement debt?</h5>
                                                <p>Your payer will withhold additional amounts to cover any compulsory repayment that may be raised on your notice of assessment.</p> 
                                                <form class="inline-flex">
                                                    <div class="form-check-inline mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_fnancial_supplement_debt == 'Yes') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->tfdn_fnancial_supplement_debt == 'No') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> No
                                                        </label>
                                                    </div>
                                                
                                                <hr>
                                                <h5 style="color:#333;font-weight:500;"> <b>DECLARATION</b> by payee:I declare that the information I have given is true and correct.</h5>
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->tfdn_date!="null")?$employee_data->tfdn_date:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <p style="background-color:#000;color:#fff;padding:2px;text-align: center;"><small>There are penalties for deliberately making a false or misleading statement.</small></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> -->
                            <div class="table-responsive section-B">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr>
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <p style="background-color: #000;color: #fff;padding: 2px;text-align: center;">Once section A is completed and signed, give it to your payer to complete section B.</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h4 style="color:#333;font-weight:500;font-size:16px;">Section B: To be completed by the PAYER (if you are not lodging online)</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <h5 style="color:#333;font-weight:500;">1) What is your Australian business number (ABN) withholding payer number?  </h5>
                                                <div class="inline-flex mb-5">
                                                    <input  type="text" value='<?= $p_abn[0]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_abn[1]; ?>' readonly class="form-control mr-5" maxlength="1">
                                                    <input  type="text" value='<?= $p_abn[2]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_abn[3]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_abn[4]; ?>' readonly class="form-control mr-5" maxlength="1">
                                                    <input  type="text" value='<?= $p_abn[5]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_abn[6]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_abn[7]; ?>' readonly class="form-control mr-5" maxlength="1">
                                                    <input  type="text" value='<?= $p_abn[8]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_abn[9]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_abn[10]; ?>' readonly class="form-control" maxlength="1">
                                                </div>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <h5 style="color:#333;font-weight:500;">Branch number <small> (if applicable) </small></h5>
                                                <div class="inline-flex mb-5">
                                                    <input  type="text" value='<?= $p_branchno[0]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_branchno[1]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_branchno[2]; ?>' readonly class="form-control" maxlength="1"> 
                                                </div>
                                            </td>
                                            <td colspan="8" style="vertical-align:middle;">
                                                <h5 style="color:#333;font-weight:500;">2) If you don't have an ABN or withholding payer number, have you applied for one? </h5>
                                                <form class="inline-flex">
                                                    <div class="form-check-inline mr-15">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled   <?php if($employee_data->p_isabn == 'Yes') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label for="radio" class="form-check-label">
                                                            <input type="radio" disabled  <?php if($employee_data->p_isabn == 'No') { echo 'checked'; }?>     class="form-check-input" style="vertical-align: middle;"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5 style="color:#333;font-weight:500;">3) What is your legal name or registered business name (or your individual name if not in business)? </h5>
                                                <div class="inline-flex mb-5">
                                                    <input  type="text" value='<?= $p_lname[0]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[1]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[2]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_lname[3]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[4]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[5]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[6]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[7]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[8]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[9]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[10]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_lname[11]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[12]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[13]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[14]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[15]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[16]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[17]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[18]; ?>' readonly class="form-control" maxlength="1">
                                                </div>
                                                <div class="inline-flex mb-5">
                                                    <input  type="text" value='<?= $p_lname[19]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[20]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[21]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[22]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_lname[23]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[24]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[25]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[26]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[27]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[28]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[29]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[30]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_lname[31]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[32]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[33]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[34]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[35]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[36]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[37]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                </div>
                                                <div class="inline-flex mb-5">
                                                    <input  type="text" value='<?= $p_lname[38]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[39]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[40]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[41]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[42]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_lname[43]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[44]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[45]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[46]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[47]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[48]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[49]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[50]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_lname[51]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[52]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[53]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[54]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[55]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_lname[56]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5 style="color:#333;font-weight:500;">5) What is your business address?</h5> 
                                                <div class="inline-flex mb-5">
                                                    <input  type="text" value='<?= $p_address[0]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_address[1]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[2]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[3]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[4]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[5]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[6]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[7]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[8]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[9]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_address[10]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[11]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[12]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[13]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[14]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[15]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[16]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[17]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[18]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[19]; ?>' readonly class="form-control" maxlength="1">
                                                </div>
                                                <div class="inline-flex mb-5">
                                                    <input  type="text" value='<?= $p_address[20]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_address[21]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[22]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[23]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[24]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[25]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[26]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[27]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[28]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[29]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_address[30]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[31]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[32]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[33]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[34]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[35]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[36]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[37]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[38]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_address[39]; ?>' readonly class="form-control" maxlength="1">
                                                </div>
                                                <label>Suburb/town/local</label>
                                                <div class="inline-flex mb-5">
                                                    <input  type="text" value='<?= $p_suburb[0]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_suburb[1]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[2]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[3]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[4]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[5]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[6]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[7]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[8]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[9]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                    <input  type="text" value='<?= $p_suburb[10]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[11]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[12]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[13]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[14]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[15]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[16]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[17]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[18]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_suburb[19]; ?>' readonly class="form-control" maxlength="1">
                                                </div>
                                                <label class="mt-14">State/territory</label>
                                                 <?php $state_list =$this->db->get_where(db_prefix().'state', array('is_active' => 1))->result();  ?>
                                                <select class="form-control">
                                                    <?php
                                                    if ($state_list) {
                                                        foreach ($state_list as $rrr) {
                                                    ?>
                                                           <option <?php if($employee_data->p_state == $rrr->name){ echo "selected"; } ?> ><?= $rrr->name; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label class="mt-15">Postcode</label>
                                                <input  type="text" value='<?= ($employee_data->p_postcode!="null")?$employee_data->p_postcode:''; ?>' readonly class="form-control" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="vertical-align:middle;">
                                                <h5 style="color:#333;font-weight:500;">5) Who is your contact person?</h5> 
                                                <div class="inline-flex mb-5">
                                                    <input  type="text" value='<?= $p_contact_person[0]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_contact_person[1]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_contact_person[2]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_contact_person[3]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_contact_person[4]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_contact_person[5]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_contact_person[6]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_contact_person[7]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_contact_person[8]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    <input  type="text" value='<?= $p_contact_person[9]; ?>' readonly class="form-control" maxlength="1">
                                                </div>
                                            </td>
                                            <td colspan="6" style="vertical-align:middle;">
                                                <div>
                                                    <label>Business phone number</label>
                                                    <div class="inline-flex mb-5">
                                                        <input  type="text" value='<?= $p_bphone_number[0]; ?>' readonly class="form-control mr-2" maxlength="1"> 
                                                        <input  type="text" value='<?= $p_bphone_number[1]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                        <input  type="text" value='<?= $p_bphone_number[2]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                        <input  type="text" value='<?= $p_bphone_number[3]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                        <input  type="text" value='<?= $p_bphone_number[4]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                        <input  type="text" value='<?= $p_bphone_number[5]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                        <input  type="text" value='<?= $p_bphone_number[6]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                        <input  type="text" value='<?= $p_bphone_number[7]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                        <input  type="text" value='<?= $p_bphone_number[8]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                        <input  type="text" value='<?= $p_bphone_number[9]; ?>' readonly class="form-control mr-2" maxlength="1">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <div>
                                                    <form class="inline-flex">
                                                        <div class="form-check-inline mr-15">
                                                            <label for="checkbox" class="form-check-label">
                                                                <input type="checkbox"  disabled <?= ($employee_data->p_nolonger_payee=='If you no longer make payments to this payee, print X in this box' ? 'checked' : ''); ?>   class="form-check-input" style="vertical-align: middle;"> If you no longer make payments to this payee, print X in this box.
                                                            </label>
                                                        </div>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <h5 style="color:#333;font-weight:500;"> <b>DECLARATION</b> by payee:I declare that the information I have given is true and correct.</h5>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                  
                                                <?php if($employee_data->p_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->p_signature!="null")?$employee_data->p_signature:''; ?>">
                                                <?php } if($employee_data->p_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->p_signature_base!="null")?$employee_data->p_signature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->p_data!="null")?$employee_data->p_date:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <p style="background-color: #000; color: #fff; padding: 2px; text-align: center;">There are penalties for deliberately making a false or misleading statement. </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="font-weight: 600; vertical-align: middle;">
                                                <div class="note" style="color: #333;border:1px solid #eee;padding:15px;background-color:#eee;">
                                                    <p style="line-height: 3px;color:#000;font-weight:500;">Return the completed original ATO copy to : </p>
                                                    <p style="line-height: 12px;">Australian Taxation Office</p> 
                                                    <p style="line-height: 12px;">PO Box 9004</p> 
                                                    <p style="line-height: 12px;">PENRITH NSW 2740</p>
                                                </div>
                                            </td>
                                            <td colspan="6" style="font-weight: 600; vertical-align: middle;">
                                                <div class="note" style="color: #333;border:1px solid #eee;padding:15px;background-color:#eee;">
                                                    <p style="line-height: 3px;color:#000;font-weight:500;">IMPORTANT </p>
                                                    <p style="line-height: 3px;">See next page for : </p>
                                                    <ul>
                                                        <li>payer obligations</li>
                                                        <li>Lodging online</li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600; vertical-align: middle;">
                                                <p style="background-color: #eee; color: #333; padding: 2px; text-align: center;">Sensitive (When Completed)</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Applicant Medical Report</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>1) Personal Details</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align:middle;">
                                                Surname
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->amr_sname!="null")?$employee_data->amr_sname:''; ?>' readonly class="form-control" placeholder="Surname">
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                First Name
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->amr_fname!="null")?$employee_data->amr_fname:''; ?>' readonly class="form-control" placeholder="First Name">
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                DOB
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->amr_dob!="null")?$employee_data->amr_dob:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                Telephone No.
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->amr_telephone!="null")?$employee_data->amr_telephone:''; ?>' readonly class="form-control" placeholder="Telephone No.">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <span>Address</span>
                                                <textarea readonly row="3" class="form-control" placeholder="Address"><?= ($employee_data->amr_address!="null")?$employee_data->amr_address:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align:middle;">
                                                Suburb
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->amr_subrub!="null")?$employee_data->amr_subrub:''; ?>' readonly class="form-control" placeholder="Surname">
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                Proposed Position
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->amr_position!="null")?$employee_data->amr_position:''; ?>' readonly class="form-control" placeholder="Proposed Position">
                                            </td>
                                            <td colspan="1" style="vertical-align:middle;">
                                                Proposed Employer
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input  type="text" value='<?= ($employee_data->amr_employer!="null")?$employee_data->amr_employer:''; ?>' readonly class="form-control" placeholder="Caring Approach Pty Ltd" disabled/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>2) Personal Health History </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"></td>
                                            <td colspan="4" style="vertical-align: middle;font-weight:500;color:#000;"> 
                                                Yes/ No
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;font-weight:500;color:#000;"> 
                                                If yes, give details
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Are you currently being treated for any illness or injury?
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_illness == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_illness == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_illness_detail!="null")?$employee_data->amr_illness_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Are you currently taking any medications, including inhalers?
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_medications == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_medications == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_medications_detail!="null")?$employee_data->amr_medications_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Are you allergic to anything?
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_allergic == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_allergic == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_allergic_detail!="null")?$employee_data->amr_allergic_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Apart from child birth, have you ever spent time the hospital as a patient?
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_child_birth == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_child_birth == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_child_birth_detail!="null")?$employee_data->amr_child_birth_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Have you broken or fractured any bones?
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_fractured == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_fractured == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_fractured_detail!="null")?$employee_data->amr_fractured_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Do you suffer from back, neck, or spinal injuries, including whiplash? 
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_spinal == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_spinal == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_spinal_detail!="null")?$employee_data->amr_spinal_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Do you suffer from any hearing problems (including industrial deafness)? 
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_hearing == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_hearing == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_hearing_detail!="null")?$employee_data->amr_hearing_detail:''; ?></textarea>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Do you wear prescription glasses/sunglasses? 
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_sunglasses == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_sunglasses == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_sunglasses_detail!="null")?$employee_data->amr_sunglasses_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Do you suffer from diabetes? 
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_diabetes == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_diabetes == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_diabetes_detail!="null")?$employee_data->amr_diabetes_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Do suffer from high/low blood pressure?  
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_blood_pressure == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_blood_pressure == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_blood_pressure_detail!="null")?$employee_data->amr_blood_pressure_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Do you suffer from epilepsy, fits or blackouts?   
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_blackouts == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_blackouts == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_blackouts_detail!="null")?$employee_data->amr_blackouts_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Have you, in the past 2 years, taken time off work because of a workplace injury?   
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_off_work == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_off_work == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_off_work_detail!="null")?$employee_data->amr_off_work_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Have you suffered a hernia?  
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_hernia == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_hernia == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_hernia_detail!="null")?$employee_data->amr_hernia_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Do you suffer from arthritis? Have you been exposed to any toxic substances or environmental hazards?
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_toxic == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_toxic == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_toxic_detail!="null")?$employee_data->amr_toxic_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Do you suffer of have you ever suffered from occupational overuse syndrome (e.g. Tennis Elbow)?
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_overuse_syndrome == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_overuse_syndrome == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_overuse_syndrome_detail!="null")?$employee_data->amr_overuse_syndrome_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                    Do you suffer of have you ever suffered from occupational overuse syndrome (e.g. Tennis Elbow)?
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="Yes" <?php if($employee_data->amr_ability_to_perform == 'Yes') { echo 'checked'; }?>     class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" disabled  value="No" <?php if($employee_data->amr_ability_to_perform == 'No') { echo 'checked'; }?>     class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                <textarea readonly class="form-control" row="2" placeholder="Details"><?= ($employee_data->amr_ability_to_perform_detail!="null")?$employee_data->amr_ability_to_perform_detail:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;"> 
                                                <p>Have you had or do you have any conditions (illness, injury or disability) which may impact upon your ability to perform your employment duties or which may need appropriate equipment or modifications to enable you to perform your employment duties with the employer?</p>
                                                <p>Yes / No (please circle), if yes, please specify (if applicable) any requirements / modifications / equipment;</p>
                                                <!-- amr_requirement -->
                                                <textarea readonly row="4" class="form-control" placeholder="Any requirements / Modifications / Equipment"><?= ($employee_data->amr_requirement_value!="null")?$employee_data->amr_requirement_value:''; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align: middle; text-align: center;">
                                                <span>I</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <input value='<?= ($employee_data->amr_name!="null")?$employee_data->amr_name:''; ?>'  readonly placeholder="Name" class="form-control">
                                            </td>
                                            <td colspan="8" style="vertical-align: middle; text-align: center;">
                                                (insert name), confirm that the information provided above is true and correct.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>Sign</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                               
                                                <?php if($employee_data->amr_sign!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->amr_sign!="null")?$employee_data->amr_sign:''; ?>">
                                                <?php } if($employee_data->amr_sign_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->amr_sign_base!="null")?$employee_data->amr_sign_base:''; ?>">
                                                 <?php } ?>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>Date</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->amr_date!="null")?$employee_data->amr_date:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <p style="color:#000;font-weight:500;">NB: If you provide incorrect or misleading information it could result in disciplinary action including dismissal. </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Code of Conduct</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <p>Caring Approach's Code of Conduct provides a guide to outline the behaviour and decision making of all employees within the organisation. The code explains the principles of appropriate behaviour and outlines a minimum standard of behaviour expected of all employees.</p>
                                                <p>In explaining Caring Approach's principles it will not give specific examples of incidences that employees may face. If any situation arises that an employee is unsure of, or if any confusion arises about this code, advice should be sought from your manager.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Values and client focus</h5>
                                                <p>Caring Approach's person centered and caring ethos is to ensure our customers receive the optimum client service available.</p>
                                                <ul>
                                                    <li>Our organisation seeks to understand and serve people's needs in an effective and efficient manner.</li>
                                                    <li>Clients needs should be met in a respectful culturally appropriate way.</li>
                                                    <li>Be solution focused to ensure customer satisfaction.    </li>
                                                    <li>Ensure the safety of clients and employees.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Integrity</h5>
                                                <p>Caring Approach's moral code is to operate the organisation with honesty, openness and accountability in dealing with others:</p>
                                                <ul>
                                                    <li>Our goal is to deliver on time what we say we will.</li>
                                                    <li>Act in accordance with our policies and procedures and current relevant legislation.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Performance and striving for excellence and continuous improvement </h5>
                                                <ul>
                                                    <li>Setting clear service guidelines and ensuring these are met.</li>
                                                    <li>Being accountable for our decisions and actions.</li>
                                                    <li>Being up to date with current legislation, awards, policies and procedures.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Valuing and recognising our people </h5>
                                                <ul>
                                                    <li>Encouraging workplace skills development and personal responsibility for learning.</li>
                                                    <li>Valuing everyone's unique contributions, strengths and abilities.</li> 
                                                    <li>Valuing a culturally diverse workforce reflecting the client base of the wider communities and their needs.</li> 
                                                    <li>Providing a safe place to work.</li> 
                                                    <li>Providing a workplace environment free from discrimination, harassment and bullying.</li>
                                                    <li>Providing support to our employees.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Code of conduct</h5>
                                                <p>The code applies to all employees of Caring Approach. When interacting with clients all employees and management must:</p>
                                                <ul>
                                                    <li>Identify themselves to clients and carers.</li>
                                                    <li>Act with courtesy, promptness and fairness. </li> 
                                                    <li>Respect the rights and dignity of the clients, colleagues, supervisors and management.</li>
                                                    <li>Maintain and uphold confidentiality and privacy.</li> 
                                                    <li>Manage working relationships so that professional boundaries are maintained.</li> 
                                                    <li>Not provide advice to clients where we are not qualified to do so (e.g. financial or medical).</li> 
                                                    <li>Not have a financial relationship with the client that benefits the worker (e.g. extra tasks organised without the knowledge and consent of Caring Approach's management).</li>
                                                    <li>Not enter into a relationship that may lead to a conflict of interest (e.g. be the signatory on bank accounts, or become the power of attorney etc).</li>
                                                    <li>Not manipulate clients for their own benefit.</li>
                                                    <li>Not make digital recordings of the clients without their permission.</li> 
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Duty of care and dignity of risk</h5>
                                                <p>Duty of care means that all employees have a duty (legally and ethically) to maintain and ensure a safe working environment. This is also extended to clients and colleagues. Neglect is a failure to maintain duty of care. Dignity of risk means that clients have the right to make their own decisions and act according to their own wishes. Where dignity of risk places a work health and safety risk on employees and clients, employees (in consultation with management) need to balance dignity of risk with duty of care to ensure the safety of the client and themselves.</p> 
                                                <p>If the employee considers that an accident or incident may occur, they must take all reasonable steps to prevent that accident or incident from happening.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>General Principles of the Code of Conduct</h5>
                                                <p>All employees and managers are expected to:</p>
                                                <ul>
                                                    <li>Respect individual differences and not discriminate against anyone. </li>
                                                    <li>Work cooperatively as a team member. </li>
                                                    <li>Be punctual and honor any assigned work commitments. </li>
                                                    <li>Help maintain a safe working environment. </li>
                                                    <li>Comply with all lawful and reasonable directions. </li>
                                                    <li>Not attend work under the influence of alcohol and drugs. 
                                                    <li>Be open and honest when confronted with dilemmas and seek to resolve these in consultation with management. Not act corruptly or illegally. </li>
                                                    <li>Report suspected fraud or corrupt conduct. </li>
                                                    <li>Not defame or publicly criticise other employees or management either verbally, in writing or in the social media domain. </li>
                                                    <li>Interact professionally and appropriately with clients including within the social media domain. </li>
                                                    <li>Interact professionally and appropriately with clients including within the social media domain. </li>
                                                    <li>Ensure all work claims and related expenses are accurate and honest. </li>
                                                    <li>Not manipulate work hours on time sheets. </li>
                                                    <li>Ensure that all work is signed for before completion, not in advance by the clients or staff. 
                                                    Declare any criminal charge or conviction immediately to management (including drink driving, illegal drug use or loss of license). </li>
                                                    <li>Provide a Working With Children clearance under the Commission for Children and Young People Act (1998). Employees in the A.C.T are to have a current Working With Vulnerable People card.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Definitions</h5>
                                                <p><span style="color:#333;font-weight:500;">Fraud:</span> deliberate and premeditated turn of events that involves the use of deception to gain unfair advantage.</p>
                                                <p><span style="color:#333;font-weight:500;">Defame:</span> spread reports about someone that could do them harm or cause their reputation to be injured or to shun, avoid, ridicule or openly despise another individual. </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Managers </h5>
                                                <p>Managers are required to:</p>
                                                <ul>
                                                    <li>Provide leadership, information, resources, training and policies to assist employees to provide the best quality of service possible.</li> 
                                                    <li>Ensure that employees know what their job entails and are aware of their job description.</li>  <li>Provide appropriate supervision to employees.</li> 
                                                    <li>Treat employees and others with fairness.</li> 
                                                    <li>Encourage employees to work harmoniously with each other and with their clients. </li>
                                                    <li>Actively discourage harassment and bullying.</li> 
                                                    <li>Strive to create and maintain a safe working environment.</li> 
                                                    <li>Manage performance in a collaborative manner.</li> 
                                                    <li>Practice and encourage open communication.</li> 
                                                    <li>Ensure code of conduct is understood by all employees.</li> 
                                                    <li>Protect confidentiality and privacy. </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Guide to ethical decision making</h5>
                                                <p>When making a decision these questions may be considered.</p>
                                                <ul>
                                                    <li>Is the decision or conduct lawful?</li>
                                                    <li>Is it consistent with company policies and values?</li> 
                                                    <li>What are the outcomes for clients, and other people involved?</li> 
                                                    <li>Will the decision lead to a conflict of interest?</li> 
                                                    <li>Will the decision lead to private gain?</li> 
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Conflict of interest </h5>
                                                <p>A conflict of interest is conflict between an employee's duties and responsibilities to clients and the employee's private interests. A conflict of interest can be actual, potential or perceived. It is anything that may affect the ability of an employee to carry out their duties objectively. Any Conflict of interest should be declared.</p>
                                                <p>Methods to resolve a conflict of interest include:</p>
                                                <ul>
                                                    <li>Management are to record the details.</li>
                                                    <li>Management may consider that no more action is required because the potential for conflict is minimal or can be eliminated with supervision.</li> 
                                                    <li>Request the employee to give up the personal interest.</li> 
                                                    <li>Change the employee's duties.</li> 
                                                    <li>Cease employment.</li> 
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <h5>Acceptable and unacceptable conduct </h5>
                                                <p style="color:#333;font-weight:500;">a) Bullying, harassment and discrimination</p>
                                                <p>Caring Approach expects a certain standard of behavior from all employees. The following areas need special mention to ensure all staff are clear on what is expected from them.</p>
                                                <p>All employees and managers must:</p>
                                                <ul>
                                                    <li>Treat colleagues and clients with courtesy, respect, and dignity. </li>
                                                    <li>Not bully, harass or discriminate against other employees or clients.</li> 
                                                    <li>Intervene, when safe to do so, to stop inappropriate behavior.</li> 
                                                    <li>Report situations to management. </li> 
                                                </ul>
                                                <p>Management is responsible for the prevention and elimination of bullying, harassment and discrimination in the work place. Management must: </p>
                                                <ul>
                                                    <li>Monitor the workplace and identify and remove factors that may lead to inappropriate behavior.  </li>
                                                    <li>Be alert for potential incidents and intervene as required.</li> 
                                                    <li>Take all complaints and reports seriously and work to resolve issues.</li> 
                                                    <li>Take steps to ensure that individuals are not victimised. </li> 
                                                </ul>
                                                <p style="color:#333;font-weight:500;">Bullying Definition</p>
                                                <ul>
                                                    <li>Behaviour that frightens, puts down, humiliates, or offends an individual or a group of people.</li>
                                                    <li>Can be repetitive.</li> 
                                                    <li>May cause injury or risk of injury to another.</li> 
                                                    <li>Makes the workplace unpleasant, humiliating, and intimidating.</li> 
                                                </ul>
                                                <p><span style="color:#333;font-weight:500;">Discriminate:</span> to treat someone less favourably because of their sex, race, pregnancy, disability, age, marital status, religion, sexual preference or transgender identity.</p>
                                                <p><span style="color:#333;font-weight:500;">Harassment:</span> any unwanted behaviour that offends, humiliates or intimidates a person.</p>
                                                <p style="color:#333;font-weight:500;">b) Gifts, benefits and bequests</p>
                                                <p>At times employees of the company may be offered gifts by the clients and other employees of the company. These gifts may create a conflict of interest, result in bias or preferential treatment or corrupt conduct. </p>
                                                <p>Employees should not:</p>
                                                <ul>
                                                    <li>Seek out gifts from any persons, especially clients of the company.</li>  
                                                    <li>Must not accept a gift that is intended to influence the way duties are carried out from any person.</li> 
                                                    <li>Generally employees should decline gifts, benefits or bequests (things left to them in wills.)</li> 
                                                    <li>Employees must declare all gifts of value to management. </li>
                                                    <li>Employees must not seek out bequests — this poses the risk of corrupt conduct.</li> 
                                                    <li>Employees must report to the management any actual or potential bequest.</li> 
                                                    <li>All declarations of gifts etc. should be recorded in a register.</li> 
                                                </ul>
                                                <p style="color:#333;font-weight:500;">c) Confidentiality and privacy </p>
                                                <p>Confidentiality means not disclosing any information about the clients or employees of Caring Approach unless permission has been given to do so. </p>
                                                <p>All employees are expected to:</p>
                                                <ul>
                                                    <li>Respect the confidentiality and privacy of clients and colleagues.</li>  
                                                    <li>Keep official information confidential and not use it to gain an advantage.</li> 
                                                </ul>
                                                <p>Comply with the Privacy and Personal Information Protection Act (1998) ensuring that all personal details of employees and clients are kept safe and, where necessary, secure.</p>
                                                <p style="color:#333;font-weight:500;">d) Secondary employment and private work</p>
                                                <p>While Caring Approach respects the right of the employee to be employed elsewhere at the same time as working for us, we request that management be informed of your work. We have a duty of care to ensure that your safety is not compromised by excessively long work hours and that you have had sufficient break time. We are also aware that conflicts of interest may arise in relation to the clients and we would wish to avoid this to minimize any difficulties.</p> 
                                                <p>As an employee of Caring Approach, if you engage in or have existing secondary employment with another company of a similar nature to support a Client or Participant that has changed from Caring Approach as the current or previous provider, Caring Approach may terminate your employment at its discretion if it believes there is an actual, perceived or potential conflict of interest, including circumstances where other Caring Approach clients or Participants may be encouraged by the employee to change provider resulting in loss of business for Caring Approach Pty Ltd.</p>
                                                <p style="color:#333;font-weight:500;">e) Client services provided by Caring Approach and use of systems and template</p>
                                                <p>Caring Approach works hard to maintain and ensure that Clients receive the standard of service they expect and that we continue to be the service provider of choice. </p> 
                                                <p>Staff are expected to promote Caring Approach as the preferred provider in a competitive market. If an employee is found to be promoting their own business including in a private arrangement capacity outside of Caring Approach, another alternate service provider including private arrangements or influencing the Client to move to an alternate provider including private arrangements this may result in disciplinary action or termination of employment at the discretion of the Caring Approach Management team.</p>  
                                                <p>Caring Approach has Systems and templates compliant with regulations and relevant registration bodies. The Systems and templates developed by Caring Approach remain the property of the Caring Approach and cannot be copied or utilized for any activities outside of work with Caring Approach without written authorization from a delegated authorised member of the Caring Approach Management team.</p>
                                                <p>Please refer to the Conflict of interest and private work sections of this code of conduct for more information.</p>
                                                <p style="color:#333;font-weight:500;">f) Breach of the Code of Conduct </p>
                                                <p>As an employee of the Caring Approach, you hold a position of trust and are accountable for your actions.</p> 
                                                <p>Consequences of inappropriate behavior and breaches of this Code of Conduct may have a serious impact on the services we provide to our clients and on your fellow team members. Breaches therefore may lead to disciplinary action or termination if you are found to have failed to follow reasonable direction as outlined in this code. As an employee of the Caring Approach, you are also required to report any breaches by your colleagues to ensure that we are able to continue to uphold safe and quality services to our client base. </p>  
                                                <p>Procedural fairness requires that if you are reported as having breached this code that you are informed of the allegations made against you and that you are given an opportunity to respond. </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;table-layout:fixed;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Caring Approach Pty Ltd Code of Conduct </h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="12" style="vertical-align:middle;">
                                                <p style="font-weight: 500;color:#333;">The agreement that you have received, read, and understood this Code of Conduct: </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>I (employee name)</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <input placeholder="Employee Name" value='<?= ($employee_data->cacc_name!="null")?$employee_data->cacc_name:''; ?>'  readonly class="form-control">
                                            </td>
                                            <td colspan="6" style="vertical-align: middle;"> 
                                                have read and understood Caring Approach's Code of Conduct and the NDIS Code of Conduct. 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>Employee signature</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                               
                                                <?php if($employee_data->cacc_esignature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->cacc_esignature!="null")?$employee_data->cacc_esignature:''; ?>">
                                                <?php } if($employee_data->cacc_esignature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->cacc_esignature_base!="null")?$employee_data->cacc_esignature_base:''; ?>">
                                                <?php } ?>
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>Date</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->cacc_edate!="null")?$employee_data->cacc_edate:''; ?>'  readonly  autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>Manager signature</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <!-- <?php if($employee_data->cacc_msignature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->cacc_msignature!="null")?$employee_data->cacc_msignature:''; ?>">
                                                <?php } if($employee_data->cacc_msignature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->cacc_msignature_base!="null")?$employee_data->cacc_msignature_base:''; ?>">
                                                <?php } ?> -->
                                                 <?php if($employee_data->eic_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->eic_signature!="null")?$employee_data->eic_signature:''; ?>">
                                                <?php } if($employee_data->eic_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->eic_signature_base!="null")?$employee_data->eic_signature_base:''; ?>">
                                                <?php } ?>
                                                <!-- <input placeholder="Employee Signature" class="form-control"> -->
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>Date</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->cacc_mdate!="null")?$employee_data->cacc_mdate:''; ?>'  readonly name="cacc_mdate"  id="cacc_mdate"  autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;table-layout:fixed;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Infection control and exposure to Covid-19 (Coronavirus) or other transmittable virus / Illness acknowledgement statement August 2020</h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>I</span>
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <input placeholder="Name" value='<?= ($employee_data->icec_name!="null")?$employee_data->icec_name:''; ?>'  readonly  class="form-control">
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;"> 
                                                Employed By Caribg Approach As A  
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <input placeholder="Employee Name" value='<?= ($employee_data->icec_caribg!="null")?$employee_data->icec_caribg:''; ?>'  readonly   class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <p>acknowledge the risk to the vulnerable people Caring Approach Pty Ltd supports and risk to fellow colleagues in relation to the spread and transmission of Coronavirus and/or other virus's including influenza that can affect the operations of Caring Approach, the staff and people who we have been engaged to support.</p>
                                                <p>I agree to follow all Caring Approach and Government policies and strategies related to managing the spread of the Corona Virus and/or other virus's or illnesses including but not limited to;</p>
                                                <ul>
                                                    <li>Following all infection control procedures including the proper / best practice use of Personal Protective Equipment (PPE) including wearing masks at each service , donning gloves , apron and the use of hand sanitizer where required for specific tasks, general services and general hygiene including washing hands before all interactions.</li>
                                                    <li>Notifying Caring Approach at the first opportunity if I show signs and symptoms of illness including coughing, sneezing or fever and self-isolating.</li>
                                                    <li>Notifying Caring Approach if I have been advised of the need to self-isolate, have been in Victoria , a known COVID hotspot or overseas within the last 14 days or have been in contact with someone that may or has in fact been diagnosed with Coronavirus or another transmissible illness that requires quarantine or self-isolation including if I have been in contact with someone that has recently been to Victoria or a known hotspot.</li>
                                                    <li>Seek medical advice should I show signs or symptoms of Coronavirus or a transmissible illness such as the flu and follow that advice including not attending work.</li>
                                                    <li>Taking all precautions available to me to prevent the spread of Coronavirus or other transmissible illnesses.</li>
                                                    <li>Advising Caring Approach at the first opportunity should the people we support show signs and / or symptoms of Coronavirus or another transmissible illness.</li>
                                                    <li>Advising Caring Approach at the first opportunity should the people we support show signs and / or symptoms of Coronavirus or another transmissible illness.</li>
                                                    <li>Attending and completing all required training related to infection control and / or preventing the spread of Coronavirus or other transmissible illnesses.</li>
                                                    <li>Disposing of any used PPE at the end of a service safely and securely.</li> 
                                                    <li>Ask the supplied COVID-19 screening questions to Clients, Participants, or representatives at the commencement of each service and contacting the relevant Caring Approach office immediately should any of the answers be <span class="text-theme">YES</span>.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" style="vertical-align: middle;"></td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>Signed</span>
                                                <?php if($employee_data->icec_sign!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->icec_sign!="null")?$employee_data->icec_sign:''; ?>">
                                                <?php } if($employee_data->icec_sign_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->icec_sign_base!="null")?$employee_data->icec_sign_base:''; ?>">
                                                <?php }  ?>

                                            </td>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->icec_date!="null")?$employee_data->icec_date:''; ?>'  readonly   id="icec_date"  autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                    <tbody>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <h4>Caring Approach salary confidentiality agreement </h4>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <p style="color:#000;font-weight:500;">Intent</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <p style="color:#000;font-weight:500;">Intent</p>
                                                <p style="color:#000;font-weight:500;">It is the objective of this agreement to establish the importance of discretion and confidentiality in terms of salary information. Salary is determined considering a large array of factors which may not be immediately apparent to every employee. As such, in an attempt to minimize any feelings of confusion or doubt in regard to the application of fairness in the levels of compensation provided to our employees, Caring Approach has adopted this policy in an effort to provide clear guidelines of the expectation of confidentiality.</p>
                                                <p style="color:#000;font-weight:500;">As the provision of competitive wages is paramount to our success, Caring Approach strives to ensure that we provide appropriate and fair wages for our employees in an effort to retain, motivate and provide maximum benefit for our staff. As such, our wages and other forms of compensation are determined based on a large number of factors (e.g. performance reviews, years of experience, years worked at Caring Approach and Award etc.). </p>
                                                <p style="color:#000;font-weight:500;">All Caring Approach salary information is confidential and should not be disclosed for any reason, other than as required for appropriate financial reporting purposes. </p>
                                                <p style="color:#000;font-weight:500;">Caring Approach requests that all employees keep their wages, benefits, bonuses and any other form of compensation confidential, and avoid providing or otherwise broadcasting this information with other Caring Approach employees, or with any third party that does not have a bona fide need to know. </p>
                                                <p style="color:#000;font-weight:500;">Any unauthorized disclosure of confidential information by employees may impede our ability to effectively compete for talent, may create unnecessary conflict and disputes, and could lead to disciplinary action up to and including termination of employment. </p>
                                                <p>Acknowledgment and Agreement </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align: middle;">
                                                <span>I</span>
                                            </td>
                                            <td colspan="4" style="vertical-align: middle;">
                                                <input placeholder="Name"  value='<?= ($employee_data->casca_name!="null")?$employee_data->casca_name:''; ?>'  readonly  class="form-control">
                                            </td>
                                            <td colspan="6" style="vertical-align: middle;"> acknowledge that I have read and understood the </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align: middle;">
                                                <p>Salary Confidentiality Agreement of Caring Approach. Further, I agree to adhere to this agreement and will ensure that employees working under my direction adhere to these guiding principles. I understand that if I violate the rules/procedures outlined in this agreement, I may face corrective action, up to and including termination of employment.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="vertical-align: middle;">Name</td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <input placeholder="Name"  value='<?= ($employee_data->casca_name2!="null")?$employee_data->casca_name2:''; ?>'  readonly  class="form-control">
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">Signature</td>
                                            <td colspan="3" style="vertical-align: middle;">
                                               
                                                <?php if($employee_data->casca_signature!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->casca_signature!="null")?$employee_data->casca_signature:''; ?>">
                                                <?php } if($employee_data->casca_signature_base!=''){ ?>
                                                    <img width="100px" src="<?= ($employee_data->casca_signature_base!="null")?$employee_data->casca_signature_base:''; ?>">
                                                <?php } ?>
                                                
                                            </td>
                                            <td colspan="1" style="vertical-align: middle;">Date</td>
                                            <td colspan="3" style="vertical-align: middle;">
                                                <div class=" date input-group p-0">
                                                    <input class="form-control" placeholder="Date"  value='<?= ($employee_data->casca_date!="null")?$employee_data->casca_date:''; ?>'  readonly   autofocus="autofocus" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="btn-row">
                                            <td colspan="11"></td>
                                            <td colspan="1" style="font-weight: 300; vertical-align: middle;">
                                                <div role="group" aria-label="Basic example" class="btn-group action-btns float-right">
                                                    <button type="submit" class="btn btn-success mr-10" onclick="return checkafile()">Save</button>
                                                    <button  class="btn btn-primary mr-10">Print</button>
                                                    <!-- <button class="btn btn-danger">Cancel</button> -->
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> -->
<script>
    $(document).ready(function() {
        $("#processed_line_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#police_check_received_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#discloseable_outcomes_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#fully_deducted_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#uniform_ordered_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#cost_uniform_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#total_cost_uniform").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#fully_deducted_pay_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#cb_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#cb_start_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#cacc_mdate").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#eic_date").datetimepicker({
            minDate: 0,       
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#police_start_date").datetimepicker({   
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#wwcc_start_date").datetimepicker({
            timepicker:false,
            format: 'd-m-Y',
            
        });
        $("#firstaid_start_date").datetimepicker({
            timepicker:false,
            format: 'd-m-Y',
            
        });
    });

// <?php if($this->session->flashdata('success')){ ?>
// toastr.success("<?php echo $this->session->flashdata('success'); ?>", {timeOut: 10});

// <?php }else if($this->session->flashdata('error')){ ?>
// toastr.error("<?php echo $this->session->flashdata('error'); ?>", {timeOut: 10});
// <?php }else if($this->session->flashdata('warning')){ ?>
// toastr.warning("<?php echo $this->session->flashdata('warning'); ?>", {timeOut: 10});
// <?php }else if($this->session->flashdata('info')){ ?>
// toastr.info("<?php echo $this->session->flashdata('info'); ?>", {timeOut: 10});
// <?php } ?>

</script>



<?php
  $this->app_scripts->theme('signature-pad','assets/plugins/signature-pad/signature_pad.min.js');
?>
<script>
    function checkafile(){
        var ext = $('#taxfile').val().split(".").pop().toLowerCase();
        if($.inArray(ext, ["doc","pdf",'docx']) == -1) {
            console.log('false');
            $('#errorfiles').text('invalid file formate');
            $('#errorfiles').css('color','red');
            $([document.documentElement, document.body]).animate({
               scrollTop: $("#taxscroll").offset().top-250
            }, 2000);
            return false;
        }else{
            $('#errorfiles').text(' ');
            // $('#errorfiles').css('color','red');
            console.log('true');
            return true;
        }
    }
  $(function(){
   SignaturePad.prototype.toDataURLAndRemoveBlanks = function() {
     var canvas = this._ctx.canvas;
       // First duplicate the canvas to not alter the original
       var croppedCanvas = document.createElement('canvas'),
       croppedCtx = croppedCanvas.getContext('2d');

       croppedCanvas.width = canvas.width;
       croppedCanvas.height = canvas.height;
       croppedCtx.drawImage(canvas, 0, 0);

       // Next do the actual cropping
       var w = croppedCanvas.width,
       h = croppedCanvas.height,
       pix = {
         x: [],
         y: []
       },
       imageData = croppedCtx.getImageData(0, 0, croppedCanvas.width, croppedCanvas.height),
       x, y, index;

       for (y = 0; y < h; y++) {
         for (x = 0; x < w; x++) {
           index = (y * w + x) * 4;
           if (imageData.data[index + 3] > 0) {
             pix.x.push(x);
             pix.y.push(y);

           }
         }
       }
       pix.x.sort(function(a, b) {
         return a - b
       });
       pix.y.sort(function(a, b) {
         return a - b
       });
       var n = pix.x.length - 1;

       w = pix.x[n] - pix.x[0];
       h = pix.y[n] - pix.y[0];
       var cut = croppedCtx.getImageData(pix.x[0], pix.y[0], w, h);

       croppedCanvas.width = w;
       croppedCanvas.height = h;
       croppedCtx.putImageData(cut, 0, 0);

       return croppedCanvas.toDataURL();
     };


     function signaturePadChanged() {

       var input = document.getElementById('signatureInput');
       var $signatureLabel = $('#signatureLabel');
       $signatureLabel.removeClass('text-danger');

       if (signaturePad.isEmpty()) {
         $signatureLabel.addClass('text-danger');
         input.value = '';
         return false;
       }

       $('#signatureInput-error').remove();
       var partBase64 = signaturePad.toDataURLAndRemoveBlanks();
       partBase64 = partBase64.split(',')[1];
       input.value = partBase64; 
     }

     var canvas = document.getElementById("signature");
     var clearButton = wrapper.querySelector("[data-action=clear]");
     var undoButton = wrapper.querySelector("[data-action=undo]");
     var identityFormSubmit = document.getElementById('identityConfirmationForm');

     var signaturePad = new SignaturePad(canvas, {
      maxWidth: 2,
      onEnd:function(){
        signaturePadChanged();
      }
    });

     clearButton.addEventListener("click", function(event) {
       signaturePad.clear();
       signaturePadChanged();
     });

     undoButton.addEventListener("click", function(event) {
       var data = signaturePad.toData();
       if (data) {
           data.pop(); // remove the last dot or line
           signaturePad.fromData(data);
           signaturePadChanged();
         }
       });

     $('#identityConfirmationForm').submit(function() {
       signaturePadChanged();
     });
   });
 </script>