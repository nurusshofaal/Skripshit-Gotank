<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pesan;
use App\Driver;
use App\Company;
use App\Jam;
use Auth;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function index()
    {
    	$company_id = Auth::user()->id;
        $company = Company::find($company_id);
        $data['drivers'] = $company->drivers()->get();
//        $data['data_pesan'] = $company->pesans()->get();
        $data['data_pesan'] = DB::table('pesans')->select('companies.name as name_companies','drivers.name as name_drivers',
            'users.name as name_users','pesans.created_at','pesans.status','pesans.tgl_pesan','pesans.bukti_pembayaran','pesans.id as id_pesans','jams.jam')
            ->join('companies', 'companies.id', '=', 'pesans.company_id')
            ->join('drivers', 'drivers.id', '=', 'pesans.driver_id')
            ->join('users', 'users.id', '=', 'pesans.user_id')
            ->join('jams', 'jams.id', '=', 'pesans.jam_id')
            ->get();
        $data['tahun'] = DB::table('pesans')->select(DB::raw('YEAR(created_at) as tahun'))->groupBy('tahun')->get();
        // $data['users'] = User::all();
        $data['company'] = Company::all();
        return view('pages.admin.pesan.datapesan')->with($data);
    }

    public function show(Request $request, $id)
    {
        $data = Pesan::find($id);
        return view('pages.admin.pesan.detail-pesan', ['data' => $data]);
    }

    public function cetak(Request $request){
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $company = $request->company;
        $cari = $tahun;

        if ($bulan != 00){
            $cari .= "-".$bulan;
        }

        if ($company=="semua"){
            $where = "";
        } else {
            $where = $company;
        }

        $data['data'] = DB::table('pesans')->select('companies.name as name_companies','drivers.name as name_drivers',
            'users.name as name_users','pesans.created_at','pesans.status','jams.jam')
            ->join('companies', 'companies.id', '=', 'pesans.company_id')
            ->join('drivers', 'drivers.id', '=', 'pesans.driver_id')
            ->join('users', 'users.id', '=', 'pesans.user_id')
            ->join('jams', 'jams.id', '=', 'pesans.jam_id')
            ->where('pesans.created_at', 'like', '%'.$cari.'%')
            ->where('companies.id', 'like', '%'.$where.'%')
            ->get();

        return view('pages.admin.pesan.cetak-pesan')->with($data);
    }
}
