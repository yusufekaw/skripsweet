<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Prediksi Forex Menggunakan Metode BackPropagation Neural Network Dengan Teknik Online Learning">
    <meta name="author" content="Yusuf Eka Wiraswastawan">
    <title>Prediksi Forex Menggunakan Metode BackPropagation Neural Network Dengan Teknik Online Learning</title>
    <!-- CSS Bootstrap -->    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
</head>
<body>
    <!--Navbar-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
		  <a class="nav-item nav-link" href="http://yusufeka.cvbensonshop.masuk.id/show.php?period=0">Online Training</a>
		  <a class="nav-item nav-link" href="http://yusufeka.cvbensonshop.masuk.id/show.php?period=36">Online Testing</a>
		  <a class="nav-item nav-link" href="http://yusufeka.cvbensonshop.masuk.id/show.php?period=37">Offline Training</a>
		  <a class="nav-item nav-link" href="http://yusufeka.cvbensonshop.masuk.id/show.php?period=38">Offline Testing</a>
		  <a class="nav-item nav-link" data-toggle="modal" data-target="#modalTentang">Tentang</a>
		</div>
	  </div>
	</nav>
	<!--Akhir Navbar-->
	<!--Mocal tentang-->
	<div class="modal fade" id="modalTentang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Tentang Program</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p>Ini adalah program skripsi dengan judul "Prediksi Forex Menggunakan Metode BackPropagation Neural Network Dengan Teknik Online Learning".</p>
			<p>Oleh : </p>
			<p><strong>YUSUF EKA WIRASWASTAWAN</strong></p>
			<p><strong>06.2017.1.90468</strong></p>
			<p>Besar harapan saya, pada akhirnya apa yang saya kerjakan mendapatkan hasil yang terbaik.</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	<!--Akhir Mocal tentang-->
	<!-- Kontent-->
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p  class="lead">Prediksi Forex Menggunakan Metode BackPropagation Neural Network Dengan Teknik Online Learning</p>
                <p id="period-title" class="lead"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <div class="form-inline">
                <label class="form-group mb-2" >Periode</label>
                <select class="form-control mx-sm-3 mb-2" id="period" name="period" >
                <?php for($i=1; $i<=38; $i++){ ?>
                    <?php if($i<36) { ?>
                    <option value="<?php echo $i; ?>">Training ke <?php echo $i;  ?></option>
                    <?php } else if($i==36){ ?>
                    <option value="<?php echo $i; ?>">Testing</option>
                   <?php } else if($i==37){ ?>
                    <option value="<?php echo $i; ?>">Standart Training</option>
                   <?php } else { ?>
                    <option value="<?php echo $i; ?>">Standart Testing</option>
                   <?php } ?>
                <?php } ?>
                </select>
                <button type="submit" class="btn btn-dark mb-2" onclick="redirectPeriod();"> Go </button>
            </div>   
            </div>
            <div class="col-lg-12">
                <!-- Menampilkan data kedalam bentuk tabel -->
                <table id="tabledisplay" class="table table-striped nowrap" style="width:100%">
                    <!-- Tabel header -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>X1</th>
                            <th>X2</th>
                            <th>X3</th>
                            <th>Target</th>
                            <th>Output</th>
                        </tr>
                    </thead>
                    <!-- Akhir tabel header -->
                    <!-- Tabel footer -->
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>X1</th>
                            <th>X2</th>
                            <th>X3</th>
                            <th>Target</th>
                            <th>Output</th>
                        </tr>
                    </tfoot>
                    <!-- Akhir tabel footer -->
                </table>
                <!-- Akhir Tabel -->
            </div>
            <!-- visualisasi data kedalam bentuk grafik -->
            <div  class="col-lg-12">
                <!-- canvas grafik -->
                <canvas id="chartdisplay" height="400" width="0"></canvas>
                <!-- Akhir canvas -->
            </div>
            <!-- Akhir grafik -->
            <!-- Hasil pengukuran kesalahan -->
            <div  class="col-lg-12">
                <table class="table table-striped" id="error">
                    
                </table>
            </div>
            <!-- akhir pengukuran kesalahan -->
        </div>
    </div>
    <!-- Akhir konten -->
    <!-- Footer -->
	<footer class="footer">
      <div class="container">
        <span class="text-muted">&copy; Yusuf Eka Wiraswastawan | 06.2017.1.90468 2020.</span>
      </div>
    </footer>
	<!-- Footer -->
</body>
<!-- JQuery -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- PropperJS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<!-- Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<!-- https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
<!-- momentJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.1"></script>
<!-- HammerJS -->
<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
<!-- plugin zoom ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.4"></script>

<script>
    function redirectPeriod()
    {
        var period = document.getElementById("period").value;
        return window.location = 'http://yusufeka.cvbensonshop.masuk.id/show.php?period='+period;     
    }
</script>

<script>
    //global variable
    //url periode training
    var get_url = window.location.href;
    //url sebagai string
    var url_string = new URL(get_url);
    //periode training dari berdasarkan parameter url
    var period = url_string.searchParams.get("period");
    //var eppoach = url_string.searchParams.get("eppoach");
    //link url json
    var url_json = 'http://yusufeka.cvbensonshop.masuk.id/json.php?period='+period;
    console.log(url_json)
    //variable target -> menyimpan data target dari json
    var target = [];
    //variable output -> menyimpan data output dari json
    var output = [];
    //variable date -> menyimpan data date dari json
    var date = [];
