<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">
            <h4>Data Masyarakat</h4>

            <!-- Start kodingan di sini -->
            <table id="Masyarakat" class="table">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Tgl Register</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($masyarakat as $m) : ?>
                        <tr>
                            <th><?= $m->nik ?></th>
                            <td><?= $m->nama ?></td>
                            <td><?= $m->jk ?></td>
                            <td><?= $m->email ?></td>
                            <td><?= $m->no_hp ?></td>
                            <td><?= $m->alamat ?></td>
                            <td><?= $m->nama ?></td>
                            <td><?= $m->status ?></td>
                            <td>
                                <a href="<?= base_url('backend/masyarakat/blokir/' . $m->id_masyarakat) ?>" data="#" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i> </a>
                                <a href="<?= base_url('backend/masyarakat/aktifkan/' . $m->id_masyarakat) ?>" data="#" class="btn btn-primary btn-sm item-delete"><i class="fa fa-check"></i> </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- End -->

            <?php $this->load->view('backend/_partials/footer') ?>
        </div>
    </main>
</body>

</html>

<script>
    $(document).ready(function() {
        var table = $('#Masyarakat').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>