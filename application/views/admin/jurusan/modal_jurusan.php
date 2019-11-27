<div class="modal fade" id="modalFormJurusan" tabindex="-1" role="form" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Data Kategori Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/kategori/') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Nama Kategori">Nama</label>
                        <span id="pesan" class="error"></span></p>
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_kategori" placeholder="Masukkan nama kategori" required />
                    </div>
                    <div class="form-group">
                        <label for="Nama Kategori">Nama</label>
                        <span id="pesan" class="error"></span></p>
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_kategori" placeholder="Masukkan nama kategori" required />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Masukan</button>
                </form>
            </div>
        </div>
    </div>
</div>