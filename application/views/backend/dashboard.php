<!DOCTYPE html>
<html Lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">
            <h4>Data Laporan Pemenang</h4>

            <!-- Start kodingan di sini -->
            <table id="laporan" class="table">
                <thead>
                    <tr>
                        <th>Nik</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Id Barang</th>
                        <th>Nama Barang</th>
                        <th>Deskripsi</th>
                        <th>Harga Awal</th>
                        <th>Penawaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporan as $L) : ?>
                        <tr>
                            <td><?= $L->nik ?></td>
                            <td><?= $L->email ?></td>
                            <td><?= $L->no_hp ?></td>
                            <td><?= $L->alamat ?></td>
                            <td><?= $L->id_barang ?></td>
                            <td><?= $L->nama_barang ?></td>
                            <td><?= $L->deskripsi ?></td>
                            <td><?= $L->harga_awal ?></td>
                            <td><?= $L->harga_akhir ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- End -->

            <div class="content">
                <h4>Lelang Berlangsung</h4>

                <!-- Start kodingan di sini -->
                <table id="berlangsung" class="table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Harga Awal</th>
                            <th>Total Penawaran</th>
                            <th>Penawaran Tertinggi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dashboard as $d) : ?>
                            <tr>
                                <td>
                                    <img src="<?= empty($d->gambar) ? base_url('assets/img/no_image.png') : base_url('upload/barang/' . $d->gambar) ?>" width="100">
                                </td>
                                <td><?= $d->nama_barang ?></td>
                                <td><?= $d->tgl_mulai ?></td>
                                <td><?= $d->tgl_akhir ?></td>
                                <td><?= $d->harga_awal ?></td>
                                <td><?= $d->total_penawaran ?></td>
                                <td><?= $d->harga_tertinggi ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

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

<script>
    $(document).ready(function() {
        var table = $('#laporan').DataTable({
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