@extends('app', ['page_title' => 'Vendors'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('vendors.create') }}"><i class="fas fa-plus"></i> New Vendor</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="accordion1">
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading3" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            <strong>Active</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>NAME</strong></th>
                                    <th width="20%"><strong>MOBILE NO.</strong></th>
                                    <th width="30%"><strong>EMAIL ADDRESS</strong></th>
                                    <th width="10%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $vendor)
                                    @if ($vendor->active)
                                <tr>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->mobile_no }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('vendors.edit', [$vendor->slug()]) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                        <a title="Trash" href="{{ route('vendors.disable', [$vendor->slug()]) }}" onclick="return confirmDisable()"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading4" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                            <strong>Inactive</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable2" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>NAME</strong></th>
                                    <th width="20%"><strong>MOBILE NO.</strong></th>
                                    <th width="30%"><strong>EMAIL ADDRESS</strong></th>
                                    <th width="10%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $vendor)
                                    @if (!$vendor->active)
                                <tr>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->mobile_no }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td class="text-center">
                                        <a title="Restore" href="{{ route('vendors.enable', [$vendor->slug()]) }}"><i class="fas fa-undo"></i></a>
                                    </td>
                                </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection