<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">
            <h4>Data Users</h4>

            <!-- Start kodingan di sini -->
            <table id="users" class="table">
                <thead>
                    <a class="btn btn-primary mb-2" href="<?= site_url('backend/users/new'); ?>">Tambah Data</a>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nip</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u) : ?>
                        <tr>
                            <th><?= $u->id_user ?></th>
                            <td><?= $u->username ?></td>
                            <td><?= $u->password ?></td>
                            <td><?= $u->nip ?></td>
                            <td><?= $u->nama ?></td>
                            <td><?= $u->level ?></td>
                            <td><?= $u->status ?></td>

                            <td>
                                <?php if ($u->status == "1") : ?>
                                    <!-- edit-->
                                    <a href="<?= site_url('backend/users/edit/' . $u->id_user) ?>">
                                        <button type="button" class="btn btn-warning" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <!--delete-->
                                    <a href="#" data-delete-url="<?= site_url('backend/users/delete/' . $u->id_user) ?>" onclick="deleteConfirm(this)">
                                        <button type="button" class="btn btn-danger" title="Hapus">
                                            <i class=" fa-solid fa-trash"></i>
                                        </button>
                                    </a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </td>

                </tbody>
            </table>
            <!-- End -->

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
        var table = $('#users').DataTable({
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