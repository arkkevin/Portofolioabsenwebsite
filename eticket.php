<?php
// panggil koneksi sql
include 'conn.php';

// grep data eticket
$g_id = $_GET[ID];
$sql = "SELECT B.*, A.id, A.truck_id FROM tx_transactions A INNER JOIN tx_container B ON A.cntr_id = B.id
        WHERE A.id = '".$g_id."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $d_id = $row["id"];
      $CNTR_ID = $row["cntr_id"];
      $TRUCK_ID = $row["truck_id"];
      $r_cntr_type = $row["cntr_type"];
      $r_vessel = $row["vessel"];
      $r_voyage = $row["voyage"];
      $r_shipper = $row["shipper"];
      $r_POL = $row["POL"];
      $r_FD = $row["FD"];
      $r_ATB = $row["ATB"];
      $r_CREATED = $row["CREATED"];
  }
  
  $r_STATUS = TRUE;
  $r_MESSAGE = "Success muat halaman!!!";
} else {
  $r_STATUS = FALSE;
  $r_MESSAGE = "Gagal muat halaman!!!";
}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Gatepass</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bg-light {
            background: #ffffff !important;
        }
        .btn-danger {
            color:red;
        }
        .tx-9  {
            font-size: 11px;
        }
        .gatepass {
            box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>
    
    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
    <script>
        window.print();
    </script> 
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">

    
<main class="form-signin w-100 m-auto">
  <?php
  if($r_STATUS == TRUE) {
  ?>
      <div class="gatepass">
        <div class="col-md-12 tx-9 bg-light text-dark">
            <center><h3>GATEPASS</h3></center>
        </div>
        <div class="col-md-12 tx-9 bg-light text-dark" style="margin-top: -8px;">
            <div class="row">
                <div class="col-md-5"><img src = "gatepass.php?ID=<?php echo $d_id.'_'.$CNTR_ID.'_'.$TRUCK_ID; ?>" alt="" height="100px" width="100px"/><br>
                <span>&nbsp;&nbsp;<?php echo $r_CREATED; ?></span></div>
                <div class="col-md-7">
                    <div class="pd-5 pd-t-10 mg-5">
                        <h5><?php echo $CNTR_ID; ?></h5>
                        <?php echo $r_cntr_type; ?><br><br>
                        <?php echo $r_shipper; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 tx-9 bg-primary text-white">
            <div class="container pd-5"><br>
            <?php echo 'Vess '.$r_vessel; ?><br>
            <?php echo 'Voy. '.$r_voyage; ?><br>
            <?php echo 'ATB. '.$r_ATB; ?>
            <hr>
            <center><?php echo $r_POL.'  -  '.$r_FD; ?></center><br>
            </div>
        </div>
      </div>
  <?php
  } else {
      echo '<h4 class="btn-danger">'.$r_MESSAGE.'</h4>';
  }
  ?>

    </body>
</html>
<?php
$conn->close();
?>