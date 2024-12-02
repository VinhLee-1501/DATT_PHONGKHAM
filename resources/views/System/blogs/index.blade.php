@extends('layouts.admin.master')
@section('Quản lí bài viết')
@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center m-1 mb-4">
                <a href="{{ route('system.blog.resetsearch') }}" class="card-title">
                    <h3>Quản lý bài viết</h3>
                </a>
                <div>
                    <a href="{{ route('system.blogs.create') }}" class="btn btn-success">Thêm mới</a>
                </div>
            </div>
            <nav class="mb-4">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Đã xuất bản</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Chờ xuất bản</button>
                </div>
            </nav>
            <div class="row align-items-center me-0">
                <!-- Tìm kiếm và nút xóa -->
                <div class="col-12 col-md-6 col-sm-2 d-flex align-items-center mb-3 mb-md-0">
                    <form id="searchForm" action="{{ route('system.blogs.search') }}" method="GET"
                        class="d-flex align-items-center">
                        <div class="w-40">
                            <input type="text" name="search" id="searchInput" class="form-control"
                                value="{{ request('search', $search) }}" placeholder="Nhập tiêu đề">
                        </div>
                        <input type="hidden" name="tab" class="tab" id="tabInput" value="0">
                        <button type="submit" class="btn btn-success" id="searchButton">
                            <i class="ti ti-search"></i>
                        </button>
                    </form>
                    <button type="button" id="deleteButton" class="btn btn-danger ms-2 multiple-delete">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>

                <!-- Chọn số lượng hiển thị nằm trên cùng một hàng -->
                <div class="col-auto ms-auto d-flex align-items-center">
                    <span class="me-2 d-none d-sm-inline">Hiển thị:</span>
                    <select class="form-select d-none d-sm-inline" style="width: 75px" id="itemsPerPage" aria-label="Items per page">
                        <option value="5" {{ request()->input('itemsPerPage', 5) == 5 ? 'selected' : '' }}>
                            5
                        </option>
                        <option value="10" {{ request()->input('itemsPerPage', 5) == 10 ? 'selected' : '' }}>10
                        </option>
                        <option value="15" {{ request()->input('itemsPerPage', 5) == 15 ? 'selected' : '' }}>15
                        </option>
                        <option value="20" {{ request()->input('itemsPerPage', 5) == 20 ? 'selected' : '' }}>20
                        </option>
                    </select>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <!-- Tab Dịch vụ hoạt động -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="table-responsive ">
                        <table class="table table-bordered text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr class="text-center">
                                    <th></th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Mã bài viết</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tiều đề</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày xuất bản</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Thao tác</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="activeTable">
                                @if ($blogs->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <h5 class="text-muted">Không tìm thấy kết quả nào
                                        </h5>
                                    </td>
                                </tr>
                            @else
                            
                                @foreach ($blogs as $data)
                                    <tr class="text-center">
                                        <td>
                                            <input type="checkbox" name="blog_id[]" value="{{ $data->id }}"
                                                class="blogCheckbox">
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="fw-semibold mb-0">{{ $data->id }}</p>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            <p class="mb-0 fw-semibold" style="word-wrap: break-word; overflow-wrap: break-word;
                                            white-space: normal; max-width: 200px; word-break: normal;">{{ $data->title }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-semibold">{{ Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            @if ($data->status == 0)
                                                <p class="badge bg-danger mb-0 fw-semibold">Đã xuất bản</p>
                                            @else
                                                <p class="badge bg-success mb-0 fw-semibold">Chờ xuất bản</p>
                                            @endif
                                        </td>
                                        <td class="border-bottom-0 d-flex justify-content-center align-items-centers">
                                            <a href="{{ route('system.blogs.edit', $data->slug) }}"
                                                class="btn btn-primary me-1">
                                                <i class="ti ti-pencil"></i>
                                            </a>
                                            <a data-id="{{ $data->id }}" class="btn btn-danger me-1">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                        <div class="mt-3 d-flex justify-content-center">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>

                <!-- Tab Dịch vụ không hoạt động -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="table-responsive ">
                        <table class="table table-bordered text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr class="text-center">
                                    <th></th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Mã bài viết</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tiều đề</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày xuất bản</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Thao tác</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="activeTable">
                                @if ($blogInactive->isNotEmpty())
                                    @foreach ($blogInactive as $data)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="blog_id[]" value="{{ $data->id }}"
                                                class="blogCheckbox">
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="fw-semibold mb-0">{{ $data->id }}</p>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            <p class="mb-0 fw-semibold" style="word-wrap: break-word; overflow-wrap: break-word;
                                            white-space: normal; max-width: 200px; word-break: normal;">{{ $data->title }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-semibold">{{ Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            @if ($data->status == 0)
                                                <p class="badge bg-danger mb-0 fw-semibold">Đã xuất bản</p>
                                            @else
                                                <p class="badge bg-success mb-0 fw-semibold">Chờ xuất bản</p>
                                            @endif
                                        </td>
                                        <td class="border-bottom-0 d-flex">
                                            <a href="{{ route('system.blogs.edit', $data->slug) }}"
                                                class="btn btn-primary me-1">
                                                <i class="ti ti-pencil"></i>
                                            </a>
                                            <a data-id="{{ $data->id }}" class="btn btn-danger me-1">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <h5 class="text-muted">Không tìm thấy kết quả nào</h5>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="mt-3 d-flex justify-content-center">
                            {{ $blogInactive->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Gắn sự kiện onchange cho select
                $('#itemsPerPage').on('change', function() {
                    // Lấy giá trị của select
                    var itemsPerPage = $(this).val();

                // Lấy URL hiện tại
                var url = new URL(window.location.href);

                // Thêm hoặc cập nhật tham số itemsPerPage trong URL
                url.searchParams.set('itemsPerPage', itemsPerPage);

                // Thực hiện điều hướng (reload trang với tham số itemsPerPage mới)
                window.location.href = url.toString();
            });
        });
        </script>
        <script>
            $(document).ready(function() {
                // Tạo khóa lưu trữ duy nhất dựa trên đường dẫn URL hiện tại để tránh xung đột
                const uniqueKey = 'activeTabId_' + window.location.pathname;

                // Khi người dùng click vào tab, lưu trạng thái của tab vào sessionStorage với tên khóa duy nhất
                $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const activeTabId = $(e.target).attr('id'); // Lấy ID của tab đang hoạt động
                    sessionStorage.setItem(uniqueKey,
                        activeTabId); // Lưu ID của tab vào sessionStorage với khóa duy nhất
                });

                // Khi trang được tải lại, kiểm tra sessionStorage và kích hoạt tab đã lưu trong đó
                const activeTabId = sessionStorage.getItem(uniqueKey);
                if (activeTabId) {
                    $('#' + activeTabId).tab('show'); // Kích hoạt tab được lưu trong sessionStorage
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                // Khi người dùng chuyển tab, cập nhật giá trị của input ẩn "tabInput"
                $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const activeTab = $(e.target).attr('id');
                    if (activeTab === 'nav-home-tab') {
                        $('#tabInput').val(0); // Tab "Hoạt động"
                    } else if (activeTab === 'nav-profile-tab') {
                        $('#tabInput').val(1); // Tab "Không hoạt động"
                    }
                });

                // Sự kiện khi nhấn nút tìm kiếm
                $('#searchButton').on('click', function() {
                    // Trước khi gửi form, đảm bảo giá trị của "tabInput" đã được cập nhật đúng
                    $('#searchForm').submit();
                });
            });
        </script>
        <script>
            document.addEventListener('click', function(e) {
                const deleteButton = e.target.closest('.btn-danger');

                // Bỏ qua nếu nút là nút "Xóa nhiều"
                if (deleteButton && !deleteButton.classList.contains('multiple-delete')) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn xóa?',
                        text: "Hành động này không thể hoàn tác!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const rowId = deleteButton.getAttribute('data-id');
                            const deleteUrl = '/system/blogs/delete/' + rowId;
                            window.location.href = deleteUrl;
                        }
                    });
                }
            });
        </script>
         <script>
            document.getElementById('deleteButton').addEventListener('click', function(e) {
                e.preventDefault();

                // Lấy danh sách các checkbox đã chọn
                var selectedCheckboxes = document.querySelectorAll('input[name="blog_id[]"]:checked');
                var selectedIds = [];

                selectedCheckboxes.forEach(function(checkbox) {
                    selectedIds.push(checkbox.value);
                });

                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn xóa?',
                        text: "Hành động này không thể hoàn tác!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: './blogs/multipledelete', // Đường dẫn tới route xóa
                                type: 'POST', // Sử dụng POST
                                data: {
                                    _token: '{{ csrf_token() }}', // Token CSRF
                                    blog_id: selectedIds
                                },
                                success: function(response) {
                                    toastr.success('Các dịch vụ đã được xóa thành công.');
                                    location.reload();
                                },
                                error: function(xhr, status, error) {
                                    toastr.error('Đã xảy ra lỗi khi xóa dịch vụ.');
                                }
                            });
                        }
                    });
                } else {
                    toastr.error('Vui lòng chọn ít nhất một dịch vụ để xóa');
                }
            });
        </script>
    @endpush
@endsection
