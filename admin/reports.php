<?php
$eid = isset($_GET['employee_id']) ? $_GET['employee_id'] : "all";
//$date_start = isset($_GET['date_start']) ? $_GET['date_start'] : date('Y-m-d', strtotime(date('Y-m-d') . " -1 week"));
$date_start = isset($_GET['date_start']) ? $_GET['date_start'] : date('Y-m-d');
$date_filter = isset($_GET['date_start']) ? $_GET['date_start'] : date('Y-m-d');
$nuevo_formato = date("Y-m", strtotime($date_filter));
//echo $nuevo_formato;
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] : date('Y-m-d');
?>
<style>
    .logo-img {
        width: 45px;
        height: 45px;
        object-fit: scale-down;
        background: var(--bs-light);
        object-position: center center;
        border: 1px solid var(--bs-dark);
        border-radius: 50% 50%;
    }
</style>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Reports</h3>
        <div class="card-tools align-middle">
            <a class="btn btn-success btn-sm py-1 rounded-2" href="javascript:void(0)" id="print"><i class="fa fa-print"></i> Print</a>
        </div>
    </div>
    <div class="card-body">
        <form action="" id="filter">
            <div class="row align-items-end mb-3">
                <div class="form-group col-md-3">
                    <label for="employee_id" class="control-label">Employee</label>
                    <select class="form-select form-select-sm rounded-0 select2" name="employee_id" required>
                        <option value="all" <?php echo $eid == 'all' ? 'selected' : '' ?>>All Records</option>
                        <?php
                        $employee = $conn->query("SELECT *,(lastname || ', ' || firstname || ' ' || middlename) as `name` FROM employee_list order by `name` asc ");
                        while ($row = $employee->fetchArray()) :
                        ?>
                            <option value="<?php echo $row['employee_id'] ?>" <?php echo $eid == $row['employee_id'] ? 'selected' : '' ?>><?php echo $row['employee_code'] . ' ' . $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="date_start" class="control-label">Start Date</label>
                    <input type="date" name="date_start" id="date_start" required class="form-control form-control-sm rounded-0" value="<?php echo isset($date_start) ? $date_start : '' ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="date_end" class="control-label">End Date</label>
                    <input type="date" name="date_end" id="date_end" required class="form-control form-control-sm rounded-0" value="<?php echo isset($date_end) ? $date_end : '' ?>">
                </div>
                <div class="form-group col-md-3">
                    <button class="btn btn-sm rounded-2 btn-primary"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
        <div id="outprint">
            <table class="table table-hover table-striped table-bordered" >
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="30%">
                    <col width="30%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="text-center p-0">#</th>
                        <th class="text-center p-0">Date and Time</th>
                        <th class="text-center p-0">Employee</th>
                        <th class="text-center p-0">Total Hours / day</th>
                        <th class="text-center p-0">Total Hours/ month</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    /**FUNCION PARA CONTAR HORAS */
                    function sumTimes($times) {
                        $seconds = 0;
                        $milliseconds = 0;
                        foreach ($times as $time) {
                            list($hours, $minutes, $secondsPart) = explode(':', $time);
                            list($minutesPart, $milliseconds) = explode('.', $secondsPart);
                            $seconds += $hours * 3600;
                            $seconds += $minutes * 60;
                            $seconds += $minutesPart;
                            $milliseconds = intval($milliseconds);
                        }
                    
                        $hours = floor($seconds / 3600);
                        $seconds -= $hours * 3600;
                        $minutes = floor($seconds / 60);
                        $seconds -= $minutes * 60;
                    
                        return sprintf('%02d:%02d:%02d.%03d', $hours, $minutes, $seconds, $milliseconds);
                    }
                    
                    //echo sumTimes(["00:01:40.759", "00:00:09.759"]);
                    // output: "00:02:50.518"
                    /**FUNCION PARA CONTAR HORAS */

                    $where = " where date(h.date_created) between '{$date_start}' and '{$date_end}' ";
                    if (is_numeric($eid) && $eid > 0) {
                        $where .= " and h.employee_id = '{$eid}' ";
                    }
                    //Por dia
                    $sql = "SELECT e.*,(e.lastname || ', ' || e.firstname || ' ' || e.middlename) as `name`, h.total_time, h.date_created FROM `employee_list`e inner join `hours_list` h on e.employee_id = h.employee_id {$where} order by `date_created` asc";
                    $qry = $conn->query($sql);
                    //Por mes
                
                    $i = 1;
                    while ($row = $qry->fetchArray()) :
                    ?>
                        <tr>
                            <td class="text-center p-0"><?php echo $i++; ?></td>
                            <td class="py-1 px-1 text-end align-middle"><?php echo date("Y-m-d h:i A", strtotime($row['date_created'])) ?></td>
                            <td class="py-1 px-1 lh-1">
                                <span class="text-muted">Name:</span> <?php echo $row['name'] ?>
                            </td>
                            <td class="py-1 px-1 lh-1"> <span class="badge bg-success rounded-pill text-dark">
                                <?php echo $row['total_time'] ?></span>
                            </td>
                            <td class="py-1 px-1 lh-1 "> <span class="badge bg-info rounded-pill text-dark">
                           <?php 
                                $arrayHours = array();
                                $fecha_actual = date('Y-m');
                                //echo $fecha_actual;
                                $idAgent = $row['employee_id'];
                                $sqlH = "SELECT total_time FROM 'hours_list' WHERE employee_id = $idAgent and (date_created LIKE '$nuevo_formato%')"; 
                                $qryH = $conn->query($sqlH);
                                while ($rowH = $qryH->fetchArray()) :
                                    array_push($arrayHours, $rowH['total_time']);
                                endwhile;
                                echo(sumTimes($arrayHours));
                                //var_dump($arrayHours);
                                ?> 
                            </td></span>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var dtable;
    $(function() {
        $('.view_data').click(function() {
            uni_modal("Registro Detalles de Asistencia", 'view_att.php?id=' + $(this).attr('data-id'), 'large')
        })
        $('.delete_data').click(function() {
            _conf("¿Está seguro de eliminar este registro de asistencia de <b>" + $(this).attr('data-name') + "</b> de la lista?", 'delete_data', [$(this).attr('data-id')])
        })
        dtable = $('table').dataTable({
            columnDefs: [{
                orderable: false,
                targets: 3
            }]
        })
        $('#print').click(function() {
            dtable.fnDestroy()
            var _p = $('#outprint').clone()
            var _h = $('head').clone()
            var el = $('<div>')
            if (_p.find('#list tbody tr').length <= 0) {
                _p.find('#list tbody').append('<tr><th class="text-center py-1" colspan="4">Sin Datos</th></tr>')
            }
            el.append(_h)
            el.append('<h2 class="text-center fw-bold">Lista de Registro de Asistencia</h2>')
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
                            targets: 3
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

    

    function delete_data($id) {
        $('#confirm_modal button').attr('disabled', true)
        $.ajax({
            url: './../Actions.php?a=delete_attendance',
            method: 'POST',
            data: {
                id: $id
            },
            dataType: 'JSON',
            error: err => {
                alert("Ha ocurrido un error")
                $('#confirm_modal button').attr('disabled', false)
            },
            success: function(resp) {
                if (resp.status == 'success') {
                    location.reload()
                } else {
                    alert("Ha ocurrido un error")
                    $('#confirm_modal button').attr('disabled', false)
                }
            }
        })
    }
</script>