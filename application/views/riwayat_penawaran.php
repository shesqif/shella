<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/header'); ?>
</head>

<body>
    <?php $this->load->view('partials/sidenav') ?>

    <div class="content">
        <div class="container my-4">
            <br>
            <div style="color:#477a7d">
                <h5>Riwayat Penawaran Diajukan</h5>
            </div>
            <hr>
            <div class=" card-body border mt-2">
                <table id="penawaran" class="table table-striped table-bordered small table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal Penawaran</th>
                            <th>Nama Barang</th>
                            <th>Nama Penawaran</th>
                            <th>No Hp</th>
                            <th>Email</th>
                            <th>Status Penawaran</th>
                            <th>Harga Awal</th>
                            <th>Harga Penawaran</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($penawaran as $p) : ?>
                            <tr>
                                <td><?= $p->tgl_penawaran ?></td>
                                <td><?= $p->nama_barang ?></td>
                                <td><?= $p->nama_penawar ?></td>
                                <td><?= $p->no_hp ?></td>
                                <td><?= $p->email_penawar ?></td>
                                <td><?= $p->status_penawar == 1 ? "Aktif" : "Blocked" ?></td>
                                <td>IDR <?= number_format($p->harga_awal, 2) ?></td>
                                <td>IDR <?= number_format($p->harga_penawaran, 2) ?></td>
                                <td>
                                    <?php if ($p->status_lelang == "open") : ?>
                                        <a href="<?= base_url('page/delete_penawaran/' . $p->id_penawaran) ?>" data="#" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i> </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view('partials/footer'); ?>
</body>

</html>

<?php if ($this->session->flashdata('message')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('message') ?>'
        })
    </script>
<?php endif ?>


<!-- Datatable -->
<script>
    $(document).ready(function() {
        var table = $('#penawaran').DataTable({
            buttons: ['copy', 'excel', 'pdf', 'print'],
            dom: "<'row '<'col-md-4'l> <'col-md-4'B> <'col-md-4'f>>" +
                "<'row '<'col-md-12'tr>>" +
                "<'row '<'col-md-5'i> <'col-md-7'p>>",
            lengthChange: true
        });

        table.buttons().container()
            .appendTo('#penawaran_wrapper .col-md-6:eq(0)');
    });
</script>

<!-- Sweatalert JS -->
<script>
    function deleteConfirm(event) {
        Swal.fire({
            title: 'Delete Confirmation!',
            text: 'Yakin hapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya Hapus',
            confirmButtonColor: 'red'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.deleteUrl);
            }
        });
    }
</script>