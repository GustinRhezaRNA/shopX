@extends('admin.layouts.app')
@push('styles')
    <style>
        .dd-item.custom-cat-item {
            border: none;
            padding: 0;
            margin-bottom: 0;
            background: none;
            border-radius: 0;
        }

        .dd-item-row.custom-cat-row {
            user-select: text;
            background: none;
            gap: 4px;
            border: 1px solid #e9ecef;
            min-height: 38px;
            display: flex;
            align-items: center;
            padding-left: 0.75rem;
            /* px-2 */
            padding-right: 0.75rem;
            padding-top: 0.25rem;
            /* py-1 */
            padding-bottom: 0.25rem;
        }

        .dd-handle.custom-cat-handle {
            cursor: move;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            /* me-2 */
        }

        .cat-folder-icon {
            font-size: 16px;
            color: #6c757d;
        }

        .cat-label.custom-cat-label {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 2px;
            flex: 1 1 auto;
        }
    </style>
@endpush
@section('contents')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span>Categories</span>
                        <button class="btn btn-primary">New</button>
                    </div>
                    <div class="card-body">
                        <div id="category-tree" class="dd">
                            <ol class="dd-list" style="margin-bottom: 0">
                                <li class="dd-item custom-cat-item" data-id="">
                                    <div class="dd-item-row custom-cat-row">
                                        <div class="dd-handle custom-cat-handle" title="Drag to reorder">
                                            <i class="ti ti-grip-horizontal"></i>
                                        </div>

                                        <i class="ti ti-folder cat-folder-icon"></i>

                                        <div class="cat-label custom-cat-label" data-id="">
                                            <span>Category Name</span>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <div id="tree-loading" class=" text-center my-2">
                            <div class="spinner-border text-primary" role="status">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><span>Create Category</span></div>
                    <div class="card-body">
                        <form action="" id="category-form">
                            <div class="mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label for="parent_id" class="form-label">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-select">
                                    <option value="">Select Parent Category</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" checked="is_active" id="parent_id"
                                        name="is_active">
                                    <span class="form-check-label">Active</span>
                                </label>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <button type="submit" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#category-form').submit(function(e) {
                e.preventDefault();
                let method = 'POST';
                let url = "{{ route('admin.categories.store') }}";
                let data = {
                    name: $('#name').val(),
                    slug: $('#slug').val(),
                    parent_id: $('#parent_id').val(),
                    is_active: $('#is_active').is(':checked') ? 1 : 0,
                    _token: "{{ csrf_token() }}"
                }

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function(response) {
                        console.log(response);
                        clearForm();
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, (field, messages) => {
                            messages.forEach((msg) => {
                                notyf.error(msg);
                            });
                        });
                    }
                });
            });


            // load parent dropdown
            function loadParentCategories(selectedId, excludedId) {
                $.get("{{ route('admin.categories.nested') }}", function(categories) {
                    let options = '<option value="">Select Parent Category</option>';

                    function addOptions(categories, prefix, depth) {
                        categories.forEach(category => {
                            if (category.id !== excludedId) {
                                options +=
                                    `<option value="${category.id}" ${category.id == selectedId ? 'selected' : ''}>${prefix} ${category.name}</option>`;

                                if (category.children && category.children.length > 0) {
                                    addOptions(category.children, prefix + '-', depth + 1);
                                }
                            } else return;
                        });
                    }
                    addOptions(categories, '', 0);
                    $('#parent_id').html(options);
                });
            }

            // clear form
            function clearForm() {
                $('#name').val('');
                $('#slug').val('');
                $('#parent_id').val('');
                $('#is_active').prop('checked', true);
                loadParentCategories(null, null);
            }

            // Initial load
            clearForm();
        })
    </script>
@endpush
