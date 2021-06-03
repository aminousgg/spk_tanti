<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $judul ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/fontawesome-free/css/all.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/dist/css/adminlte.min.css">


  <style>
    /* Code By Webdevtrick ( https://webdevtrick.com ) */
  .container_ {
    padding: 50px 10%;
  }

  .box {
    position: relative;
    background: #ffffff;
    width: 100%;
  }

  .box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
    border-bottom: 1px solid #f4f4f4;
    margin-bottom: 10px;
  }

  .box-tools {
    position: absolute;
    right: 10px;
    top: 5px;
  }

  .dropzone-wrapper {
    border: 2px dashed #91b0b3;
    color: #92b0b3;
    position: relative;
    height: 150px;
  }

  .dropzone-desc {
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    text-align: center;
    width: 40%;
    top: 50px;
    font-size: 16px;
  }

  .dropzone,
  .dropzone:focus {
    position: absolute;
    outline: none !important;
    width: 100%;
    height: 150px;
    cursor: pointer;
    opacity: 0;
  }

  .dropzone-wrapper:hover,
  .dropzone-wrapper.dragover {
    background: #ecf0f5;
  }

  .preview-zone {
    text-align: center;
  }

  .preview-zone .box {
    box-shadow: none;
    border-radius: 0;
    margin-bottom: 0;
  }

  .btn-primary_ {
    background-color: crimson;
    border: 1px solid #212121;
  }
  </style>


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php $this->load->view('template/header') ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('template/sidebar') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h2>
                      <?= $judul ?>
                    </h2>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header bg-secondary text-light">Photo</div>
                  <div class="card-body text-center">
                    <div style="height:240px !important; width: 90% !important; margin: auto !important;">
                      <img class="img-thumbnail" src="<?= base_url('res/profile')."/".$pelamar['foto'] ?>"
                      style="max-width: 100% !important; max-height: 100% !important;">
                    </div>
                    <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#m_profile">Upload</button>
                  </div>
                </div>

                <ul class="list-group" style="cursor: pointer;">
                  <li class="list-group-item active" id="dd">
                    Datadiri
                    <?php if($kelengkapan['datadiri'] == 1){ ?>
                      <span class="badge badge-success float-right"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <?php }else{ ?>
                      <span class="badge badge-danger float-right">Belum Lengkap</span>
                    <?php } ?>
                  </li>
                  <li class="list-group-item" id="rp">
                    Riwayat Pendidikan
                    <?php if($kelengkapan['pendidikan'] == 1){ ?>
                      <span class="badge badge-success float-right"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <?php }else{ ?>
                      <span class="badge badge-danger float-right">Belum Lengkap</span>
                    <?php } ?>
                  </li>
                  <li class="list-group-item" id="rpk">
                    Riwayat Pekerjaan
                    <?php if($kelengkapan['pekerjaan'] == 1){ ?>
                      <span class="badge badge-success float-right"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <?php }else{ ?>
                      <span class="badge badge-danger float-right">Belum Lengkap</span>
                    <?php } ?>
                  </li>
                  <li class="list-group-item" id="up">
                    Upload Berkas
                    <?php if($kelengkapan['upload'] == 1){ ?>
                      <span class="badge badge-success float-right"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <?php }else{ ?>
                      <span class="badge badge-danger float-right">Belum Lengkap</span>
                    <?php } ?>
                  </li>
                </ul>



              </div>
              <div class="col-md-8">
                <div class="card data_diri">
                  <div class="card-header">Mohon Mengisi Datadiri</div>
                  <div class="card-body">
                    <?= form_open('main/insertDatadiri') ?>
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" autocomplete="off" class="form-control" value="<?= $pelamar['nama'] ?>" placeholder="Nama Lengkap" name="nama">
                      </div>
                      <div class="form-group">
                        <label>ID Ktp</label>
                        <input type="text" autocomplete="off" class="form-control" value="<?= $pelamar['nik'] ?>" placeholder="Nomer Induk kependudukan" name="nik">
                      </div>
                      <div class="form-group">
                        <label>TTL</label>
                        <div class="row">
                          <div class="col-4"><input type="date" class="form-control" value="<?= $pelamar['tgl_lahir'] ?>" placeholder="Tanggal" name="tgl_lahir"></div>
                          <div class="col-8"><input type="text" class="form-control" value="<?= $pelamar['tmp_lahir'] ?>" placeholder="Tempat" name="tmp_lahir"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>No Telp / No HP</label>
                        <input type="text" class="form-control" value="<?= $pelamar['no_hp'] ?>" placeholder="+62..." name="no_hp">
                      </div>
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" value="<?= $pelamar['gender'] ?>" name="gender">
                          <option value="">Pilih</option>
                          <option value="Laki-laki" <?php if($pelamar['gender']=="Laki-laki"){ echo "selected"; } ?> >Laki-laki</option>
                          <option value="Perempuan" <?php if($pelamar['gender']=="Perempuan"){ echo "selected"; } ?> >Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" placeholder="Alamat Lengkap" name="alamat"><?= $pelamar['alamat'] ?></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    <?= form_close() ?>
                  </div>
                </div>

                <div class="card r_pendidikan">
                  <div class="card-header">Riwayat Pendidikan</div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <label>Pendidikan Formal</label>
                        <table class="table table-bordered table-hovered t_pend_formal">
                          <thead>
                            <tr>
                              <th>Nama Institusi / Sekolah</th>
                              <th>Tahun</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if($kelengkapan['pendidikan']==1){ ?>
                              <?php foreach ($pendidikan1 as $row) { ?>
                                <tr>
                                  <td><?= $row->nama ?> - <?= $row->tingkat ?></td>
                                  <td><?= $row->tahun ?></td>
                                  <td>
                                    <button class="btn btn-primary btn-sm edit_pend_formal"
                                    data-id="<?= $row->id ?>" data-toggle="modal" data-target="#me_pend_formal"
                                    ><i class="fa fa-list-alt"></i></button>
                                    <button class="btn btn-danger btn-sm del_pend_formal"
                                    data-id="<?= $row->id ?>"
                                    ><i class="fa fa-minus"></i></button>
                                  </td>
                                </tr>
                              <?php } ?>
                            <?php } ?>
                          </tbody>
                        </table>
                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#m_pend_formal">Tambah</button>
                      </div>
                    </div>
                    <!--  -->
                    <div class="row">
                      <div class="col-12">
                        <label>Pendidikan Non Formal</label>
                        <table class="table table-bordered table-hovered t_pend_nonformal">
                          <thead>
                            <tr>
                              <th>Nama Institusi / Sekolah</th>
                              <th>Tahun</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($pendidikan2 as $row) { ?>
                                <tr>
                                  <td><?= $row->nama ?> <?= $row->bidang ?> - <?= $row->tahun ?></td>
                                  <td><?= $row->tahun ?></td>
                                  <td>
                                    <button class="btn btn-primary btn-sm edit_pend_nformal"
                                    data-id="<?= $row->id ?>" data-toggle="modal" data-target="#me_pend_nformal"
                                    ><i class="fa fa-list-alt"></i></button>
                                    <button class="btn btn-danger btn-sm del_pend_nformal"
                                    data-id="<?= $row->id ?>"
                                    ><i class="fa fa-minus"></i></button>
                                  </td>
                                </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#m_pend_nonformal">Tambah</button>
                      </div>
                    </div>
                    <?= form_open('main/insertNilai') ?>
                      <div class="row">
                            <p class="mb-0 ml-2 text-danger">Mohon mengisi nilai pada pendidikan terakhir anda !</p>
                            <div class="col-6">
                                <label>Nilai</label>
                                <input type="number" step="0.01" class="form-control" name="nilai" value="<?= $pelamar['nilai'] ?>" required>
                            </div>
                            <div class="col-6">
                                <label>Nilai Range</label>
                                <select name="nilai_range" class="form-control" required>
                                  <option value="">-- Pilih --</option>
                                  <option <?php if($pelamar['range_nilai']=="4"){echo "selected";} ?> value="4">IPK (4)</option>
                                  <option <?php if($pelamar['range_nilai']=="10"){echo "selected";} ?> value="10">Standar (10)</option>
                                </select>
                                <br>
                                <button class="btn btn-primary float-right">Save</button>
                            </div>
                            
                      </div>
                  <?= form_close() ?>

                  </div>
                </div>
                




                <div class="card r_pekerjaan">
                  <div class="card-header">Tuliskan Pengalaman Bekerja</div>
                  <div class="card-body">
                    <table class="table table-hovered table-bordered t_pekerjaan">
                      <thead>
                        <tr>
                          <th>Nama Perusahaan</th>
                          <th>Jabatan</th>
                          <th>Tahun</th>
                          <th>Gaji</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($kelengkapan['pekerjaan']==1){ ?>
                          <?php foreach ($pekerjaan as $row) { ?>
                            <tr>
                              <td><?= $row->nama_perusahaan ?></td>
                              <td><?= $row->jabatan ?></td>
                              <td><?= $row->tahun_mulai ?> - <?= $row->tahun_selesai ?></td>
                              <td><?= $row->gaji ?></td>
                              <td>
                                <button class="btn btn-primary btn-sm edit_kerja"
                                data-id="<?= $row->id ?>" data-toggle="modal" data-target="#medit_pekerjaan"
                                ><i class="fa fa-list-alt"></i></button>
                                <button class="btn btn-danger btn-sm del_pekerjaan"
                                data-id="<?= $row->id ?>"
                                ><i class="fa fa-minus"></i></button>
                              </td>
                            </tr>
                          <?php } ?>
                        <?php } ?>
                      </tbody>
                    </table>
                    <button class="btn btn-success float-right" data-toggle="modal" data-target="#m_pekerjaan">Tambah</button>
                  </div>
                </div>

                <div class="card up_berkas">
                  <div class="card-header">Pemberkasan</div>
                  <div class="card-body text-center">
                    <?php if($kelengkapan['pekerjaan'] == 1){ ?>
                      <div class="row border mb-2 bg-light">
                        <div class="col-12">
                          <label>KTP</label><br>
                          <?php if(pathinfo($pelamar['img_ktp'],PATHINFO_EXTENSION)=="jpg" || pathinfo($pelamar['img_ktp'],PATHINFO_EXTENSION)=="png"){ ?>
                            <img src="<?= base_url('res/ktp')."/".$pelamar['img_ktp'] ?>" width="450" height="300">
                          <?php }elseif (pathinfo($pelamar['img_ktp'],PATHINFO_EXTENSION)=="pdf") { ?>
                            <embed src="<?= base_url('res/ktp')."/".$pelamar['img_ktp'] ?>" width="450" height="300">
                          <?php } ?><br>
                          <button class="btn btn-danger">Update</button>
                        </div>
                      </div>
                      <div class="row border mb-2 bg-light">
                        <div class="col-12">
                          <label>KTP</label><br>
                          <?php if(pathinfo($pelamar['img_cv'],PATHINFO_EXTENSION)=="jpg" || pathinfo($pelamar['img_cv'],PATHINFO_EXTENSION)=="png"){ ?>
                            <img src="<?= base_url('res/cv')."/".$pelamar['img_cv'] ?>" width="450" height="300">
                          <?php }elseif (pathinfo($pelamar['img_cv'],PATHINFO_EXTENSION)=="pdf") { ?>
                            <embed src="<?= base_url('res/cv')."/".$pelamar['img_cv'] ?>" width="450" height="300">
                          <?php } ?><br>
                          <button class="btn btn-danger">Update</button>
                        </div>
                      </div>
                      <div class="row border mb-2 bg-light">
                        <div class="col-12">
                          <label>KTP</label><br>
                          <?php if(pathinfo($pelamar['img_ijasah'],PATHINFO_EXTENSION)=="jpg" || pathinfo($pelamar['img_ijasah'],PATHINFO_EXTENSION)=="png"){ ?>
                            <img src="<?= base_url('res/ijasah')."/".$pelamar['img_ijasah'] ?>" width="450" height="300">
                          <?php }elseif (pathinfo($pelamar['img_ijasah'],PATHINFO_EXTENSION)=="pdf") { ?>
                            <embed src="<?= base_url('res/ijasah')."/".$pelamar['img_ijasah'] ?>" width="450" height="300">
                          <?php } ?><br>
                          <button class="btn btn-danger">Update</button>
                        </div>
                      </div>
                    <?php }else{ ?>
                      <?= form_open_multipart('main/insertBerkas') ?>
                        <div class="container">
                          <div class="row">
                            <div class="col-md-12">
                              <!-- KTP -->
                              <div class="form-group">
                                <label class="control-label">Upload File KTP</label>
                                <div class="preview-zone preview-zone_ktp hidden">
                                  <div class="box box-solid">
                                    <div class="box-header with-border">
                                      <div><b>File ktp</b></div>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-danger btn-xs remove-preview_ktp">
                                          <i class="fa fa-times"></i> Reset The Field
                                        </button>
                                      </div>
                                    </div>
                                    <div class="box-body"></div>
                                  </div>
                                </div>
                                <div class="dropzone-wrapper">
                                  <div class="dropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <p>Choose an image file or drag it here.</p>
                                  </div>
                                  <input type="file" name="ktp" class="dropzone dropzone_ktp" required>
                                </div>
                              </div>
                              <!-- CV -->
                              <div class="form-group">
                                <label class="control-label">Upload File CV</label>
                                <div class="preview-zone preview-zone_cv hidden">
                                  <div class="box box-solid">
                                    <div class="box-header with-border">
                                      <div><b>File CV</b></div>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-danger btn-xs remove-preview_cv">
                                          <i class="fa fa-times"></i> Reset The Field
                                        </button>
                                      </div>
                                    </div>
                                    <div class="box-body"></div>
                                  </div>
                                </div>
                                <div class="dropzone-wrapper">
                                  <div class="dropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <p>Choose an image file or drag it here.</p>
                                  </div>
                                  <input type="file" name="cv" class="dropzone dropzone_cv" required>
                                </div>
                              </div>
                              <!-- IJAZAH -->
                              <div class="form-group">
                                <label class="control-label">Upload File Ijasah</label>
                                <div class="preview-zone preview-zone_ijasah hidden">
                                  <div class="box box-solid">
                                    <div class="box-header with-border">
                                      <div><b>File Ijasah</b></div>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-danger btn-xs remove-preview_ijasah">
                                          <i class="fa fa-times"></i> Reset The Field
                                        </button>
                                      </div>
                                    </div>
                                    <div class="box-body"></div>
                                  </div>
                                </div>
                                <div class="dropzone-wrapper">
                                  <div class="dropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <p>Choose an image file or drag it here.</p>
                                  </div>
                                  <input type="file" name="ijasah" class="dropzone dropzone_ijasah" required>
                                </div>
                              </div>


                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <button type="submit" class="btn btn-primary float-right">Upload</button>
                            </div>
                          </div>
                        </div>
                      <?= form_close() ?>
                    <?php } ?>
                  </div>
                </div>

              </div>
            </div>
            
        </div>
    </section>
  </div>





  <!-- modal tambah pendidikan -->
  <div class="modal fade" id="m_pend_formal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?= form_open('main/insertRiwayatPendidikan') ?>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Pendidikan Formal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label>Nama Institusi</label>
            <input type="text" autocomplete="off" class="form-control" name="nama" required>
            <label>Tingkat</label>
            <select class="form-control" name="tingkat" required>
              <option value="">-- Pilih --</option>
              <option value="SD">Sekolah Dasar</option>
              <option value="SMP">Sekolah Menengah Pertama (SLTP)</option>
              <option value="SMA">Sekolah Menengah Akhir (SLTA)</option>
              <option value="S1">Sarjana 1 (S1)</option>
            </select>
            <label>Tahun</label>
            <input type="text" class="form-control" name="tahun" required>
            <input type="hidden" name="jenis_pend" value="Formal">
            <?php if($kelengkapan['pendidikan']==1){ ?>
              <input type="hidden" name="status" value="tambah">
            <?php }else{ ?>
              <input type="hidden" name="status" value="baru">
            <?php } ?>
            <input type="hidden" name="bidang" value="-">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
    <!-- edit -->
  <div class="modal fade" id="me_pend_formal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?= form_open('main/editRiwayatPendidikan') ?>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Pendidikan Formal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_user" value="<?= $this->session->userdata('sesi')['id_user'] ?>">
            <input type="hidden" name="id" class="id_utama_pend_formal">
            <label>Nama Institusi</label>
            <input type="text" autocomplete="off" class="form-control mep_nama" name="nama" required>
            <label>Tingkat</label>
            <select class="form-control mep_tingkat" name="tingkat" required>
              <option value="">-- Pilih --</option>
              <option value="SD">Sekolah Dasar</option>
              <option value="SMP">Sekolah Menengah Pertama (SLTP)</option>
              <option value="SMA">Sekolah Menengah Akhir (SLTA)</option>
              <option value="S1">Sarjana 1 (S1)</option>
            </select>
            <label>Tahun</label>
            <input type="text" class="form-control mep_tahun" name="tahun" required>
            <input type="hidden" name="jenis_pend" value="Formal">
            <?php if($kelengkapan['pendidikan']==1){ ?>
              <input type="hidden" name="status" value="tambah">
            <?php }else{ ?>
              <input type="hidden" name="status" value="baru">
            <?php } ?>
            <input type="hidden" name="bidang" value="-">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
  <div class="modal fade" id="me_pend_nformal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?= form_open('main/editRiwayatPendidikan') ?>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Pendidikan Formal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_user" value="<?= $this->session->userdata('sesi')['id_user'] ?>">
            <input type="hidden" name="id" class="id_utama_pend_nformal">
            <label>Nama Institusi</label>
            <input type="text" autocomplete="off" class="form-control mepn_nama" name="nama" required>
            <label>Bidang</label>
            <input type="text" class="form-control mepn_bidang" name="bidang">
            <label>Tahun</label>
            <input type="text" class="form-control mepn_tahun" name="tahun" required>
            <input type="hidden" name="jenis_pend" value="Non">
            <?php if($kelengkapan['pendidikan']==1){ ?>
              <input type="hidden" name="status" value="tambah">
            <?php }else{ ?>
              <input type="hidden" name="status" value="baru">
            <?php } ?>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>



  <div class="modal fade" id="m_pend_nonformal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?= form_open('main/insertRiwayatPendidikan') ?>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Pendidikan Non Formal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label>Nama Institusi Penyelenggara</label>
            <input type="text" autocomplete="off" class="form-control" name="nama" required>
            <label>Bidang</label>
            <input type="text" name="bidang" class="form-control" required>
            <label>Tahun</label>
            <input type="text" class="form-control" name="tahun">
            <input type="hidden" name="jenis_pend" value="Non">
            <input type="hidden" name="status" value="tambah">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>

  <!-- tambah modal pekerjaan -->
  <div class="modal fade" id="m_pekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?= form_open('main/insertRiwayatPekerjaan') ?>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Pendidikan Formal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label>Nama Perusaan</label>
            <input type="text" class="form-control" name="nama_perusahaan" required>
            <label>Jabatan</label>
            <input type="text" class="form-control" name="jabatan" required>
            <label>Tahun</label>
            <div class="row">
              <div class="col-6"> <input type="text" class="form-control" name="tahun_mulai" placeholder="Tahun Mulai" required></div>
              <div class="col-6"> <input type="text" class="form-control" name="tahun_selesai" placeholder="Tahun Selesai" required></div>
            </div>
            <label>Gaji</label>
            <input type="number" class="form-control" name="gaji" required>

            <?php if($kelengkapan['pekerjaan']==1){ ?>
              <input type="hidden" name="status" value="tambah">
            <?php }else{ ?>
              <input type="hidden" name="status" value="baru">
            <?php } ?>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
  <!-- edit peker -->
  <div class="modal fade" id="medit_pekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?= form_open('main/editRiwayatPekerjaan') ?>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Pendidikan Formal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" class="id_utama_pekerjaan">
            <label>Nama Perusaan</label>
            <input type="text" class="form-control me_nama_perusahaan" name="nama_perusahaan" required>
            <label>Jabatan</label>
            <input type="text" class="form-control me_jabatan" name="jabatan" required>
            <label>Tahun</label>
            <div class="row">
              <div class="col-6"> <input type="text" class="form-control me_tahun_mulai" name="tahun_mulai" placeholder="Tahun Mulai" required></div>
              <div class="col-6"> <input type="text" class="form-control me_tahun_selesai" name="tahun_selesai" placeholder="Tahun Selesai" required></div>
            </div>
            <label>Gaji</label>
            <input type="number" class="form-control me_gaji" name="gaji" required>

            <?php if($kelengkapan['pekerjaan']==1){ ?>
              <input type="hidden" name="status" value="tambah">
            <?php }else{ ?>
              <input type="hidden" name="status" value="baru">
            <?php } ?>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>

  <!-- modal upload -->
  <div class="modal fade" id="m_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?= form_open_multipart('main/updateProfile') ?>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Image Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label">Upload Foto Profile</label>
              <div class="preview-zone preview-zone_profile hidden">
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <div><b>File foto</b></div>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-danger btn-xs remove-preview_profile">
                        <i class="fa fa-times"></i> Reset The Field
                      </button>
                    </div>
                  </div>
                  <div class="box-body"></div>
                </div>
              </div>
              <div class="dropzone-wrapper">
                <div class="dropzone-desc">
                  <i class="glyphicon glyphicon-download-alt"></i>
                  <p>Pilih file atau seret file.</p>
                </div>
                <input type="file" name="profile" class="dropzone dropzone_profile" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>

  <!-- Main footer -->
  <?php $this->load->view('template/footer') ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets_lte') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets_lte') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets_lte') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets_lte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets_lte') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets_lte') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="<?= base_url('assets_lte') ?>/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets_lte') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url('assets_lte') ?>/dist/js/demo.js"></script> -->


