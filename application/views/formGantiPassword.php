<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>

    <div class="card" style="width: 50%;">
        <div class="card-body">
            <form action="<?php echo base_url('gantiPassword/gantiPasswordAksi') ?>" method="post">
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="password" name="passBaru" class="form-control">
                    <?php echo form_error('passBaru','<small class="text-danger pl-2">','</small>') ?>
                </div>
                <div class="form-group">
                    <label for="">Ulangi Password Baru</label>
                    <input type="password" name="ulangPass" class="form-control">
                    <?php echo form_error('ulangPass','<small class="text-danger pl-2">','</small>') ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->   