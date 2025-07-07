@extends('layouts.master')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Chỉnh Sửa Bộ Lọc Sản Phẩm</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('filters.update', $filter->id) }}" method="POST">
            @csrf
            <div class="card main-card">
                <div class="card-header bg-white border-0 pb-0">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0">Thông Tin Bộ Lọc</h4>
                    </div>
                </div>

                <div class="card-body pt-4">
                    <!-- Filter Name -->
                    <div class="mb-4">
                        <label for="filterKey" class="form-label fw-semibold text-dark">Tên Bộ Lọc</label>
                        <input type="text" class="form-control bg-light text-muted" id="filterKey" value="{{$filter->key}}"  disabled>
                        <small class="text-muted">Tên bộ lọc không thể chỉnh sửa</small>
                    </div>

                    <!-- Current Values -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label fw-semibold text-dark mb-0">
                                Giá Trị Bộ Lọc (<span id="valueCount">6</span> giá trị)
                            </label>
                        </div>

                        <!-- Values Grid -->
                        <div class="row g-3" id="valuesContainer">
                            <!-- Values will be populated by JavaScript -->
                        </div>

                        <!-- Empty State -->
                        <div class="text-center py-5 d-none" id="emptyState">
                            <i class="fas fa-filter text-muted mb-3" style="font-size: 3rem;"></i>
                            <p class="text-muted">Chưa có giá trị nào được thêm</p>
                        </div>
                    </div>

                    <!-- Add New Value -->
                    <div class="card add-section">
                        <div class="card-body">
                            <label class="form-label fw-semibold text-dark mb-3">Thêm Giá Trị Mới</label>
                            <div class="row g-3">
                                <div class="col-12 col-md-8">
                                    <input type="text" class="form-control border-gray" id="newValue" placeholder="Nhập giá trị mới...">
                                </div>
                                <div class="col-12 col-md-4">
                                    <button type="button" class="btn btn-success w-100" onclick="addValue()">
                                        <i class="fas fa-plus me-2"></i>Thêm
                                    </button>
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block">Nhấn Enter hoặc click "Thêm" để thêm giá trị mới</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-100 d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light mb-4 mx-auto">Cập Nhật Bộ Lọc</button>

            </div>


        </form>
    </div>

    <script>
        // Initial filter values
        let filterValues = @json($filter->value ? json_decode($filter->value, true) : []);

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            renderValues();

            // Add Enter key support for new value input
            document.getElementById('newValue').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addValue();
                }
            });
        });

        // Render all filter values
        function renderValues() {
            const container = document.getElementById('valuesContainer');
            const emptyState = document.getElementById('emptyState');
            const valueCount = document.getElementById('valueCount');

            // Update count
            valueCount.textContent = filterValues.length;

            // Show/hide empty state
            if (filterValues.length === 0) {
                container.classList.add('d-none');
                emptyState.classList.remove('d-none');
                return;
            } else {
                container.classList.remove('d-none');
                emptyState.classList.add('d-none');
            }

            // Clear container
            container.innerHTML = '';

            // Render each value
            filterValues.forEach((value, index) => {
                const col = document.createElement('div');
                col.className = 'col-12 col-sm-6 col-lg-4';

                col.innerHTML = `
                    <div class="value-item rounded p-3 d-flex justify-content-between align-items-center fade-in">
                        <span class="badge bg-white text-dark py-2 px-3 flex-grow-1 text-start">${value}</span>
                         <input type="hidden" name="values[]" value="${value}">
                        <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeValue(${index})" title="Xóa giá trị">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;

                container.appendChild(col);
            });
        }

        // Add new value
        function addValue() {
            const input = document.getElementById('newValue');
            const newValue = input.value.trim();

            if (!newValue) {
                showToast('Vui lòng nhập giá trị mới', 'warning');
                return;
            }

            if (filterValues.includes(newValue)) {
                showToast('Giá trị đã tồn tại', 'warning');
                return;
            }

            filterValues.push(newValue);
            input.value = '';
            renderValues();
            showToast(`Đã thêm giá trị "${newValue}"`, 'success');
        }

        // Remove value
        function removeValue(index) {
            const removedValue = filterValues[index];
            filterValues.splice(index, 1);
            renderValues();
            showToast(`Đã xóa giá trị "${removedValue}"`, 'info');
        }

        // Update filter (simulate save)
        function updateFilter() {
            showToast('Cập nhật thành công! Bộ lọc sản phẩm đã được cập nhật.', 'success');
        }

        // Show toast notification
        function showToast(message, type = 'info') {
            const toastContainer = document.getElementById('toastContainer');
            const toastId = 'toast_' + Date.now();

            const toastHTML = `
                <div class="toast align-items-center text-bg-${type} border-0 fade show" role="alert" id="${toastId}">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-${getToastIcon(type)} me-2"></i>${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="closeToast('${toastId}')"></button>
                    </div>
                </div>
            `;

            toastContainer.insertAdjacentHTML('beforeend', toastHTML);

            // Auto remove after 5 seconds
            setTimeout(() => {
                closeToast(toastId);
            }, 5000);
        }

        // Close toast
        function closeToast(toastId) {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 150);
            }
        }

        // Get toast icon based on type
        function getToastIcon(type) {
            switch(type) {
                case 'success': return 'check-circle';
                case 'warning': return 'exclamation-triangle';
                case 'danger': return 'exclamation-circle';
                case 'info': return 'info-circle';
                default: return 'info-circle';
            }
        }
    </script>
@endsection
