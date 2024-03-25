@extends('dashboard')

@section('user')
    <?php
    $row = 1;
    ?>
    <a href="/user" class="btn btn-info">Tambah User</a>
    <table class="table table-hover shadow mt-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NAMA</th>
                <th scope="col">DIVISI</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $row }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->divisi }}</td>

                    <td>
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal"
                                data-bs-target="#exampleModal-{{ $item->id }}">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal-{{ $item->id }}">Delete</button>
                        </div>
                    </td>
                </tr>
                <?php
                $row++;
                ?>
                <div class="modal fade" id="confirmDeleteModal-{{ $item->id }}" tabindex="-1"
                    aria-labelledby="confirmDeleteModalLabel-{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $item->id }}">Confirm Deletion
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure want to delete {{ $item->name }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                <form action="{{ route('user.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-3 d-flex" action="/user/update/{{ $item->id }}" method="POST">
                                @csrf
                            <div class="modal-body">
                                
                                    <div class="col-md-12">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" id="nama" value="{{ $item->name }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputPassword4" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="input new password">
                                    </div>
                                   
                                    <div class="col-md-12">
                                        <label for="role" class="form-label">role :</label>
                                        <div class="input-group">
                                            <select class="form-select" id="role_select" name="divisi">
                                                <option value="{{ $item->divisi }}">{{ $item->divisi }}</option>
                                                <option value="operasional">Operasional</option>
                                                <option value="produksi">Produksi</option>
                                                <option value="quality">Quality Control</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-12 pb-4">
                                    </div>
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update User</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection
