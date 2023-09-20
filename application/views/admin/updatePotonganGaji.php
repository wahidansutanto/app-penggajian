<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>

    <div class="card text-dark" style="width: 50%;">
        <div class="card-body">
            <?php foreach ($pot_gaji as $p) : ?>
                <form action="<?php echo base_url('admin/potonganGaji/updateDataAksi') ?>" method="POST">
                    <div class="form-group">
                        <label>Jenis Potongan</label>
                        <input type="hidden" name="id" class="form-control" value="<?php echo $p->id ?>">
                        <input type="text" name="potongan" class="form-control" value="<?php echo $p->potongan ?>">
                        <?php echo form_error('potongan','<div class="text-small text-danger"></div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Potongan</label>
                        <input type="number" name="jml_potongan" class="form-control" value="<?php echo $p->jml_potongan ?>">
                        <?php echo form_error('jml_potongan','<div class="text-small text-danger"></div>') ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->