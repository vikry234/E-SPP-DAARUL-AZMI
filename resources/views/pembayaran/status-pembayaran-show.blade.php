@extends('layouts.backend.app')
@section('title', 'Data Pembayaran')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush

@section('content_title', 'Pembayaran Tahun '.$spp->tahun)
@section('content')
<x-alert></x-alert>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('pembayaran.status-pembayaran.show',$siswa->nisn) }}" class="btn btn-danger btn-sm">
          <i class="fas fa-fw fa-arrow-left"></i> KEMBALI
        </a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        @if($pembayaran->count() > 0)
        <table id="dataTable2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Nisn</th>
              <th>Tanggal Bayar</th>
              <th>Untuk Bulan</th>
              <th>Untuk Tahun</th>
              <th>Nominal</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pembayaran as $row)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $row->siswa->nama_siswa }}</td>
              <td>{{ $row->siswa->kelas->nama_kelas }}</td>
              <td>{{ $row->nisn }}</td>
              <td>{{ \Carbon\Carbon::parse($row->tanggal_bayar)->format('d-m-Y') }}</td>
              <td>{{ $row->bulan_bayar }}</td>
              <td>{{ $row->tahun_bayar }}</td>
              <td>
                @php
                $jumlahBayar = is_numeric($row->jumlah_bayar) ? $row->jumlah_bayar : floatval(str_replace(['Rp', '.', ','], '', $row->jumlah_bayar));
                @endphp
                {{ number_format($jumlahBayar, 0, ',', '.') }}
              </td>
              <td>
                @if ($row->status == 'Lunas')
                <span class="badge badge-success">Lunas</span>
                @else
                <span class="badge badge-warning">Belum Lunas</span>
                <!-- Tombol Update -->
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateModal"
                  data-id="{{ $row->id }}"
                  data-jumlah_bayar="{{ $row->jumlah_bayar }}"
                  data-nama_siswa="{{ $row->siswa->nama_siswa }}"
                  data-bulan_bayar="{{ $row->bulan_bayar }}">
                  <i class="fas fa-edit"></i> Update
                </button>

                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Data Pembayaran Tidak Tersedia!</h4>
          <p>Pembayaran Spp {{ $siswa->nama_siswa }} di Tahun {{ $spp->tahun }} tidak tersedia.</p>
        </div>
        @endif
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<!-- Modal Update Pembayaran -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateForm" method="POST" action="{{ route('pembayaran.update') }}">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <!-- Hidden Input ID -->
          <input type="hidden" name="id" id="id">

          <!-- Nama Siswa -->
          <div class="form-group">
            <label for="nama_siswa">Nama Siswa</label>
            <input type="text" class="form-control" id="nama_siswa" readonly>
          </div>

          <!-- Bulan Bayar -->
          <div class="form-group">
            <label for="bulan_bayar">Bulan Bayar</label>
            <input type="text" class="form-control" id="bulan_bayar" readonly>
          </div>

          <!-- Jumlah Bayar -->
          <div class="form-group">
            <label for="jumlah_bayar">Jumlah Bayar</label>
            <input type="number" class="form-control" name="jumlah_bayar" id="jumlah_bayar" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@stop

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $('#updateModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Tombol yang diklik
    var id = button.data('id'); // Ambil ID pembayaran
    var nama_siswa = button.data('nama_siswa'); // Ambil nama siswa
    var bulan_bayar = button.data('bulan_bayar'); // Ambil bulan bayar
    var jumlah_bayar = button.data('jumlah_bayar'); // Ambil jumlah bayar

    // Isi data ke dalam modal
    var modal = $(this);
    modal.find('#id').val(id);
    modal.find('#nama_siswa').val(nama_siswa);
    modal.find('#bulan_bayar').val(bulan_bayar); // Isi bulan bayar di modal
    modal.find('#jumlah_bayar').val(jumlah_bayar); // Isi jumlah bayar di modal
  });

  $('#jumlah_bayar').on('input', function() {
    var input = $(this).val();
    // Menghapus karakter non-numerik, hanya menyisakan angka dan titik desimal
    var validInput = input.replace(/[^0-9.]/g, '');

    // Set input kembali dengan nilai yang valid
    $(this).val(validInput);
  });



  $('#jumlah_bayar').on('input', function() {
    var input = $(this).val();
    // Menghapus karakter non-numerik, hanya menyisakan angka dan titik desimal
    var validInput = input.replace(/[^0-9.]/g, '');

    // Set input kembali dengan nilai yang valid
    $(this).val(validInput);
  });


  $(function() {
    $("#dataTable1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#dataTable2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush