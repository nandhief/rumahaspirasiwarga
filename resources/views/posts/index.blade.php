@extends('layouts.lte')

@section('title')
    Data Post
@endsection

@section('content-header')
    <h1>
        Post
        <small>Data Post</small>
    </h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Post</h3>
            <a class="btn btn-xs btn-flat btn-primary tambah" style="margin-left: 10px;"><i class="fa fa-plus"></i> Tambah</a>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered datatable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Gambar</th>
                            <th>Content</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css_down')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('js')
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        $(document).ready(() => {
            window.posts = $('.datatable').DataTable({
                ajax: '{{ route('posts.index') }}?action=datatable',
                deferRender: true,
                stateSave: true,
                columns: [
                    { data: 'name' },
                    { data: 'image', defaultContent: '' },
                    { data: 'sample', defaultContent: '' },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: data => {
                            var json = JSON.stringify(data)
                            var btn = `<button class="btn btn-xs btn-flat btn-primary" onclick='detail(${json})' title="Detail"><i class="fa fa-eye"></i></button> `
                            btn += `<button class="btn btn-xs btn-flat btn-info" onclick='edit(${json})' title="Edit"><i class="fa fa-edit"></i></button> `
                            btn += `<button class="btn btn-xs btn-flat btn-danger" onclick='hapus(${json})' title="Hapus"><i class="fa fa-trash"></i></button> `
                            return btn
                        }
                    }
                ]
            })
            window.detail = data => {
                multiModal({
                    url: '{{ route('posts.index') }}/'+data.id,
                    title: `Detail Post ${data.name} `,
                    size: 'lg',
                })
            }
            window.edit = data => {
                multiModal({
                    url: `{{ route('posts.index') }}/${data.id}/edit`,
                    title: `Edit Post ${data.name} `,
                    size: 'lg',
                })
            }
            window.hapus = data => {
                multiModal({
                    message: `Yakin Hapus data ${data.name}`,
                    title: 'Peringatan',
                    size: 'sm',
                    footer: [
                        { text: '<i class="fa fa-close"></i> Tidak', style: 'default', close: true },
                        { text: '<i class="fa fa-trash"></i> Ya', style: 'primary', click: e => {
                            e.target.disabled = true
                            $.ajax({
                                url: `{{ route('posts.index') }}/`+data.id,
                                type: 'DELETE',
                                success: result => {
                                    e.target.disabled = false
                                    notif(result.message)
                                    posts.ajax.reload()
                                    $('.modal').modal('hide')
                                },
                                error: errors => {
                                    e.target.disabled = false
                                    notifError(errors.responseJSON)
                                }
                            })
                            $('.modal').modal('hide')
                        } },
                    ]
                })
            }
            $('.tambah').click(e => {
                multiModal({
                    url: '{{ route('posts.create') }}?action=import',
                    title: 'Tambah Data',
                    size: 'lg',
                    backdrop: true
                })
            })
        })
    </script>
@endsection
