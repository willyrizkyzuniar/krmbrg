<?= $this->extend('template/index'); ?>

<?= $this->section('judul'); ?>
Management Data Satuan
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
<?= form_button('', 'Tambah Data', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('satuan/formtambah') . "')"
]) ?>
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<?= session()->getFlashdata('sukses'); ?>
<table class="table table-striped table-borderd" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 5%">No</th>
            <th scope="col">Nama Satuan</th>
            <th style="width: 15%">Aksi</style=>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($tampildata as $row) :
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['satnama']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection('isi'); ?>