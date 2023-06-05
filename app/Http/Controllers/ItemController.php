<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Imports\ItemImport;
use App\Exports\ItemExport;
use App\Imports\BidangImport;
use App\Imports\KelompokImport;
use App\Imports\JenisImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Bidang;
use App\Models\Kelompok;
use App\Models\Jenis;
use App\Models\Userf;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function create()
    {
        $data['bidang'] = Bidang::get(["name", "id", "value_bidang"]);
        $data['userf'] = Userf::get(['name', 'id','userf_number']);
        return view('item.create', $data);
    }

    public function store(Request $request)
    {

        $this->validateStore($request);
        $item = new Item;
        abort_if(!$this->busSave($item, $request), 404);

        return redirect()->route('item.index');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $data['userf'] = Userf::get(['name', 'id','userf_number']);
        $data['bidang'] = Bidang::get(["name", "id", "value_bidang"]);
        $data['kelompoks'] = Kelompok::get(['name', 'id', 'value_bidang', 'value_kelompok']);
        $data['jeniss'] = Jenis::get(['name', 'id', 'value_kelompok', 'value_bidang', 'value_jenis']);
        $data['kelompok'] = Kelompok::where('bidang_id', $item->bidang)->pluck('name', 'id', 'value_bidang', 'value_kelompok');
        $data['jenis'] = Jenis::where('kelompok_id', $item->kelompok)->pluck('name', 'id', 'value_kelompok', 'value_bidang', 'value_jenis');
        $data['item'] = $item;
        //return view('item.edit', $data);

        //return view('item.edit', $data);

        return view('item.edit', compact('item'), $data);
       // return view('item.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $this->validateUpdate($request);
        $item = Item::findOrFail($id);
        //abort_if(!$this->busSave($item, $request), 404);
        $this->busSave($item, $request);
        Alert::toast('Item info updated.');
        return redirect()->route('item.index');
    }
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        Alert::toast('Item deleted!');
        return redirect()->route('item.index');
    }

    private function busSave(Item $item, $request)
    {

        // $item->name = $request->name;
        // $item->qty = $request->qty;
        // $item->input_date = $request->input_date;
        // $item->approval_status = $request->approval_status;
        // $item->user = $request->user;
        // $item->unit = $request->unit;
        // $item->tipe = $request->tipe;
        // $item->jenis_transaksi = $request->jenis_transaksi;
        // $item->bidang = $request->bidang;
        // $item->kelompok = $request->kelompok;
        // $item->jenis = $request->jenis;
        // $item->type = $request->type;
        // $item->bulan = $request->bulan;
        // $item->kode_barang = $request->kode_barang;

        $item->name = $request->name;
        $item->qty = $request->qty;
        $item->input_date = $request->input_date;
        $item->approval_status = $request->approval_status;
        // $item->user = $request->user;
        // $item->unit = $request->unit;
        $item->tipe = $request->tipe;
        $item->jenis_transaksi = $request->jenis_transaksi;

        $item->user = $request->user;
        $item->unit = $request->unit;

        // // retrieve bidang model by value_bidang
        // $bidang = Bidang::findOrFail($request->bidang);
        // $item->bidang = $bidang->name;

        // // retrieve kelompok model by value_kelompok
        // $kelompok = Kelompok::findOrFail($request->kelompok);
        // $item->kelompok = $kelompok->name;

        // // retrieve jenis model by value_jenis
        // $jenis = Jenis::findOrFail($request->jenis);
        // $item->jenis = $jenis->name;

        $bidang = Bidang::where('value_bidang', $request->bidang)->firstOrFail();
        $item->bidang = $bidang->name;

        $kelompok = Kelompok::where('value_kelompok', $request->kelompok)->firstOrFail();
        $item->kelompok = $kelompok->name;

        $jenis = Jenis::where('value_jenis', $request->jenis)->firstOrFail();
        $item->jenis = $jenis->name;

        // if ($request->has('bidang') && $request->bidang !== '') {
        //     // retrieve bidang model by id
        //     $bidang = Bidang::findOrFail($request->bidang);
        //     $item->bidang = $bidang->name;
        // }

        // if ($request->has('kelompok') && $request->kelompok !== '') {
        //     // retrieve kelompok model by name
        //     $kelompok = Kelompok::findOrFail($request->kelompok);
        //     $item->kelompok = $kelompok->name;
        // }

        // if ($request->has('jenis') && $request->jenis !== '') {
        //     // retrieve jenis model by name
        //     $jenis = Jenis::findOrFail($request->jenis);
        //     $item->jenis = $jenis->name;
        // }

        $item->type = $request->type;
        $item->bulan = $request->bulan;
        $item->kode_barang = $request->kode_barang;



        //logo
        if ($request->hasFile('img')) {
            $fileNameToStore = $this->getFileName($request->file('img'));
            $logoPath = $request->file('img')->storeAs('public/item', $fileNameToStore);
            if ($item->img) {
                Storage::delete('public/item/' . basename($item->img));
            }
            $item->img = 'storage/item/' . $fileNameToStore;
        }


        if ($item->save()) {
            return true;
        }
        return false;
    }
    private function validateStore($request)
    {
        return $request->validate([
            'name',// => 'required|min:3',
            'qty',// => 'required|min:3',
            //'img',// => 'required|image|max:3000',
            'input_date', //=> 'required|min:2',
            'approval_status',// => 'required|min:2',
            'user',// => 'required',
            'unit',// => 'required',
            'tipe',// => 'required',
            'jenis_transaksi', //=> 'required',
            'bidang' => 'required',
            'kelompok' => 'required',
            'jenis' => 'required',
            'type',// => 'required',
            'bulan',//=> 'required',
            'kode_barang', //=> //'required',
        ]);
    }
    private function validateUpdate($request)
    {
        return $request->validate([
            'name',// => 'required|min:3',
            'qty',// => 'required|min:3',
            //'img',// => 'required|image|max:3000',
            'input_date', //=> 'required|min:2',
            'approval_status',// => 'required|min:2',
            'user',// => 'required',
            'unit',// => 'required',
            'tipe',// => 'required',
            'jenis_transaksi', //=> 'required',
            'bidang' => 'required',
            'kelompok'=> 'required',
            'jenis'=> 'required',
            'type',// => 'required',
            'bulan',//=> 'required',
            'kode_barang', //=> //'required',
        ]);
    }
    protected function getFileName($file)
    {
        $fileName = $file->getClientOriginalName();
        $actualFileName = pathinfo($fileName, PATHINFO_FILENAME);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        return $actualFileName . time() . '.' . $fileExtension;
    }

    public function import_excel(Request $request)
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('item',$nama_file);

		// import data
		Excel::import(new ItemImport, public_path('/item/'.$nama_file));

		// notifikasi dengan session
		//Session::flash('sukses','Data Siswa Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect()->route('item.index');
	}

    public function import_bidang(Request $request)
	{
		// validasi
		$this->validate($request, [
			'file1' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file1');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('bidang',$nama_file);

		// import data
		Excel::import(new BidangImport, public_path('/bidang/'.$nama_file));

		// notifikasi dengan session
		//Session::flash('sukses','Data Siswa Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect()->route('item.index');
	}

    public function import_kelompok(Request $request)
	{
		// validasi
		$this->validate($request, [
			'file2' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file2');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('kelompok',$nama_file);

		// import data
		Excel::import(new KelompokImport, public_path('/kelompok/'.$nama_file));

		// notifikasi dengan session
		//Session::flash('sukses','Data Siswa Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect()->route('item.index');
	}

    public function import_jenis(Request $request)
	{
		// validasi
		$this->validate($request, [
			'file3' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file3');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('jenis',$nama_file);

		// import data
		Excel::import(new JenisImport, public_path('/jenis/'.$nama_file));

		// notifikasi dengan session
		//Session::flash('sukses','Data Siswa Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect()->route('item.index');
	}

    public function export_excel()
	{
		return Excel::download(new ItemExport, 'item.xlsx');
	}


    public function fetchKelompok(Request $request)
    {
        $data['kelompok'] = Kelompok::where("value_bidang", $request->valuee_bidang)
                                ->get(["name", "id", "value_bidang", "value_kelompok"]);

        return response()->json($data);
    }

    public function fetchJenis(Request $request)
    {
        $data['jenis'] = Jenis::where("value_kelompok", $request->valuee_kelompok)
                                    ->get(["name", "id", "value_kelompok", "value_bidang", "value_jenis"]);

        return response()->json($data);
    }

    public function getData(Request $request)
{
    // Ambil data berdasarkan pilihan pada select option
    $data = DB::table('unit')
            ->where('userf_number', $request->selectedOption)
            ->pluck('name_unit');

    // Return data sebagai response JSON
    return response()->json(['data' => $data]);
}


}