<script>
  var notip = "<?= $this->session->flashdata('notip'); ?>";
  if(notip!=""){
    alert(notip);
  }


  function del(id){
    if (confirm('Are you sure DELETE this?')) {
      // Save it!
      window.location = "<?= base_url('main/del') ?>/"+id;
    } else {
      // Do nothing!
      console.log('Thing was not saved to the database.');
    }
  }

  $(".r_pendidikan").hide();
  $(".r_pekerjaan").hide();
  $(".up_berkas").hide();

  $("#dd").on('click', function(){
    // alert('halo');
    $(".data_diri").show();
    $(".r_pendidikan").hide();
    $(".r_pekerjaan").hide();
    $(".up_berkas").hide();
    $("#dd").removeClass('active');
    $("#rp").removeClass('active');
    $("#rpk").removeClass('active');
    $("#up").removeClass('active');
    $(this).addClass('active');

  });
  $("#rp").on('click', function(){
    $(".data_diri").hide();
    $(".r_pendidikan").show();
    $(".r_pekerjaan").hide();
    $(".up_berkas").hide();
    $("#dd").removeClass('active');
    $("#rp").removeClass('active');
    $("#rpk").removeClass('active');
    $("#up").removeClass('active');
    $(this).addClass('active');
  });
  $("#rpk").on('click', function(){
    $(".data_diri").hide();
    $(".r_pendidikan").hide();
    $(".r_pekerjaan").show();
    $(".up_berkas").hide();
    $("#dd").removeClass('active');
    $("#rp").removeClass('active');
    $("#rpk").removeClass('active');
    $("#up").removeClass('active');
    $(this).addClass('active');
  });
  $("#up").on('click', function(){
    $(".data_diri").hide();
    $(".r_pendidikan").hide();
    $(".r_pekerjaan").hide();
    $(".up_berkas").show();
    $("#dd").removeClass('active');
    $("#rp").removeClass('active');
    $("#rpk").removeClass('active');
    $("#up").removeClass('active');
    $(this).addClass('active');
  });


  $('.t_pend_formal').DataTable({
    "searching": false,
    "lengthChange": false,
    "paging":   false,
    "ordering": false,
    "info":     false
  });
  $('.t_pend_nonformal').DataTable({
    "searching": false,
    "lengthChange": false,
    "paging":   false,
    "ordering": false,
    "info":     false
  });
  $('.t_pekerjaan').DataTable({
    "searching": false,
    "lengthChange": false,
    "paging":   false,
    "ordering": false,
    "info":     false
  });



  var notif_1 = "<?= $this->session->flashdata('notif_1') ?>";
  if(notif_1 != "")
  {
    toastr.success(notif_1);
  }
  var notif_0 = "<?= $this->session->flashdata('notif_0') ?>";
  if(notif_0 != "")
  {
    toastr.success(notif_0);
  }

  $(".dropzone_ktp").change(function() {
    readFile(this, "ktp");
  });
  $(".dropzone_cv").change(function() {
    readFile(this, "cv");
  });
  $(".dropzone_ijasah").change(function() {
    readFile(this, "ijasah");
  });
  $(".dropzone_profile").change(function() {
    readFile(this, "profile");
  });

  $('.dropzone-wrapper').on('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass('dragover');
  });

  $('.dropzone-wrapper').on('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass('dragover');
  });

  $('.remove-preview_ktp').on('click', function() {
    var jenis = "ktp";
    var boxZone = $(this).parents('.preview-zone_'+jenis).find('.box-body');
    var previewZone = $(this).parents('.preview-zone_'+jenis);
    var dropzone = $(this).parents('.form-group').find('.dropzone');
    boxZone.empty();
    previewZone.addClass('hidden');
    reset(dropzone, jenis);
  });
  $('.remove-preview_cv').on('click', function() {
    var jenis = "cv";
    var boxZone = $(this).parents('.preview-zone_'+jenis).find('.box-body');
    var previewZone = $(this).parents('.preview-zone_'+jenis);
    var dropzone = $(this).parents('.form-group').find('.dropzone');
    boxZone.empty();
    previewZone.addClass('hidden');
    reset(dropzone, jenis);
  });
  $('.remove-preview_ijasah').on('click', function() {
    var jenis = "ktp";
    var boxZone = $(this).parents('.preview-zone_'+jenis).find('.box-body');
    var previewZone = $(this).parents('.preview-zone_'+jenis);
    var dropzone = $(this).parents('.form-group').find('.dropzone');
    boxZone.empty();
    previewZone.addClass('hidden');
    reset(dropzone, jenis);
  });
  $('.remove-preview_profile').on('click', function() {
    var jenis = "profile";
    var boxZone = $(this).parents('.preview-zone_'+jenis).find('.box-body');
    var previewZone = $(this).parents('.preview-zone_'+jenis);
    var dropzone = $(this).parents('.form-group').find('.dropzone');
    boxZone.empty();
    previewZone.addClass('hidden');
    reset(dropzone, jenis);
  });

  // edit modal get value
  $(document).on('click', ".edit_pend_formal", function(){
    var id = $(this).data('id');
    $.ajax({
      url   : "<?= base_url('main/getFormEdit') ?>",
      type  : 'GET',
      data  : {id : id},
      success : function(data){
        data = JSON.parse(data);
        $(".mep_nama").val(data.nama);
        $(".mep_tingkat").val(data.tingkat);
        $(".mep_tahun").val(data.tahun);
        $(".id_utama_pend_formal").val(data.id);
      }
    });
  });
  $(document).on('click', '.edit_pend_nformal', function(){
    var id = $(this).data('id');
    $.ajax({
      url   : "<?= base_url('main/getFormEdit') ?>",
      type  : 'GET',
      data  : {id : id},
      success : function(data){
        data = JSON.parse(data);
        $(".mepn_nama").val(data.nama);
        $(".mepn_bidang").val(data.bidang);
        $(".mepn_tahun").val(data.tahun);
        $(".id_utama_pend_nformal").val(data.id);
      }
    });
  });
  $(document).on('click', '.edit_kerja', function(){
    var id = $(this).data('id');
    $.ajax({
      url   : "<?= base_url('main/getFormEditKerja') ?>",
      type  : 'GET',
      data  : {id : id},
      success : function(data){
        data = JSON.parse(data);
        console.log(data);
        $(".me_nama_perusahaan").val(data.nama_perusahaan);
        $(".me_jabatan").val(data.jabatan);
        $(".me_tahun_mulai").val(data.tahun_mulai);
        $(".me_tahun_selesai").val(data.tahun_selesai);
        $(".me_gaji").val(data.gaji);
        $(".id_utama_pekerjaan").val(data.id);
      }
    });
  });

  // delete
  $(document).on('click', '.del_pend_formal', function(){
    var id = $(this).data('id');
    var r = confirm("Apakah anda akan menghapus ini?");
    if (r == true) {
      window.location = "<?= base_url('main/delPendidikan') ?>/"+id
    } else {
      
    }
  });
  $(document).on('click', '.del_pend_nformal', function(){
    var id = $(this).data('id');
    var r = confirm("Apakah anda akan menghapus ini?");
    if (r == true) {
      window.location = "<?= base_url('main/delPendidikan') ?>/"+id
    } else {
      
    }
  });
  $(document).on('click', '.del_pekerjaan', function(){
    var id = $(this).data('id');
    var r = confirm("Apakah anda akan menghapus ini?");
    if (r == true) {
      window.location = "<?= base_url('main/delPekerjaan') ?>/"+id
    } else {
      
    }
  });



  // Code By Webdevtrick ( https://webdevtrick.com )
  function readFile(input, jenis) {
    // var fileTypes = ['jpg', 'jpeg', 'png', 'what', 'ever', 'you', 'want'];
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var extension = input.files[0].name.split('.').pop().toLowerCase();
      if(extension == "pdf"){
        reader.onload = function (e) {
            // $('#uploadForm + img').remove();
            // $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');
            var htmlPreview = '<embed src="'+e.target.result+'" width="450" height="300">';
            var wrapperZone = $(input).parent();
            var previewZone = $(input).parent().parent().find('.preview-zone_'+jenis);
            var boxZone = $(input).parent().parent().find('.preview-zone_'+jenis).find('.box').find('.box-body');

            wrapperZone.removeClass('dragover');
            previewZone.removeClass('hidden');
            boxZone.empty();
            boxZone.append(htmlPreview);
        };
        // reader.readAsDataURL(input.files[0]);
      }else if(extension == "jpg" || extension == "png"){
        reader.onload = function(e) {
          var htmlPreview =
            '<img width="200" src="' + e.target.result + '" />' +
            '<p>' + input.files[0].name + '</p>';
          var wrapperZone = $(input).parent();
          var previewZone = $(input).parent().parent().find('.preview-zone_'+jenis);
          var boxZone = $(input).parent().parent().find('.preview-zone_'+jenis).find('.box').find('.box-body');

          wrapperZone.removeClass('dragover');
          previewZone.removeClass('hidden');
          boxZone.empty();
          boxZone.append(htmlPreview);
        };
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  function reset(e,jenis) {
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
  }

  


</script>
</body>
</html>
