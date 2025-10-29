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
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/bulat_logo2.png') }}">
    <title>Geran Penyelidikan – {{ config('app.name') }}</title>

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

        /* Custom search bar and button layout */
        .dataTables_wrapper .row:first-child {
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
            margin-bottom: 1rem;
        }
        .dataTables_length {
            flex: 0 0 auto;
            margin-right: 1rem;
        }
        .dataTables_filter {
            flex: 1;
            margin-left: 1rem;
            margin-right: 15px;
        }
        .dataTables_filter input {
            margin-left: 0.5rem;
        }

        .dataTables_filter .btn {
            margin-left: 15px;
        }
        .create-file-btn-container {
            flex: 0 0 auto;
        }
        
        /* Button styling */
        .btn-edit {
            color: #fff;
            background-color: #36b9cc;
            border-color: #36b9cc;
        }
        .btn-delete {
            color: #fff;
            background-color: #e74a3b;
            border-color: #e74a3b;
        }
        
        /* DataTable enhancements */
        .table th {
            background-color: #123cc5ff !important;
            color: white !important;
            border-color: #010713ff;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            vertical-align: middle;
        }
        
        .table th.sorting,
        .table th.sorting_asc,
        .table th.sorting_desc {
            cursor: pointer;
            position: relative;
        }
        
        .table th.sorting:hover,
        .table th.sorting_asc:hover,
        .table th.sorting_desc:hover {
            background-color: #254892;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        /* Search input styling */
        .dataTables_filter input {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .dataTables_filter input:focus {
            border-color: #2E5AAC;
            box-shadow: 0 0 0 0.2rem rgba(46, 90, 172, 0.25);
            outline: 0;
        }
        
        /* Processing indicator */
        .dataTables_processing {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dataTables_wrapper .row:first-child {
                flex-wrap: wrap;
            }
            .dataTables_length,
            .dataTables_filter,
            .create-file-btn-container {
                flex: 0 0 100%;
                margin: 0.5rem 0;
            }
        }
    </style>
</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    @include('layouts.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        @include('layouts.header')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h2 mb-4 text-gray-900 gradient-title">Geran Penyelidikan</h1>

          <!-- Filter Section -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h6 class="mb-3 font-weight-bold text-dark">Tarikh Tutup Permohonan (DD/MM/YYYY)</h6>
              <div class="row align-items-end">
                <div class="col-md-3">
                  <label for="dateFrom" class="form-label">Dari</label>
                  <input type="date" id="dateFrom" class="form-control" placeholder="DD/MM/YYYY">
                </div>
                <div class="col-md-3">
                  <label for="dateTo" class="form-label">Ke</label>
                  <input type="date" id="dateTo" class="form-control" placeholder="DD/MM/YYYY">
                </div>
                <div class="col-md-4">
                  <button type="button" id="applyFilter" class="btn" style="background:#123cc5ff;border-color:#123cc5ff;color:#fff;">
                    <i class="fas fa-search"></i> Cari
                  </button>
                  <button type="button" id="resetFilter" class="btn" style="background:#ff8a00;border-color:#ff8a00;color:#fff;">
                    <i class="fas fa-redo"></i> Semula
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- DataTable Container -->
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="filesTable" width="100%" cellspacing="0">
                  <thead style="background-color: #2E5AAC; color: white;">
                      <tr>
                          <th>BIL.</th>
                          <th>NAMA GERAN PENYELIDIKAN LUAR</th>
                          <th>PEMBERI DANA</th>
                          <th>TARIKH TUTUP PERMOHONAN</th>
                          <th>JUMLAH DANA DIPOHON</th>
                          <th>STATUS PERMOHONAN</th>
                          <th>TINDAKAN</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Add/Edit Geran Modal -->
          <div class="modal fade" id="addGeranModal" tabindex="-1" role="dialog" aria-labelledby="addGeranModalLabel">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addGeranModalLabel">Tambah Permohonan Geran Penyelidikan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="geranForm">
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
                                <label>Nama Geran Penyelidikan Luar <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_geran" required>
                            </div>
                            <div class="form-group">
                                <label>Pemberi Dana <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="pemberi_dana" required>
                            </div>
                            <div class="form-group">
                                <label>Tarikh Tutup Permohonan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tarikh_tutup_permohonan" required>
                            </div>
                            <div class="form-group">
                                <label>Tajuk Penyelidikan <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="tajuk_penyelidikan" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Dana Dipohon (RM) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" name="jumlah_dana" required>
                            </div>
                            <div class="form-group">
                                <label>Status Permohonan <span class="text-danger">*</span></label>
                                <select class="form-control" name="status_permohonan" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Lulus">Lulus</option>
                                    <option value="Dalam Proses">Dalam Proses</option>
                                    <option value="Tidak Berjaya">Tidak Berjaya</option>
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
                  <input type="hidden" id="deleteGeranId">
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
                  <h5 class="modal-title" id="viewDetailsModalLabel">Butiran Permohonan Geran Penyelidikan</h5>
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
                      <label class="font-weight-bold">Nama Geran Penyelidikan Luar:</label>
                      <p id="detail_nama_geran" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Pemberi Dana:</label>
                      <p id="detail_pemberi_dana" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Tarikh Tutup Permohonan:</label>
                      <p id="detail_tarikh" class="mb-2"></p>
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
      var table = $('#filesTable').DataTable({
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
        order: [[3, 'desc']], // Default sort by Date column descending
        initComplete: function() {
            // Add create button next to search
            $('.dataTables_filter').css('float', 'right');
            $('.dataTables_filter input').attr('placeholder', 'Cari permohonan...');
            $('.dataTables_filter').append(
                '<span style="margin-left: 15px;"></span>' +
                '<a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#addGeranModal" style="background:#123cc5ff;border-color:#123cc5ff;color:#fff;">' +
                '<i class="fas fa-plus"></i> Tambah Permohonan</a>'
            );
        },
        ajax: {
          url: '{{ route('admin.geranpenyelidikan.data') }}',
          data: function(d) {
            d.date_from = $('#dateFrom').val();
            d.date_to = $('#dateTo').val();
          }
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
            data: 'nama_geran', 
            name: 'nama_geran',
            orderable: true,
            searchable: true
          },
          { 
            data: 'pemberi_dana', 
            name: 'pemberi_dana',
            orderable: true,
            searchable: true
          },
          { 
            data: 'tarikh_tutup_permohonan', 
            name: 'tarikh_tutup_permohonan',
            orderable: true,
            searchable: true
          },
          { 
            data: 'jumlah_dana', 
            name: 'jumlah_dana',
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
            width: "15%"
          }
        ]
      });

      // Handle form submission
      $('#geranForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        var id = $(this).attr('data-id');
        var url = id ? '{{ url("admin/geran-penyelidikan") }}/' + id : '{{ route("admin.geranpenyelidikan.store") }}';
        var method = id ? 'PUT' : 'POST';
        
        if (id) {
          formData += '&_method=PUT';
        }
        
        $.ajax({
          url: url,
          type: 'POST',
          data: formData,
          success: function(result) {
            $('#addGeranModal').modal('hide');
            $('#geranForm')[0].reset();
            $('#successMessage').html(id ? 'Permohonan berjaya dikemaskini.' : 'Permohonan berjaya disimpan.');
            $('#successModal').modal('show');
            $('#filesTable').DataTable().ajax.reload();
          },
          error: function(xhr) {
            alert('Ralat berlaku. Sila cuba lagi.');
          }
        });
      });

      // Handle view details button
      $(document).on('click', '.view-geran-btn', function() {
        var id = $(this).data('id');
        
        $.ajax({
          url: '{{ url("admin/geran-penyelidikan") }}/' + id + '/edit',
          type: 'GET',
          success: function(data) {
            $('#detail_nama_ketua').text(data.nama_ketua_penyelidik || '-');
            $('#detail_penyelidik_bersama').text(data.penyelidik_bersama || '-');
            $('#detail_nama_geran').text(data.nama_geran || '-');
            $('#detail_pemberi_dana').text(data.pemberi_dana || '-');
            $('#detail_tarikh').text(data.tarikh_tutup_permohonan_formatted || '-');
            $('#detail_tajuk').text(data.tajuk_penyelidikan || '-');
            
            var jumlahDana = parseFloat(data.jumlah_dana);
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
      $(document).on('click', '.edit-geran-btn', function() {
        var id = $(this).data('id');
        // Load data and open modal for editing
        $.ajax({
          url: '{{ url("admin/geran-penyelidikan") }}/' + id + '/edit',
          type: 'GET',
          success: function(data) {
            $('#addGeranModalLabel').text('Edit Permohonan Geran Penyelidikan');
            $('#geranForm').attr('data-id', id);
            $('input[name="nama_ketua_penyelidik"]').val(data.nama_ketua_penyelidik);
            $('textarea[name="penyelidik_bersama"]').val(data.penyelidik_bersama || '');
            $('input[name="nama_geran"]').val(data.nama_geran);
            $('input[name="pemberi_dana"]').val(data.pemberi_dana);
            // Ensure date is in correct format (YYYY-MM-DD) for date input
            $('input[name="tarikh_tutup_permohonan"]').val(data.tarikh_tutup_permohonan);
            $('textarea[name="tajuk_penyelidikan"]').val(data.tajuk_penyelidikan);
            // Keep full precision for jumlah_dana
            $('input[name="jumlah_dana"]').val(parseFloat(data.jumlah_dana));
            $('select[name="status_permohonan"]').val(data.status_permohonan);
            $('#addGeranModal').modal('show');
          },
          error: function(xhr) {
            alert('Ralat berlaku. Sila cuba lagi.');
          }
        });
      });

      // Handle delete button - show confirmation modal
      $(document).on('click', '.delete-geran-btn', function() {
        var id = $(this).data('id');
        $('#deleteGeranId').val(id);
        $('#deleteModal').modal('show');
      });

      // Handle confirm delete button
      $('#confirmDelete').on('click', function() {
        var id = $('#deleteGeranId').val();
        
        $.ajax({
          url: '{{ url("admin/geran-penyelidikan") }}/' + id,
          type: 'DELETE',
          data: {
            '_token': '{{ csrf_token() }}'
          },
          success: function(result) {
            $('#deleteModal').modal('hide');
            $('#successMessage').html('Permohonan berjaya dipadam.');
            $('#successModal').modal('show');
            $('#filesTable').DataTable().ajax.reload();
          },
          error: function(xhr) {
            $('#deleteModal').modal('hide');
            alert('Ralat berlaku semasa memadam. Sila cuba lagi.');
          }
        });
      });

      // Reset modal when closed
      $('#addGeranModal').on('hidden.bs.modal', function() {
        $('#addGeranModalLabel').text('Tambah Permohonan Geran Penyelidikan');
        $('#geranForm').removeAttr('data-id');
        $('#geranForm')[0].reset();
      });

      // Filter by year
      $('#applyFilter').on('click', function() {
        table.ajax.reload();
      });

      // Reset filter
      $('#resetFilter').on('click', function() {
        $('#dateFrom').val('');
        $('#dateTo').val('');
        table.ajax.reload();
      });
    });
  </script>
</body>
</html>