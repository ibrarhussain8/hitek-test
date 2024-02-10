@extends('layout')
@section('content')
<div class="row pt-4">
    <div class="col-md-12">
       
    <form id="buildingForm" method="POST" enctype="multipart/form-data" action="{{Route('store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Building Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Building ABC">
        </div>
        <div class="form-group">
            <label for="monthly_consumption">Monthly Consumption</label>
            <input type="number" class="form-control" id="monthly_consumption" name="monthly_consumption" value="0">
        </div>
        <div class="form-group">
            <label for="location_details">Location Details</label>
            <textarea class="form-control" id="location_details" name="location_details" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" multiple class="form-control" id="images" name="images[]">
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    </div>
</div>    
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#buildingForm').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true,
                },
                monthly_consumption: {
                    required: true,
                    number:true
                },
                location_details: {
                    required: true,
                },
                'images[]': {
                    required: true,
                    accept: "image/jpg,image/jpeg,image/png,image/gif"
                }
            }
        });
    
    });    
    </script>
    
@endsection

