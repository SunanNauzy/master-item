@extends('layouts.admin-panel')

@section('content')
<div style="overflow-y:scroll" class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <form action="" id="filtersForm">
                <div class="input-group">
                <input type="text" name="from-to" class="form-control mr-2" id="date_filter">
                <span class="input-group-btn">
                    <input type="submit" class="btn btn-primary" value="Filter">
                </span>
                </div>
            </form>
  </div>


  <!-- Content Row -->

  <div style="width: 2500px; " class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Bar Chart Jumlah Pengajuan Per Bidang</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
    </div>
      </div>
    </div>

  <div style="width: 2500px" class="row">
    <div class="col-xl-8 col-lg-7" >
        <div class="card shadow mb-4" >
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pie Chart Jumlah Pengajuan Per Tipe Item</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myPieChart1"></canvas>
            </div>
          </div>
      </div>
        </div>
    </div>

    <div style="width: 2500px" class="row">
        <div class="col-xl-8 col-lg-7" >
            <div class="card shadow mb-4" >
              <!-- Card Header - Dropdown -->
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pie Chart Jumlah Pengajuan Per Jenis Transaksi</h6>
              </div>
              <!-- Card Body -->
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="myPieChart"></canvas>
                </div>
              </div>
          </div>
            </div>
        </div>

        <div style="width: 2500px;" class="row">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Bar Chart Jumlah Pengajuan Per Unit</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart1"></canvas>
                  </div>
                </div>
            </div>
              </div>
            </div>


            <!-- The Modal -->
            {{-- <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-body"></div>
                </div>
            </div> --}}

</div>



{{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div> --}}

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalContent"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js" integrity="sha512-PzUUEHvq8mLGKd6UHXZpVx9IcR8PVUW47LnU/c3zUJszIcL8SgS71T87hMkGj9WrB4DyQWzTqtQU7VJHrGBtQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-5oXkSWq3KEO6+FX5PxODQvZIMLgGQrHt+28EzQHEJklcYj58PbZOyDEHVEtDkA+N" crossorigin="anonymous"></script> --}}
<!-- Pastikan library jQuery dimuat sebelum Bootstrap -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Pastikan library Bootstrap dimuat setelah jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Pastikan stylesheet Bootstrap dimuat dalam tag <head> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}

@push('js')


<script>

var tipe = [];
var total = [];
var bidang = [];
var total1 = [];
var jenis_transaksi = [];
var total2 = [];
var unit = [];
var total3 = [];
var jenis = [];

var result =[];


@foreach ($totalBuyerPurchases as $totalBuyerPurchase)
    tipe.push('{{$totalBuyerPurchase->tipe}}');
    total.push('{{$totalBuyerPurchase->total}}');
@endforeach
@foreach ($totalbidang as $totalbidang)
    bidang.push('{{$totalbidang->bidang}}');
    total1.push('{{$totalbidang->total}}');
@endforeach
@foreach ($totaljtransaksi as $totaljtransaksi)
    jenis_transaksi.push('{{$totaljtransaksi->jenis_transaksi}}');
    total2.push('{{$totaljtransaksi->total}}');
@endforeach
@foreach ($totalunit as $totalunit)
    unit.push('{{$totalunit->unit}}');
    total3.push('{{$totalunit->total}}');
@endforeach
@foreach ($totaljenis as $jenis)
    jenis.push('{{$jenis}}');
@endforeach


// Pie Chart Example


var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: jenis_transaksi,
    datasets: [{
      data: total2,
      backgroundColor: getRandomColor(),
      //hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      //hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    //cutoutPercentage: 80,
  },
});

