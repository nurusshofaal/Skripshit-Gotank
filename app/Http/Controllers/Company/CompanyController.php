<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;
use App\Company;
use App\Pesan;
use App\Driver;
use App\User;
use Storage;
use File;
use Auth;
use DB;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company');
    }

    public function index(Request $request)
    {
        // $company = Company::find($company_id);
        // $data['drivers'] = $company->drivers()->get();
        // $datas['data_pesan'] = $company->pesans()->get();
        $company_id = Auth::user()->id;
        $data_pesan = Pesan::where('company_id', $company_id)->get();

        $datas[] = Pesan::where('company_id', $company_id)->count();
        // $datas = Pesan::sum('pesans')->get();

        return view('pages.company.dashboard', ['data_pesan' => $data_pesan, 'datas' => $datas]);
        
    }

    public function profile()
    {
        $company = \App\Company::find(auth::user()->id);
        return view('pages.company._Profile', ['company' => $company]);
    }

    public function edit(Request $request)
    {
        $company = \App\Company::find(auth::user()->id);
        return view('pages.company.update-profile', ['company' => $company]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2000',
            'description' => 'required',
            'phone' => 'required|numeric|digits_between:10,13|unique:companies'
        ]);
        //dd($request->all());

        $company = Company::where('id', Auth::user()->id)->first();

        // $company = Company::find($id);

        if ($request->avatar) {
            $image_path = $company->avatar;
            if ($image_path == 'default.jpg') {
                $imgName = $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->move('img', $imgName);

                $company->avatar = $request->file('avatar')->getClientOriginalName();
                $company->update([
                    'description' => $request->description,
                    'avatar' => $imgName,
                ]);
            } else {
                if (\File::exists(public_path('img/' . $image_path))) {
                    \File::delete(public_path('img/' . $image_path));
                }
                $imgName = $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->move('img', $imgName);

                $company->avatar = $request->file('avatar')->getClientOriginalName();
                $company->update([
                    'description' => $request->description,
                    'avatar' => $imgName,
                ]);
            }
        } else {
            $company->update([
                'description' => $request->description,
            ]);
        }

        return redirect()->back()->with('message','Berhasil Update Profile');
    }
}
