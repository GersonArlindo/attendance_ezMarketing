<?php date_default_timezone_set('America/El_Salvador'); ?>
<?php $loc_details = json_decode(file_get_contents("http://ipinfo.io/json")); ?>
<style>
    .acumulatedTime{
        background: -webkit-linear-gradient(blue, red);
        -webkit-text-fill-color: transparent;
        -webkit-background-clip: text;
    }

    .textMarcador {
        text-align: left;
        font-family: Arial Black;
        font-weight: bold;
        font-size: 30px;
        color: #094293;
        text-shadow: 0 1px 0 #ddd, 0 2px 0 #ccc, 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 0 #acacac, 0 6px 1px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3), 0 3px 5px rgba(0, 0, 0, 0.2), 0 5px 10px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.2), 0 20px 20px rgba(0, 0, 0, 0.15);
    }



    .textMarcadorOut {
        text-align: left;
        font-family: Arial Black;
        font-weight: bold;
        font-size: 30px;
        color: #ed1c24;
        text-shadow: 0 1px 0 #ddd, 0 2px 0 #ccc, 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 0 #acacac, 0 6px 1px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3), 0 3px 5px rgba(0, 0, 0, 0.2), 0 5px 10px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.2), 0 20px 20px rgba(0, 0, 0, 0.15);
    }

    /*Estilos de cards*/
    .cards-list {
    z-index: 0;
    width: 100%;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
  }
  .pcard1{
    color: rgb(197 56 73);
    font-size: 20px;
    margin-top: 5px;
  }
  .pcard2{
    color: rgb(246, 183, 43);
    font-size: 20px;
    margin-top: 43px;
  }
  .pcard3{
    color: rgb(255, 255, 255);
    font-size: 20px;
    margin-top: 45px;
  }
  .pcard4{
    color: aliceblue;
    font-size: 20px;
    margin-top: 45px;
  }
  .card {
    margin: 30px auto;
    width: 250px;
    height: 250px;
    border-radius: 40px;
    box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
    cursor: pointer;
    transition: 0.4s;
  }
  
  .card .card_image {
    width: inherit;
    height: inherit;
    border-radius: 40px;
  }
  
  .card .card_image img {
    width: inherit;
    height: inherit;
    border-radius: 40px;
    object-fit: cover;
  }
  
  .card .card_title {
    text-align: center;
    border-radius: 0px 0px 40px 40px;
    font-family: sans-serif;
    font-weight: bold;
    font-size: 30px;
    margin-top: -80px;
    height: 40px;
  }
  
  .card:hover {
    transform: scale(0.9, 0.9);
    box-shadow: rgba(240, 46, 46, 0.4) -5px 5px, rgba(240, 46, 46, 0.3) -10px 10px, rgba(19, 3, 13, 0.2) -15px 15px, rgba(240, 46, 170, 0.1) -20px 20px, rgba(240, 46, 170, 0.05) -25px 25px;
  }
  
  .title-white {
    color: white;
  }
  
  .title-black {
    color: black;
  }
  
  @media all and (max-width: 500px) {
    .card-list {
      /* On small screens, we are no longer using row direction but column */
      flex-direction: column;
    }
  } 
