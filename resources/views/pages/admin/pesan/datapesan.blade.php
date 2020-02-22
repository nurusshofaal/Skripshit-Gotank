@extends('templates.admin.default')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        @if (session('sukses'))
            <div class="box-body">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <h4>
                        <i class="icon fa fa-check"></i>
                        Sukses !!!
                    </h4>
                    {{ session('sukses') }}
                </div>
            </div>
        @endif
        <h1>
            Data Pemesanan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4><b>Pilihan Cetak</b></h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form action="{{url('admin/pesan_cetak')}}" method="get">
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <label for="company" class="control-label">Company</label>
                                        <select class="form-control" id="company" name="company">
                                            @if(sizeof($company)>0)
                                                <option value="semua">Semua</option>
                                                @foreach($company as $itemc)
                                                    <option value="{{ $itemc->id }}">{{ $itemc->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Tidak Ada</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <label for="tahun" class="control-label">Tahun</label>
                                        <select class="form-control" id="tahun" name="tahun">
                                            @if(sizeof($tahun)>0)
                                                @foreach($tahun as $items)
                                                    <option value="{{ $items->tahun }}">{{ $items->tahun }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Tidak Ada</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <label for="tahun" class="control-label">Bulan</label>
                                        <select class="form-control" id="bulan" name="bulan">
                                            <option value="00">Semua</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3"><br>
                                    <button type="submit" class="btn btn-primary btn-block">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    {{-- <a href="{{ url('pesan/create') }}" class="btn btn-primary fa fa-plus-square-o"> Tambah </a> --}}
                    {{-- <button type="button" class="btn btn-primary fa fa-plus-square-o" data-toggle="modal" data-target="#exampleModal">
                      Tambah
                    </button> --}}
                    <!-- Modal -->
                        {{-- <div class="modal fade" id="exampleModall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                           <div class="modal-content">
                             <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Tambah Driver</h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                             </div>
                             <div class="box-body">
                               <div class="modal-body">
                                 <form class="form-horizontal" action="{{ url('pesan') }}" method="POST">
                                 @csrf
                                   <div class="form-group">
                                     <label for="inputEmail3" class="col-sm-2 control-label">Company ID</label>
                                     <div class="col-sm-10">
                                       <input type="text" name="company_id" class="form-control" id="inputEmail3" placeholder="company_id">
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label for="inputEmail3" class="col-sm-2 control-label">User ID</label>
                                     <div class="col-sm-10">
                                       <input type="text" name="user_id" class="form-control" id="inputEmail3" placeholder="company_id">
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label for="inputEmail3" class="col-sm-2 control-label">Tgl Pesan</label>
                                     <div class="col-sm-10">
                                         <input type="date" name="tgl_pesan" class="form-control" id="inputEmail3" placeholder="Nama">
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label for="inputEmail3" class="col-sm-2 control-label">Jam</label>
                                     <div class="col-sm-10">
                                         <input type="time" name="jam_id" class="form-control" id="inputEmail3" placeholder="Jam">
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label for="inputEmail3" class="col-sm-2 control-label">Desc Pesan</label>
                                     <div class="col-sm-10">
                                         <input type="text" name="deskripsi_pesan" class="form-control" id="inputEmail3" placeholder="Deskripsi Pesan">
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label for="inputEmail3" class="col-sm-2 control-label">Struk Pembayaran</label>
                                     <div class="col-sm-10">
                                       <input type="file" name="bukti_pembayaran" class="form-control" id="inputEmail3" placeholder="Bukti Pembayaran">
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                     <div class="col-sm-10">
                                       <select class="form-control" id="inputEmail3">
                                         <option value="Belum Dibayar">Belum Dibayar</option>
                                         <option value="Belum Dikonfirmasi">Belum Dikonfirmasi</option>
                                         <option value="Dikonfirmasi">Dikonfirmasi</option>
                                         <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                                         <option value="Selesai">Selesai</option>
                                         <option value="Batal">Batal</option>
                                       </select>
                                     </div>
                                   </div>
                                   <div class="modal-footer">
                                     <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                     <button type="submit" class="btn btn-success">Simpan</button>
                                   </div>
                                 </form>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div> --}}
                        {{-- <a href="/export-pesan" class="btn btn-primary fa fa-download"> Data Pesan </a> --}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table-driver" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th style="width: 110px">Company Name</th>
                                <th style="width: 100px">Driver Name</th>
                                <th style="width: 80px">Tgl Pesan</th>
                                <th style="width: 80px">Jam</th>
                                <th style="width: 100px">Upload Struck</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $no = 1;
                            @endphp

                            {{-- cek data di database --}}
                            @if(sizeof($data_pesan)>0)
                                @foreach($data_pesan as $pesans)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            {{ $pesans->name_companies }}
                                        </td>
                                        <td>
                                            {{ $pesans->name_drivers }}
                                        </td>
                                        <td>{{ $pesans->tgl_pesan }}</td>
                                        <td>{{ $pesans->jam }}</td>
                                        <td align="center"><a href="{{asset('img/'.$pesans->bukti_pembayaran)}}" rel="zoom-id:zoom;opacity-reverse:true"> <img src="{{asset('img/'.$pesans->bukti_pembayaran)}}" width="45px"; height="45px";></a></td>
                                        <td style="text-align: center;">{{ $pesans->status }}</td>
                                        <td>
                                            <form action="{{url('admin/pesan/'.$pesans->id_pesans) }}" method="POST" class="text-center">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{url('admin/pesan/'.$pesans->id_pesans.'') }}" class="fa fa-info btn btn-primary"></a>
                                                {{-- <a href="{{url('pesan/'.$pesans->id.'/edit') }}" class="fa fa-edit btn btn-warning"></a>
                                                <button type="submit" class="fa fa-trash btn btn-danger"></button> --}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td class="text-center" colspan="6"><i>Tidak ada data</i></td>
                                </tr>
                            @endif

                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <!-- Modal -->
    {{-- <div class="modal fade" id="modalkonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pilih Driver</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form_driver" class="form-horizontal" action="{{ url('pesan/konfirmasi') }}" method="POST">
              @csrf
              <input type="hidden" id="pesan_id" name="id">
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Driver</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="driver_id">
                      <option value="">-Pilih Driver-</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div> --}}

@endsection

@push('scripts')

@endpush

@section('myjs')
    <script>
        $(function () {
            $('#table-driver').DataTable();
        });

        function showKonfirmasi(id){
            $("#pesan_id").val(id);
            $("#modalkonfirmasi").modal("show");
        }
    </script>
@endsection
