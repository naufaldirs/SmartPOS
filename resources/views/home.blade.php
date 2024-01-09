<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/bootstrap4.min.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="icon" type="image/x-icon" href="{{ 'img/logo.ico' }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #EBCDC3; padding: 15px;">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <img src="/img/logo.png" style="width: 70px;" alt="logo">
            </li>
            
        </ul>
        <a class="navbar-brand" style="font-size: 30px; font-style: italic; font-weight: 600; color: black;" href="/">SMART POS</a>
        <!-- You can add more menu items here if needed -->
    </nav>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 pt-4">
                    <h2><span style="color: #EBCDC3">BENGKEL</span> SMART</h2>
                    <div class="pt-4">
                        <h2>Memperkenalkan Smart POS. <br> Perangkat kasir paling mutakhir untuk kenyamanan dan kemudahan operasi bisnis.</h2>
                    </div>
                    <br>
                    <div class="pt-5">
                        <a href="{{ route('indexlogin') }}" class="btn btn-lg login" style="border-radius: 30px; width: 700px; height: 100%; background-color: #EBCDC3; color: black; font-weight:700;" role="button" aria-pressed="true">LOGIN</a>
                    </div>
                </div>
                <div class="col-md-6 pt-3 text-center">
                    <img src="img/mekanik.png" alt="mekanik" style="width: 70%;">
                </div>
            </div>
        </div>
        <br>
        <br>

        <div class="container" id="faq" style="padding-top:50px;height:100%;">
      <div class="row py-5 no-gutters">
        <div class="col-md-12 text-center">
          <h2 class="text-center">Frequently Asked Question</h2>
          <span class="text-center d-block m-auto">Berikut adalah pertanyaan dalam menggunakan website ini</span>
        </div>
      </div>
      <!-- FAQ -->
      <div class="row">
        <div class="col-md-12">
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title">
                              <a class="first" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  BAGAIMANA CARA MENAMBAHKAN STOK SPAREPART?
                                  <span></span>
                              </a>
                          </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                              <p>   1.	Membuka menu “Stok Sparepart” <br>
                                    2.	Pilih masukkan stok masuk <br>
                                    3.	Masukkan kode sparepart <br>
                                    4.	Tambahkan nama produk <br>
                                    5.	Masukkan harga per-satuan barang dan jumlah yang ditambahkan</p>
                          </div>
                      </div>
                  </div>

                  <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingTwo">
                          <h4 class="panel-title">
                              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  BAGAIMANA CARA MEMASUKKAN DATA PELANGGAN ?
                                  <span> </span>
                              </a>
                          </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                              <p>1.	Membuka menu Input Customer <br>
                                2.	Masukkan data pelanggan berupa “Nama, No Telp, dan Email” <br>
                                3.	Klik tombol “simpan” <br>
                                4.	Data pelanggan berhasil ditambahkan
                                </p>
                          </div>
                      </div>
                  </div>

                  <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingThree">
                          <h4 class="panel-title">
                              <a class="collapsed last" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  BAGAIMANA CARA MENGGUNAKAN TRANSAKSI KASIR ?
                                  <span> </span>
                              </a>
                          </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                              <p>1.	Masukkan barang yang dipilih<br>
                                    2.	Pilih data pelanggan yang telah dimasukkan sebelumnya<br>
                                    3.	Masukkan no nota<br>
                                    4.	Pilih tanggal pemesanan<br>
                                    5.	Pilih nama petugas<br>
                                    6.	Pilih metode pembayaran<br>
                                    7.	Input biaya pembayaran, jika terdapat kelebihan, akan ada kembalian yang dihitung secara otomatis<br>
                                    8.	Klik tombol “Selanjutnya”<br>
                                    9.	Lalu klik tombol “Cetak”<br>
                                    10.	Dan struk penjualan akan dicetak<br>
                                    </p>
                          </div>
                      </div>
                  </div>

                  <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingFour">
                          <h4 class="panel-title">
                              <a class="collapsed last" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                 BAGAIMANA CARA MELIHAT DAFTAR PENJUALAN ?
                                  <span> </span>
                              </a>
                          </h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                          <div class="panel-body">
                              <p>1.	Membuka menu “Data Penjualan”<br>
                                    2.	Memilih nota penjualan yang diinginkan<br>
                                    3.	Menekan ikon aksi ubah<br>
                                    4.	Cetak kembali struk jika diperlukan
                                </p>
                          </div>
                      </div>
                  </div>

                  <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingFive">
                          <h4 class="panel-title">
                              <a class="collapsed last" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                  BAGAIMANA CARA MENAMBAHKAN USER ?
                                  <span> </span>
                              </a>
                          </h4>
                      </div>
                      <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                          <div class="panel-body">
                              <p>1.	Memilih menu “Manajemen User”<br>
                                2.	Klik tombol “tambah user” <br>
                                3.	Mengisi form tambah user untuk diberikan password > klik simpan <br>
                                4.	Mengisi data diri user > klik simpan<br>
                                5.	Data user berhasil disimpan</p>
                       
                            </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
        
    </main>
    

    <div class="row mt-5">
        <!-- Your existing footer content -->
        <div class="col-12 p-5 border text-center footer">
            &copy; SMART - 2023

            <!-- Contact Us section -->
            <div class="footer-section">
                Contact Us: smartpos@gmail.com
            </div>
        </div>
    </div>

    <!-- Script Bootstrap (JQuery, Popper.js, Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
