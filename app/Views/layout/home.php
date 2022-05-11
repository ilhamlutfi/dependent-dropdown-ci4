<?= $this->extend('layout/main'); ?>

<?= $this->Section('content'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="row justify-content-center mt-2">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                Input Tempat Tinggal
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <select name="provinsi" id="provinsi" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="kota">Kabupaten / Kota</label>
                    <select name="kota" id="kota" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="desa">Kelurahan / Desa</label>
                    <select name="desa" id="desa" class="form-control">

                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function dataProvinsi() {
        // ambil provinsi
        $('#provinsi').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: 'Cari Provinsi',
            ajax: {
                dataType: 'json',
                url: "<?= site_url('main/ambilDataProvinsi') ?>",
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                }
            }
        });

        // ambil kabupaten
        $('#provinsi').change(function(e) {
            $.ajax({
                type: "post",
                url: "<?= site_url('main/ambilKabupatenKota'); ?>",
                data: {
                    provinsi: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('#kota').html(response.data);
                        $('#kota').select2();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        // ambil kecamatan
        $('#kota').change(function(e) {
            $.ajax({
                type: "post",
                url: "<?= site_url('main/ambilKecamatan'); ?>",
                data: {
                    kecamatan: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('#kecamatan').html(response.data);
                        $('#kecamatan').select2();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        // ambil desa
        $('#kecamatan').change(function(e) {
            $.ajax({
                type: "post",
                url: "<?= site_url('main/ambilDesa'); ?>",
                data: {
                    desa: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('#desa').html(response.data);
                        $('#desa').select2();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    }


    $(document).ready(function() {
        dataProvinsi();
    });
</script>
<?= $this->endSection(); ?>
