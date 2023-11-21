@extends('layouts.admin')

@section('title')
Regions &rarr; View &rarr; {{ $region->name }}
@endsection

@section('content-header')
<h1>{{ $region->name }}<small>Region Details</small></h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin.index') }}">Admin</a></li>
    <li><a href="{{ route('admin.regions') }}">Regions</a></li>
    <li class="active">{{ $region->name }}</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Region Details</h3>
            </div>
            <form action="{{ route('admin.regions.view', $region->id) }}" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">Region Name</label>
                        <input type="text" id="pName" name="name" class="form-control" value="{{ $region->name }}" />
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    {!! method_field('PATCH') !!}
                    <button name="action" value="edit" class="btn btn-sm btn-primary pull-right">Save</button>
                    <button name="action" value="delete" class="btn btn-sm btn-danger pull-left muted muted-hover"><i class="fa fa-trash-o"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Locations in this Region</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Short Code</th>
                        <th>Description</th>
                    </tr>
                    @foreach($region->locations as $location)
                    <tr>
                        <td><code>{{ $location->id }}</code></td>
                        <td><a href="{{ route('admin.locations.view', $location->id) }}">{{ $location->short }}</a></td>
                        <td>{{ $location->long }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <button class="btn btn-sm btn-primary pull-right"" data-toggle="modal" data-target="#assignLocationModal">Assign Location</button>

            <!-- Modal for Assigning Locations -->
            <div class="modal fade" id="assignLocationModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Assign Location to Region</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(isset($allLocations) && count($allLocations) > 0)
                            @foreach($allLocations as $location)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="locations[]" value="{{ $location->id }}"
                                           {{ $region->locations->contains($location->id) ? 'checked' : '' }}>
                                    {{ $location->short }} - {{ $location->long }}
                                </label>
                                <!-- Individual form for adding location to region -->
                                <form action="{{ route('admin.regions.assign', ['region' => $region->id]) }}" method="POST" style="display: inline;">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="locations[]" value="{{ $location->id }}">
                                    <button type="submit" class="btn btn-xs btn-success">Add</button>
                                </form>
                                <form action="{{ route('admin.regions.assign', ['region' => $region->id]) }}" method="POST" style="display: inline;">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="locations[]" value="{{ $location->id }}">
                                    <button type="submit" class="btn btn-xs btn-danger">Remove</button>
                                </form>
                            </div>
                            @endforeach
                            @else
                            <p>No locations available to assign.</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </









        </div>
    </div>

</div>
@endsection
