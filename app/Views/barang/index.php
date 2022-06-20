<?= $this->extend('template/index'); ?>

<?= $this->section('judul'); ?>
Management Data Barang
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<?= form_button('', 'Tambah Data', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('barang/formtambah') . "')"
]) ?>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>

<?= form_open('barang/index'); ?>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari Data barang" name="cari" value="<?= $cari; ?>" autofocus>
    <div class="input-group-append">
        <button class="btn btn-outline-primary" type="submit" id="tombolcari" name="tombolcari">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>
<?= form_close(); ?>

<span class="badge badge-pill">
    <h3>
        Total Data : <?= $totaldata; ?>
    </h3>
</span>

<table class="table table-striped table-borderd" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 5%">No</th>
            <th scope="col">Kode Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Kategori</th>
            <th scope="col">Satuan</th>
            <th scope="col">Harga</th>
            <th scope="col">Stok</th>
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
                <td><?= $row['brgkode']; ?></td>
                <td><?= $row['brgnama']; ?></td>
                <td><?= $row['katnama']; ?></td>
                <td><?= $row['satnama']; ?></td>
                <td><?= number_format($row['brgharga'], 0); ?></td>
                <td><?= number_format($row['brgstok'], 0); ?></td>
                <td>
                    <button type="button" class="btn btn-primary" title="Edit Data" onclick="edit('<?= $row['brgkode']; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>

                    <form method="POST" action="/barang/hapus/<?= $row['brgkode']; ?>" style="display:inline;" onsubmit="return hapus();">
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
    <?= $pager->links('barang', 'paging') ?>
</div>

<script>
    function edit(kode) {
        window.location.href = ('/barang/edit/' + kode);
    }

    function hapus(kode) {
        pesan = confirm('Data Barang Ini Akan Dihapus, Apakah Anda Yakin?');
        if (pesan) {
            return true;
        } else {
            return false;
        }
    }
</script>

<?= $this->endSection('isi'); ?>