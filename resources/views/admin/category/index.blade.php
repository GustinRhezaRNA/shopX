@extends('admin.layouts.app')

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
                        <div class="category-tree" class="dd"></div>
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
