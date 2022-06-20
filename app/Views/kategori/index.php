<?= $this->extend('template/index'); ?>

<?= $this->section('judul'); ?>
Management Data Kategori
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<?= form_button('', 'Tambah Data', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('kategori/formtambah') . "')"
]) ?>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= session()->getFlashdata('sukses'); ?>
<?= form_open('kategori/index'); ?>

<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari Data Kategori" name="cari" value="<?= $cari; ?>">
    <div class="input-group-append">
        <button class="btn btn-outline-primary" type="submit" id="tombolcari" name="tombolcari">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>
<?= form_close(); ?>

<table class="table table-striped table-borderd" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 5%">No</th>
            <th scope="col">Nama Kategori</th>
            <th style="width: 15%">Aksi</style=>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1 + (($nohalaman - 1) * 5);
        foreach ($tampildata as $row) :
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['katnama']; ?></td>
                <td><button type="button" class="btn btn-primary" title="Edit Data" onclick="edit('<?= $row['katid']; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>

                    <form method="POST" action="/kategori/hapus/<?= $row['katid']; ?>" style="display:inline;" onsubmit="return hapus();">
                        <input type="hidden" value="delete" name="_method">

                        <button type="submit" class="btn btn-danger" title="Hapus Data">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="float-center">
    <?= $pager->links('kategori', 'paging'); ?>
</div>

<script>
    function edit(id) {
        window.location = ('/kategori/formedit/' + id);
    }

    function hapus() {
        pesan = confirm('Data Kategori akan dihapus, apakah anda Yakin?');
        if (pesan) {
            return true;
        } else {
            return false;
        }
    }
</script>

<?= $this->endSection('isi'); ?>