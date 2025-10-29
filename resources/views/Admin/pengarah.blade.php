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
    <title>Pengarah – {{ config('app.name') }}</title>

    <!-- Vendor CSS -->
    <link href="{{ asset('css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- SB Admin core CSS -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- Inline Custom Styles -->
    <style>
        .table th {
            background-color: #2E5AAC !important;
            color: white !important;
            border-color: #1e3a6d;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
        }
        .table td {
            vertical-align: middle;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body id="page-top">
  <div id="wrapper">
    @include('layouts.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        @include('layouts.header')
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pengarah</h1>
          </div>
          <!-- Filter Section -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h6 class="mb-3 font-weight-bold">Tarikh (DD/MM/YYYY)</h6>
              <div class="row align-items-end">
                <div class="col-md-3">
                  <label for="date_from" class="form-label">Dari</label>
                  <input type="date" id="date_from" class="form-control" placeholder="DD/MM/YYYY">
                </div>
                <div class="col-md-3">
                  <label for="date_to" class="form-label">Ke</label>
                  <input type="date" id="date_to" class="form-control" placeholder="DD/MM/YYYY">
                </div>
                <div class="col-md-4">
                  <button type="button" id="filter-btn" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari
                  </button>
                  <button type="button" id="resetFilter" class="btn btn-secondary">
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
                <table class="table table-bordered table-hover table-striped" id="pengarahTable" width="100%" cellspacing="0">
                  <thead style="background-color: #2E5AAC; color: white;">
                      <tr>
                          <th>BIL.</th>
                          <th>TAJUK</th>
                          <th>PERKARA</th>
                          <th>TARIKH</th>
                          <th>STATUS</th>
                          <th>TINDAKAN</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Add/Edit Modal -->
          <div class="modal fade" id="pengarahModal" tabindex="-1" role="dialog" aria-labelledby="pengarahModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="pengarahModalLabel">Tambah Pengarah</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="pengarahForm">
                        @csrf
                        <input type="hidden" id="pengarah_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tajuk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tajuk" name="tajuk" placeholder="Masukkan tajuk" required>
                            </div>
                            <div class="form-group">
                                <label>Perkara <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="perkara" name="perkara" placeholder="Masukkan perkara" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tarikh <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tarikh" name="tarikh" required>
                            </div>
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="status" name="status" placeholder="Masukkan status" required>
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
                  <h5 class="modal-title" id="viewDetailsModalLabel">Butiran Pengarah</h5>
                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label class="font-weight-bold">Tajuk:</label>
                      <p id="detail_tajuk" class="mb-2"></p>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label class="font-weight-bold">Perkara:</label>
                      <p id="detail_perkara" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Tarikh:</label>
                      <p id="detail_tarikh" class="mb-2"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="font-weight-bold">Status:</label>
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
      </div>
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Hak Cipta &copy; {{ config('app.name') }} {{ date('Y') }}</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script src="{{ asset('js/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    function handleAjaxError(xhr) {
      console.error('AJAX Error:', xhr);
      if (xhr.responseJSON && xhr.responseJSON.message) {
        alert('Error: ' + xhr.responseJSON.message);
      } else {
        alert('Ralat berlaku. Sila cuba lagi. Status: ' + xhr.status);
      }
    }
    var table = $('#pengarahTable').DataTable({
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
      order: [[1, 'asc']],
      initComplete: function() {
          $('.dataTables_filter').css('float', 'right');
          $('.dataTables_filter input').attr('placeholder', 'Cari...');
          $('.dataTables_filter').append(
              '<span style="margin-left: 15px;"></span>' +
              '<a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#pengarahModal">' +
              '<i class="fas fa-plus"></i> Tambah Data</a>'
          );
      },
      ajax: {
        url: '/admin/pengarah/data',
        data: function(d) {
          d.date_from = $('#date_from').val();
          d.date_to = $('#date_to').val();
        }
      },
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: "5%" },
        { data: 'tajuk', name: 'tajuk', orderable: true, searchable: true },
        { data: 'perkara', name: 'perkara', orderable: true, searchable: true },
        { data: 'tarikh', name: 'tarikh', orderable: true, searchable: true, render: function(data) { return data ? new Date(data).toLocaleDateString('ms-MY') : '-'; } },
        { data: 'status', name: 'status', orderable: true, searchable: true, render: function(data) { return data || '-'; } },
        { data: 'action_buttons', name: 'action_buttons', orderable: false, searchable: false, width: "15%" }
      ]
    });
    $('#pengarahForm').on('submit', function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      var id = $('#pengarah_id').val();
      var url = id ? '/admin/pengarah/update/' + id : '/admin/pengarah';
      var method = 'POST';
      $.ajax({
        url: url,
        type: method,
        data: formData,
        success: function(result) {
          $('#pengarahModal').modal('hide');
          $('#pengarahForm')[0].reset();
          $('#pengarah_id').val('');
          $('#successMessage').html(id ? 'Data berjaya dikemaskini.' : 'Data berjaya disimpan.');
          $('#successModal').modal('show');
          table.ajax.reload();
        },
        error: function(xhr) {
          handleAjaxError(xhr);
        }
      });
    });
    $(document).on('click', '.view-btn', function() {
      var id = $(this).data('id');
      $.ajax({
        url: '/admin/pengarah/edit/' + id,
        type: 'GET',
        success: function(data) {
          $('#detail_tajuk').text(data.tajuk || '-');
          $('#detail_perkara').text(data.perkara || '-');
          if (data.tarikh) {
            const date = new Date(data.tarikh);
            $('#detail_tarikh').text(date.toLocaleDateString('ms-MY'));
          } else {
            $('#detail_tarikh').text('-');
          }
          let status = data.status || '-';
          $('#detail_status').text(status);
          $('#viewDetailsModal').modal('show');
        },
        error: function(xhr) {
          handleAjaxError(xhr);
        }
      });
    });
    $(document).on('click', '.edit-btn', function() {
      var id = $(this).data('id');
      $.ajax({
        url: '/admin/pengarah/edit/' + id,
        type: 'GET',
        success: function(data) {
          $('#pengarahModalLabel').text('Edit Pengarah');
          $('#pengarah_id').val(data.id);
          $('#tajuk').val(data.tajuk);
          $('#perkara').val(data.perkara);
          $('#tarikh').val(data.tarikh);
          $('#status').val(data.status);
          $('#pengarahModal').modal('show');
        },
        error: function(xhr) {
          handleAjaxError(xhr);
        }
      });
    });
    $(document).on('click', '.delete-btn', function() {
      var id = $(this).data('id');
      $('#deleteId').val(id);
      $('#deleteModal').modal('show');
    });
    $('#confirmDelete').on('click', function() {
      var id = $('#deleteId').val();
      $.ajax({
        url: '/admin/pengarah/delete/' + id,
        type: 'POST',
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
    $('#pengarahModal').on('hidden.bs.modal', function() {
      $('#pengarahModalLabel').text('Tambah Pengarah');
      $('#pengarahForm')[0].reset();
      $('#pengarah_id').val('');
    });
    $('#filter-btn').on('click', function() {
      table.ajax.reload();
    });
    $('#resetFilter').on('click', function() {
      $('#date_from').val('');
      $('#date_to').val('');
      table.ajax.reload();
    });
  });
  </script>
</body>
</html>
