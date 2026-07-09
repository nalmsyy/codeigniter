<?php foreach ($discounts as $index => $diskon) : ?>
    <!-- Edit Modal Begin -->
    <div class="modal fade" id="editModal-<?= $diskon['id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open(base_url('diskon/edit/' . $diskon['id'])); ?>
                <?= csrf_field(); ?>

                <div class="modal-body">
                    <!-- Tanggal: readonly, tidak boleh diubah -->
                    <div class="mb-3">
                        <?= form_label('Tanggal', 'tanggal_edit'); ?>
                        <?= form_input([
                            'type'     => 'text',
                            'name'     => 'tanggal_display',
                            'id'       => 'tanggal_edit',
                            'class'    => 'form-control',
                            'value'    => $diskon['tanggal'],
                            'readonly' => true
                        ]); ?>
                    </div>

                    <!-- Nominal: boleh diubah -->
                    <div class="mb-3">
                        <?= form_label('Nominal', 'nominal_edit'); ?>
                        <?= form_input([
                            'type'     => 'number',
                            'name'     => 'nominal',
                            'id'       => 'nominal_edit',
                            'class'    => 'form-control',
                            'value'    => $diskon['nominal'],
                            'min'      => '0',
                            'required' => true
                        ]); ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <?= form_submit('submit', 'Simpan', ['class' => 'btn btn-primary']); ?>
                </div>

                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <!-- Edit Modal End -->
<?php endforeach ?>