</style>
<div class="container py-1">

    <div class="w-100 d-flex justify-content-center my-2">
        <div class="w-auto">
            <div class="w-auto fs-1 fw-bolder text-center" id="time"><?php echo date('h:i:s A') ?></div>
            <div class="w-auto fs-4 fw-bolder text-center" id="date"><?php echo date('M d, Y') ?></div>
        </div>
    </div>
    <div class="w-100 row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2  gx-4 gy-4 justify-content-center my-2 mx-2">
        <!-- <div class="col text-center">
            <button class="btnshadow att_btn w-100 text-center btn btn-sm rounded-3 btn-primary"   onclick="iniciar()" type="button" data-type="IN"><i class="fa-solid fa-right-to-bracket disabled" ></i>&nbsp; Log in</button>
        </div>
        <div class="col text-center">
            <button class="btnshadow2 att_btn w-100 text-center btn btn-sm rounded-3 btn-danger" onclick="pausar(); iniciar2();" type="button" data-type="L_OUT"><i class="fa-solid fa-utensils"></i>&nbsp; Lunch/Break Out</button>
        </div>
        <div class="col text-center">
            <button class="btnshadow att_btn w-100 text-center btn btn-sm rounded-3 btn-primary" onclick="iniciar(); pausar2();" type="button" data-type="L_IN"><i class="fa-solid fa-rotate-left"></i>&nbsp; Lunch/Break In</button>
        </div>
        <div class="col text-center">
            <button class="btnshadow2 att_btn w-100 text-center btn btn-sm rounded-3 btn-danger" onclick="reiniciar(); reiniciar2();" type="button" data-type="OUT"> <i class="fa-solid fa-person-walking-arrow-loop-left"></i>&nbsp; Log out</button>
        </div> -->


        <div class="cards-list">
        <div class="card 3 att_btn" onclick="iniciar()" data-type="IN">
            <div class="card_image">
              <img src="https://media3.giphy.com/media/l3q2WMhNcyFOWP280/giphy.gif?cid=ecf05e471bkgakn4iyzkdnhaml4pffc3wzub9hqhy72lvv0m&rid=giphy.gif&ct=g" />
            </div>
            <div class="card_title "> <br>
              <p class="pcard1">Log In</p>
            </div>
        </div>
            
        <div class="card 4 att_btn" onclick="pausar(); iniciar2();" data-type="L_OUT">
            <div class="card_image">
              <img src="https://media1.giphy.com/media/8JpDTXGCMEBj9Vh9eB/giphy.gif?cid=ecf05e47a209dfye9rsaf70kodbr7607wi42s01via31ulte&rid=giphy.gif&ct=g" />
              </div>
            <div class="card_title ">
              <p class="pcard2">Lunch/Breack Out</p>
            </div>
        </div>
    
        <div class="card 3 att_btn" onclick="iniciar(); pausar2();" data-type="L_IN">
          <div class="card_image">
            <img src="https://media1.giphy.com/media/C7l38dCPSgz6mPiDgQ/giphy.gif?cid=ecf05e47nfizjprxqzxnnicc76zlr16xbpspdgsofof8eu9c&rid=giphy.gif&ct=g" />
          </div>
          <div class="card_title ">
            <p class="pcard3">Lunch/Break In</p>
          </div>
        </div>
          
        <div class="card 4 att_btn" onclick="reiniciar(); reiniciar2();" data-type="OUT">
          <div class="card_image">
            <img src="https://media3.giphy.com/media/kaZb7wDqm1A7sgW3ec/giphy.gif?cid=ecf05e472jylfe5ifohjbfn004qzpkskoqt3st9wp9x5s4jv&rid=giphy.gif&ct=g" />
            </div>
          <div class="card_title ">
            <p class="pcard4">Log Out</p>
          </div>
          </div>
        </div>

    </div>
    <div>
        <br>
        <div class="row text-center">
             <!-- <div class="col-md-12">
                <?php
                $qry = $conn->query("SELECT z.campaign_name as campaign_name FROM `employee_list`e inner join `campaign_list` z on e.campaign_id = z.campaign_id where e.employee_id = '{$_SESSION['employee_id']}'");
                while ($row = $qry->fetchArray()) :
                ?>
                    <h3 class="text-center" style='color:blue; font-size: 20px;'>Campaign: <?php echo ($row['campaign_name']); ?></h3>
                <?php
                endwhile;
                ?>
            </div>  -->
            <div class="col-md-2">
                <h4 class="badge bg-info rounded-pill text-dark">Hours Worked: </h4>
            </div>
            <div class="col-md-2 acumulatedTime text-center">
                <!--Cronometro-->
                <!-- CSS (Efectos visuales) -->
                <style>
                    * {
                        transition: all 0.3s;
                    }
                </style>
                <!-- HTML (Estructura) -->
                <div class="marco">
                    <label class="tiempo" id="tiempo" name="tiempo" style="font-size: 135%;">
                        <script>
                            document.getElementById("tiempo").innerHTML = localStorage.getItem('valor')
                        </script>
                    </label>
                </div>
                <!-- JS (Parte Lógica) -->
                <script>
                    let tiempoRef = Date.now()
                    let cronometrar = false
                    let acumulado = 0
                    let tiempoGuardar = ''

                    function iniciar() {
 
                        cronometrar = true
                    }

                    function pausar() {
                        cronometrar = false
                        //iniciar2()
                    }

                    function reiniciar() {
                        acumulado = 0
                    }

                    setInterval(() => {
                        let tiempo = document.getElementById("tiempo")
                        if (cronometrar) {
                            acumulado += Date.now() - tiempoRef
                        }
                        tiempoRef = Date.now()
                        tiempo.innerHTML = formatearMS(acumulado)
                        window.addEventListener("beforeunload", function() {
                        // Guardar el valor del input en localStorage
                        localStorage.setItem("valor",  tiempo.innerHTML);
                        });
                    }, 1000 / 60);

                    function formatearMS(tiempo_ms) {
                        let MS = tiempo_ms % 1000
                        //Agregué la variable St para solucionar el problema de contar los minutos y horas.
                        let St = Math.floor(((tiempo_ms - MS) / 1000))
                        let S = St % 60
                        let M = Math.floor((St / 60) % 60)
                        let H = Math.floor((St / 60 / 60))
                        Number.prototype.ceros = function(n) {
                            return (this + "").padStart(n, 0)
                        } 
                        return H.ceros(2) + ":" + M.ceros(2) + ":" + S.ceros(2) +
                            "." + MS.ceros(3)
                    }
                </script>
                <!--Cronometro-->
            </div>

