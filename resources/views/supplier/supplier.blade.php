@extends('dashboard')

@section('data_supplier')
    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Tambah Supplier
    </button>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID SUPPLIER</th>
                <th scope="col">SUPPLIER NAME</th>
                <th scope="col">TELEPHONE</th>
                <th scope="col">CONTACT NAME</th>
                <th scope="col">STATUS</th>
                <th scope="col">ADDRESS</th>
                <th scope="col">CITY</th>
                <th scope="col">PROVINCES</th>
                <th scope="col">POSTAL CODE</th>
                <th scope="col">COUNTRY</th>
                <th scope="col">EMAIL</th>
                <th scope="col">NOTE</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($supplier as $i)
                <tr>
                    <th scope="row" style="font-size: 14px;">{{ $i->id_supplier }}</th>
                    <td style="font-size: 14px;">{{ $i->supplier_name }}</td>
                    <td style="font-size: 14px;">{{ $i->telephone }}</td>
                    <td style="font-size: 14px;">{{ $i->contact_name }}</td>
                    <td style="font-size: 14px;">{{ $i->status }}</td>
                    <td style="font-size: 14px;">{{ $i->address }}</td>
                    <td style="font-size: 14px;">{{ $i->city }}</td>
                    <td style="font-size: 14px;">{{ $i->provinces }}</td>
                    <td style="font-size: 14px;">{{ $i->postal_code }}</td>
                    <td style="font-size: 14px;">{{ $i->country }}</td>
                    <td style="font-size: 14px;">{{ $i->email }}</td>
                    <td style="font-size: 14px;">{{ $i->note }}</td>
                    <td style="font-size: 14px;">
                        <div class="d-flex">
                            <a href="/supplier/update/{{ $i->id_supplier }}"
                                class="btn btn-outline-primary btn-sm me-1">Ubah</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal-{{ $i->id_supplier }}">Delete</button>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="confirmDeleteModal-{{ $i->id_supplier }}" tabindex="-1"
                    aria-labelledby="confirmDeleteModalLabel-{{ $i->id_supplier }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $i->id_supplier }}">Confirm Deletion
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this record?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                <form action="{{ route('supplier.delete', $i->id_supplier) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade modal-dialog-scrollable" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container shadow pt-2 mt-2">
                        <form action="/supplier/store" method="POST" enctype="multipart/form-data" id="customerForm"
                            class="resettable-form">
                            @csrf
                            {{-- <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ID SUPPLIER</label>
                                <input type="text" name="id_supplier" class="form-control" id="exampleInputEmail1">
                            </div> --}}
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">SUPPLIER NAME</label>
                                <input type="text" name="supplier_name" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">TELEPHONE</label>
                                <input type="text" name="telephone" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">CONTACT NAME</label>
                                <input type="text" name="contact_name" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">STATUS</label>
                                <input type="text" name="status" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">ADDRESS</label>
                                <input type="text" name="address" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">CITY</label>
                                <input type="text" name="city" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">PROVINCES</label>
                                <input type="text" name="provinces" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">POSTAL CODE</label>
                                <input type="text" name="postal_code" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">COUNTRY</label>
                                <input type="text" name="country" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">EMAIL</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">NOTE</label>
                                <input type="text" name="note" class="form-control" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.getElementById('staticBackdrop');
            var modalCloseButton = modalElement.querySelector('[data-bs-dismiss="modal"]');
            var customerForm = document.getElementById('customerForm');

            modalElement.addEventListener('shown.bs.modal', function() {
                // Tindakan yang dijalankan ketika modal ditampilkan
            });

            modalElement.addEventListener('hidden.bs.modal', function() {
                // Tindakan yang dijalankan ketika modal ditutup
                customerForm.reset();
            });

            if (modalCloseButton && customerForm) {
                modalCloseButton.addEventListener('click', function() {
                    // Mengosongkan nilai formulir
                    customerForm.reset();
                });
            }
        });
    </script>
@endsection
