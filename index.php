<?php
// panggil koneksi sql
include 'conn.php';

// setelah di submit
if($_GET['CONTAINER']) {
    // print_r($_GET);
    $CNTR_ID = $_GET['CONTAINER'];
    $TRUCK_ID = $_GET['TRUCK_ID'];
    
    $sql = "SELECT * FROM tx_container
            WHERE cntr_id = '".$CNTR_ID."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $d_REMAKS = $row["REMAKS"];
          $d_id = $row["id"];
          $d_cntr_id = $row["cntr_id"];
      }
    } else {
      $r_STATUS = FALSE;
      $r_MESSAGE = "Gagal Transaction!!!";
    }
    
    // proses melakukan insert sql
    if($d_REMAKS == NULL) {
        $sql = "INSERT INTO tx_transactions (cntr_id, created_by, truck_id)
                VALUES ($d_id, 'MANUAL', '$TRUCK_ID')";
        
        if ($conn->query($sql) === TRUE) {
            $r_STATUS = TRUE;
            $r_MESSAGE = "Transaction insert successfully";
          
            $sql = "UPDATE tx_container set REMAKS = 'X'
                    WHERE id = $d_id";
        
            if ($conn->query($sql) === TRUE) {
                $r_STATUS = TRUE;
                $r_MESSAGE = "Transaction update successfully";
                
                $sql = "SELECT id FROM tx_transactions
                        WHERE cntr_id = '".$d_id."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $d_id = $row["id"];
                  }
                } else {
                  $r_STATUS = FALSE;
                  $r_MESSAGE = "Gagal muat halaman!!!";
                }
                
                header('Location: gatepass_eticket.php?ID='.$d_id);
                exit;
            } else {
                $r_STATUS = FALSE;
                $r_MESSAGE = "Error: " . $conn->error;
            }
        } else {
          $r_STATUS = FALSE;
          $r_MESSAGE = "Error: " . $conn->error;
        }
    } else {
        header('Location: gatepass_eticket.php?ID='.$d_id);
        exit;
    }
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
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>

    
<main class="form-signin w-100 m-auto">
  <form>
  <center><img class="mb-4" src="TPK-KOJA.png" alt="" width="400" height="150"></center>
    <h1 class="h3 mb-3 fw-normal">eTicket Gatepass</h1>
    <label for="floatingInput">Container</label>
    <div class="form-floating">
      <!--<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">-->
      
        <?php
        $sql = "SELECT * FROM tx_container";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $d_cntr_id = $row["cntr_id"];
              $d_cntr_type = $row["cntr_type"];
                echo '<div class="form-check">
                      <input class="form-check-input" type="radio" name="CONTAINER" id="'.$d_cntr_id.'" value="'.$d_cntr_id.'">
                      <label class="form-check-label" for="'.$d_cntr_id.'">
                        '.$d_cntr_id.' : '.$d_cntr_type.'
                      </label>
                    </div>';
          }
        } else {
          echo "0 Container";
        }
        ?>
    </div>
    <br>
    <label for="floatingInput">Truck Number</label>
    <div class="form-floating">
      <input type="text" class="form-control" id="truck" name="TRUCK_ID" placeholder="truck" minlength="5" minlength="8">
      <label for="truck">Truck Number</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault" required>
      <label class="form-check-label" for="flexCheckDefault">
        Saya setuju dengan transaksi tersebut.
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Submit</button>
  </form>
  <?php
  if($r_STATUS == TRUE) {
  ?>
      <div class="gatepass">
        <div class="col-md-12 tx-9 bg-light text-dark">
            <center><h3>GATEPASS</h3></center>
        </div>
        <div class="col-md-12 tx-9 bg-light text-dark" style="margin-top: -8px;">
            <div class="row">
                <div class="col-md-5"><img src = "gatepass.php?ID=<?php echo $CNTR_ID.'_'.$TRUCK_ID; ?>" alt="" height="100px" width="100px"/></div>
                <div class="col-md-7">
                    <div class="pd-5 pd-t-10 mg-5">
                        <h5><?php echo $CNTR_ID; ?></h5><br>
                        <?php echo '22G1'; ?><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 tx-9 bg-primary text-white">
            <div class="container pd-5">
            <?php //echo 'DUMMYK'; ?><br>
            <?php //echo 'Voy. DUMMY KOJA 001'; ?><br>
            <hr>
            <center><?php //echo 'SGSIN / SGSIN'; ?></center><br>
            </div>
        </div>
      </div>
  <?php
  } else {
      echo '<h4 class="btn-danger">'.$r_MESSAGE.'</h4>';
  }
  ?>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
</main>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
<?php
$conn->close();
?>