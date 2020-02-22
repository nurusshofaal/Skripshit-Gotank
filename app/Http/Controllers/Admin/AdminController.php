<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pesan;
use App\Driver;
use App\Company;
use App\User;
use App\Jam;
use App\Admin;
use Illuminate\Support\Facades\DB;
use Auth;

class AdminController extends Controller
{
    public function __construct(){
      $this->middleware('auth:admin');
    }

    public function index()
    {
        // $bulan = $request->bulan;
        $company_id = Auth::user()->id;
        $company = Company::find($company_id);
        $data_pesan = Pesan::select('company_id', DB::raw('count(company_id) as total'))->groupBy('company_id')->get();
        // dd($data_pesan);
        $categories = [];
        $pesan = [];
        foreach ($data_pesan as $data) {
            $categories[] = $data->company->name;
            // $pesan[] = $company->pesan;
            $pesan[]=  $data->total;
            // $categories = DB::table('pesans')->select('companies.name as name_companies','drivers.name as name_drivers',
            // 'users.name as name_users','pesans.created_at','pesans.status','pesans.tgl_pesan','pesans.bukti_pembayaran','pesans.id as id_pesans', 'pesans.company_id as company_name', 'jams.jam')
            // ->join('companies', 'companies.id', '=', 'pesans.company_id')
            // ->join('drivers', 'drivers.id', '=', 'pesans.driver_id')
            // ->join('users', 'users.id', '=', 'pesans.user_id')
            // ->join('jams', 'jams.id', '=', 'pesans.jam_id')
            // // ->where('pesans.company_id', $company_id)
            // ->get();
            // $categories[] = $data->company_name;
        }
        // dd($pesan);
        // dd($categories);
        // $pesan[] = Company::count();
      return view('pages.admin.dashboard',['company' => $company, 'data_pesan' => $data_pesan, 'categories' => $categories, 'pesan' => $pesan]);
              // $company_id = Auth::user()->id;
        // $company = Company::find($company_id);
        // $data['drivers'] = $company->drivers()->get();
       // $datas['data_pesan'] = $company->pesans()->get();
        // $datas['data_pesan'] = DB::table('pesans')->select('companies.name as name_companies','drivers.name as name_drivers',
        //     'users.name as name_users','pesans.created_at','pesans.status','pesans.tgl_pesan','pesans.bukti_pembayaran','pesans.id as id_pesans','jams.jam')
        //     ->join('companies', 'companies.id', '=', 'pesans.company_id')
        //     ->join('drivers', 'drivers.id', '=', 'pesans.driver_id')
        //     ->join('users', 'users.id', '=', 'pesans.user_id')
        //     ->join('jams', 'jams.id', '=', 'pesans.jam_id')
        //     ->get();
        // $datas['tahun'] = DB::table('pesans')->select(DB::raw('YEAR(created_at) as tahun'))->groupBy('tahun')->get();
        // // $data['users'] = User::all();
        // $datas['company'] = Company::all();

        // dd('datas');

      // return view('pages.admin.dashboard')->with($data);

    }

}