</script>

<script>
    //mengatur header judul program
    if(period<36 & period>0)
    {   
        //untuk periode data training
        document.getElementById("period-title").innerHTML = "Periode training ke "+period;
    }
    else if(period==37)
    {   
        //untuk standart training
        document.getElementById("period-title").innerHTML = "Offline training";
    }
    else if(period==38)
    {   
        //untuk periode data training
        document.getElementById("period-title").innerHTML = "Offline testing";
    }
	else if(period==0)
    {   
        //untuk periode data training
        document.getElementById("period-title").innerHTML = "Online training";
    }
    else
    {
        //untuk periode data testing
        document.getElementById("period-title").innerHTML = "Online testing";
    }
</script>

<script>
    //visualisasi data kedalam tabel
    $(document).ready(function () {
        var tables = $('#tabledisplay').DataTable({
            'ajax': {
                "type": "GET", 
                "url": url_json, //memanggul url json
                "dataSrc": function (json) {
                    var return_data = new Array();
                    //copy data json ke dalam array javascript
                    for (var i in json[1]) {
                        ii = 0;
                        return_data.push({
                            'id': json[1][i].id,
                            'date': json[1][i].date,
                            'x1': json[1][i].x1,
                            'x2': json[1][i].x2,
                            'x3': json[1][i].x3,
                            'target': json[1][i].target,
                            'output': json[1][i].output,
                        })
                    }
                    return return_data;
                }
            },
            //kolom yang akan ditampilkan dalam tabel
            "columns": [
                { 'data': 'id' },
                { 'data': 'date' },
                { 'data': 'x1' },
                { 'data': 'x2' },
                { 'data': 'x3' },
                { 'data': 'target' },
                { 'data': 'output' },
            ]
        });
    });
</script>
<script>
    //visualisasi data dalam bentuk grafik
    $(document).ready(function () {
        $.ajax({
            url: url_json, //dataset
            data: "",
            dataType: 'json',
            success: function (rows) {
                for (var i in rows[1]) {
                    date[i] = rows[1][i].date;
                    target[i] = rows[1][i].target;
                    output[i] = rows[1][i].output;
                }
            }
        });
        //menamppilkan grafik di canvas html
        var ctx = document.getElementById("chartdisplay");
        //proses menampilkan data dalam grafik
        var myChart = function () {
            new Chart(ctx, {
                type: 'line', //tipe grafik = garis
                //data yang ditampilkan dalam grafik
                data: {
                    labels: date, //menampilkan label tanggal dataset
                    datasets: [
                        //data output
                        //pengaturan garis grafik data output
                        {
                            label: '# output',
                            borderColor: "#1d7af3",
                            pointBorderColor: "#FFF",
                            pointBackgroundColor: "#1d7af3",
                            pointBorderWidth: 1,
                            pointHoverRadius: 2,
                            pointHoverBorderWidth: 1,
                            pointRadius: 2,
                            backgroundColor: 'transparent',
                            fill: true,
                            borderWidth: 1,
                            //borderDash: [10, 5],
                            lineTension: 0,
                            data: output
                        },
                        //data target
                        //pengaturan garis grafik data target
                        {
                            label: '# target',
                            borderColor: "#59d05d",
                            pointBorderColor: "#FFF",
                            pointBackgroundColor: "#59d05d",
                            pointBorderWidth: 1,
                            pointHoverRadius: 2,
                            pointHoverBorderWidth: 1,
                            pointRadius: 2,
                            backgroundColor: 'transparent',
                            fill: true,
                            borderWidth: 1,
                            lineTension: 0,
                            data: target
                        }
                    ],
                },
                //pengaturan grafik
                options: {
                    responsive: true, //grafik responsif
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                reverse: false,
                                beginAtZero: false
                            }
                        }]
                    },
                    //penempatan posisi legenda
                    legend: {
                        position: 'top',
                    },
                    //pengaturan tooltip
                    tooltips: {
                        bodySpacing: 4,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    //pengaturan tata letak
                    layout: {
                        padding: { left: 0, right: 0, top: 15, bottom: 15 }
                    },
                    //plugin zoom
                    plugins: {
                        zoom: {
                            // pengaturan pan
                            pan: {
                                // mengaktifkan mode pan
                                enabled: true,
                                //mode x y(vertical - horizontal)
                                mode: 'xy'
                            },

                            // pengaturan zoom
                            zoom: {
                                // mengaktifkan mode zoom
                                enabled: true,
                                //mode x y(vertical - horizontal)
                                mode: 'xy',
                                //kecepatan zoom
                                speed: 0.01
                            }
                        }
                    }
                }
            });
        }
        window.onload = myChart;
    });
</script>
<script>
    //menampilkan hasil pengukuran kesalahan (error measurement)
    $.getJSON(url_json, function(data) {    
        var text = "<tr>"
                    +"<th>eppoach</th>"
                    +"<td>"+data[0].eppoach+"</td>"
                    +"</tr>"
                    +"<tr>"
                    +"<th>MAD</th>"
                    +"<td>"+data[0].mad+"</td>"
                    +"</tr>"
                    +"<tr>"
                    +"<th>MSE</th>"
                    +"<td>"+data[0].mse+"</td>"
                    +"</tr>"
                    +"<tr>"
                    +"<th>MAPE</th>"
                    +"<td>"+data[0].mape+"</td>"
                    +"</tr>";
        $("#error").html(text);
    });
</script>
</html>