var ctx1 = document.getElementById("myPieChart1");
var myPieChart = new Chart(ctx1, {
  type: 'pie',
  data: {
    labels: tipe,
    datasets: [{
      data: total,
      backgroundColor: getRandomColor(),
      //hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      //hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    //cutoutPercentage: 80,
  },
});

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

function getRandomColor() { //generates random colours and puts them in string
  var colors = [];
  for (var i = 0; i < 50; i++) {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var x = 0; x < 6; x++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    colors.push(color);
  }
  return colors;
}

// Area Chart Example
var ctx2 = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: bidang,
    datasets: [{
      label: 'Total',
      //lineTension: 0.3,
      backgroundColor: getRandomColor(),
      data: total1,

    }],

  },
  options: {
    maintainAspectRatio: false,
    // layout: {
    //   padding: {
    //     left: 10,
    //     right: 25,
    //     top: 25,
    //     bottom: 0
    //   }
    // },
    scales: {
      xAxes: [{

        gridLines: {
          display: false,
          drawBorder: false
        },

      }],
      yAxes: [{
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      //titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      //borderWidth: 1,
      //xPadding: 15,
     // yPadding: 15,
      //displayColors: false,
      //intersect: false,
      //mode: 'index',
      //caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    },
    // onClick: function(e) {
    // var activePoints = myLineChart.getElementsAtEvent(e);
    // if (activePoints && activePoints.length > 0) {
    //     var selectedIndex = activePoints[0]._index;
    //     var selectedBidang = bidang[selectedIndex];
    //     var selectedTotal = total1[selectedIndex];
    //     var selectedJenis = jenis[selectedIndex];
    //     var selectedTotalJenis = totaljenis[selectedIndex];

        // // Ensure that selectedJenis and selectedTotalJenis are arrays
        // if (Array.isArray(selectedJenis) && Array.isArray(selectedTotalJenis)) {
        //     // Initialize DataTable
        //     var table = $('#myDataTable').DataTable({
        //         // DataTable configuration options
        //         paging: true,
        //         searching: true,
        //         processing: true,
        //         serverSide: true,
        //         // ...
        //     });

        //     // Clear existing data from the DataTable
        //     table.clear().draw();

        //     // Add data to the DataTable
        //     for (var i = 0; i < selectedJenis.length; i++) {
        //         table.row.add([selectedJenis[i], selectedTotalJenis[i]]).draw(false);
        //     }
        // }
        // $('#myModal').modal('show');
        // $('.modal-body').html("Unit: " + selectedTotalJenis + "<br>" + "Total: " + selectedTotal);






        //     // Create a new canvas element for the chart inside the modal
        //     var modalCanvas = document.getElementById("myAreaChart21");

        //     // Get the existing chart instance on the modal canvas
        //     var modalChart = modalCanvas.chart;

        //     // Check if the chart exists and destroy it
        //     if (modalChart) {
        //     modalChart.destroy();
        //     }

        //     // Initialize the new chart on the modal canvas
        //     modalChart = new Chart(modalCanvas, {
        //     type: 'bar',
        //     data: {
        //         labels: jenis,
        //         datasets: [{
        //         label: 'Total',
        //         backgroundColor: getRandomColor(),
        //         data: totaljenis,
        //         }],
        //     },
        //     options: {
        //         maintainAspectRatio: false,
        //         scales: {
        //         xAxes: [{
        //             gridLines: {
        //             display: false,
        //             drawBorder: false
        //             },
        //         }],
        //         yAxes: [{
        //             gridLines: {
        //             color: "rgb(234, 236, 244)",
        //             zeroLineColor: "rgb(234, 236, 244)",
        //             drawBorder: false,
        //             borderDash: [2],
        //             zeroLineBorderDash: [2]
        //             }
        //         }],
        //         },
        //         legend: {
        //         display: false
        //         },
        //         tooltips: {
        //         backgroundColor: "rgb(255,255,255)",
        //         bodyFontColor: "#858796",
        //         titleFontColor: '#6e707e',
        //         titleFontSize: 14,
        //         borderColor: '#dddfeb',
        //         callbacks: {
        //             label: function(tooltipItem, chart) {
        //             var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
        //             return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        //             }
        //         }
        //         }
        //     }
        //     });

        //     // Show the modal
        //     $('#myModal').modal('show');
        // }
        // Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        // Chart.defaults.global.defaultFontColor = '#858796';

        // function number_format(number, decimals, dec_point, thousands_sep) {
        // // *     example: number_format(1234.56, 2, ',', ' ');
        // // *     return: '1 234,56'
        // number = (number + '').replace(',', '').replace(' ', '');
        // var n = !isFinite(+number) ? 0 : +number,
        //     prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        //     sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        //     dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        //     s = '',
        //     toFixedFix = function(n, prec) {
        //     var k = Math.pow(10, prec);
        //     return '' + Math.round(n * k) / k;
        //     };
        // // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        // s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        // if (s[0].length > 3) {
        //     s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        // }
        // if ((s[1] || '').length < prec) {
        //     s[1] = s[1] || '';
        //     s[1] += new Array(prec - s[1].length + 1).join('0');
        // }
        // return s.join(dec);
        // }
        // }}

  }
});

// // Saat mengklik bar chart
// myLineChart.options.onClick = function(e) {
//     var activePoints = myLineChart.getElementsAtEvent(e);
//     if (activePoints && activePoints.length > 0) {
//         var selectedIndex = activePoints[0]._index;
//         var selectedBidang = bidang[selectedIndex];
//         var selectedTotal = total1[selectedIndex];
//         var selectedJenis = jenis[selectedIndex];
//         var selectedTotalJenis = totaljenis[selectedIndex];

//         // Memperbarui konten modal dengan hasil query
//         var modalContent = $('#modalContent');
//         modalContent.empty(); // Menghapus konten sebelumnya

//         // Loop melalui hasil query $totaljenis
//         $.each(@json($totaljenis), function(index, item) {
//             // Membuat elemen baru untuk setiap item
//             var newItem = $('<p>').text('Jenis: ' + item.lowjenis + ', Total: ' + item.total);

//             // Menambahkan elemen baru ke dalam modal content
//             modalContent.append(newItem);
//         });

//         // Menampilkan modal
//         $('#myModal').modal('show');
//     }
// };
// // Saat mengklik bar chart
// myLineChart.options.onClick = function(e) {
//     var activePoints = myLineChart.getElementsAtEvent(e);
//     if (activePoints && activePoints.length > 0) {
//         var selectedIndex = activePoints[0]._index;
//         var selectedBidang = bidang[selectedIndex];
//         var selectedTotal = total1[selectedIndex];
//         var selectedJenis = jenis[selectedIndex];
//         var selectedTotalJenis = totaljenis[selectedIndex];

//         // Memperbarui konten modal dengan hasil query
//         var modalContent = $('#modalContent');
//         modalContent.empty(); // Menghapus konten sebelumnya

//         // Loop melalui hasil query $totaljenis
//         $.each(@json($totaljenis), function(index, item) {
//             // Membuat elemen baru untuk setiap item
//             var newItem = $('<p>').text('Jenis: ' + item.lowjenis + ', Total: ' + item.total);

//             // Menambahkan elemen baru ke dalam modal content
//             modalContent.append(newItem);
//         });

//         // Menampilkan modal
//         $('#myModal').modal('show');
//     }
// };
// Saat mengklik bar chart
let dateInterval;
myLineChart.options.onClick = function(e) {
    var activePoints = myLineChart.getElementsAtEvent(e);
    if (activePoints && activePoints.length > 0) {
        var selectedIndex = activePoints[0]._index;
        var selectedBidang = bidang[selectedIndex];
        var selectedTotal = total1[selectedIndex];
        var selectedJenis = jenis;
        // var selectedTotalJenis = total_jenis[selectedIndex];
        // console.log(selectedJenis);

        if (selectedJenis === undefined) {
            return;
        }

        // Mengirim permintaan AJAX ke query controller
            $.ajax({
            url: "{{route ('admin.dataget') }}",
            type: 'GET',
            data: {
                selectedBidang: selectedBidang,
                'from-to': dateInterval ? dateInterval.join(' - ') : null,
                // console.log(selectedBidangs);
            },
            // datatype: 'json',
            success: function(response) {
                // Menghandle respons dari query controller
                // Lakukan tindakan sesuai kebutuhan, seperti memperbarui modal dengan hasil query
                // Memperbarui konten modal dengan hasil query
                var modalContent = $('#modalContent');
                modalContent.empty(); // Menghapus konten sebelumnya

                // var table = $('<table>').attr('id', 'dataTable').addClass('display');
                // modalContent.append(table);


                // Loop melalui hasil query $totaljenis
                //$.each(@json($totaljenis), function(index, item) {
                    // Membuat elemen baru untuk setiap item
                    // var newItem = $('<p>').text('Jenis: ' + selectedJenis);
                    // var newItem1 = $('<p>').text('Total: '+ selectedTotalJenis);
                    // // console.log('Nilai selectedBidang:', selectedBidang);
                    // console.log(newItem);
                    // console.log(newItem1);
                    // // Menambahkan elemen baru ke dalam modal content
                    // modalContent.append(newItem);
                    // modalContent.append(newItem1);
                    // var newItem = $('<p>').text('Jenis: ' + selectedJenis);
                    // var newItem1 = $('<p>').text('Total: ' + selectedTotalJenis);
                    // ...

                    for (var i = 0; i < response.length; i++) {
                    var newItem = $('<p>').text('Jenis: ' + response[i]);
                    modalContent.append(newItem);
                }
                console.log(response[i]);

                //     modalContent.append(newItem);
                //     // modalContent.append(newItem1);
                //     console.log(newItem);
                //     // console.log(newItem1);
                // //});
                // console.log(selectedBidang);
                // var dataTable = $('#dataTable').DataTable({
                //     data: response,
                //     columns: [
                //         { title: 'Jenis', data: selectedJenis },
                //         { title: 'Total', data: selectedTotalJenis }

                //     ]
                // });

                // var tableData = [];
                // for (var i = 0; i < selectedJenis.length; i++) {
                //     tableData.push([selectedJenis[i], selectedTotalJenis[i]]);
                // }

                // // Clear modal content
                // var modalContent = $('#modalContent');
                // modalContent.empty();

                // // Create DataTable
                // var table = $('<table>').attr('id', 'dataTable').addClass('display');
                // modalContent.append(table);

                // var dataTable = $('#dataTable').DataTable({
                //     data: tableData,
                //     columns: [
                //         { title: 'Jenis', data: 0 },
                //         { title: 'Total', data: 1 }
                //     ]
                // });

                // console.log(selectedJenis);

            },
            error: function(xhr, status, error) {
                // Menghandle error jika terjadi
                console.error(error);
            }
            });




        // // Menampilkan modal
        $('#myModal').modal('show');

    //     $.ajax({
    //     url: '/getModalData', // Replace with your endpoint URL
    //     type: 'GET',
    //     data: {
    //       bidang: selectedBidang, // Pass any necessary parameters
    //       jenis: selectedJenis
    //     },
    //     success: function(response) {
    //       // Populate the table with the data returned from the server
    //       $('#myDataTable').html(response);
    //     },
    //     error: function(xhr, status, error) {
    //       console.log(error); // Handle the error accordingly
    //     }
    //   });
    }
};


var canvas = document.getElementById("myAreaChart1");
var ctx3 = canvas.getContext('2d');
var myLineChart1 = new Chart(ctx3, {
  type: 'bar',
  data: {
    labels: unit,
    datasets: [{
      label: 'Total',
      //lineTension: 0.3,
      backgroundColor: getRandomColor(),
      data: total3,

    }],

  },
  options: {
    maintainAspectRatio: false,
    scales: {
      xAxes: [{

        gridLines: {
          display: false,
          drawBorder: false
        },

      }],
      yAxes: [{
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      //titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      //borderWidth: 1,
      //xPadding: 15,
     // yPadding: 15,
      //displayColors: false,
      //intersect: false,
      //mode: 'index',
      //caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    }

  }
});

myLineChart1.options.onclick = function(e) {
    //var activePoints = myLineChart.getElementsAtEvent(evt);
    var activePoints = myLineChart1.getElementsAtEvent(e);
    if (activePoints.length > 0) {
        var selectedIndex = activePoints[0]._index;
        var selectedUnit = unit[selectedIndex];
        var selectedTotal = total3[selectedIndex];
        // var selectedJenis = jenis[selectedIndex];


        // Tampilkan modal dengan data yang sesuai
        $('#myModal').modal('show');
        $('.modal-body').html("Unit: " + selectedUnit + "<br>" + "Total: " + selectedTotal);

    }
};



// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

    $(function () {
  let searchParams = new URLSearchParams(window.location.search)
  dateInterval = searchParams.get('from-to');
  let start = moment().subtract(29, 'days');
  let end = moment();

  if (dateInterval) {
      dateInterval = dateInterval.split(' - ');
      start = dateInterval[0];
      end = dateInterval[1];
  }

  $('#date_filter').daterangepicker({
      "showDropdowns": true,
      "showWeekNumbers": true,
      "alwaysShowCalendars": true,
      startDate: start,
      endDate: end,
      locale: {
          format: 'YYYY-MM-DD',
          firstDay: 1,
      },
      ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'This Year': [moment().startOf('year'), moment().endOf('year')],
          'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
          'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
      }
  });

  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
      url: "{{ route('admin.dashboard') }}",
      data: {
        'from-to': searchParams.get('from-to'),
      }
    },

  };




  $('.datatable-Transaction').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});







</script>






@endpush


