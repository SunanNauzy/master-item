@extends('layouts.admin-panel')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Updating item</h1>
  <form action="{{route('item.update',['id'=>$item->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">

      <div class="col-lg-6">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enter the item details</h6>
          </div>
          <div class="card-body">
            @if($errors->any())
              <div class="alert alert-danger">
                {{ implode('', $errors->all(':message')) }}
              </div>
            @endif
              <div class="form-group">
                <label for="">Name of the PIC</label>
                <input type="text" value="{{$item->name}}" class="form-control form-control-user" @error('name') is-invalid @enderror  name="name" placeholder="Enter name ..."   autocomplete="name" autofocus>
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>

              <div class="form-group">
                <label for="">Bulan</label>
                <input type="text"  value="{{$item->bulan}}" class="form-control form-control-user" @error('bulan') is-invalid @enderror  name="bulan" placeholder="bulan"   >
                @error('bulan')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date"  value="{{$item->input_date}}" class="form-control form-control-user" @error('input_date') is-invalid @enderror  name="input_date" placeholder="Tanggal"   >
                @error('input_date')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Approval Status</label>
                <input type="text"  value="{{$item->approval_status}}" class="form-control form-control-user" @error('approval_status') is-invalid @enderror  name="approval_status" placeholder="Approval Status"   >
                  @error('approval_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>

              <div class="form-group">
                <label for="">Jumlah Pengajuan</label>
                <input type="number"  value="{{$item->qty}}" class="form-control form-control-user" @error('qty') is-invalid @enderror  name="qty" placeholder="Jumlah Pengajuan ..."  >
                @error('qty')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              {{-- <div class="form-group">
                <label for="">User</label>
                <input type="text" value="{{$item->user}}" class="form-control form-control-user" @error('user') is-invalid @enderror  name="user" placeholder="User"   >
                @error('user')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Unit</label>
                <input type="text"  value="{{$item->unit}}" class="form-control form-control-user" @error('unit') is-invalid @enderror  name="unit" placeholder="unit"   >
                @error('unit')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div> --}}

              <div class="form-group">
                <label for="selectOption">User</label>
                <select name="user" class="form-control" id="selectOption">
                    <option value="">-- Select User --</option>
                    @foreach ($userf as $data)
                        <option value="{{$data->userf_number}}" {{ $item->user == $data->userf_number ? 'selected' : '' }}>
                            {{$data->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="inputAutoFill">Unit</label>
                <input type="text" value="{{$item->unit}}" class="form-control" id="inputAutoFill" name="unit" readonly>
            </div>

            <hr>

          <div class="card-body">
            {{-- <p class="text-primary">Additional details</p> --}}

          </div>
        </div>
      </div>



    </div>

          <div class="col-lg-6">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enter The Item Details</h6>
          </div>
          <div class="card-body">

            <div class="form-group">
                <label for="">Tipe</label>
                {{-- <input type="text"  value="{{$item->tipe}}" class="form-control form-control-user" @error('tipe') is-invalid @enderror  name="tipe" placeholder="tipe"   > --}}
                <select value="{{old('tipe')}}" name="tipe" class="form-control form-control-user" @error('tipe') is-invalid @enderror  placeholder="Tipe"  >
                    <option value="">-- Select Tipe --</option>
                    <option value="Barang" {{ $item->tipe == 'Barang' ? 'selected' : '' }}>Barang</option>
                    <option value="Jasa" {{ $item->tipe == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                </select>
                                @error('tipe')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Jenis Transaksi</label>
                <input type="text"  value="{{$item->jenis_transaksi}}" class="form-control form-control-user" @error('jenis_transaksi') is-invalid @enderror  name="jenis_transaksi" placeholder="jenis_transaksi"   >
                @error('jenis_transaksi')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Kode Barang</label>
                <input type="text"  value="{{$item->kode_barang}}" class="form-control form-control-user" @error('kode_barang') is-invalid @enderror  name="kode_barang" placeholder="kode_barang"   >
                @error('kode_barang')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              {{-- <div class="form-group">
                <label for="">Bidang</label>
                <input type="text"  value="{{$item->bidang}}" class="form-control form-control-user" @error('bidang') is-invalid @enderror  name="bidang" placeholder="bidang"   >
                @error('bidang')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Kelompok</label>
                <input type="text"  value="{{$item->kelompok}}" class="form-control form-control-user" @error('kelompok') is-invalid @enderror  name="kelompok" placeholder="kelompok"   >
                @error('kelompok')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Jenis</label>
                <input type="text"  value="{{$item->jenis}}" class="form-control form-control-user" @error('jenis') is-invalid @enderror  name="jenis" placeholder="jenis"   >
                @error('jenis')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div> --}}

              {{-- <div class="form-group mb-3">
                <label class="form-control-label" for="bidang">Bidang</label>
                <select  id="bidang-dropdown" name="bidang" class="form-control">
                    <option value="{{$item->bidang}}">-- Select Bidang --</option>
                    @foreach ($bidang as $data)
                        <option value="{{$data->id}}">
                            {{$data->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-control-label" for="kelompok">Kelompok</label>
                <select id="kelompok-dropdown" value="{{$item->kelompok}}" name="kelompok" class="form-control">
                </select>
            </div>
            <div class="form-group">
                <label class="form-control-label" for="jenis">Jenis</label>
                <select id="jenis-dropdown" value="{{$item->jenis}}" name="jenis" class="form-control">
                </select>
            </div> --}}

            <div class="form-group mb-3">
                <label class="form-control-label" for="bidang">Bidang</label>
                {{-- <input readonly type="text"  value="{{$item->bidang}}" class="form-control form-control-user" @error('bidang') is-invalid @enderror  name="" placeholder="bidang"   > --}}
                @error('bidang')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <select id="bidang-dropdown" name="bidang" class="form-control">
                    <option value="">-- Select Bidang --</option>
                    @foreach ($bidang as $data)
                    {{-- value="{{$data->userf_number}}" {{ $item->user == $data->userf_number ? 'selected' : '' }} --}}
                        <option value="{{ $data->value_bidang }}" {{ $item->bidang == $data->name ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-control-label" for="kelompok">Kelompok</label>
                {{-- <input readonly type="text"  value="{{$item->kelompok}}" class="form-control form-control-user" @error('kelompok') is-invalid @enderror  name="" placeholder="kelompok"   > --}}
                @error('kelompok')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <select id="kelompok-dropdown" name="kelompok" class="form-control">
                    {{-- <option value="">-- Select Kelompok --</option>
                    @foreach ($kelompok as $key => $value)
                        <option value="{{ $key }}" {{ $key == $selected_kelompok ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach --}}
                    <option value="">-- Select Kelompok --</option>
                    @foreach ($kelompoks as $data)
                    {{-- value="{{$data->userf_number}}" {{ $item->user == $data->userf_number ? 'selected' : '' }} --}}
                        <option value="{{ $data->value_kelompok }}" {{ $item->kelompok == $data->name ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-control-label" for="jenis">Jenis</label>
                {{-- <input readonly type="text"  value="{{$item->jenis}}" class="form-control form-control-user" @error('jenis') is-invalid @enderror  name="" placeholder="jenis"   > --}}
                @error('jenis')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <select id="jenis-dropdown" name="jenis" class="form-control">
                    {{-- <option value="">-- Select Jenis --</option>
                    @foreach ($jenis as $key => $value)
                        <option value="{{ $key }}" {{ $key == $selected_jenis ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach --}}
                    <option value="">-- Select Jenis --</option>
                    @foreach ($jeniss as $data)
                    {{-- value="{{$data->userf_number}}" {{ $item->user == $data->userf_number ? 'selected' : '' }} --}}
                        <option value="{{ $data->value_jenis }}" {{ $item->jenis == $data->name ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="form-group mb-3">
                <label class="form-control-label" for="kelompok">Kelompok</label>
                <select id="kelompok-dropdown" name="kelompok" class="form-control">
                    <option value="">-- Select Kelompok --</option>
                    @foreach ($kelompok as $key => $value)
                        <option value="{{ $key }}" {{ $key == $item->kelompok ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-control-label" for="jenis">Jenis</label>
                <select id="jenis-dropdown" name="jenis" class="form-control">
                    <option value="">-- Select Jenis --</option>
                    @foreach ($jenis as $key => $value)
                        <option value="{{ $key }}" {{ $key == $item->jenis ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div> --}}


              <div class="form-group">
                <label for="">Type</label>
                {{-- <input type="text"  value="{{$item->type}}" class="form-control form-control-user" @error('type') is-invalid @enderror  name="type" placeholder="type"   >
                @error('type')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror --}}
                {{-- <select value="{{old('type')}}" name="type" class="form-control form-control-user" @error('type') is-invalid @enderror  placeholder="Type"  >
                    <option value="">-- Select Type --</option>
                    <option value="ITB Asset Item">ITB Asset Item</option>
                    <option value="ITB Inventory Item">ITB Inventory Item</option>
                    <option value="ITB Expense Item">ITB Expense Item</option>
                </select> --}}
                <select name="type" class="form-control form-control-user @error('type') is-invalid @enderror" placeholder="Type">
                    <option value="">-- Select Type --</option>
                    <option value="ITB Asset Item" {{ $item->type == 'ITB Asset Item' ? 'selected' : '' }}>ITB Asset Item</option>
                    <option value="ITB Inventory Item" {{ $item->type == 'ITB Inventory Item' ? 'selected' : '' }}>ITB Inventory Item</option>
                    <option value="ITB Expense Item" {{ $item->type == 'ITB Expense Item' ? 'selected' : '' }}>ITB Expense Item</option>
                </select>

              </div>
              <button type="submit" class="btn btn-primary">Update</button>

            </form>
              <div class="d-flex flex-row-reverse">
                <form action="{{route('item.destroy',['id'=>$item])}}" method="post" class="right">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger" type="submit">Delete item</button>
                </form>
              </div>

          </div>

        </div>

      </div>

  </form>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script >
    $(document).ready(function () {

        $('#bidang-dropdown').on('change', function () {
           // var idBidang = this.value;

            var bidang = $('select[name="bidang"]').val();
            $("#kelompok-dropdown").html('');
            $.ajax({
                url: "{{ route('item.fetch-kelompok') }}",
                type: "POST",
                data: {
                    valuee_bidang: bidang,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                // success: function (result) {
                //     $('#kelompok-dropdown').html('<option value="">-- Select Kelompok --</option>');
                //     $.each(result.kelompok, function (key, value) {
                //         // $("#kelompok-dropdown").append('<option value="' + value
                //         //     .id + '">' + value.name + '</option>');
                //             // for ($bidang as $data){
                //             //     $("#kelompok-dropdown").append('<option value="' + value.value_kelompok + '" {{$item->kelompok == $data->name}}>' + value.name + '</option>');
                //             // }
                //             // <option value="{{ $data->value_bidang }}" {{ $item->bidang == $data->name ? 'selected' : '' }}>
                //             //     {{ $data->name }}
                //             // </option>
                //             $("#kelompok-dropdown").append('<option value="' + value.value_kelompok + '">' + value.name + '</option>');

                //         // $("#kelompok-dropdown").append('<option value="' + value.value_kelompok + '">' + value.name + '</option>');
                //         // $("#kelompok-dropdown").append('<option name="kelompok_id" value="' + value.id + '">' + value.name + '</option>');
                //     });
                //     $('#jenis-dropdown').html('<option value="">-- Select Jenis --</option>');
                // }
                success: function (result) {
                    $('#kelompok-dropdown').html('<option value="">-- Select Kelompok --</option>');
                    $.each(result.kelompok, function (key, value) {
                        var selected = "{{ $item->kelompok }}" == value.name ? 'selected' : '';
                        $("#kelompok-dropdown").append('<option value="' + value.value_kelompok + '" ' + selected + '>' + value.name + '</option>');
                    });
                    $('#jenis-dropdown').html('<option value="">-- Select Jenis --</option>');

                }
                // success: function (result) {
                //     $('#kelompok-dropdown').html('<option value="">-- Select Kelompok --</option>');
                //     $.each(result.kelompok, function (key, value) {
                //         var selected = "{{ $item->kelompok }}" == value.name ? 'selected' : '';
                //         $("#kelompok-dropdown").append('<option value="' + value.value_kelompok + '" ' + selected + '>' + value.name + '</option>');
                //     });
                //     $('#jenis-dropdown').html('<option value="">-- Select Jenis --</option>');
                // }

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
                    // $('#jenis-dropdown').html('<option value="">-- Select Jenis --</option>');
                    // $.each(res.jenis, function (key, value) {
                    //     $("#jenis-dropdown").append('<option value="' + value
                    //         .value_jenis + '">' + value.name + '</option>');
                    // });
                    $('#jenis-dropdown').html('<option value="">-- Select Jenis --</option>');
                    $.each(res.jenis, function (key, value) {
                        var selected = "{{ $item->jenis }}" == value.name ? 'selected' : '';
                        $("#jenis-dropdown").append('<option value="' + value.value_jenis + '" ' + selected + '>' + value.name + '</option>');
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

//     $(document).ready(function () {
//     $('#bidang-dropdown').on('change', function () {
//         var bidang = $('select[name="bidang"]').val();
//         $("#kelompok-dropdown").html('');
//         $.ajax({
//             url: "{{ route('item.fetch-kelompok') }}",
//             type: "POST",
//             data: {
//                 bidang_id: bidang,
//                 _token: '{{csrf_token()}}'
//             },
//             dataType: 'json',
//             success: function (result) {
//                 $('#kelompok-dropdown').html('<option value="">-- Select Kelompok --</option>');
//                 $.each(result.kelompok, function (key, value) {
//                     $("#kelompok-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
//                 });
//                 $('#jenis-dropdown').html('<option value="">-- Select Jenis --</option>');
//             }
//         });
//     });

//     $('#kelompok-dropdown').on('change', function () {
//         var kelompok = $('select[name="kelompok"]').val();
//         $("#jenis-dropdown").html('');
//         $.ajax({
//             url: "{{ route('item.fetch-jenis') }}",
//             type: "POST",
//             data: {
//                 kelompok_id: kelompok,
//                 _token: '{{csrf_token()}}'
//             },
//             dataType: 'json',
//             success: function (result) {
//                 $('#jenis-dropdown').html('<option value="">-- Select Jenis --</option>');
//                 $.each(result.jenis, function (key, value) {
//                     $("#jenis-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
//                 });
//             }
//         });
//     });

//     // set selected values in dropdowns on page load
//     var bidang = $('select[name="bidang"]').val();
//     var kelompok = $('select[name="kelompok"]').val();
//     var jenis = $('select[name="jenis"]').val();
//     if (bidang) {
//         $('#bidang-dropdown').trigger('change');
//         $('#kelompok-dropdown').val(kelompok);
//     }
//     if (kelompok) {
//         $('#kelompok-dropdown').trigger('change');
//         $('#jenis-dropdown').val(jenis);
//     }
// });
</script>