<!--SEGUNDO CRONOMETRO-->
            <div class="col-md-2">
                <h4 class="badge bg-danger rounded-pill text-white">Hours Breack: </h4>
            </div>
            <div class="col-md-2 acumulatedTime text-center">
                <!--Cronometro-->
                <!-- CSS (Efectos visuales) -->
                <style>
                    * {
                        transition: all 0.3s;
                    }
                </style>
                <!-- HTML (Estructura) -->
                    <label for="tiempo2" class="tiempo2" id="tiempo2" name="tiempo2" style="font-size: 135%;">
                        <script>
                            document.getElementById("tiempo2").innerHTML = '00:00:00.000'
                        </script>
                    </label>
                <!-- JS (Parte Lógica) -->
                <script>
                    let tiempoRef2 = Date.now()
                    let cronometrar2 = false
                    let acumulado2 = 0
                    let tiempoGuardar2 = ''

                    function iniciar2() {
 
                        cronometrar2 = true
                    }

                    function pausar2() {
                        cronometrar2 = false
                        //iniciar2()
                    }

                    function reiniciar2() {
                        acumulado2 = 0
                    }

                    setInterval(() => {
                        let tiempo2 = document.getElementById("tiempo2")
                        if (cronometrar2) {
                            acumulado2 += Date.now() - tiempoRef2
                        }
                        tiempoRef2 = Date.now()
                        tiempo2.innerHTML = formatearMS(acumulado2)
                    }, 1000 / 60);

                    function formatearMS(tiempo_ms2) {
                        let MS = tiempo_ms2 % 1000
                        //Agregué la variable St para solucionar el problema de contar los minutos y horas.
                        let St = Math.floor(((tiempo_ms2 - MS) / 1000))
                        let S = St % 60
                        let M = Math.floor((St / 60) % 60)
                        let H = Math.floor((St / 60 / 60))
                        Number.prototype.ceros = function(n) {
                            return (this + "").padStart(n, 0)
                        } 
                        return H.ceros(2) + ":" + M.ceros(2) + ":" + S.ceros(2) +
                            "." + MS.ceros(3)
                    }
                </script>
                <!--Cronometro-->
            </div>
