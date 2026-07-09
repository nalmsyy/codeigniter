<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Detail Transaksi #<?= $transaction['id'] ?></h5>
        <p><strong>Pembeli:</strong> <?= $transaction['username'] ?></p>
        <p><strong>Alamat:</strong> <?= $transaction['alamat'] ?></p>
        <p><strong>Waktu Pembelian:</strong> <?= $transaction['created_at'] ?></p>
        <p><strong>Status:</strong> 
            <?= ($transaction['status'] == '1')
                ? '<span class="badge bg-primary">Sudah Selesai</span>'
                : '<span class="badge bg-warning text-dark">Belum Selesai</span>' ?>
        </p>
        
        <hr>

        <h6>Daftar Produk:</h6>
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $index => $item) : ?>
                <div class="d-flex align-items-center mb-3">
                    <?php
                    $imagePath = FCPATH . 'img/' . $item['foto'];
                    if (!empty($item['foto']) && file_exists($imagePath)) :
                    ?>
                        <div class="me-3">
                            <img src="<?= base_url('img/' . $item['foto']) ?>" width="100" class="img-thumbnail">
                        </div>
                    <?php endif; ?>
                    <div>
                        <strong><?= $item['nama'] ?></strong><br>
                        Harga Asli: <?= number_to_currency($item['harga'], 'IDR') ?><br>
                        Jumlah: <?= $item['jumlah'] ?> pcs<br>
                        <?php if ((float)$item['diskon'] > 0) : ?>
                            Diskon: <?= number_to_currency($item['diskon'], 'IDR') ?><br>
                        <?php endif; ?>
                        Subtotal: <strong><?= number_to_currency($item['subtotal_harga'], 'IDR') ?></strong>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <p><strong>Ongkir:</strong> <?= number_to_currency($transaction['ongkir'], 'IDR') ?></p>
        <h5><strong>Total Bayar:</strong> <?= number_to_currency($transaction['total_harga'], 'IDR') ?></h5>

        <a href="<?= base_url('pembelian') ?>" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>
