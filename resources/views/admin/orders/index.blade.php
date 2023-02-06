@extends('layouts.admin')

@section('title', 'My Orders')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>My Orders
                    </h3>
                </div>
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">


                            <div class="col-md-3">
                                <label>Filter by Date</label>
                                <input type="date" name="date" class="form-control"
                                    value="{{ Request::get('date') ?? date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3">
                                <label>Filter by Status</label>
                                <select name="status" class="form-select" id="">
                                    <option value="">Select Status</option>
                                    <option value="in progress"
                                        {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In Progress
                                    </option>
                                    <option value="completed" {{ Request::get('status') == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                    <option value="out-for-delivery"
                                        {{ Request::get('status') == 'out-for-delivery' ? 'selected' : '' }}>Out
                                        For Delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Tracking No</th>
                                    <th>Username</th>
                                    <th>Payment Mode</th>
                                    <th>Ordered Date</th>
                                    <th>Status Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $orderItem)
                                    <tr>
                                        <td>{{ $orderItem->id }}</td>
                                        <td>{{ $orderItem->tracking_no }}</td>
                                        <td>{{ $orderItem->fullname }}</td>
                                        <td>{{ $orderItem->payment_mode }}</td>
                                        <td>{{ $orderItem->created_at->format('d-m-y') }}</td>
                                        <td>{{ $orderItem->status_message }}</td>
                                        <td>
                                            <a href="{{ url('admin/orders/' . $orderItem->id) }}"
                                                class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Orders Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