<!--SEGUNDO CRONOMETRO-->

            <div class="col-md-2">
                <h4 class="badge bg-success rounded-pill text-dark">
                    Accumulated Time:
                </h4>
            </div>
            <div class="col-md-2">
                <h4 class="acumulatedTime">
                    <script>
                            var timeCronometro = localStorage.getItem("valor");
                            if (localStorage.getItem('valor') !== null) {
                                let miVariable = localStorage.getItem('valor');
                                //document.write(`${miVariable}`)
                            // La clave existe en el almacenamiento local
                            //console.log('La clave existe y su valor es ' + localStorage.getItem('valor'));
                        }
                    </script>
                    <?php
                    /*AQUI ESTABA ANTES LA LLAMADA Y LA IMPRESION DE LAS HORAS TRABAJADAS*/ 
                    $fechaUser = "";
                    $fecha_actualUsers = date('Y-m-d');
                    $idAgentUser = $_SESSION['employee_id'];
                    $sqlU = "SELECT total_time FROM 'hours_list' WHERE employee_id = $idAgentUser and (date_created LIKE '$fecha_actualUsers%')"; 
                    $qryU = $conn->query($sqlU);
                    while ($rowU = $qryU->fetchArray()) { 
                        $fechaUser = $rowU['total_time']; 
                    }?>
                     <?php
                    if($fechaUser==""){
                        echo "00:00:00.000";
                    }else{
                        echo $fechaUser;
                    } ?>  
                    <!--AQUI ESTABA ANTES LA LLAMADA Y LA IMPRESION DE LAS HORAS TRABAJADAS--> 
                </h4>
            </div>
        </div>
        <hr>

        <table class="table table-striped">
            <thead class="bg-dark text-light">
                <tr>
                    <th class="py-1 px-2">Date and Time</th>
                    <th class="py-1 px-2">Type</th>
                    <th class="py-1 px-2">Device Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $log_type = array('IN' => 'Log In', 'L_OUT' => 'Luch / Breack Out', 'L_IN' => 'Luch / Breack In', 'OUT' => 'Log Out');
                $fecha_actual = date('Y-m-d');
                $qry = $conn->query("SELECT * FROM `attendance_list` where (employee_id = '{$_SESSION['employee_id']}') and (date_created LIKE '$fecha_actual%') order by strftime('%s',date_created) desc");
                while ($row = $qry->fetchArray()) :
                ?>
                    <tr>
                        <td class="py-1 px-2"><?php echo date("Y-m-d h:i A", strtotime($row['date_created'])) ?></td>
                        <td class="py-1 px-2"><?php echo $log_type[$row['att_type']] ?></td>
                        <td class="py-1 px-2">
                            <?php if ($row['device_type'] == 'desktop') : ?>
                                <span><span class="fa fa-desktop text-primary"></span> Desktop </span>
                            <?php else : ?>
                                <span><span class="fa fa-mobile-alt text-primary"></span> Mobile Phone</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
     window.addEventListener("beforeunload", (evento) => {
     if (true) {
         evento.preventDefault();
         evento.returnValue = "";
        return "";
     }
    }); 
    var timeInterval;
    $(function() {
        timeInterval = setInterval(() => {
            var date = new Date();
            var month = date.toLocaleString('default', {
                month: 'short'
        })
            var day = date.getDate()
            var year = date.getFullYear()
            var hr = String(date.getHours()).padStart(2, '0')
            var min = String(date.getMinutes()).padStart(2, '0')
            var sec = String(date.getSeconds()).padStart(2, '0')
            var amp = hr >= 12 ? "PM" : "AM";
            //hr = String(Math.floor(hr % 12)).padStart(2, '0')
            $('#time').text(hr + ":" + min + ":" + sec + " " + amp)
            $('#date').text(month + " " + day + ", " + year)
        }, 500);
        $('.att_btn').click(function() {
            $('.att_btn').attr('disabled', true)
            var time = new Date("YYYY-MM-DD H:i:s");
            $.ajax({
                url: 'Actions.php?a=save_attendance',
                method: 'POST',
                data: {
                    type: $(this).attr('data-type'),
                    json_data: '<?php echo json_encode($loc_details) ?>',
                    time: time,
                    tiempoGuardar: document.getElementById('tiempo').innerHTML,
                    //Nueva linea
                    accumulated_time: localStorage.getItem('valor'),
                    hours_breack: document.getElementById('tiempo2').innerHTML
                },
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert("An error occurred")
                    $('.att_btn').attr('disabled', false)
                },
                success: function(resp) {
                    if (resp.status == 'success') {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Attendance record successfully added',
                            icon: 'success',
                            timer: 2000,
                            timerProgressBar: true,
                            willClose: () => {
                                if (resp.logOut == 'true') {
                                    location.reload()
                                }
                            }
                        })
                    } else {
                        console.log(resp)
                        alert("An error occurred")
                    }
                    $('.att_btn').attr('disabled', false)
                }
            })

        })
    })


</script>


