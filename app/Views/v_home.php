<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<!-- Table with stripped rows -->
<div class="row">
    <?php foreach ($products as $key => $item) : ?>
        <?php
        // Hitung harga setelah diskon dari session active_discount
        $activeDiscount     = session('active_discount');
        $nominalDiskon      = ($activeDiscount !== null) ? $activeDiscount['nominal'] : 0;
        $hargaSetelahDiskon = max(0, $item['harga'] - $nominalDiskon);
        ?>
        <div class="col-lg-6">
            <?= form_open('keranjang') ?>
            <?= form_hidden([
            'id'    => $item['id'],
            'nama'  => $item['nama'],
            'harga' => $item['harga'],
            'foto'  => $item['foto']]) ?>
            <div class="card">
                <div class="card-body">
                    <img src="<?= base_url() . "img/" . $item['foto'] ?>" alt="..." width="50%">
                    <h5 class="card-title"><?= $item['nama'] ?><br>
                        <?php if ($nominalDiskon > 0) : ?>
                            <span style="text-decoration: line-through; color: #999; font-size: 0.85em;">
                                <?= number_to_currency($item['harga'], 'IDR') ?>
                            </span>
                            <span style="color: #198754; font-weight: bold;">
                                <?= number_to_currency($hargaSetelahDiskon, 'IDR') ?>
                            </span>
                        <?php else : ?>
                            <?= number_to_currency($item['harga'], 'IDR') ?>
                        <?php endif; ?>
                    </h5>
                    <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div>
<!-- End Table with stripped rows -->
<?= $this->endSection() ?>