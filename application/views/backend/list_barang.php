<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">
            <h4>Data Barang</h4>

            <!-- Start kodingan disini -->
            <table id="barang" class="table">
                <thead>
                    <a class="btn btn-primary mb-2" href="<?= site_url('backend/barang/new'); ?>">Tambah Data</a>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Harga Awal</th>
                        <th>Status</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($barang as $b) : ?>
                        <tr>
                            <th><?= $no++ ?></th>
                            <td><?= $b->nama_barang ?></td>
                            <td>IDR <?= number_format($b->harga_awal, 2) ?></td>
                            <td><?= $b->status ?></td>
                            <td> <img src="<?= empty($b->gambar) ? base_url('assets/img/no_image.png') : base_url('upload/barang/' . $b->gambar) ?>" width="100">
                            </td>
                            <td>
                                <!--edit-->
                                <?php if ($b->status == "new") : ?>
                                    <a href="<?= site_url('backend/barang/edit/' . $b->id_barang) ?>">
                                        <button type="button" class="btn btn-warning" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <!--delete-->
                                    <a href="#" data-delete-url="<?= site_url('backend/barang/delete/' . $b->id_barang) ?>" onclick="deleteConfirm(this)">
                                        <button type="button" class="btn btn-danger" title="Hapus">
                                            <i class=" fa-solid fa-trash"></i>
                                        </button>
                                    </a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- End-->

            <?php $this->load->view('backend/_partials/footer') ?>
        </div>
    </main>
</body>

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

<!--Datatable-->
<script>
    $(document).ready(function() {
        var table = $('#barang').DataTable({
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