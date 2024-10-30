<?php 
if ($mod == ''){
    header('location:../404');
    echo 'kosong';
} else {
    include_once 'sw-mod/sw-header.php';

    // Jika user belum login (cookie belum ada)
    if (!isset($_COOKIE['COOKIES_MEMBER'])) {
        echo '
        <!-- App Capsule -->
        <div id="appCapsule" style="height: 100vh; display: flex; align-items: center; justify-content: center; background-image: url(\'https://your-image-url.com/background.jpg\'); background-size: cover; background-position: center;">
            <div style="max-width: 400px; padding: 20px; background-color: rgba(255, 255, 255, 0.5); border-radius: 15px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); backdrop-filter: blur(10px);">
                <div class="section text-center mb-4">
                    <h2 style="color: #007bff; font-size: 24px; font-weight: bold;">PT. TARGET MEDIA</h2>
                    <h1 style="font-size: 30px; font-weight: bold; color: #333;">Selamat Datang</h1>
                    <p style="font-size: 16px; color: #6c757d;">Masuk menggunakan email dan password</p>
                </div>
                <form id="form-login">
                    <div style="margin-bottom: 15px;">
                        <label for="email1" style="display: block; margin-bottom: 5px; font-weight: bold;">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Anda" style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="password1" style="display: block; margin-bottom: 5px; font-weight: bold;">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kata sandi Anda" style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);" required>
                    </div>

                    <div class="form-links text-center" style="margin-bottom: 15px;">
                        <p>Belum punya akun? <a href="registrasi" style="color: #007bff; text-decoration: none;">Daftar disini</a></p>
                    </div>

                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; background-color: #007bff; border: none; border-radius: 50px; font-size: 18px; color: #fff; cursor: pointer; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                            <ion-icon name="log-in-outline" style="vertical-align: middle;"></ion-icon> Masuk
                        </button>
                    </div>

                    <div style="text-align: center; margin-top: 10px;">
                        <a href="http://localhost/absensi/absensi/sw-admin/login/" class="btn btn-danger" style="display: block; padding: 12px; border-radius: 50px; background-color: #dc3545; color: #fff; text-align: center; text-decoration: none; font-size: 18px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                            Login Admin
                        </a>
                    </div>
                </form>
            </div>
        </div>
    <!-- * App Capsule -->';}
  else{

  echo'<!-- App Capsule -->
    <div id="appCapsule">
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title"> Selamat '.$salam.'</span>
                        <h1 class="total">'.ucfirst($row_user['employees_name']).'</h1>
                    </div>
                </div>
                <!-- * Balance -->
                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="./absent">
                            <div class="icon-wrapper bg-danger">
                                <ion-icon name="camera-outline"></ion-icon>
                            </div>
                            <strong>Absen Karyawan</strong>
                        </a>
                    </div>

                   
                    <div class="item">
                        <a href="./history">
                            <div class="icon-wrapper bg-success">
                               <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                            <strong>History</strong>
                        </a>
                    </div>

                    <div class="item">
                        <a href="./profile">
                            <div class="icon-wrapper bg-warning">
                               <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <strong>Profil</strong>
                        </a>
                    </div>


                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->

    <!-- Label Absensi Hari ini -->
    <div class="section">
        <div class="row mt-2">';
            if($result_absent->num_rows > 0){
                $row_absent     = $result_absent->fetch_assoc();
                echo'
                <div class="col-6">
                    <div class="stat-box bg-danger">
                        <div class="title text-white">Absen Masuk</div>
                        <div class="value text-white">'.$row_absent['time_in'].'</div>
                    </div>
                </div>';

                if($row_absent['time_out']=='00:00:00'){
                echo'
                <div class="col-6">
                    <a href="./absent"><div class="stat-box bg-success">
                        <div class="title text-white">Absen Pulang</div>
                        <div class="value text-white">Belum absen</div>
                    </div></a>
                </div>';
                }else{
                echo'
                <div class="col-6">
                    <div class="stat-box bg-success">
                        <div class="title text-white">Absen Pulang</div>
                        <div class="value text-white">'.$row_absent['time_out'].'</div>
                    </div>
                </div>';}
            } 
            else{
                echo'
                <div class="col-6">
                    <a href="./absent"><div class="stat-box bg-danger">
                        <div class="title text-white">Absen Masuk</div>
                        <div class="value text-white">Belum absen</div>
                    </div></a>
                </div>

                <div class="col-6">
                    <div class="stat-box bg-secondary">
                        <div class="title text-white">Absen Pulang</div>
                        <div class="value text-white">Belum Absen</div>
                    </div>
                </div>
                ';
            }   
        echo' 
        </div>
    </div>


    <div class="section mt-4">
        <div class="section-title mb-1">Absensi Bulan
            <select class="select select-change text-primary" required>';
                if($month ==1){echo'<option value="01" selected>Januari</option>';}else{echo'<option value="01">Januari</option>';}
                if($month ==2){echo'<option value="02" selected>Februari</option>';}else{echo'<option value="02">Februari</option>';}
                if($month ==3){echo'<option value="03" selected>Maret</option>';}else{echo'<option value="03">Maret</option>';}
                if($month ==4){echo'<option value="04" selected>April</option>';}else{echo'<option value="04">April</option>';}
                if($month ==5){echo'<option value="05" selected>Mei</option>';}else{echo'<option value="05">Mei</option>';}
                if($month ==6){echo'<option value="06" selected>Juni</option>';}else{echo'<option value="06">Juni</option>';}
                if($month ==7){echo'<option value="07" selected>Juli</option>';}else{echo'<option value="07">Juli</option>';}
                if($month ==8){echo'<option value="08" selected>Agustus</option>';}else{echo'<option value="08">Agustus</option>';}
                if($month ==9){echo'<option value="09" selected>September</option>';}else{echo'<option value="09">September</option>';}
                if($month ==10){echo'<option value="10" selected>Oktober</option>';}else{echo'<option value="10">Oktober</option>';}
                if($month ==11){echo'<option value="12" selected>November</option>';}else{echo'<option value="12">November</option>';}
                if($month ==12){echo'<option value="12" selected>Desember</option>';}else{echo'<option value="12">Desember</option>';}
              echo'
            </select><span class="text-primary">'.$year.'</span>
        </div>
        <div class="transactions">
            <div class="row">
                <div class="load-home" style="display:contents"></div>   
            </div>
            </div>
        </div>

      <div class="section mt-2 mb-2">
            <div class="section-title">1 Minggu Terakhir</div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-dark rounded bg-danger">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam Masuk</th>
                                <th scope="col">Jam Pulang</th>
                            </tr>
                        </thead>
                        <tbody>';
                        $query_absen="SELECT presence_date,time_in,time_out FROM presence WHERE MONTH(presence_date) ='$month' AND employees_id='$row_user[id]' ORDER BY presence_id DESC LIMIT 6";
                        $result_absen = $connection->query($query_absen);
                        if($result_absen->num_rows > 0){
                            while ($row_absen= $result_absen->fetch_assoc()) {
                            echo'
                            <tr>
                                <th scope="row">'.tgl_ind($row_absen['presence_date']).'</th>
                                <td>'.$row_absen['time_in'].'</td>
                                <td>'.$row_absen['time_out'].'</td>
                            </tr>';
                        }}
                        echo'
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div>';

    }
  include_once 'sw-mod/sw-footer.php';
} ?>