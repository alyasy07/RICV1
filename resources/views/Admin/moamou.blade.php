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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MoA/MoU – {{ config('app.name') }}</title>

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
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h2 mb-0 text-gray-900 gradient-title">MoA/MoU</h1>
          </div>

          <!-- DataTable Container -->
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="moaTable" width="100%" cellspacing="0">
                  <thead style="background-color: #2E5AAC; color: white;">
                      <tr>
                          <th>BIL.</th>
                          <th>JENIS PERUNDINGAN</th>
                          <th>AGENSI TERLIBAT</th>
                          <th>TAJUK PENYELIDIKAN</th>
                          <th>STATUS PERMOHONAN</th>
                          <th>TINDAKAN</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
                </table>
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

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="addMoaModal" tabindex="-1" role="dialog" aria-labelledby="addMoaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addMoaModalLabel">Tambah MoA/MoU</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="moaForm">
                    @csrf
                    <input type="hidden" id="moa_id" name="moa_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jenis_perundingan">Jenis Perundingan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="jenis_perundingan" name="jenis_perundingan" required>
                        </div>
                        <div class="form-group">
                            <label for="agensi_terlibat">Agensi Terlibat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="agensi_terlibat" name="agensi_terlibat" required>
                        </div>
                        <div class="form-group">
                            <label for="tajuk_penyelidikan">Tajuk Penyelidikan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="tajuk_penyelidikan" name="tajuk_penyelidikan" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status_permohonan">Status Permohonan <span class="text-danger">*</span></label>
                            <select class="form-control" id="status_permohonan" name="status_permohonan" required>
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

    <!-- View Details Modal -->
    <div class="modal fade" id="viewMoaModal" tabindex="-1" role="dialog" aria-labelledby="viewMoaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="viewMoaModalLabel">Butiran MoA/MoU</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold">Jenis Perundingan:</label>
                            <p id="view_jenis_perundingan" class="mb-2"></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold">Agensi Terlibat:</label>
                            <p id="view_agensi_terlibat" class="mb-2"></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold">Tajuk Penyelidikan:</label>
                            <p id="view_tajuk_penyelidikan" class="mb-2" style="white-space: pre-line;"></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold">Status Permohonan:</label>
                            <p id="view_status_permohonan" class="mb-2"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteMoaModal" tabindex="-1" role="dialog" aria-labelledby="deleteMoaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteMoaModalLabel">Pengesahan Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Adakah anda pasti ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Berjaya</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="successMessage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

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

            // Initialize DataTable
            var table = $('#moaTable').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                order: [[1, 'asc']],
                initComplete: function() {
                    // Add create button next to search
                    $('.dataTables_filter').css('float', 'right');
                    $('.dataTables_filter input').attr('placeholder', 'Cari permohonan...');
                    $('.dataTables_filter').append(
                        '<span style="margin-left: 15px;"></span>' +
                        '<a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#addMoaModal" style="background:#123cc5ff;border-color:#123cc5ff;color:#fff;">'  +
                        '<i class="fas fa-plus"></i> Tambah Permohonan</a>'
                    );
                },
                ajax: "{{ route('admin.moamou.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'jenis_perundingan', name: 'jenis_perundingan' },
                    { data: 'agensi_terlibat', name: 'agensi_terlibat' },
                    { data: 'tajuk_penyelidikan', name: 'tajuk_penyelidikan' },
                    { 
                        data: 'status_permohonan', 
                        name: 'status_permohonan',
                        render: function(data, type, row) {
                            if (type === 'display') {
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
                            return data;
                        }
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Malay.json'
                }
            });

            // Add/Edit Form Submit
            $('#moaForm').on('submit', function(e) {
                e.preventDefault();
                
                var moaId = $('#moa_id').val();
                var url = moaId ? "{{ url('admin/moa-mou') }}/" + moaId : "{{ route('admin.moamou.store') }}";
                var method = moaId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addMoaModal').modal('hide');
                        $('#moaForm')[0].reset();
                        $('#moa_id').val('');
                        table.ajax.reload();
                        $('#successMessage').text(response.message);
                        $('#successModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            });

            // View Button Click
            $(document).on('click', '.view-moa-btn', function() {
                var id = $(this).data('id');
                
                $.ajax({
                    url: "{{ url('admin/moa-mou') }}/" + id + "/edit",
                    type: 'GET',
                    success: function(data) {
                        $('#view_jenis_perundingan').text(data.jenis_perundingan);
                        $('#view_agensi_terlibat').text(data.agensi_terlibat);
                        $('#view_tajuk_penyelidikan').text(data.tajuk_penyelidikan);
                        
                        // Add badge styling for status
                        var badgeClass = '';
                        if (data.status_permohonan === 'Lulus') {
                            badgeClass = 'badge-success';
                        } else if (data.status_permohonan === 'Tidak Berjaya') {
                            badgeClass = 'badge-danger';
                        } else {
                            badgeClass = 'badge-warning';
                        }
                        $('#view_status_permohonan').html('<span class="badge ' + badgeClass + '">' + data.status_permohonan + '</span>');
                        
                        $('#viewMoaModal').modal('show');
                    }
                });
            });

            // Edit Button Click
            $(document).on('click', '.edit-moa-btn', function() {
                var id = $(this).data('id');
                
                $.ajax({
                    url: "{{ url('admin/moa-mou') }}/" + id + "/edit",
                    type: 'GET',
                    success: function(data) {
                        $('#addMoaModalLabel').text('Edit MoA/MoU');
                        $('#moa_id').val(data.id);
                        $('#jenis_perundingan').val(data.jenis_perundingan);
                        $('#agensi_terlibat').val(data.agensi_terlibat);
                        $('#tajuk_penyelidikan').val(data.tajuk_penyelidikan);
                        $('#status_permohonan').val(data.status_permohonan);
                        $('#addMoaModal').modal('show');
                    }
                });
            });

            // Delete Button Click
            var deleteId;
            $(document).on('click', '.delete-moa-btn', function() {
                deleteId = $(this).data('id');
                $('#deleteMoaModal').modal('show');
            });

            // Confirm Delete
            $('#confirmDelete').on('click', function() {
                $.ajax({
                    url: "{{ url('admin/moa-mou') }}/" + deleteId,
                    type: 'DELETE',
                    success: function(response) {
                        $('#deleteMoaModal').modal('hide');
                        table.ajax.reload();
                        $('#successMessage').text(response.message);
                        $('#successModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            });

            // Reset form when modal is closed
            $('#addMoaModal').on('hidden.bs.modal', function () {
                $('#moaForm')[0].reset();
                $('#moa_id').val('');
                $('#addMoaModalLabel').text('Tambah MoA/MoU');
            });
        });
    </script>

</body>

</html>
