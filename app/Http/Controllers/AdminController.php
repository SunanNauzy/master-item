<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Reservation;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function dashboard(Request $request)
    {
        $date = explode(" - ", request()->input('from-to', ""));

        if(count($date) != 2)
        {
            $date = [now()->subDays(29)->format("Y-m-d"), now()->format("Y-m-d")];
        }
        // print_r($date);
        //$selectedBidang = $request->input('selectedBidang');
        //$selectedJenis = $request->input('selectedJenis');
        //$selectedTotalJenis = $request->input('selectedTotalJenis');
        // dd($selectedBidang);

        // $subquery = DB::table('items')
        //         ->select(['*', DB::raw('lower(jenis) as jenis'),DB::raw('count(*) as total')])
        //         ->where('bidang', $selectedBidang)
        //         ->pluck('jenis')
        //         ->toArray();
        // echo($selectedBidang);
        // $subquery = DB::table('items')
        //         ->select(['*', DB::raw('lower(jenis) as lowjenis'),DB::raw('count(*) as total')])
        //         ->where('bidang', $selectedBidang)
        //         ->get()
        //         ->mapToGroups(function ($item) {
        //             return ['jenis' => $item->jenis];
        //         })
        //         ->toArray();


        // $result = Item::select('*', DB::raw('lower(jenis) as lowjenis'), DB::raw('count(*) as total'))
        //         ->whereIn('jenis', $subquery)
        //         ->where('bidang', $selectedBidang) // Menggunakan variabel $selectedBidang yang didefinisikan sebelumnya
        //         ->groupBy('lowjenis')
        //         ->whereBetween('input_date', [$date[0], $date[1]])
        //         ->orderBy('total', 'desc')
        //         ->get();

        //DB::statement('PRAGMA case_sensitive_like = ON;');
        $totalBuyerPurchases = Item::select(['*',DB::raw('lower(tipe) as lowtipe'), DB::raw('count(*) as total')])
                                    ->groupBy('lowtipe')
                                    ->whereBetween('input_date', [$date[0], $date[1]])->get();
                                    //->orderBy('lowtipe')->get();
                                    //->cursor('tipe', SORT_NATURAL|SORT_FLAG_CASE)->get();
        $totalbidang = Item::select(['*',DB::raw('lower(bidang) as lowbidang'),DB::raw('count(*) as total')])
                                    // ->whereIn('jenis', $subquery)
                                    // ->whereIn('jenis', $subquery)
                                    // ->where('bidang', $selectedBidang)
                                    ->groupBy('lowbidang')
                                    ->whereBetween('input_date', [$date[0], $date[1]])
                                    ->orderBy('total','desc')->get();
        $totaljtransaksi = Item::select(['*', DB::raw('lower(jenis_transaksi) as lowjt'),DB::raw('count(*) as total')])
                                ->groupBy('lowjt')
                                ->whereBetween('input_date', [$date[0], $date[1]])
                                ->orderBy('total', 'desc')->get();
        $totalunit = Item::select(['*', DB::raw('lower(unit) as lowunit'),DB::raw('count(*) as total')])
                                ->groupby('lowunit')
                                ->whereBetween('input_date', [$date[0], $date[1]])
                                ->orderBy('total', 'desc')->get();
        $totaljenis =           Item::select(['jenis'])
                                // Item::select(['*', DB::raw('lower(jenis) as jenis'),DB::raw('count(*) as total')])
                                //    ->whereIn('jenis', $subquery)
                                //->where('bidang', $selectedBidang) // Menggunakan variabel $selectedBidang yang didefinisikan sebelumnya
                                ->groupby('jenis')
                                // ->whereBetween('input_date', [$date[0], $date[1]])
                                // ->orderBy('total', 'desc')
                                ->limit(3)
                                ->pluck('jenis')
                                ->toArray();
        // print_r($totaljenis);
                                //->toArray();
        // $totaljenis = $totaljenis->pluck('total', 'jenis')->toArray();
        // dd($totaljenis);

        // $totaljenis = DB::select('SELECT *, lower(jenis) as lowjenis, count(*) as total FROM items WHERE input_date BETWEEN ? AND ? GROUP BY lowjenis ORDER BY total DESC LIMIT 3', [$date[0], $date[1]]);
        // return view('nama_view', compact('totaljenis'));

        // $filmonth = Item::select(['*',DB::raw('users') ])
        //                         ->whereMonth('created_at', '05')
        //                         ->get();

        // $totalBuyerPurchases = Item::select(['*',DB::raw('count(tipe) as total')])
        //                             ->groupBy('tipe')
        //                             ->whereBetween('input_date', [$date[0], $date[1]])
        //                             ->orderBy('tipe')->get();
        //                             //->cursor('tipe', SORT_NATURAL|SORT_FLAG_CASE)->get();
        // $totalbidang = Item::select(['*',DB::raw('count(bidang) as total')])
        //                             ->groupBy('bidang')
        //                             ->whereBetween('input_date', [$date[0], $date[1]])
        //                             ->orderBy('total','desc')->get();
        // $totaljtransaksi = Item::select(['*', DB::raw('count(jenis_transaksi) as total')])
        //                         ->groupBy('jenis_transaksi')
        //                         ->whereBetween('input_date', [$date[0], $date[1]])
        //                         ->orderBy('total', 'desc')->get();
        // $totalunit = Item::select(['*', DB::raw('count(unit) as total')])
        //                         ->groupby('unit')
        //                         ->whereBetween('input_date', [$date[0], $date[1]])
        //                         ->orderBy('total', 'desc')->get();

        //$status = $request->input('status');

        // if ($status == 'active') {
        //     $data = Data::where('status', true)->get();
        // } elseif ($status == 'inactive') {
        //     $data = Data::where('status', false)->get();
        // } else {
        //     $data = Data::all();
        // }s

        //return view('data.index', compact('data'));
        // return response()->json($result);

        return view('admin.dashboard')->with([

            'totalBuyerPurchases' => $totalBuyerPurchases,
            'totalbidang' => $totalbidang,
            'totaljtransaksi' => $totaljtransaksi,
            'totalunit' => $totalunit,
             'totaljenis' => $totaljenis,
            // 'result' => json_encode($result),
            // response()->json($data);
            // 'selectedJenis' => $selectedJenis, // Add this line
            // 'selectedTotalJenis' => $selectedTotalJenis, // Add this line
        ]);

    }

    public function dataget(Request $request)
    {
        $date = explode(" - ", request()->input('from-to', ""));

        if(count($date) != 2)
        {
            $date = [now()->subDays(29)->format("Y-m-d"), now()->format("Y-m-d")];
        }
        $selectedBidang = $request->input('selectedBidang');
        $selectedJenis = $request->input('selectedJenis');
        $selectedTotalJenis = $request->input('selectedTotalJenis');
        $totaljenis =
                                // Item::select(['jenis'])
                                Item::select(['*', DB::raw('lower(jenis) as jenis'),DB::raw('count(*) as total')])
                                //    ->whereIn('jenis', $subquery)
                                ->where('bidang', $selectedBidang) // Menggunakan variabel $selectedBidang yang didefinisikan sebelumnya
                                ->groupby('jenis')
                                ->whereBetween('input_date', [$date[0], $date[1]])
                                ->orderBy('total', 'desc')
                                // ->limit(4)
                                ->pluck('jenis')
                                ->toArray();
        //  print_r($date);

       return response()->json($totaljenis);
    }

    public function item()
    {
        return view('item.index');
    }
    public function notifications()
    {
        $user = auth()->user();
        return $user->notifications;
    }
    public function unreadNotifications()
    {
        $user = auth()->user();
        return $user->unreadNotifications;
    }
    public function readNotifications()
    {
        $user = auth()->user();
        return $user->readNotifications;
    }


}
