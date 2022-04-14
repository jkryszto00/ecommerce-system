@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header d-inline-flex align-items-center justify-content-between">
                        {{ __('Categories') }}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">
                            {{ __('Add category') }}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addCategoryLabel">{{ __('New category') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.categories.store') }}" method="post" id="newCategoryForm">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input type="text" name="name" class="form-control" id="nameInput" placeholder="Name">
                                                <label for="nameInput">Name</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        <button type="submit" class="btn btn-primary"
                                            onclick="event.preventDefault();
                                            document.getElementById('newCategoryForm').submit();">{{ __('Create') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:40%;">Name</th>
                                    <th scope="col" style="width:40%;">Slug</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td >{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCategory{{ $category->id }}">{{ __('Edit') }}</button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                   onclick="event.preventDefault();
                                                   document.getElementById('delete-category-{{ $category->id }}-form').submit();">{{ __('Delete') }}</button>
                                            </div>
                                            <form id="delete-category-{{ $category->id }}-form" action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            <div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('admin.categories.update', $category) }}" method="post" id="updateCategory{{$category->id}}Form">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editCategoryLabel">{{ __('Edit category') }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                @method('put')
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="nameInput" placeholder="Name">
                                                                    <label for="nameInput">Name</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" id="nameInput" placeholder="Category slug">
                                                                    <label for="nameInput">Slug</label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    onclick="event.preventDefault();
                                                                    document.getElementById('updateCategory{{$category->id}}Form').submit();">{{ __('Update') }}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
