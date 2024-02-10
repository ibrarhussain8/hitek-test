@extends('layout')
@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{{route('pdf')}}">Export PDF</a>
        </div>
    </div>
    <table class="table table-bordered data-table mt-4">
    <thead>
    <tr>
    <th>Building ID</th>
    <th>Name</th>
    <th>Monthly Consumption</th>
    <th>Location Details</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    </table>
    </div>
    

@endsection

@section('js')
<script type="text/javascript">
    $(function () {
    var table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('home') }}",
    columns: [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'monthly_consumption', name: 'monthly_consumption'},
    {data: 'location_details', name: 'location_details'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    });
    });
    </script>
@endsection