
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Employee List</h3>
        <div class="row">
        <div class="card-tools align-middle col-7">
            <button class="btn btn-dark btn-sm py-1 rounded-2" type="button" id="create_new"> <i class="fa fa-plus"></i> Add New Employee</button>
        </div>
        <div class="card-tools aling-middle col-5">
            <a class="btn btn-success btn-sm py-1 rounded-2" href="javascript:void(0)" id="print"><i class="fa fa-print"></i> Print</a>
        </div>
        </div>
    </div>
    <div class="card-body">
        <div id="outprint">
            <table class="table table-hover table-striped table-bordered" id="list">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="text-center p-0">#</th>
                        <th class="text-center p-0">Employee Code</th>
                        <th class="text-center p-0">Name</th>
                        <th class="text-center p-0">Department/Position</th>
                        <th class="text-center p-0">Information</th>
                        <th class="text-center p-0">Status</th>
                        <th class="text-center p-0">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT e.*,(e.lastname || ', ' || e.firstname || ' ' || e.middlename) as `name`,d.name as dept, p.name as position, z.campaign_name as campaign_name FROM `employee_list`e inner join `position_list` p on e.position_id = p.position_id INNER JOIN `department_list` d on e.department_id = d.department_id inner join `campaign_list` z on e.campaign_id = z.campaign_id  order by `name` asc";
                    $qry = $conn->query($sql);
                    $i = 1;
                        while($row = $qry->fetchArray()):
                    ?>
                    <tr>
                        <td class="text-center p-0"><?php echo $i++; ?></td>
                        <td class="py-0 px-1"><?php echo $row['employee_code'] ?></td>
                        <td class="py-0 px-1"><?php echo $row['name'] ?>
                        <?php if($row['gender'] == "Male"): ?>
                            <span class="fa fa-mars mx-1 text-primary opacity-50" title="Male"></span>
                        <?php else: ?>
                            <span class="fa fa-venus mx-1 text-danger opacity-50" title="Female"></span>
                        <?php endif; ?>
                        </td>
                        <td class="py-0 px-1">
                            <small><span class="text-muted">Department:</span> <?php echo $row['dept'] ?></small><br>
                            <small><span class="text-muted">Position:</span> <?php echo $row['position'] ?></small>
                            <small><span class="text-muted">Campaign:</span> <?php echo $row['campaign_name'] ?></small>
                        
                        </td>
                        <td class="py-0 px-1">
                            <small>Email: <?php echo $row['email'] ?></small><br>
                            <small>Contact: <?php echo $row['contact'] ?></small>
                        </td>
                        <td class="py-0 px-1 text-center">
                        <?php if($row['status'] == 1): ?>
                            <span class="badge bg-success rounded-pill">Active</span>
                        <?php else: ?>
                            <span class="badge bg-danger rounded-pill">Inactive</span>
                        <?php endif; ?>
                        </td>
                        <th class="text-center py-0 px-1">
                            <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm rounded-2 py-1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item view_data" data-id = '<?php echo $row['employee_id'] ?>' href="javascript:void(0)">View</a></li>
                                <li><a class="dropdown-item edit_data" data-id = '<?php echo $row['employee_id'] ?>' href="javascript:void(0)">Edit</a></li>
                                <li><a class="dropdown-item delete_data" data-id = '<?php echo $row['employee_id'] ?>' data-name = '<?php echo $row['reference_code']." - ".$row['name'] ?>' href="javascript:void(0)">Delete</a></li>
                                </ul>
                            </div>
                        </th>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var dtable;
    $(function(){
        $('#create_new').click(function(){
            uni_modal('Add New Employee',"manage_employee.php",'mid-large')
        })
        $('.edit_data').click(function(){
            uni_modal('Edit Employee Detail',"manage_employee.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('.view_data').click(function(){
            uni_modal('EmployeeDetails',"view_employee.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('.delete_data').click(function(){
            _conf("¿Are you sure to eliminate <b>"+$(this).attr('data-name')+"</b> de la lista?",'delete_data',[$(this).attr('data-id')])
        })
        $('table td,table th').addClass('align-middle')
        dtable = $('table').dataTable({
            columnDefs: [
                { orderable: false, 
                    targets:6
                }
            ]
        })
        $('#print').click(function() {
            dtable.fnDestroy()
            var _p = $('#outprint').clone()
            var _h = $('head').clone()
            var el = $('<div>')
            _p.find('#list td:nth-last-child(1),#list th:nth-last-child(1)').remove()
            if (_p.find('#list tbody tr').length <= 0) {
                _p.find('#list tbody').append('<tr><th class="text-center py-1" colspan="4">Sin Datos</th></tr>')
            }
            el.append(_h)
            el.append('<h2 class="text-center fw-bold">Employees List</h2>')
            el.append('<hr/>')
            el.append(_p)

            var nw = window.open("", "_blank", "width=1000,height=900,top=50,left=250")
            nw.document.write(el.html())
            nw.document.close()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    nw.close()
                    dtable = $('table').dataTable({
                        columnDefs: [{
                            orderable: false,
                            targets: 6
                        }]
                    })
                }, 200);
            }, 200);
        })
        $('#filter').submit(function(e) {
            e.preventDefault();
            location.replace(location.href + "&" + $(this).serialize())
        })
    })
    

    function delete_data($id){
        $('#confirm_modal button').attr('disabled',true)
        $.ajax({
            url:'./../Actions.php?a=delete_employee',
            method:'POST',
            data:{id:$id},
            dataType:'JSON',
            error:err=>{
                consolre.log(err)
                alert("An error occurred")
                $('#confirm_modal button').attr('disabled',false)
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.reload()
                }else{
                    alert("An error occurred")
                    $('#confirm_modal button').attr('disabled',false)
                }
            }
        })
    }
   
</script>