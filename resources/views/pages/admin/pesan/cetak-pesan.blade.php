<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Go-Tank</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- jQuery 3 -->
    <script src="{{asset('backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</head>
<body onload="print()">
<div class="row">
    <div class="container" style="padding: 0px">
        <img style=" width: 150px;position: absolute;margin-top: 8px; padding-left:2em;" src=" {{asset('frontend/img/favicon.png')}}" alt="">
        <div valign="top" class="text-center" align="center" style="font-size: x-large;">
            <br>
            <b> Go-Tank </b>
            <br><br><br>
        </div>
        <hr style="margin-bottom:0px; border-top: 1px solid #000;">
        <hr style="margin-top:2px;border-top: 3px solid #000;">
        <td valign="top">
            <div align="center">
                <div align="center">
                    <span style="font-size: x-large;"><u><b>LAPORAN DATA PEMESANAN</b></u></span><br/>
                </div>
            </div>
        </td><br><br><br>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pengguna</th>
                <th>Nama Company</th>
                <th>Nama Driver</th>
                <th>Tanggal Pesan</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @if(sizeof($data) > 0)
                @php
                    $no = 1;
                @endphp
                @foreach($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name_users }}</td>
                        <td>{{ $item->name_companies }}</td>
                        <td>{{ $item->name_drivers }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->jam }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7"><center>Tidak ada data</center></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
</body>
