@extends('layouts.lte')

@section('title')
    Dashboard
@endsection

@section('content-header')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Transaksi Keluar</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-xs btn-flat btn-success send"><i class="fa fa-send"></i> Kirim</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover data-kirim">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode</th>
                                <th>Kepada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Transaksi Masuk</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover data-masuk">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode</th>
                                <th>Dari</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(() => {
            //
        })
    </script>
@endsection
