@extends('layouts.app')

@section('content')
<form role="form" action="{{ route('store.checkup') }}" method="POST">
    {{ csrf_field() }}

    <div class="invoice-00001 m-4">
        <div class="content-section animated animatedFadeInUp fadeInUp">
            <div class="row inv--head-section">
                <div class="col-12">
                    <h3 class="in-heading">PRESCRIPTION</h3>
                </div>
            </div>

            <div class="row inv--detail-section">
                <div class="col-12 mt-3 mb-3">
                    <h5 class="text-primary">FORM PEMERIKSAAN PASIEN</h5>
                    <hr>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="namaPasien" class="col-3 col-form-label col-form-label-sm">Nama Pasien:</label>
                        <div class="col-9">
                            <select name="patient_id" id="namaPasien" class="form-control selectpicker" data-live-search="true" required>
                                <option value="" disabled selected>Pilih Pasien</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}"
                                        data-birthdate="{{ $patient->birth_date }}"
                                        data-gender="{{ $patient->gender }}"
                                        data-address="{{ $patient->address }}"
                                        data-phone="{{ $patient->phone }}">
                                        {{ $patient->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="tanggalLahir" class="col-3 col-form-label col-form-label-sm">Tanggal Lahir:</label>
                        <div class="col-9">
                            <input type="date" class="form-control" id="tanggalLahir" name="birth_date" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="jenisKelamin" class="col-3 col-form-label col-form-label-sm">Jenis Kelamin:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="jenisKelamin" name="gender" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="inputAlamat" class="col-3 col-form-label col-form-label-sm">Alamat:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="inputAlamat" name="address" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="noTelpon" class="col-3 col-form-label col-form-label-sm">Nomor Telepon:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="noTelpon" name="phone" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                        <label for="tanggalCheckup" class="col-3 col-form-label col-form-label-sm">Tanggal Pemeriksaan:</label>
                        <div class="col-9">
                            <input type="date" class="form-control" id="tanggalCheckup" name="checkup_date" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="text-primary">VITAL STATUS</h5>
                    <hr>
                </div>

                @php
                    $vitals = [
                        'height' => ['label' => 'Tinggi Badan', 'unit' => 'cm'],
                        'weight' => ['label' => 'Berat Badan', 'unit' => 'kg'],
                        'systole' => ['label' => 'Sistole', 'unit' => 'mmHg'],
                        'diastole' => ['label' => 'Diastole', 'unit' => 'mmHg'],
                        'heart_rate' => ['label' => 'Denyut Jantung', 'unit' => 'bpm'],
                        'respiration_rate' => ['label' => 'Denyut Nadi', 'unit' => 'rpm'],
                        'temperature' => ['label' => 'Suhu Tubuh', 'unit' => '°C']
                    ];
                @endphp

                @foreach ($vitals as $key => $vital)
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="{{ $key }}" class="col-3 col-form-label col-form-label-sm">{{ $vital['label'] }}:</label>
                            <div class="col-9">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="{{ $key }}" name="{{ $key }}" min="1" step="0.1" required>
                                    <span class="input-group-text">{{ $vital['unit'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="text-primary">HASIL PEMERIKSAAN</h5>
                    <hr>
                    <textarea class="form-control" name="diagnosis" rows="5" placeholder="Tulis hasil pemeriksaan..." required></textarea>
                </div>
            </div>

            <div class="row mt-5 mb-2">
                <div class="col-sm-7 align-self-center">
                    <h5 class="text-primary">RESEP OBAT</h5>
                </div>
    
                <table class="table table-bordered" id="medicineTable">
                    <thead>
                        <tr>
                            <th>Obat</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Harga Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                
                <button type="button" id="addMedicine" class="btn btn-primary" data-toggle="modal" data-target="#medicineModal">+ Tambah Obat</button>
            </div>
    
            <div class="row mt-5 mb-3">
                <div class="col-sm-7 align-self-center">
                    <p>Dokter: </p>
                </div>
    
                <div class="col-sm-8 align-self-center order-sm-0 order-1">
                    <p class="inv-detail-title">-----------------------------------------</p>
                </div>
    
                <div class="col-sm-8 align-self-center order-sm-0 order-1">
                    <p class="inv-detail-title"><span class="inv-number text-primary">dr. {{ Auth::user()->name }}</span></p>
                </div>
            </div>

            {{-- <div class="row mt-4">
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="modal fade" id="medicineModal" tabindex="-1" aria-labelledby="medicineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="medicineModalLabel">Tambah Obat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="nama_obat" class="form-label">Nama Obat</label>
                <select name="medicine_id" class="col-12 selectpicker" data-live-search="true" id="nama_obat">
                    <option value="" disabled selected hidden>Pilih Obat</option>
                    @foreach ($medicines as $medicine)
                        <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                    @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="jumlah_obat" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah_obat" min="1" name="quantity">
              </div>
              <div class="mb-3">
                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                <input type="number" class="form-control" id="harga_satuan" min="1" readonly>
              </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
              <button type="button" class="btn btn-primary" id="saveMedicine">Simpan</button>
            </div>
          </div>
        </div>
    </div>
    <div class="row mt-4 mb-3 mx-1">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $("#nama_obat").change(function () {
        var selectedOption = $(this).find(':selected');
        var price = selectedOption.data('price') || 0; // Ambil harga dari data attribute
        $("#harga_satuan").val(price);
    });

    $("#saveMedicine").click(function () {
        var nama_obat = $("#nama_obat option:selected").text();
        var medicine_id = $("#nama_obat").val();
        var jumlah = $("#jumlah_obat").val();
        var harga_satuan = $("#harga_satuan").val();
        var harga_total = jumlah * harga_satuan;

        if (!medicine_id || jumlah <= 0) {
            alert("Silakan pilih obat dan masukkan jumlah yang valid.");
            return;
        }

        var newRow = `
            <tr>
                <td>
                    <input type="hidden" name="medicines[]" value="${medicine_id}">
                    ${nama_obat}
                </td>
                <td>
                    <input type="hidden" name="quantities[]" value="${jumlah}">
                    ${jumlah}
                </td>
                <td>${harga_satuan}</td>
                <td>
                    <input type="hidden" name="prices[]" value="${harga_total}">
                    ${harga_total}
                </td>
                <td><button type="button" class="btn btn-danger btn-sm remove-medicine">Hapus</button></td>
            </tr>
        `;

        $("#medicineTable tbody").append(newRow);
        $("#medicineModal").modal("hide");

        // Reset form modal setelah ditutup
        $("#nama_obat").val("").change();
        $("#jumlah_obat").val("");
        $("#harga_satuan").val("");
    });

    // Hapus baris obat dari tabel resep
    $(document).on("click", ".remove-medicine", function () {
        $(this).closest("tr").remove();
    });
// });

        $(document).ready(function () {
        function fetchMedicinePrice() {
            var medicineId = $("#nama_obat").val();
            var checkupDate = $("#tanggalCheckup").val();

            if (medicineId && checkupDate) {
                $.ajax({
                    url: "/get-medicine-price",
                    method: "GET",
                    data: { medicine_id: medicineId, checkup_date: checkupDate },
                    success: function (response) {
                        $("#harga_satuan").val(response.price);
                    },
                    error: function () {
                        alert("Gagal mengambil harga obat!");
                    }
                });
            }
        }

        // Fetch price when medicine changes
        $("#nama_obat").change(fetchMedicinePrice);

        // Fetch price when checkup date changes
        $("#tanggalCheckup").change(fetchMedicinePrice);
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const patientSelect = document.getElementById("namaPasien");

    patientSelect.addEventListener("change", function () {
        // Get selected option
        const selectedOption = this.options[this.selectedIndex];

        // Get patient details from data attributes
        const birthDate = selectedOption.getAttribute("data-birthdate");
        const gender = selectedOption.getAttribute("data-gender");
        const address = selectedOption.getAttribute("data-address");
        const phone = selectedOption.getAttribute("data-phone");

        // Populate fields
        document.getElementById("tanggalLahir").value = birthDate || "";
        document.getElementById("jenisKelamin").value = gender || "";
        document.getElementById("inputAlamat").value = address || "";
        document.getElementById("noTelpon").value = phone || "";
    });
});
</script>
@endsection