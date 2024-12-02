<div class="card w-100">
    <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Quản lý thuốc hết</h5>
        <div class="table-responsive">
            <div class="mb-3">
                {!! $medicineEnd->links() !!}
            </div>
            <table class="table table-bordered text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr class="text-center">
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">STT</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Tên thuốc</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Đơn vị</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Ngày thêm</h6>
                        </th>

                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Trạng thái</h6>
                        </th>

                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Hành động</h6>
                        </th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @if($medicineEnd->isEmpty())
                    <div id="noResults" class="alert alert-warning">Không tìm thấy dữ liệu.</div>
                    @else
                    @php
                    $count = 1;
                    @endphp
                    @foreach ($medicineEnd as $data)
                    <tr>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">{{ $count++ }}</h6>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-semibold text-truncate">{{ Str::limit($data->name, 30) }}</p>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-semibold">{{ $data->unit_of_measurement }}
                            </p>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-semibold">{{ Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}
                            </p>
                        </td>
                        <td class="border-bottom-0">
                            @if ($data->status == 1)
                            <span class="badge bg-success">Hoạt động</span>
                            @else
                            <span class="badge bg-danger">Hết hạn</span>
                            @endif
                        </td>
                        <td class="border-bottom-0 d-flex">
                            <a href="javascript:void(0)" class="btn btn-primary me-1"
                                onclick="openEditModalMedicine('{{ $data->medicine_id }}')">
                                <i class="ti ti-pencil"></i>
                            </a>
                            <form action="{{ route('system.medicines.delete', $data->medicine_id) }}"
                                id="form-delete{{ $data->medicine_id }}" method="post">
                                @method('delete')
                                @csrf
                            </form>
                            <button type="submit" class="btn btn-danger btn-delete" data-id="{{ $data->medicine_id }}">
                                <i class="ti ti-trash"></i>
                            </button>
                            <a class="btn btn-warning ms-1" data-bs-toggle="collapse"
                                href="#collapse{{ $data->medicine_id }}" role="button" aria-expanded="false"
                                aria-controls="collapse{{ $data->medicine_id }}">
                                Chi tiết
                            </a>
                        </td>
                    </tr>
                    <tr id="show">
                        <td colspan="10">
                            <div class="collapse" id="collapse{{ $data->medicine_id }}">
                                <div class="card card-body ">
                                    <h6 class="fw-semibold mb-2 fs-5">Thông tin chi tiết:</h6>
                                    <div class="col-md-12 d-flex mt-1">
                                        <div class="col-md-6">
                                            <p><strong>Mã thuốc:</strong> {{ $data->medicine_id }}</p>
                                            <p><strong>Tên thuốc:</strong> {{ $data->name }}</p>
                                            <p><strong>Hoạt tính:</strong> {{ $data->active_ingredient }}</p>
                                            <p><strong>Đơn vị:</strong> {{ $data->unit_of_measurement }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Nhóm thuốc:</strong> {{ $data->medicine_types_name }}</p>
                                            <p><strong>Ngày thêm thuốc:</strong>
                                                {{ Carbon\Carbon::parse($data->created_at)->format('H:i d/m/Y ') }}
                                            </p>
                                            <p><strong>Ngày cập nhật:</strong>
                                                {{ Carbon\Carbon::parse($data->updated_at)->format('H:i d/m/Y ') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            {!! $medicineEnd->links() !!}
        </div>
    </div>
</div>