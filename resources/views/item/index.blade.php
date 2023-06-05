@extends('layouts.admin-panel')

@section('content')
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Item</h1>
  {{-- <p class="mb-4">List of all the Item available in our company.</p> --}}



  <a href="{{route('item.create')}}" class="btn btn-primary mb-4">Add A New Item</a>

  <button type="button"  class="btn btn-primary mb-4" data-toggle="modal" data-target="#importExcel">
    IMPORT EXCEL
  </button>
  <button hidden type="button"  class="btn btn-primary mb-4" data-toggle="modal" data-target="#importBidang">
    IMPORT BIDANG
  </button>
  <button hidden type="button"  class="btn btn-primary mb-4" data-toggle="modal" data-target="#importKelompok">
    IMPORT KELOMPOK
  </button>
  <button hidden type="button"  class="btn btn-primary mb-4" data-toggle="modal" data-target="#importJenis">
    IMPORT JENIS
  </button>

  <a href="{{route('item.export_excel')}}" class="btn btn-primary mb-4" target="_blank">EXPORT EXCEL</a>


    {{-- <input style="float: right" class="mb-4" type="text" name="daterange" value="" />
    <button style="float: right" class="btn btn-primary mb-4 filter">Filter</button> --}}

    {{-- <div style="float: right" class="d-sm-flex align-items-center justify-content-between mb-4"  > --}}
        <div class="input-group" >
        <input type="text" name="daterange"  class="mb-4">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary filter" value="Filter">Filter</button>
        </span>
        </div>
    {{-- </div> --}}



    <!-- Import Excel -->
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('item.import_excel')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>
                        <a href="{{ asset('template/template.xlsx')}}" class="float-right" download>Download Template</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Import Bidang -->
    <div class="modal fade" id="importBidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('item.import_bidang')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Bidang</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file1" required="required">
                        </div>
                        <a href="{{ asset('template/template.xlsx')}}" class="float-right" download>Download Template</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Import Kelompok -->
    <div class="modal fade" id="importKelompok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('item.import_kelompok')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Kelompok</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file2" required="required">
                        </div>
                        <a href="{{ asset('template/template.xlsx')}}" class="float-right" download>Download Template</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Import Jenis -->
    <div class="modal fade" id="importJenis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('item.import_jenis')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Jenis</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file3" required="required">
                        </div>
                        <a href="{{ asset('template/template.xlsx')}}" class="float-right" download>Download Template</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>

                </div>
            </form>

        </div>
    </div>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Item Datatable</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Transaction" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              {{-- <th>Name</th> --}}
              <th>jumlah pengajuan</th>
              <th>tanggal</th>
              <th>approval status</th>
              <th>User</th>
              <th>Unit</th>
              <th>Tipe</th>
              <th>Jenis Transaksi</th>
              <th>Bidang</th>
              <th>Kelompok</th>
              <th>Jenis</th>
              <th>Type</th>
              <th>Bulan</th>
              <th>Kode Barang</th>
              <th>actions</th>
            </tr>
          </thead>

        </table>
      </div>
    </div>
  </div>

</div>

@endsection

@push('js')
<script>
//   $('#dataTable').dataTable({
//   processing:true,
//   serverSide:true,
//   ajax:"{{route('item.all')}}",
//     columns:[
//       {data:'id'},
//     //   {data:'name'},
//       {data:'qty'},
//       {data:'input_date'},
//       {data:'approval_status'},
//       {data:'user'},
//       {data:'unit'},
//       {data:'tipe'},
//       {data:'jenis_transaksi'},
//       {data:'bidang'},
//       {data:'kelompok'},
//       {data:'jenis'},
//       {data:'type'},
//       {data:'bulan'},
//       {data:'kode_barang'},
//       {data:'actions',orderable:false,searchable:false},
//     ]
//   });

  $(function () {

    $('input[name="daterange"]').daterangepicker({
        startDate: moment().subtract(1, 'M'),
        endDate: moment(),
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

    var table = $('.datatable-Transaction').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('item.all') }}",
            data:function (d) {
                d.from_date = $('input[name="daterange"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
                d.to_date = $('input[name="daterange"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
        },
        columns: [
            {data:'id'},
            //   {data:'name'},
            {data:'qty'},
            {data:'input_date'},
            {data:'approval_status'},
            {data:'user'},
            {data:'unit'},
            {data:'tipe'},
            {data:'jenis_transaksi'},
            {data:'bidang'},
            {data:'kelompok'},
            {data:'jenis'},
            {data:'type'},
            {data:'bulan'},
            {data:'kode_barang'},
            {data:'actions',orderable:false,searchable:false},
        ]
    });

    $(".filter").click(function(){
        table.draw();
    });

  });



</script>
@endpush
