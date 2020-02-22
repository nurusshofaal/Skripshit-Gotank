<?php

namespace App\Exports;

use App\Pesan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Auth;
use App\Driver;
use App\Company;

class PesansExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $company_id = Auth::user()->id;
        $pesans = Pesan::where('company_id', $company_id)->get();

        return $pesans;
        // $company = Company::find($company_id);
        // $data['drivers'] = $company->drivers()->get();
        // $data['data_pesan'] = $company->pesans()->get();
    }

    public function map($pesans): array
    {
        return [
            $pesans->user_id ? $pesans->user->name:$pesans->nama_pemesan,
            $pesans->tgl_pesan,
            $pesans->jam->jam,
            $pesans->bukti_pembayaran,
            $pesans->status
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Pemesan',
            'Tanggal Pemesanan',
            'Jam Pemesanan',
            'Struck Pembayaran',
            'Status',
        ];
    }
}
