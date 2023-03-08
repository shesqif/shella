<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">
            <h4>Data Penawaran</h4>

            <!-- Start kodingan disini -->
            <table id="penawaran" class="table">
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penawaran as $p) : ?>
                        <tr>
                            <th><?= $p->tgl_penawaran ?></th>
                            <td><?= $p->nama_barang ?></td>
                            <td><?= $p->nama_penawar ?></td>
                            <td><?= $p->no_hp ?></td>
                            <td><?= $p->email_penawar ?></td>
                            <td><?= $p->status_penawar ?></td>
                            <td><?= $p->harga_awal ?></td>
                            <td><?= $p->harga_penawaran ?></td>
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
<!--Datatable-->
<script>
    $(document).ready(function() {
        var table = $('#penawaran').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>