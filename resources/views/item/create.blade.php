@extends('layouts.admin-panel')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Adding a new Item</h1>
  <form action="{{route('item.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">

      <div class="col-lg-6">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enter the Item details</h6>
          </div>
          <div class="card-body">
            @if($errors->any())
              <div class="alert alert-danger">
                {{ implode('', $errors->all(':message')) }}
              </div>
            @endif
              <div class="form-group">
                <label for="">Name of the PIC</label>
                <input type="text" class="form-control form-control-user" @error('name') is-invalid @enderror value="{{old('bus_name')}}"  name="name" placeholder="Enter name ..."   autocomplete="name" autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Bulan</label>
                <input type="text" class="form-control form-control-user" @error('bulan') is-invalid @enderror  name="bulan" placeholder="bulan" value="{{old('bulan')}}"   >
                @error('bulan')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control form-control-user" @error('input_date') is-invalid @enderror value="{{old('input_date')}}"  name="input_date" placeholder="tanggal"   >
                @error('input_date')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Approval Status</label>
                <input type="text" class="form-control form-control-user" @error('approval_status') is-invalid @enderror  name="approval_status" value="{{old('approval_status')}}" placeholder="approval_status"   >
                @error('approval_status')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Jumlah Pengajuan</label>
                <input type="number" class="form-control form-control-user" @error('qty') is-invalid @enderror value="{{old('qty')}}"  name="qty" placeholder="qty ..."  >
                @error('qty')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              {{-- <div class="form-group">
                <label for="">User</label>
                <input type="text" class="form-control form-control-user" @error('user') is-invalid @enderror  name="user" value="{{old('user')}}" placeholder="user"   >
                @error('user')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Unit</label>
                <input type="text" class="form-control form-control-user" @error('unit') is-invalid @enderror  name="unit" placeholder="unit" value="{{old('unit')}}"   >
                @error('unit')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div> --}}

              <div class="form-group">
                <label for="selectOption">User</label>
                {{-- <select class="form-control" id="selectOption" name="user">
                    <option value="">-- Pilih User --</option>
                    <option value="UKFS_MAKER_PD_1003">UKFS_MAKER_PD_1003</option>
                    <option value="UKFS_MAKER_PD_1001">UKFS_MAKER_PD_1001</option>
                    <option value="UKFS_MAKER_PD_1007">UKFS_MAKER_PD_1007</option>
                </select> --}}
                <select name="user" class="form-control" id="selectOption">
                    <option value="">-- Select User --</option>
                    @foreach ($userf as $data)
                        <option value="{{$data->userf_number}}">
                            {{$data->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="inputAutoFill">Unit</label>
                <input type="text" class="form-control" id="inputAutoFill" name="unit" readonly>
            </div>




            </div>

            <hr>

            {{-- <div class="card-body">
            <p class="text-primary">Additional details</p>






          </div> --}}
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enter Item Details</h6>
          </div>
          <div class="card-body">

            <div class="form-group">
                <label for="">Tipe</label>
                {{-- <input type="text" class="form-control form-control-user" @error('tipe') is-invalid @enderror  name="tipe" placeholder="tipe" value="{{old('tipe')}}"   > --}}
                <select value="{{old('tipe')}}" name="tipe" class="form-control form-control-user" @error('tipe') is-invalid @enderror  placeholder="Tipe"  >
                    <option value="">-- Select Tipe --</option>
                    <option value="Barang">Barang</option>
                    <option value="Jasa">Jasa</option>
                </select>
                @error('tipe')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Jenis Transaksi</label>
                {{-- <input type="text" class="form-control form-control-user" @error('jenis_transaksi') is-invalid @enderror  name="jenis_transaksi" placeholder="jenis_transaksi" value="{{old('jenis_transaksi')}}"   > --}}
                <select value="{{old('jenis_transaksi')}}" name="jenis_transaksi" class="form-control form-control-user" @error('jenis_transaksi') is-invalid @enderror  placeholder="Jenis Transaksi"  >
                    <option value="">-- Select Jenis Transaksi --</option>
                    <option value="Usulan Baru">Usulan Baru</option>
                    <option value="Reject">Reject</option>
                </select>
                @error('jenis_transaksi')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Kode Barang</label>
                <input type="text" class="form-control form-control-user" @error('kode_barang') is-invalid @enderror  name="kode_barang" placeholder="kode_barang" value="{{old('kode_barang')}}"   >
                @error('kode_barang')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              {{-- <div class="form-group">
                <label for="">Bidang</label>
                <input type="text" class="form-control form-control-user" @error('bidang') is-invalid @enderror  name="bidang" placeholder="bidang" value="{{old('bidang')}}"   >
                @error('bidang')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Kelompok</label>
                <input type="text" class="form-control form-control-user" @error('kelompok') is-invalid @enderror  name="kelompok" placeholder="kelompok" value="{{old('kelompok')}}"   >
                @error('kelompok')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Jenis</label>
                <input type="text" class="form-control form-control-user" @error('jenis') is-invalid @enderror  name="jenis" placeholder="jenis" value="{{old('jenis')}}"   >
                @error('jenis')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div> --}}

              <div class="form-group mb-3">
                <label class="form-control-label" for="bidang">Bidang</label>
                <select  id="bidang-dropdown" name="bidang" class="form-control">
                    <option value="">-- Select Bidang --</option>
                    @foreach ($bidang as $data)
                        <option value="{{$data->value_bidang}}">
                            {{$data->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-control-label" for="kelompok">Kelompok</label>
                <select id="kelompok-dropdown" name="kelompok" class="form-control">
                </select>
            </div>
            <div class="form-group">
                <label class="form-control-label" for="jenis">Jenis</label>
                <select id="jenis-dropdown" name="jenis" class="form-control">
                </select>
            </div>

              <div class="form-group">
                <label for="">Type</label>
                {{-- <input type="text" class="form-control form-control-user" @error('type') is-invalid @enderror  name="type" placeholder="type" value="{{old('type')}}"   > --}}
                <select value="{{old('type')}}" name="type" class="form-control form-control-user" @error('type') is-invalid @enderror  placeholder="Type"  >
                    <option value="">-- Select Type --</option>
                    <option value="ITB Asset Item">ITB Asset Item</option>
                    <option value="ITB Inventory Item">ITB Inventory Item</option>
                    <option value="ITB Expense Item">ITB Expense Item</option>
                    </select>
                @error('type')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </div>
      </div>

    </div>
  </form>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {

        $('#bidang-dropdown').on('change', function () {
            var bidang = this.value;
            //var bidang = $('select[name="bidang"]').val();
            $("#kelompok-dropdown").html('');
            $.ajax({
                url: "{{ route('item.fetch-kelompok') }}",
                type: "POST",
                data: {
                    valuee_bidang: bidang,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#kelompok-dropdown').html('<option value="">-- Select Kelompok --</option>');
                    $.each(result.kelompok, function (key, value) {
                        // $("#kelompok-dropdown").append('<option value="' + value
                        //     .id + '">' + value.name + '</option>');
                        $("#kelompok-dropdown").append('<option value="' + value.value_kelompok + '">' + value.name + '</option>');
                        // $("#kelompok-dropdown").append('<option name="kelompok_id" value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#jenis-dropdown').html('<option value="">-- Select Jenis --</option>');
                }
            });
        });



        $('#kelompok-dropdown').on('change', function () {
            var idKelompok = this.value;
            $("#jenis-dropdown").html('');
            $.ajax({
                url: "{{ route('item.fetch-jenis') }}",
                type: "POST",
                data: {
                    valuee_kelompok: idKelompok,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#jenis-dropdown').html('<option value="">-- Select Jenis --</option>');
                    $.each(res.jenis, function (key, value) {
                        $("#jenis-dropdown").append('<option value="' + value
                            .value_jenis + '">' + value.name + '</option>');
                    });
                }
            });
        });
        });

        $(document).ready(function(){
        $('#selectOption').change(function(){
            var selectedOption = $(this).val();

            $.ajax({
                url: '{{ route("item.get-data") }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'selectedOption': selectedOption
                },
                success: function(response) {
                    // Isi kolom berikutnya dengan data yang diterima dari server
                    $('#inputAutoFill').val(response.data);
                }
            });
        });
});
</script>

