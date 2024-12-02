@extends('layouts.admin.master')

@section('content')

<div class="card w-100">
    <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Quản lý bệnh nhân</h5>

        <form action="{{ route('system.patient') }}" method="GET" class="row g-3 mb-4">

            <div class="col-12 col-md-6 col-lg-5">
                <div class="row g-2">
                    <div class="col-6">
                        <input type="text" name="lastname" class="form-control" placeholder="Họ"
                            value="{{ request('lastname') }}">
                    </div>
                    <div class="col-6">
                        <input type="text" name="firstname" class="form-control" placeholder="Tên"
                            value="{{ request('firstname') }}">
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-5">
                <div class="row g-2">
                    <div class="col-6">
                        <input type="text" name="insurance_number" class="form-control" placeholder="Số bảo hiểm y tế"
                            value="{{ request('insurance_number') }}">
                    </div>

                    <div class="col-6">
                        <input type="text" name="phone" class="form-control" placeholder="Số điện thoại"
                            value="{{ request('phone') }}">
                    </div>

                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-2">
                <div class="d-flex gap-2 justify-content-between justify-content-md-start">
                    <button type="submit" class="btn btn-primary w-100 w-md-auto">Tìm kiếm</button>
                </div>
            </div>

        </form>



        <div class="table-responsive">
            <div class="mt-3">
                {!! $patients->links() !!}
            </div>

            <table class="table table-bordered text-nowrap mb-0 align-middle ">
                <thead class="text-dark fs-4">
                    <tr class="text-center">
                        <th class="border-bottom-0">
                            <p class="fw-semibold mb-0">ID</p>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Họ tên</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Giới tính</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Ngày Sinh</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">BHYT</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Số Điện thoại</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">SĐT Khẩn cấp</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Thao tác</h6>
                        </th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @if($patients->isEmpty())
                    <div id="noResults" class="alert alert-warning">Không tìm thấy dữ liệu.</div>
                    @else
                    @foreach($patients as $item)
                    <tr class="text-center">
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">{{ $item->patient_id }}</h6>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-semibold">{{ $item->last_name }} {{ $item->first_name }}</p>
                        </td>
                        <td class="border-bottom-0">
                            <p class="badge {{ $item->gender == 1 ? 'bg-info' : 'bg-danger' }} mb-0 fw-semibold">
                                {{ $item->gender == 1 ? 'Nam' : 'Nữ' }}
                            </p>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-semibold">{{ \Carbon\Carbon::parse($item->birthday)->format('d/m/Y') }}</p>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-semibold">{{ $item->insurance_number }}</p>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-semibold">{{ $item->phone }}</p>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-semibold">{{ $item->emergency_contact }}</p>
                        </td>
                        <td class="border-bottom-0 d-flex justify-content-center align-items-center">
                            <a href="{{ route('system.patients.edit', $item->patient_id) }}" class="btn btn-primary"> <i
                                    class="ti ti-pencil"></i></a>
                            <a class="btn btn-warning ms-1" data-bs-toggle="collapse"
                                href="#collapse{{ $item->patient_id }}" role="button" aria-expanded="false"
                                aria-controls="collapse{{ $item->patient_id }}">Chi tiết</a>
                        </td>
                    </tr>
                    <tr id="show">
                        <td colspan="100">
                            <div class="collapse" id="collapse{{ $item->patient_id }}">
                                <div class="card card-body">
                                    <div class="col-md-12 d-flex mt-1">
                                        <div class="profile-img col-md-2 d-flex align-items-center">
                                            @if (empty($item->avatar))
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                                                alt="Ảnh bác sĩ" class="img-thumbnail"
                                                style="width: 80%; height: auto;">
                                            @else
                                            @if ($item->google_id || $item->zalo_id || $item->facebook_id)
                                            <img src="{{ $item->avatar }}" alt="Ảnh bác sĩ" class="img-thumbnail"
                                                style="width: 80%; height: auto;">
                                            @else
                                            @if ($item->avatar === 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png')
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                                                alt="Ảnh bác sĩ" class="img-thumbnail"
                                                style="width: 80%; height: auto;">
                                            @else
                                            <img src="{{ asset('storage/uploads/avatars/' . $item->avatar) }}"
                                                alt="Ảnh bác sĩ" class="img-thumbnail"
                                                style="width: 80%; height: auto;">
                                            @endif
                                            @endif
                                            @endif
                                        </div>
                                        <div class="col-md-10 d-flex">
                                            <div class="col-md-6">
                                                <h6 class="fw-semibold mb-2 fs-5">Thông tin bệnh nhân:</h6>
                                                <div class="d-flex gap-3">
                                                    <div class="col-6">
                                                        <p><strong>Mã bệnh nhân:</strong> {{ $item->patient_id }}</p>
                                                        <p><strong>Số điện thoại:</strong> {{ $item->phone }}</p>
                                                        <p><strong>Họ và tên:</strong>
                                                            {{ $item->last_name . ' ' . $item->first_name }}
                                                        </p>
                                                        <p><strong>Giới tính:</strong>
                                                            {{ $item->gender == 1 ? 'Nam' : 'Nữ' }}
                                                        </p>
                                                        <p><strong>Bảo hiểm y tế:</strong> {{ $item->insurance_number }}
                                                        </p>
                                                        <p><strong>SĐT Khẩn cấp:</strong>
                                                            0{{ $item->emergency_contact }}</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p><strong>Ngày sinh:</strong>
                                                            {{ Carbon\Carbon::parse($item->birthday)->format('d/m/Y') }}
                                                        </p>
                                                        <p><strong>Địa chỉ:</strong> {{ $item->address }}</p>
                                                        <p><strong>Tạo lúc:</strong>
                                                            {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                                        </p>
                                                        <p><strong>Cập nhật lúc:</strong>
                                                            {{ Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}
                                                        </p>
                                                        <p><strong>Nghề nghiệp:</strong> {{ $item->occupation }}</p>
                                                        <p><strong>Quốc tịch:</strong> {{ $item->national }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-semibold mb-0 fs-5">Lịch sử bệnh án:</h6>
                                                <table class="table table-bordered mt-1">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th class="py-0" scope="col">Mã</th>
                                                            <th class="py-0" scope="col">Chuẩn đoán</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($item->medical_id))
                                                        <tr>
                                                            <td class="py-2"><strong>{{ $item->medical_id }}</strong>
                                                            </td>
                                                            <td class="py-2"><a
                                                                    href="{{ route('system.detail_medical_record', $item->medical_id) }}">{{ $item->diaginsis }}</a>
                                                            </td>
                                                        </tr>
                                                        @else
                                                        <tr>
                                                            <td colspan="2">Không có hồ sơ y tế.</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {!! $patients->links() !!}
            </div>
            @endif
        </div>


    </div>
</div>

<script>
    $(document).ready(function() {
        $("#phoneInput, #nameInput, #insuranceInput").on("keyup", function() {
            var nameValue = $("#nameInput").val().toLowerCase();
            var phoneValue = $("#phoneInput").val().toLowerCase();
            var insuranceValue = $("#insuranceInput").val().toLowerCase();
            var found = false;

            $("#myTable tr").each(function() {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(nameValue) > -1 && rowText.indexOf(phoneValue) > -1 && rowText.indexOf(insuranceValue) > -1) {
                    $(this).show();
                    found = true;
                } else {
                    $(this).hide();
                }
            });

            if (!found) {
                $("#noResults").show();
            } else {
                $("#noResults").hide();
            }
        });
    });
</script>
@endsection