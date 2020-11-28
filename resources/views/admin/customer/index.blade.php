@extends('layouts.app', ['title' => 'Customers'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-users"></i> CUSTOMERS</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.customer.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="q"
                                    placeholder="cari berdasarkan nama customer">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">NAMA CUSTOMER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">BERGABUNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $no => $customer)
                                <tr>
                                    <th scope="row" style="text-align: center">
                                        {{ ++$no + ($customers->currentPage()-1) * $customers->perPage() }}</th>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ dateID($customer->created_at) }}</td>
                                </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <div class="alert alert-danger">
                                                Data Belum Tersedia!
                                            </div>
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $customers->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection