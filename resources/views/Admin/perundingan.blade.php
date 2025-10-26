@php
// Admin-only system
$routePrefix = function($route) {
    return 'admin.' . $route;
};
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Perundingan – {{ config('app.name') }}</title>

    <!-- Vendor CSS -->
    <link href="{{ asset('css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- SB Admin core CSS -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- Inline Custom Styles -->
    <style>

              .gradient-title {
      font-weight: 800;
      background: linear-gradient(90deg, #4016f9ff 0%, #070341ff 80%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      color: transparent;
      display: inline-block;
    }

        /* DataTable enhancements */
        .table th {
            background-color: #123cc5ff !important;
            color: white !important;
            border-color: #010713ff;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        /* Button styling */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Include Sidebar -->
    @include('layouts.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        @include('layouts.header')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h2 mb-0 text-gray-900 gradient-title">Perundingan</h1>
          </div>

          <!-- DataTable Container -->
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="perundinganTable" width="100%" cellspacing="0">
                  <thead style="background-color: #2E5AAC; color: white;">
                      <tr>
                          <th>BIL.</th>
                          <th>NAMA PELANGGAN (Syarikat/Agensi/NGO)</th>
                          <th>BIDANG PROJEK</th>
                          <th>LOKASI PROJEK</th>
                          <th>JUMLAH DANA DIPOHON (RM)</th>
                          <th>TEMPOH PENYELIDIKAN</th>
                          <th>STATUS PERMOHONAN</th>
                          <th>TINDAKAN</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Add/Edit Perundingan Modal -->
          <div class="modal fade" id="addPerundinganModal" tabindex="-1" role="dialog" aria-labelledby="addPerundinganModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addPerundinganModalLabel">Tambah Permohonan Perundingan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="perundinganForm">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Ketua Penyelidik <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_ketua_penyelidik" required>
                            </div>
                            <div class="form-group">
                                <label>Penyelidik Bersama (Jika Ada)</label>
                                <textarea class="form-control" name="penyelidik_bersama" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nama Pelanggan (Syarikat/Agensi/NGO) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_pelanggan" required>
                            </div>
                            <div class="form-group">
                                <label>Bidang Projek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="bidang_projek" required>
                            </div>
                            <div class="form-group">
                                <label>Lokasi Projek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lokasi_projek" required>
                            </div>
                            <div class="form-group">
                                <label>Tajuk Penyelidikan <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="tajuk_penyelidikan" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Dana Dipohon (RM) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" name="jumlah_dana_dipohon" required>
                            </div>
                            <div class="form-group">
                                <label>Tempoh Penyelidikan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="tempoh_penyelidikan" placeholder="Contoh: 12 bulan, 2 tahun" required>
                            </div>
                            <div class="form-group">
                                <label>Status Permohonan <span class="text-danger">*</span></label>
                                <select class="form-control" name="status_permohonan" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Tidak Berjaya">Tidak Berjaya</option>
                                    <option value="Dalam Proses">Dalam Proses</option>
                                    <option value="Lulus">Lulus</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>

          <!-- Delete Confirmation Modal -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title">Pengesahan Padam</h5>
                  <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Adakah anda pasti mahu memadam permohonan ini?</p>
                  <p class="text-muted small">Tindakan ini tidak boleh dibatalkan.</p>
                  <input type="hidden" id="deletePerundinganId">
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                  <button class="btn btn-danger" type="button" id="confirmDelete">Ya, Padam</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Success Alert Modal -->
          <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title">Berjaya</h5>
                  <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="successMessage"></div>
                <div class="modal-footer">
                  <button class="btn btn-success" type="button" data-dismiss="modal">OK</button>
                </div>
              </div>
            </div>
          </div>

          <!-- View Details Modal -->
          <div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-info text-white">
                  <h5 class="modal-title" id="viewDetailsModalLabel">Butiran Permohonan Perundingan</h5>
                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label class="font-weight-bold">Nama Ketua Penyelidik:</label>
                      <p id="detail_nama_ketua" class="mb-2"></p>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label class="font-weight-bold">Penyelidik Bersama:</label>
                      <p id="detail_penyelidik_bersama" class="mb-2" style="white-space: pre-line;"></p>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label class="font-weight-bold">Nama Pelanggan (Syarikat/Agensi/NGO):</label>
                      <p id="detail_nama_pelanggan" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Bidang Projek:</label>
                      <p id="detail_bidang_projek" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Lokasi Projek:</label>
                      <p id="detail_lokasi_projek" class="mb-2"></p>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label class="font-weight-bold">Tajuk Penyelidikan:</label>
                      <p id="detail_tajuk" class="mb-2" style="white-space: pre-line;"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Jumlah Dana Dipohon:</label>
                      <p id="detail_jumlah_dana" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Tempoh Penyelidikan:</label>
                      <p id="detail_tempoh" class="mb-2"></p>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label class="font-weight-bold">Status Permohonan:</label>
                      <p id="detail_status" class="mb-2"></p>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
          <div class="container my-auto">
              <div class="copyright text-center my-auto">
                  <span>Hak Cipta &copy; {{ config('app.name') }} {{ date('Y') }}</span>
              </div>
          </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Core JavaScript-->
  <script src="{{ asset('js/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $(document).ready(function() {
      var table = $('#perundinganTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Malay.json',
            search: "Cari:",
            searchPlaceholder: "Cari dalam semua medan...",
            processing: "Memproses...",
            lengthMenu: "Papar _MENU_ rekod per halaman",
            info: "Memapar _START_ hingga _END_ daripada _TOTAL_ rekod",
            infoEmpty: "Memapar 0 hingga 0 daripada 0 rekod",
            infoFiltered: "(ditapis daripada _MAX_ jumlah rekod)",
            emptyTable: "Tiada data dalam jadual",
            zeroRecords: "Tiada rekod yang sepadan dijumpai"
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        order: [[1, 'asc']], // Default sort by Nama Pelanggan
        initComplete: function() {
            // Add create button next to search
            $('.dataTables_filter').css('float', 'right');
            $('.dataTables_filter input').attr('placeholder', 'Cari permohonan...');
            $('.dataTables_filter').append(
                '<span style="margin-left: 15px;"></span>' +
                '<a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#addPerundinganModal" style="background:#123cc5ff;border-color:#123cc5ff;color:#fff;">' +
                '<i class="fas fa-plus"></i> Tambah Permohonan</a>'
            );
        },
        ajax: {
          url: '{{ route('admin.perundingan.data') }}'
        },
        columns: [
          { 
            data: null, 
            render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }, 
            orderable: false, 
            searchable: false,
            width: "5%"
          },
          { 
            data: 'nama_pelanggan', 
            name: 'nama_pelanggan',
            orderable: true,
            searchable: true
          },
          { 
            data: 'bidang_projek', 
            name: 'bidang_projek',
            orderable: true,
            searchable: true
          },
          { 
            data: 'lokasi_projek', 
            name: 'lokasi_projek',
            orderable: true,
            searchable: true
          },
          { 
            data: 'jumlah_dana_dipohon', 
            name: 'jumlah_dana_dipohon',
            orderable: true,
            searchable: true,
            render: function(data, type, row) {
              if (type === 'display') {
                var num = parseFloat(data);
                return 'RM ' + num.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
              }
              return data;
            }
          },
          { 
            data: 'tempoh_penyelidikan', 
            name: 'tempoh_penyelidikan',
            orderable: true,
            searchable: true
          },
          { 
            data: 'status_permohonan', 
            name: 'status_permohonan',
            orderable: true,
            searchable: true,
            render: function(data, type, row) {
              var badgeClass = '';
              if (data === 'Lulus') {
                badgeClass = 'badge-success';
              } else if (data === 'Tidak Berjaya') {
                badgeClass = 'badge-danger';
              } else {
                badgeClass = 'badge-warning';
              }
              return '<span class="badge ' + badgeClass + '">' + data + '</span>';
            }
          },
          { 
            data: 'action_buttons', 
            name: 'action_buttons',
            orderable: false,
            searchable: false,
            width: "12%"
          }
        ]
      });

      // Handle form submission
      $('#perundinganForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        var id = $(this).attr('data-id');
        var url = id ? '{{ url("admin/perundingan") }}/' + id : '{{ route("admin.perundingan.store") }}';
        var method = id ? 'PUT' : 'POST';
        
        if (id) {
          formData += '&_method=PUT';
        }
        
        $.ajax({
          url: url,
          type: 'POST',
          data: formData,
          success: function(result) {
            $('#addPerundinganModal').modal('hide');
            $('#perundinganForm')[0].reset();
            $('#successMessage').html(id ? 'Permohonan berjaya dikemaskini.' : 'Permohonan berjaya disimpan.');
            $('#successModal').modal('show');
            $('#perundinganTable').DataTable().ajax.reload();
          },
          error: function(xhr) {
            alert('Ralat berlaku. Sila cuba lagi.');
          }
        });
      });

      // Handle view details button
      $(document).on('click', '.view-perundingan-btn', function() {
        var id = $(this).data('id');
        
        $.ajax({
          url: '{{ url("admin/perundingan") }}/' + id + '/edit',
          type: 'GET',
          success: function(data) {
            $('#detail_nama_ketua').text(data.nama_ketua_penyelidik || '-');
            $('#detail_penyelidik_bersama').text(data.penyelidik_bersama || '-');
            $('#detail_nama_pelanggan').text(data.nama_pelanggan || '-');
            $('#detail_bidang_projek').text(data.bidang_projek || '-');
            $('#detail_lokasi_projek').text(data.lokasi_projek || '-');
            $('#detail_tajuk').text(data.tajuk_penyelidikan || '-');
            $('#detail_tempoh').text(data.tempoh_penyelidikan || '-');
            
            var jumlahDana = parseFloat(data.jumlah_dana_dipohon);
            $('#detail_jumlah_dana').text('RM ' + jumlahDana.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
            
            var badgeClass = '';
            if (data.status_permohonan === 'Lulus') {
              badgeClass = 'badge-success';
            } else if (data.status_permohonan === 'Tidak Berjaya') {
              badgeClass = 'badge-danger';
            } else {
              badgeClass = 'badge-warning';
            }
            $('#detail_status').html('<span class="badge ' + badgeClass + '">' + data.status_permohonan + '</span>');
            
            $('#viewDetailsModal').modal('show');
          },
          error: function(xhr) {
            alert('Ralat berlaku. Sila cuba lagi.');
          }
        });
      });

      // Handle edit button
      $(document).on('click', '.edit-perundingan-btn', function() {
        var id = $(this).data('id');
        // Load data and open modal for editing
        $.ajax({
          url: '{{ url("admin/perundingan") }}/' + id + '/edit',
          type: 'GET',
          success: function(data) {
            $('#addPerundinganModalLabel').text('Edit Permohonan Perundingan');
            $('#perundinganForm').attr('data-id', id);
            $('input[name="nama_ketua_penyelidik"]').val(data.nama_ketua_penyelidik);
            $('textarea[name="penyelidik_bersama"]').val(data.penyelidik_bersama || '');
            $('input[name="nama_pelanggan"]').val(data.nama_pelanggan);
            $('input[name="bidang_projek"]').val(data.bidang_projek);
            $('input[name="lokasi_projek"]').val(data.lokasi_projek);
            $('textarea[name="tajuk_penyelidikan"]').val(data.tajuk_penyelidikan);
            $('input[name="jumlah_dana_dipohon"]').val(parseFloat(data.jumlah_dana_dipohon));
            $('input[name="tempoh_penyelidikan"]').val(data.tempoh_penyelidikan);
            $('select[name="status_permohonan"]').val(data.status_permohonan);
            $('#addPerundinganModal').modal('show');
          },
          error: function(xhr) {
            alert('Ralat berlaku. Sila cuba lagi.');
          }
        });
      });

      // Handle delete button - show confirmation modal
      $(document).on('click', '.delete-perundingan-btn', function() {
        var id = $(this).data('id');
        $('#deletePerundinganId').val(id);
        $('#deleteModal').modal('show');
      });

      // Handle confirm delete button
      $('#confirmDelete').on('click', function() {
        var id = $('#deletePerundinganId').val();
        
        $.ajax({
          url: '{{ url("admin/perundingan") }}/' + id,
          type: 'DELETE',
          data: {
            '_token': '{{ csrf_token() }}'
          },
          success: function(result) {
            $('#deleteModal').modal('hide');
            $('#successMessage').html('Permohonan berjaya dipadam.');
            $('#successModal').modal('show');
            $('#perundinganTable').DataTable().ajax.reload();
          },
          error: function(xhr) {
            $('#deleteModal').modal('hide');
            alert('Ralat berlaku semasa memadam. Sila cuba lagi.');
          }
        });
      });

      // Reset modal when closed
      $('#addPerundinganModal').on('hidden.bs.modal', function() {
        $('#addPerundinganModalLabel').text('Tambah Permohonan Perundingan');
        $('#perundinganForm').removeAttr('data-id');
        $('#perundinganForm')[0].reset();
      });
    });
  </script>

</body>
</html>
