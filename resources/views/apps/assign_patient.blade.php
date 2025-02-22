@extends('layouts.app')

@section('content')
<form role="form" action="{{ route('assign.patient') }}" method="POST">
{{ csrf_field() }}
<div class="invoice-00001 m-4">
    <div class="content-section  animated animatedFadeInUp fadeInUp">
        <div class="row inv--head-section">

            <div class="col-sm-6 col-12">
                <h3 class="in-heading">PRESCRIPTION</h3>
            </div>
            
        </div>

        <div class="row inv--detail-section">

            <div class="col-sm-12 align-self-center mt-3 mb-3">
                {{-- <p class="inv-to"><span class="inv-number text-primary underline">HASIL PEMERIKSAAN PASIEN</span></p> --}}
            </div>

            <div class="col-sm-12 align-self-center">
                <div class="form-group row">
                    <label for="namaPasien" class="col-2 col-form-label col-form-label-sm" style="color: rgb(73, 73, 73)">NAMA PASIEN: </label>
                    <div class="col-10">
                        <input type="name" class="col-9 form-control form-control-sm" id="namaPasien" name="name">
                    </div>
                </div>
            </div>

            <div class="col-sm-12 align-self-center">
                <div class="form-group row">
                    <label for="tanggalLahir" class="col-2 col-form-label col-form-label-sm" style="color: rgb(73, 73, 73)">TANGGAL LAHIR: </label>
                    <div class="col-10">
                        <input type="date" class="col-9 form-control form-control-sm" id="tanggalLahir" name="birth_date">
                    </div>
                </div>
            </div>

            <div class="col-sm-12 align-self-center">
                <div class="form-group row">
                    <label for="jenisKelamin" class="col-2 col-form-label col-form-label-sm" style="color: rgb(73, 73, 73)">JENIS KELAMIN: </label>
                    <div class="col-10">
                        <select class="col-9 selectpicker" id="jenisKelamin" name="gender">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 align-self-center">
                <div class="form-group row">
                    <label for="inputAlamat" class="col-2 col-form-label col-form-label-sm" style="color: rgb(73, 73, 73)">ALAMAT: </label>
                    <div class="col-10">
                        <input type="text" class="col-9 form-control form-control-sm" id="inputAlamat" name="address">
                    </div>
                </div>
            </div>

            <div class="col-sm-12 align-self-center">
                <div class="form-group row">
                    <label for="noTelpon" class="col-2 col-form-label col-form-label-sm" style="color: rgb(73, 73, 73)">NOMOR TELEPON: </label>
                    <div class="col-10">
                        <input type="text" class="col-9 form-control form-control-sm" id="noTelpon" name="phone">
                    </div>
                </div>
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
@endsection
