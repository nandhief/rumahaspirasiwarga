<form id="save" class="row">
    @csrf
    <div class="form-group col-md-6">
        <label for="name">Title</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="image">Gambar</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group col-md-12">
        <label for="content">Konten</label>
        <textarea name="content" class="form-control" rows="10"></textarea>
    </div>
</form>

<script>
    $('.modal-footer').append('<button class="btn btn-sm btn-flat btn-primary save"><i class="fa fa-save"></i> Simpan</button>')
    $('.save').click(e => {
        e.target.disabled = true
        $('#save').ajaxSubmit({
            url: '{{ route('posts.store') }}',
            type: 'POST',
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
    })
</script>
