<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>

    <div class="card" style="width: 50%;">
        <div class="card-body">
            <form method="post" action="<?php echo base_url('admin/potonganGaji/tambahDataAksi') ?>">
                <div class="form-group">
                    <label for="">Jenis Potongan</label>
                    <input type="text" name="potongan" class="form-control">
                    <?php echo form_error('potongan','<small class="text-danger pl-2">','</small>') ?>
                </div>

                <div class="form-group">
                    <label for="">Jumlah Potongan</label>
                    <input type="number" name="jml_potongan" class="form-control">
                    <?php echo form_error('jml_potongan','<small class="text-danger pl-2">','</small>') ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->