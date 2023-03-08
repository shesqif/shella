<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">
            <h4>Data Lelang</h4>

            <!-- Start kodingan di sini -->
            <table id="lelang" class="table">
                <thead>
                    <a class="btn btn-primary mb-2" href="<?= site_url('backend/lelang/new'); ?>">Tambah Data</a>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                        <th>Nama Barang</th>
                        <th>Harga Awal</th>
                        <th>Penanggung Jawab</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lelang as $l) : ?>
                        <tr>
                            <td><?= $l->tgl_mulai ?></td>
                            <td><?= $l->tgl_akhir ?></td>
                            <td><?= $l->nama_barang ?></td>
                            <td>IDR <?= number_format($l->harga_awal, 2) ?></td>
                            <td><?= $l->penanggungjawab ?></td>
                            <td><?= $l->status ?></td>
                            <td>
                                <!--edit-->
                                <a href="<?= site_url('backend/lelang/edit/' . $l->id_lelang) ?>">
                                    <button type="button" class="btn btn-warning" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </a>
                                <!--delete-->
                                <a href="#" data-delete-url="<?= site_url('backend/lelang/delete/' . $l->id_lelang) ?>" onclick="deleteConfirm(this)">
                                    <button type="button" class="btn btn-danger" title="Hapus">
                                        <i class=" fa-solid fa-trash"></i>
                                    </button>
                                </a>
                                <?php if ($l->status == "open" && "closed" && "cancel" && "confirmed") : ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- End -->

</html>
<?php if ($this->session->flashdata('message')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
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

<script>
    $(document).ready(function() {
        var table = $('#lelang').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
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