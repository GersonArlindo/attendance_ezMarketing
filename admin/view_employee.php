<style>
    #uni_modal .modal-footer{
        display:none !important
    }
    #logo-img{
        width:75px;
        height:75px;
        object-fit:scale-down;
        background : var(--bs-light);
        object-position:center center;
        border:1px solid var(--bs-dark);
        border-radius:50% 50%;
    }
</style>
<?php 
require_once('./../DBConnection.php');
$qry = $conn->query("SELECT e.*,(e.lastname || ', ' || e.firstname || ' ' || e.middlename) as `name`,d.name as dept, p.name as position, z.campaign_name as campaign_name FROM `employee_list`e inner join `position_list` p on e.position_id = p.position_id INNER JOIN `department_list` d on e.department_id = d.department_id inner join `campaign_list` z on e.campaign_id = z.campaign_id where e.employee_id = '{$_GET['id']}'")->fetchArray();
foreach($qry as $k => $v){
    if(!is_numeric($k))
    $$k = $v;
}

?>
<div class="cotainer-flui">
    <div class="col-12">
        <center>
            <img src="<?php echo isset($employee_id) && is_file('./../avatars/'.$employee_id.'.png') ? './../avatars/'.$employee_id.'.png' : './../images/no-image-available.png' ?>" id="logo-img" alt="Avatar">
        </center>
        <div class="row">
            <div class="col-md-6">
                    
                <div class="w-100 d-flex">
                    <label for="" class="col-auto"><b>Name:</b></label>
                    <span class="border-bottom border-dark px-2 col-auto flex-grow-1"><?php echo $name ?></span>
                </div>
                <div class="w-100 d-flex">
                    <label for="" class="col-auto"><b>Gender:</b></label>
                    <span class="border-bottom border-dark px-2 col-auto flex-grow-1">
                        <?php echo $gender ?>
                        <?php if($gender == "Male"): ?>
                            <span class="fa fa-mars mx-1 text-primary opacity-50" title="Male"></span>
                        <?php else: ?>
                            <span class="fa fa-venus mx-1 text-danger opacity-50" title="Female"></span>
                        <?php endif; ?>
                        </span>
                </div>
                <div class="w-100 d-flex">
                    <label for="" class="col-auto"><b>Email:</b></label>
                    <span class="border-bottom border-dark px-2 col-auto flex-grow-1"><?php echo $email ?></span>
                </div>
                <div class="w-100 d-flex">
                    <label for="" class="col-auto"><b>Contact:</b></label>
                    <span class="border-bottom border-dark px-2 col-auto flex-grow-1"><?php echo $contact ?></span>
                </div>
                <div class="w-100 d-flex">
                    <label for="" class="col-auto"><b>Address:</b></label>
                    <span class="border-bottom border-dark px-2 col-auto flex-grow-1"><?php echo $address ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="w-100 d-flex">
                    <label for="" class="col-auto"><b>Employee Code:</b></label>
                    <span class="border-bottom border-dark px-2 col-auto flex-grow-1"><?php echo $employee_code ?></span>
                </div>
                <div class="w-100 d-flex">
                    <label for="" class="col-auto"><b>Department:</b></label>
                    <span class="border-bottom border-dark px-2 col-auto flex-grow-1"><?php echo $dept ?></span>
                </div>
                <div class="w-100 d-flex">
                    <label for="" class="col-auto"><b>Position:</b></label>
                    <span class="border-bottom border-dark px-2 col-auto flex-grow-1"><?php echo $position ?></span>
                </div>
                <div class="w-100 d-flex">
                    <label for="" class="col-auto"><b>Campaign:</b></label>
                    <span class="border-bottom border-dark px-2 col-auto flex-grow-1"><?php echo $campaign_name ?></span>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row justify-content-end mt-3">
                <button class="btn btn-sm rounded-2 btn-dark col-auto me-3" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>