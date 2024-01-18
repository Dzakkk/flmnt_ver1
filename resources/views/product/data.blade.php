@extends('dashboard')

@section('data_product')
    {{-- <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Tambah Supplier
</button> --}}
    <a href="/product/store" class="btn btn-info mt-1 mb-1">Tambah Product Baru</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">FAI Code</th>
                <th scope="col">FINA Code</th>
                <th scope="col">Category</th>
                <th scope="col">Aspect</th>
                <th scope="col">Name</th>
                <th scope="col">Build Product</th>
                <th scope="col">Formula ID</th>
                <th scope="col">Segment</th>
                <th scope="col">Solubility</th>
                <th scope="col">Created Date</th>
                <th scope="col">Release Date </th>
                <th scope="col">NOTE</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prd as $i)
                <tr>
                    <th scope="row">{{ $i->FAI_code }}</th>
                    <td>{{ $i->FINA_code }}</td>
                    <td>{{ $i->category }}</td>
                    <td>{{ $i->aspect }}</td>
                    <td>{{ $i->product_name }}</td>
                    <td>{{ $i->build_product }}</td>
                    <td>{{ $i->formula_id }}</td>
                    <td>{{ $i->segment }}</td>
                    <td>{{ $i->solubility }}</td>
                    <td>{{ $i->created_date }}</td>
                    <td>{{ $i->release_date }}</td>
                    <td>{{ $i->note }}</td>
                    <td>
                        <div class="">
                            <a href="/supplier/update/{{ $i->FAI_code }}"
                                class="btn btn-outline-primary btn-sm me-1 mb-1">Ubah</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal-{{ $i->FAI_code }}">Delete</button>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="confirmDeleteModal-{{ $i->FAI_code }}" tabindex="-1"
                    aria-labelledby="confirmDeleteModalLabel-{{ $i->FAI_code }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $i->FAI_code }}">Confirm Deletion
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this record?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                <form action="{{ route('product.delete', $i->FAI_code) }}" method="POST">
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
    {{-- <div class="modal fade modal-dialog-scrollable" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container shadow pt-2 mt-2">
                        <form action="/supplier/store" method="POST" enctype="multipart/form-data" id="customerForm" class="resettable-form">
                            @csrf
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
                                <input type="text" name="contact_name" class="form-control" id="exampleInputPassword1">
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
  
          modalElement.addEventListener('shown.bs.modal', function () {
              // Tindakan yang dijalankan ketika modal ditampilkan
          });
  
          modalElement.addEventListener('hidden.bs.modal', function () {
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
  </script> --}}
@endsection
