@extends('layouts.admin.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Cập nhật thuốc</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('system.medicines.update', $medicine->medicine_id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInput1" class="form-label">Mã thuốc</label>
                                    <input type="text" name="medicine_id" class="form-control @error('medicine_id') is-invalid @enderror" id=""
                                        value="{{ $medicine->medicine_id }}">
                                    @error('medicine_id')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="medicine" class="form-label">Tên thuốc</label>
                                    <select name="name" class="form-control" id="name">
                                        <option value="">Chọn tên thuốc</option>
                                        @foreach ($medicine as $medicine_name)
                                            <option value="{{ $medicine_name }}">{{ $medicine_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="name_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nhóm</label>
                                    <select class="form-select" id="inputGroupSelect01" name="medicine_type_id">
                                        <option value="{{ $medicine->medicine_type_id }}" selected>
                                            {{ $medicine->medicine_types_name }}</option>
                                        @foreach ($medicineType as $item)
                                            <option value="{{ $item->medicine_type_id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInput1" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="inputGroupSelect01" name="status">
                                        @if ($medicine->status == 1)
                                            <option value="1" selected>Hoạt động</option>
                                            <option value="0">Hết
                                            </option>
                                        @else
                                            <option value="0" selected>Hết</option>
                                            <option value="1">Hoạt động
                                            </option>
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInput1" class="form-label">Hoạt tính</label>
                                    <textarea type="text" name="active_ingredient" class="form-control @error('active_ingredient') is-invalid @enderror" id="">{{ $medicine->active_ingredient }}</textarea>
                                    @error('active_ingredient')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInput1" class="form-label">Đơn vị</label>
                                    <input type="text" name="unit_of_measurement" class="form-control @error('unit_of_measurement') is-invalid @enderror"
                                        value="{{ $medicine->unit_of_measurement }}">
                                    @error('unit_of_measurement')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</a>
                    </form>
                </div>
            </div>
        @endsection
