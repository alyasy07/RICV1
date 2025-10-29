@php
// Admin-only system
$routePrefix = function($route) {
    // For route names
    return 'admin.' . $route;
};

$urlPrefix = function($path) {
    // For URLs
    return 'admin/' . $path;
};
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/bulat_logo2.png') }}">
    <title>Global dan Pengantarabangsaan – {{ config('app.name') }}</title>

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
            <h1 class="h2 mb-0 text-gray-900 gradient-title">Global dan Pengantarabangsaan</h1>
          </div>
          
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
                  <button type="button" id="applyFilter" class="btn" style="background:#123cc5ff;border-color:#123cc5ff;color:#fff;" >
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
                <table class="table table-bordered table-hover table-striped" id="globalTable" width="100%" cellspacing="0">
                  <thead style="background-color: #2E5AAC; color: white;">
                      <tr>
                          <th>BIL.</th>
                          <th>PELAPORAN<br>(PENYELIDIKAN/ PERUNDANGAN/ PENERBITAN/ LAIN-LAIN)</th>
                          <th>PEMBERI DANA / AGENSI TERLIBAT<br>(jika berkaitan)</th>
                          <th>TARIKH TUTUP PERMOHONAN<br>(jika berkaitan)</th>
                          <th>JUMLAH DANA DIPOHON<br>(jika berkaitan)</th>
                          <th>STATUS<br>TINDAKAN / PERMOHONAN</th>
                          <th>TINDAKAN</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Add/Edit Modal -->
          <div class="modal fade" id="globalModal" tabindex="-1" role="dialog" aria-labelledby="globalModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="globalModalLabel">Tambah Global dan Pengantarabangsaan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="globalForm">
                        @csrf
                        <input type="hidden" id="global_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Pelaporan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="pelaporan" name="pelaporan" placeholder="Masukkan jenis pelaporan" required>
                            </div>
                            <div class="form-group">
                                <label>Pemberi Dana / Agensi Terlibat</label>
                                <input type="text" class="form-control" id="pemberi_dana" name="pemberi_dana" placeholder="Jika berkaitan">
                            </div>
                            <div class="form-group">
                                <label>Tarikh Tutup Permohonan</label>
                                <input type="date" class="form-control" id="tarikh_tutup" name="tarikh_tutup" placeholder="Jika berkaitan">
                            </div>
                            <div class="form-group">
                                <label>Jumlah Dana Dipohon (RM)</label>
                                <input type="number" step="0.01" class="form-control" id="jumlah_dana" name="jumlah_dana" placeholder="Jika berkaitan">
                            </div>
                            <div class="form-group">
                                <label>Status Tindakan / Permohonan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="status" name="status" placeholder="Masukkan status tindakan/permohonan" required>
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
                  <p>Adakah anda pasti mahu memadam data ini?</p>
                  <p class="text-muted small">Tindakan ini tidak boleh dibatalkan.</p>
                  <input type="hidden" id="deleteId">
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
                  <h5 class="modal-title" id="viewDetailsModalLabel">Butiran Global dan Pengantarabangsaan</h5>
                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label class="font-weight-bold">Pelaporan:</label>
                      <p id="detail_pelaporan" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Pemberi Dana / Agensi Terlibat:</label>
                      <p id="detail_pemberi_dana" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Tarikh Tutup Permohonan:</label>
                      <p id="detail_tarikh_tutup" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Jumlah Dana Dipohon:</label>
                      <p id="detail_jumlah_dana" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Status Tindakan / Permohonan:</label>
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

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
      // Function to display error messages properly
      function handleAjaxError(xhr) {
        console.error('AJAX Error:', xhr);
        if (xhr.responseJSON && xhr.responseJSON.message) {
          alert('Error: ' + xhr.responseJSON.message);
        } else {
          alert('Ralat berlaku. Sila cuba lagi. Status: ' + xhr.status);
        }
      }
      
      var table = $('#globalTable').DataTable({
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
        order: [[1, 'asc']], // Default sort by Pelaporan
        initComplete: function() {
            // Add create button next to search
            $('.dataTables_filter').css('float', 'right');
            $('.dataTables_filter input').attr('placeholder', 'Cari...');
            $('.dataTables_filter').append(
                '<span style="margin-left: 15px;"></span>' +
                '<a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#globalModal"  style="background:#123cc5ff;border-color:#123cc5ff;color:#fff;">' +
                '<i class="fas fa-plus"></i> Tambah Data</a>'
            );
        },
        ajax: {
          url: '/admin/global-antarabangsa/data',
          data: function(d) {
            d.date_from = $('#dateFrom').val();
            d.date_to = $('#dateTo').val();
          }
        },
        columns: [
          { 
            data: 'DT_RowIndex', 
            name: 'DT_RowIndex', 
            orderable: false, 
            searchable: false,
            width: "5%"
          },
          { 
            data: 'pelaporan', 
            name: 'pelaporan',
            orderable: true,
            searchable: true
          },
          { 
            data: 'pemberi_dana', 
            name: 'pemberi_dana',
            orderable: true,
            searchable: true,
            render: function(data) {
              return data || '-';
            }
          },
          { 
            data: 'tarikh_tutup', 
            name: 'tarikh_tutup',
            orderable: true,
            searchable: true,
            render: function(data) {
              return data ? new Date(data).toLocaleDateString('ms-MY') : '-';
            }
          },
          { 
            data: 'jumlah_dana', 
            name: 'jumlah_dana',
            orderable: true,
            searchable: true,
            render: function(data) {
              return data ? 'RM ' + parseFloat(data).toFixed(2) : '-';
            }
          },
          { 
            data: 'status', 
            name: 'status',
            orderable: true,
            searchable: true,
            render: function(data, type, row) {
              return data || '-';
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
      $('#globalForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        var id = $('#global_id').val();
        var url = id ? '/admin/global-antarabangsa/' + id : '/admin/global-antarabangsa';
        var method = id ? 'PUT' : 'POST';
        
        if (id) {
          formData += '&_method=PUT';
        }
        
        $.ajax({
          url: url,
          type: 'POST',
          data: formData,
          success: function(result) {
            $('#globalModal').modal('hide');
            $('#globalForm')[0].reset();
            $('#global_id').val('');
            $('#successMessage').html(id ? 'Data berjaya dikemaskini.' : 'Data berjaya disimpan.');
            $('#successModal').modal('show');
            table.ajax.reload();
          },
          error: function(xhr) {
            handleAjaxError(xhr);
          }
        });
      });

      // Handle view details button
      $(document).on('click', '.view-btn', function() {
        var id = $(this).data('id');
        
        $.ajax({
          url: '/admin/global-antarabangsa/' + id + '/edit',
          type: 'GET',
          success: function(data) {
            $('#detail_pelaporan').text(data.pelaporan || '-');
            $('#detail_pemberi_dana').text(data.pemberi_dana || '-');
            
            // Format date for display
            if (data.tarikh_tutup) {
              const date = new Date(data.tarikh_tutup);
              $('#detail_tarikh_tutup').text(date.toLocaleDateString('ms-MY'));
            } else {
              $('#detail_tarikh_tutup').text('-');
            }
            
            // Format currency
            if (data.jumlah_dana) {
              $('#detail_jumlah_dana').text('RM ' + parseFloat(data.jumlah_dana).toFixed(2));
            } else {
              $('#detail_jumlah_dana').text('-');
            }
            
            // Set status (no badge, plain text)
            let status = data.status || '-';
            $('#detail_status').text(status);
            
            $('#viewDetailsModal').modal('show');
          },
          error: function(xhr) {
            handleAjaxError(xhr);
          }
        });
      });

      // Handle edit button
      $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        
        $.ajax({
          url: '/admin/global-antarabangsa/' + id + '/edit',
          type: 'GET',
          success: function(data) {
            $('#globalModalLabel').text('Edit Global dan Pengantarabangsaan');
            $('#global_id').val(data.id);
            $('#pelaporan').val(data.pelaporan);
            $('#pemberi_dana').val(data.pemberi_dana);
            $('#tarikh_tutup').val(data.tarikh_tutup);
            $('#jumlah_dana').val(data.jumlah_dana);
            $('#status').val(data.status);
            $('#globalModal').modal('show');
          },
          error: function(xhr) {
            handleAjaxError(xhr);
          }
        });
      });

      // Handle delete button
      $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        $('#deleteId').val(id);
        $('#deleteModal').modal('show');
      });

      // Handle confirm delete button
      $('#confirmDelete').on('click', function() {
        var id = $('#deleteId').val();
        
        $.ajax({
          url: '/admin/global-antarabangsa/' + id,
          type: 'DELETE',
          data: {
            '_token': '{{ csrf_token() }}'
          },
          success: function(result) {
            $('#deleteModal').modal('hide');
            $('#successMessage').html('Data berjaya dipadam.');
            $('#successModal').modal('show');
            table.ajax.reload();
          },
          error: function(xhr) {
            $('#deleteModal').modal('hide');
            handleAjaxError(xhr);
          }
        });
      });

      // Reset modal when closed
      $('#globalModal').on('hidden.bs.modal', function() {
        $('#globalModalLabel').text('Tambah Global dan Pengantarabangsaan');
        $('#globalForm')[0].reset();
        $('#global_id').val('');
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
