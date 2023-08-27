<div>
    <div class="page-hero page-container " id="page-hero">
        <div class="padding d-flex">
            <div class="page-title">
                <h2 class="text-md text-highlight"><?=$page_title?></h2>
            </div>
            <div class="flex"></div>
        </div>
    </div>
    <div class="page-content page-container" id="page-content">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills no-border" id="tab">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-form" role="tab" aria-controls="tab-form" aria-selected="false">Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-data" role="tab" aria-controls="tab-data" aria-selected="false">Data</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="padding">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-form" role="tabpanel" aria-labelledby="tab-form">
                        <form id="form" data-plugin="parsley" data-option="{}">
                                        <div id="rootwizard" data-plugin="bootstrapWizard" data-option="{
                                                    tabClass: '',
                                                    nextSelector: '.button-next',
                                                    previousSelector: '.button-previous',
                                                    firstSelector: '.button-first',
                                                    lastSelector: '.button-last',
                                                    onTabClick: function(tab, navigation, index) {
                                                    return false;
                                                    },
                                                    onNext: function(tab, navigation, index) {
                                                    var instance = $('#form').parsley();
                                                    instance.validate();
                                                    if(!instance.isValid()) {
                                                        return false;
                                                    }
                                                    }
                                                }">
                                            <ul class="nav mb-3">
                                                <li class="nav-item">
                                                    <a class="nav-link text-center" href="#tab1" data-toggle="tab">
                                                        <span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-primary">1</span>
                                                        <div class="mt-2">
                                                            <div class="text-muted">Data</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-center" href="#tab2" data-toggle="tab">
                                                        <span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-primary">2</span>
                                                        <div class="mt-2">
                                                            <div class="text-muted">Unsur Administrasi</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-center" href="#tab3" data-toggle="tab">
                                                        <span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-primary">3</span>
                                                        <div class="mt-2">
                                                            <div class="text-muted">Unsur Teknis Utama</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-center" href="#tab4" data-toggle="tab">
                                                        <span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-primary">4</span>
                                                        <div class="mt-2">
                                                            <div class="text-muted">Unsur Teknis Penunjang</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-center" href="#tab5" data-toggle="tab">
                                                        <span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-primary">5</span>
                                                        <div class="mt-2">
                                                            <div class="text-muted">Kesimpulan</div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content p-3">
                                                <div class="tab-pane active" id="tab1">
                                                    <div class="form-group">
                                                        <label>Hari/Tanggal</label>
                                                        <input type="text" class="form-control" name="rampcheck_date" value="<?=date('d M Y');?>" readonly>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label>Lokasi</label>
                                                            <input type="text" class="form-control" name="lokasi_id" required>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Nama Lokasi</label>
                                                            <input type="text" class="form-control" name="rampcheck_nama_lokasi" placeholder="Nama Lokasi" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Pengemudi</label>
                                                        <input type="text" class="form-control" placeholder="Nama Pengemudi" name="rampcheck_nama_pengemudi" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Umur</label>
                                                        <input type="numeric" class="form-control" placeholder="Umur Pengemudi" name="rampcheck_umur" required>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label>Nama PO</label>
                                                            <input type="text" class="form-control" name="po_id" required>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Nomor Kendaraan</label>
                                                            <input type="text" class="form-control" name="rampcheck_noken" placeholder="H 0000 ABC" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-4">
                                                            <label>Nomor STUK</label>
                                                            <input type="text" class="form-control" name="rampcheck_no_stuk" placeholder="Nomor STUK" required>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Jenis Angkutan</label>
                                                            <input type="text" class="form-control" name="rampcheck_jenis_angkutan" placeholder="Jenis Angkutan" required>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Trayek</label>
                                                            <input type="text" class="form-control" name="rampcheck_trayek" placeholder="Trayek" required>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="checkbox">
                                                        <label class="ui-check">
                                                            <input type="checkbox" name="check" checked required="true">
                                                            <i></i> I agree to the
                                                            <a href="#" class="text-info">Terms of Service</a>
                                                        </label>
                                                    </div> -->
                                                </div>
                                                <div class="tab-pane" id="tab2">
                                                    <form>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kartu Uji / STUK</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nra_kartu_uji">
                                                                    <div class="form-check form-check-inline w-25">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kartu_uji" value="0"><i class="green"></i>
                                                                            Ada, Berlaku
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline w-25">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kartu_uji" value="1"><i class="red"></i>
                                                                            Tidak Berlaku
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline w-25">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kartu_uji" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline w-25">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kartu_uji" value="3"><i class="red"></i>
                                                                            Tidak Sesuai Fisik
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">KP. Reguler</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nra_kp_reguler">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kp_reguler" value="0"><i class="green"></i>
                                                                            Ada, Berlaku
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kp_reguler" value="1"><i class="red"></i>
                                                                            Tidak Berlaku
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kp_reguler" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kp_reguler" value="3"><i class="red"></i>
                                                                            Tidak Sesuai Fisik
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">KP. Cadangan (untuk kendaraan cadangan)</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nra_kp_cadangan">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kp_cadangan" value="0"><i class="green"></i>
                                                                            Ada, Berlaku
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kp_cadangan" value="1"><i class="red"></i>
                                                                            Tidak Berlaku
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kp_cadangan" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_kp_cadangan" value="3"><i class="red"></i>
                                                                            Tidak Sesuai Fisik
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">SIM Pengemudi</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nra_sim_pengemudi">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_sim_pengemudi" value="0"><i class="green"></i>
                                                                            A Umum
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_sim_pengemudi" value="1"><i class="green"></i>
                                                                            B1 Umum
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_sim_pengemudi" value="2"><i class="green"></i>
                                                                            B2 Umum
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nra_sim_pengemudi" value="3"><i class="red"></i>
                                                                            SIM Tidak Sesuai
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane" id="tab3">
                                                    <form>
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>A. SISTEM PENERANGAN</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Lampu Utama Kendaraan - Dekat</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_luk_dekat">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_luk_dekat" value="0"><i class="green"></i>
                                                                            Semua Menyala
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_luk_dekat" value="1"><i class="red"></i>
                                                                            Tidak Menyala: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_luk_dekat" value="2"><i class="red"></i>
                                                                            Tidak Menyala: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Lampu Utama Kendaraan - Jauh</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_luk_jauh">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_luk_jauh" value="0"><i class="green"></i>
                                                                            Semua Menyala
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_luk_jauh" value="1"><i class="red"></i>
                                                                            Tidak Menyala: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_luk_jauh" value="2"><i class="red"></i>
                                                                            Tidak Menyala: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Lampu Penunjuk Arah - Dekat</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_lpa_dekat">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lpa_dekat" value="0"><i class="green"></i>
                                                                            Semua Menyala
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lpa_dekat" value="1"><i class="red"></i>
                                                                            Tidak Menyala: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lpa_dekat" value="2"><i class="red"></i>
                                                                            Tidak Menyala: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Lampu Penunjuk Arah - Jauh</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_lpa_jauh">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lpa_jauh" value="0"><i class="green"></i>
                                                                            Semua Menyala
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lpa_jauh" value="1"><i class="red"></i>
                                                                            Tidak Menyala: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lpa_jauh" value="2"><i class="red"></i>
                                                                            Tidak Menyala: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Lampu Rem</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_lmp_rem">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lmp_rem" value="0"><i class="green"></i>
                                                                            Semua Menyala
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lmp_rem" value="1"><i class="red"></i>
                                                                            Tidak Menyala: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lmp_rem" value="2"><i class="red"></i>
                                                                            Tidak Menyala: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Lampu Mundur</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_lmp_mundur">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lmp_mundur" value="0"><i class="green"></i>
                                                                            Semua Menyala
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lmp_mundur" value="1"><i class="red"></i>
                                                                            Tidak Menyala: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_lmp_mundur" value="2"><i class="red"></i>
                                                                            Tidak Menyala: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <!-- Beginning of Sistem Pengereman -->
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>B. SISTEM PENGEREMAN</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kondisi Rem Utama</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_rem_utama">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_rem_utama" value="0"><i class="green"></i>
                                                                            Berfungsi
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_rem_utama" value="1"><i class="red"></i>
                                                                            Tidak Berfungsi
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kondisi Rem Parkir</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_rem_parkir">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_rem_parkir" value="0"><i class="green"></i>
                                                                            Berfungsi
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_rem_parkir" value="1"><i class="red"></i>
                                                                            Tidak Berfungsi
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Sistem Pengereman -->
                                                        <!-- Beginning of Ban -->
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>C. BAN</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kondisi Ban Depan</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_ban_depan">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_ban_depan" value="0"><i class="green"></i>
                                                                            Semua Laik
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_ban_depan" value="1"><i class="red"></i>
                                                                            Tidak Laik: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_ban_depan" value="2"><i class="red"></i>
                                                                            Tidak Laik: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kondisi Ban Belakang</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_ban_belakang">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_ban_belakang" value="0"><i class="green"></i>
                                                                            Semua Laik
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_ban_belakang" value="1"><i class="red"></i>
                                                                            Tidak Laik: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_ban_belakang" value="2"><i class="red"></i>
                                                                            Tidak Laik: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Ban -->
                                                        <!-- Beginning of Perlengkapan -->
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>D. PERLENGKAPAN</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Sabuk Keselamatan Pengemudi</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_perlengkapan_skp">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_perlengkapan_skp" value="0"><i class="green"></i>
                                                                            Ada dan Fungsi
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_perlengkapan_skp" value="1"><i class="red"></i>
                                                                            Tidak Fungsi
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_perlengkapan_skp" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Perlengkapan -->
                                                        <!-- Beginning of Pengukur Kecepatan -->
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>E. PENGUKUR KECEPATAN</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Pengukur Kecepatan</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_pengukur_kecepatan">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_pengukur_kecepatan" value="0"><i class="green"></i>
                                                                            Ada dan Berfungsi
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_pengukur_kecepatan" value="1"><i class="red"></i>
                                                                            Tidak Berfungsi
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_pengukur_kecepatan" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Pengukur Kecepatan -->
                                                        <!-- Beginning of Penghapus Kaca -->
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>F. PENGHAPUS KACA (WIPER)</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Penghapus Kaca</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_penghapus_kaca">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_penghapus_kaca" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_penghapus_kaca" value="1"><i class="red"></i>
                                                                            Tidak Berfungsi
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_penghapus_kaca" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Penghapus Kaca -->
                                                        <!-- Beginning of Tanggap Darurat -->
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>G. TANGGAP DARURAT</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Pintu Darurat</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_tangdar_pindar">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_tangdar_pindar" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_tangdar_pindar" value="1"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Jendela Darurat</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_tangdar_jendar">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_tangdar_jendar" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_tangdar_jendar" value="1"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Alat Pemukul/Pemecah Kaca</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_tangdar_pemka">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_tangdar_pemka" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_tangdar_pemka" value="1"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">APAR (Alat Pemadam Api Ringan)</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nru_tangdar_apar">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_tangdar_apar" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_tangdar_apar" value="1"><i class="red"></i>
                                                                            Kadaluarsa
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nru_tangdar_apar" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Tanggap Darurat -->
                                                    </form>
                                                </div>
                                                <div class="tab-pane" id="tab4">
                                                        <!-- Beginning of Sistem Penerangan -->
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>A. SISTEM PENERANGAN</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Lampu Posisi Depan</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_lamp_dep">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_lamp_dep" value="0"><i class="green"></i>
                                                                            Semua Menyala
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_lamp_dep" value="1"><i class="red"></i>
                                                                            Tidak Menyala: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_lamp_dep" value="2"><i class="red"></i>
                                                                            Tidak Menyala: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Lampu Posisi Belakang</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_lamp_bel">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_lamp_bel" value="0"><i class="green"></i>
                                                                            Semua Menyala
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_lamp_bel" value="1"><i class="red"></i>
                                                                            Tidak Menyala: Kanan
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_lamp_bel" value="2"><i class="red"></i>
                                                                            Tidak Menyala: Kiri
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Sistem Penerangan -->
                                                        <!-- Beginning of Badan Kendaraan -->
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>B. BADAN KENDARAAN</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kondisi Kaca Depan</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_bk_kcd">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_kcd" value="0"><i class="green"></i>
                                                                            Baik
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_kcd" value="1"><i class="red"></i>
                                                                            Kurang Baik
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Pintu Utama</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_bk_pu">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_pu" value="0"><i class="green"></i>
                                                                            Baik
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_pu" value="1"><i class="red"></i>
                                                                            Kurang Baik
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kondisi Rem Utama</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_bk_kru">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_kru" value="0"><i class="green"></i>
                                                                            Sesuai
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_kru" value="1"><i class="red"></i>
                                                                            Tidak Sesuai
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kondisi Rem Parkir</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_bk_krp">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_krp" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_krp" value="1"><i class="red"></i>
                                                                            Tidak Berfungsi
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_krp" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kondisi Lantai dan Tangga</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_bk_lt">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_lt" value="0"><i class="green"></i>
                                                                            Baik
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_bk_lt" value="1"><i class="red"></i>
                                                                            Keropos/Berlubang
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Badan Kendaraan -->
                                                        <!-- Beginning of Kapasitas Tempat Duduk -->
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>C. KAPASITAS TEMPAT DUDUK</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Jumlah Tempat Duduk Penumpang</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_ktd_jml">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_ktd_jml" value="0"><i class="green"></i>
                                                                            Sesuai
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_ktd_jml" value="1"><i class="red"></i>
                                                                            Tidak Sesuai
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Kapasitas Tempat Duduk -->
                                                        <!-- Beginning of Perlengkapan Kendaraan -->
                                                        <div class="form-group">
                                                            <label class="form-label"><h6>D. PERLENGKAPAN KENDARAAN</h6></label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Ban Cadangan</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_pk_bc">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_bc" value="0"><i class="green"></i>
                                                                            Ada dan Laik
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_bc" value="1"><i class="red"></i>
                                                                            Tidak Laik
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_bc" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Segitiga Pengaman</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_pk_sp">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_sp" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_sp" value="1"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Dongkrak</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_pk_bc">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_dkr" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_dkr" value="1"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Pembuka Roda</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_pk_pbr">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_pbr" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_pbr" value="1"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Lampu Senter</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_pk_ls">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_ls" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_ls" value="1"><i class="red"></i>
                                                                            Tidak Berfungsi
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_ls" value="2"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Pengganjal Roda</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_pk_pjr">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_pjr" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_pjr" value="1"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Sabuk Keselamatan Penumpang</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_pk_skp">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_skp" value="0"><i class="green"></i>
                                                                            Ada dan Laik
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_skp" value="1"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Kotak PT3K</label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrp_pk_ptk">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_ptk" value="0"><i class="green"></i>
                                                                            Ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrp_pk_ptk" value="1"><i class="red"></i>
                                                                            Tidak Ada
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Perlengkapan Kendaraan -->
                                                </div>
                                                <div class="tab-pane" id="tab5">
                                                    <div class="form-group">
                                                        <h4>
                                                            <strong>BEDASARKAN HASIL DIATAS, MAKA KENDARAAN TERSEBUT DINYATAKAN :</strong>
                                                        </h4>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" style="background:green;color:white;"><b>Laik Jalan</b></label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrk_status">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrk_status" value="0"><i class="green"></i>
                                                                            DIIJINKAN OPERASIONAL
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrk_status" value="1"><i class="green"></i>
                                                                            PERINGATAN/PERBAIKI
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" style="background:red;color:white;"><b>Tidak Laik Jalan</b></label>
                                                            <div class="col-sm-9">
                                                                <div class="mt-2" id="nrk_status">
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrk_status" value="2"><i class="red"></i>
                                                                            TILANG DAN DILARANG OPERASIONAL
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="md-check">
                                                                            <input type="radio" name="nrk_status" value="3"><i class="red"></i>
                                                                            DILARANG OPERASIONAL
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-group mb-5">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Catatan</span>
                                                            </div>
                                                            <textarea class="form-control" aria-label="Catatan" style="max-width:600px;"></textarea>
                                                        </div>

                                                        <h6>Catatan : Jika setiap unsur terdapat pelanggaran, maka sanksi yang dikenakan adalah sanksi yang paling berat</h6>
                                                    </div>
                                                </div>
                                                <div class="row py-3">
                                                    <div class="col-6">
                                                        <a href="#" class="btn btn-white button-next">
                                                            <i data-feather="chevron-left"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-white button-previous">
                                                            <i data-feather="arrow-left"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex justify-content-end">
                                                            <a href="#" class="btn btn-white button-next">
                                                                <i data-feather="arrow-right"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-white button-last">
                                                                <i data-feather="chevron-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                        </div>

                        <div class="tab-pane fade" id="tab-data" role="tabpanel" aria-labelledby="tab-data">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-theme table-row v-middle">
                                    <thead>
                                        <tr>
                                            <th><span>#</span></th>
                                            <th><span>Nama Modul</span></th>
                                            <th><span>Nama Menu</span></th>
                                            <th><span>Url Menu</span></th>
                                            <th><span>Parent Menu</span></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const auth_insert = '<?=$rules->i?>';
    const auth_edit = '<?=$rules->e?>';
    const auth_delete = '<?=$rules->d?>';
    const auth_otorisasi = '<?=$rules->o?>';

    const url = '<?=base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1)?>';
    const url_ajax = '<?=base_url() . "/" . uri_segment(0) . "/ajax"?>';

    var dataStart = 0;
    var coreEvents;

    const select2Array = [];

    $(document).ready(function(){
        coreEvents = new CoreEvents();
        coreEvents.url = url;
        coreEvents.ajax = url_ajax;
        coreEvents.csrf = { "<?=csrf_token()?>": "<?=csrf_hash()?>" };
        coreEvents.tableColumn = datatableColumn();

        coreEvents.insertHandler = {
            placeholder : 'Berhasil menyimpan menu',
            afterAction : function(result) {

            }
        }

        coreEvents.editHandler = {
            placeholder : '',
            afterAction : function(result) {
                setTimeout(function() {
                    $('#module_id').val(result.data.module_id).trigger('change');

                    getListMenu(result.data.module_id,function(){
                        $('#menu_id').val(result.data.menu_id).trigger('change');
                    });
                },500);
            }
        }

        coreEvents.deleteHandler = {
            placeholder : 'Berhasil menghapus menu',
            afterAction : function() {

            }
        }

        coreEvents.resetHandler = {
            action : function() {
                $('#menu_id').data('select2').destroy();
                $('#menu_id').html('');
                $('#menu_id').select2({ placeholder : "Pilih modul terlebih dahulu" });
                $('#module_id').val(null).trigger('change');
            }
        }

        coreEvents.load();

        $('#module_id').select2({
            placeholder : "Pilih modul"
        }).on('select2:select', function (e) {
            getListMenu(e.params.data.id,function(){});
        });

        $('#menu_id').select2({
            placeholder : "Pilih modul terlebih dahulu"
        });
    });

   function getListMenu(id,completion) {
        $('#menu_id').data('select2').destroy();

        $.get({
            url : url_ajax + "/menu_select_get/" +id,
            dataType : 'html',
            success: function(result){
                $('#menu_id').html(result);
                $('#menu_id').select2();
                completion();
            }
        })
    }

    function datatableColumn(){
        let columns = [
                {
                    data: "id", orderable: false, width: 100,
                    render: function (a, type, data, index) {
                        return dataStart + index.row + 1
                    }
                },
                {data: "module_name", orderable: true},
                {data: "menu_name", orderable: true},
                {data: "menu_url", orderable: true},
                {data: "menu_parent", orderable: true,
                    render: function (a, type, data, index) {
                        return data.menu_parent || '';
                    }
                },
                {
                    data: "id", orderable: false, width: 100,
                    render: function (a, type, data, index) {
                        let button = ""

                        if(auth_edit == "1"){
                            button += '<button class="btn btn-sm btn-outline-primary edit" data-id="'+data.id+'" title="Edit">\
                                    <i class="fa fa-edit"></i>\
                                </button>\
                                ';
                        }

                        if(auth_delete == "1"){
                            button += '<button class="btn btn-sm btn-outline-danger delete" data-id="'+data.id+'" title="Delete">\
                                        <i class="fa fa-trash-o"></i>\
                                    </button></div>';
                        }

                        button += (button == "") ? "<b>Tidak ada aksi</b>" : ""

                        return button;
                    }
                }
            ];

        return columns;
    }
</script>