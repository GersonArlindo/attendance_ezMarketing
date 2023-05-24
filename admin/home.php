<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png"sizes="32x32" href="../images/favicon.png">

    <title>Frontend Mentor | Four card feature section</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header"> 
        <h1>Welcome to the</h1>
        <h1>Employee Assistance <br>  System Administrative Environment</h1>
    </div>
    <div class="row1-container">
        <div class="box box-down cyan">
            <a class="nav-link" <?php echo ($page == 'maintenance') ? 'active' : '' ?> href="./?page=maintenance">
                <h2>Department</h2>
            </a>
            <h2><?php
                $department = $conn->query("SELECT count(department_id) as `count` FROM `department_list` where status = 1 ")->fetchArray()['count'];
                echo $department > 0 ? number_format($department) : 0;
                ?></h2>
            <img src="https://www.svgrepo.com/show/341453/office-station-bureau-building-house.svg" alt="" width="45%" height="45%">
        </div>

        <div class="box red">
            <a class="nav-link" <?php echo ($page == 'employees') ? 'active' : '' ?> href="./?page=employees">
                <h2>Employees</h2>
            </a>
            <h2><?php
                $enrollees = $conn->query("SELECT count(employee_id) as `count` FROM `employee_list` where status = 1 ")->fetchArray()['count'];
                echo $enrollees > 0 ? number_format($enrollees) : 0;
                ?></h2>
            <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/512/external-employees-security-guard-flaticons-flat-flat-icons.png" alt="" width="45%" height="45%">
        </div>

        <div class="box box-down blue">
            <a class="nav-link" <?php echo ($page == 'maintenance') ? 'active' : '' ?> href="./?page=maintenance">
                <h2>Position</h2>
            </a>
            <h2><?php
                $position = $conn->query("SELECT count(position_id) as `count` FROM `position_list` where status = 1 ")->fetchArray()['count'];
                echo $position > 0 ? number_format($position) : 0;
                ?></h2>
            <img src="https://img.icons8.com/external-flatarticons-blue-flatarticons/65/null/external-Analysis-achievements-and-badges-flatarticons-blue-flatarticons.png" />
        </div>



    </div>
    <div class="row2-container">
        <div class="box orange">
            <a class="nav-link" <?php echo ($page == 'admin') ? 'active' : '' ?> href="./?page=admin">
                <h2>Users</h2>
                <h2><?php
                    $admin = $conn->query("SELECT count(admin_id) as `count` FROM `admin_list`")->fetchArray()['count'];
                    echo $admin > 0 ? number_format($admin) : 0;
                    ?></h2>
                <img src="https://img.icons8.com/ios/50/null/conference-call--v1.png" width="45%" height="45%" />
        </div>
    </div>

    <footer>
        <p class="attribution">
            Developed to <a href="#" target="_blank">EZ Marketing</a>.
            Coded by <a href="#">Ez-Marketing Devs Team</a>.
        </p>
    </footer>
</body>

<style>
    :root {
        --red: hsl(0, 78%, 62%);
        --cyan: hsl(180, 62%, 55%);
        --orange: hsl(34, 97%, 64%);
        --blue: hsl(212, 86%, 64%);
        --varyDarkBlue: hsl(234, 12%, 34%);
        --grayishBlue: hsl(229, 6%, 66%);
        --veryLightGray: hsl(0, 0%, 98%);
        --weight1: 200;
        --weight2: 400;
        --weight3: 600;
    }

    body {
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        background-color: var(--veryLightGray);
        height:100%;
        width:100%;
     
    }
    
    .attribution {
        font-size: 11px;
        text-align: center;
    }

    .attribution a {
        color: hsl(228, 45%, 44%);
    }

    h1:first-of-type {
        font-weight: var(--weight1);
        color: var(--varyDarkBlue);

    }

    h1:last-of-type {
        color: var(--varyDarkBlue);
    }

    @media (max-width: 400px) {
        h1 {
            font-size: 1.5rem;
        }
    }

    .header {
        text-align: center;
        line-height: 0.8;
        margin-bottom: 50px;
        margin-top: 10px;
    }

    .header p {
        margin: 0 auto;
        line-height: 2;
        color: var(--grayishBlue);
    }


    .box p {
        color: var(--grayishBlue);
    }

    .box {
        border-radius: 5px;
        box-shadow: 0px 30px 40px -20px var(--grayishBlue);
        padding: 30px;
        margin: 20px;
    }

    img {
        float: right;
    }

    @media (max-width: 450px) {
        .box {
            height: 200px;
        }
    }

    @media (max-width: 950px) and (min-width: 450px) {
        .box {
            text-align: center;
            height: 180px;
        }
    }

    .cyan {
        border-top: 3px solid var(--cyan);
    }

    .red {
        border-top: 3px solid var(--red);
    }

    .blue {
        border-top: 3px solid var(--blue);
    }

    .orange {
        border-top: 3px solid var(--orange);
    }

    h2 {
        color: var(--varyDarkBlue);
        font-weight: var(--weight3);
    }


    @media (min-width: 950px) {
        .row1-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .row2-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box-down {
            position: relative;
            top: 250px;
        }

        .box {
            width: 25%;

        }

        .header p {
            width: 30%;
        }

    }
    .box:hover{
         scale: 1.1;
        cursor:pointer;
        background-color: #D5F7E6;
        border-color: red;
    }

</style>

</html>