@extends('layouts.dashboard_layout')

@section('dashboard_content')
<div class="container-fluid">
    {{-- @include('layouts.procurement_header') --}}

    <!-- Main Content Section -->
    <div class="card p-4 mt-3" style="border: 1px solid #ddd; border-radius: 20px; margin-top: -25px;">
        <div class="d-flex justify-content-between align-items-center">
            <h4>{{str_pad($purchase_requests->id, 6, '0', STR_PAD_LEFT)}} - {{$purchase_requests->status}}</h4>

            <div>
                {{-- <button>
                    Save    
                </button>
                <button>
                    Save    
                </button> --}}
                <button type="button" class="btn btn-warning text-white" title="Edit" data-bs-toggle="modal" data-bs-target="#editPr{{$purchase_requests->id}}">
                    Edit
                </button>
                <button type="button" class="btn btn-info text-white" title="Request for quotation" data-bs-toggle="modal" data-bs-target="#rfq{{$purchase_requests->id}}">
                    Request For Quotation (RFQ)
                </button>
                <a href="{{url('procurement/purchase-request')}}" type="button" class="btn btn-danger text-white">
                    Close   
                </a>
            </div>
        </div>

        <p class="h5 mt-4">Primary Information</p>
        <hr class="mt-0">
        <div class="row">
            <div class="col-md-6 mb-2">
                <p class="m-0 fw-bold">Purchase No.:</p>
                {{str_pad($purchase_requests->id, 6, '0', STR_PAD_LEFT)}}
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2">
                <p class="m-0 fw-bold">Requestor Name:</p>
                {{$purchase_requests->user->name}}
            </div>
            <div class="col-md-6">
                <p class="m-0 fw-bold">Request Date Time:</p>
                {{date('m/d/Y', strtotime($purchase_requests->created_at))}}
            </div>
            <div class="col-md-6 mb-2">
                <p class="m-0 fw-bold">Remarks:</p>
                {!! nl2br(e($purchase_requests->remarks)) !!}
            </div>
            <div class="col-md-6 mb-2">
                <p class="m-0 fw-bold">Request Due Date:</p>
                {{date('m/d/Y', strtotime($purchase_requests->due_date))}}
            </div>
            <div class="col-md-6 mb-2">
                <p class="m-0 fw-bold">Assigned To:</p>
                {{$purchase_requests->assignedTo->name}}
            </div>
        </div>

        <p class="h5 mt-4">Classification</p>
        <hr class="mt-0">
        <div class="row">
            <div class="col-md-6 mb-2">
                <p class="m-0 fw-bold">Subsidiary:</p>
                {{$purchase_requests->subsidiary}}
            </div>
            <div class="col-md-6 mb-2">
                <p class="m-0 fw-bold">Class:</p>
                
            </div>
            <div class="col-md-6 mb-2">
                <p class="m-0 fw-bold">Department:</p>
                {{$purchase_requests->department->name}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="padding:5px 10px;">Item Code</th>
                                <th style="padding:5px 10px;">Item Category</th>
                                <th style="padding:5px 10px;">Item Description</th>
                                <th style="padding:5px 10px;">Quantity</th>
                                <th style="padding:5px 10px;">Unit of Measurement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($purchase_requests->purchaseItems->isNotEmpty())
                                @foreach ($purchase_requests->purchaseItems as $item)
                                    <tr>
                                        <td style="padding: 5px 10px;">{{$item->item_code}}</td>
                                        <td style="padding: 5px 10px;">{{$item->item_category}}</td>
                                        <td style="padding: 5px 10px;">{{$item->item_description}}</td>
                                        <td style="padding: 5px 10px;">{{$item->item_quantity}}</td>
                                        <td style="padding: 5px 10px;">{{$item->unit_of_measurement}}</td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="5" style="padding:5px 10px;">No data available.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="padding:5px 10px;">Attachments</th>
                                <th style="padding:5px 10px;">Document Type</th>
                                <th style="padding:5px 10px;">Remove</th>
                                <th style="padding:5px 10px;">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($purchase_requests->purchaseRequestFiles->isNotEmpty())
                                @foreach ($purchase_requests->purchaseRequestFiles as $file)
                                    <tr>
                                        <td style="padding: 5px 10px;">
                                            <a href="{{url($file->file)}}" target="_blank">
                                                <i class="bi bi-files"></i>
                                            </a>
                                        </td>
                                        <td style="padding: 5px 10px;">{{$file->document_type}}</td>
                                        <td style="padding: 5px 10px;">
                                            <form method="POST" action="{{url('procurement/delete-files/'.$file->id)}}" class="d-inline-block" id="deleteForm{{$file->id}}">
                                                @csrf 

                                                <button type="button" class="btn btn-sm btn-danger text-white" title="Remove File" onclick="removeFiles({{$file->id}})">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td style="padding: 5px 10px;">
                                            <button type="button" class="btn btn-sm btn-warning text-white" title="Edit File" data-bs-toggle="modal" data-bs-target="#editFile{{$file->id}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    @include('purchase_request.edit_file')
                                @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="5" style="padding:5px 10px;">No data available.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('purchase_request.edit2_purchase_request')
@include('purchase_request.request_for_quotation')
@endsection

@push('scripts')
    <script src="{{ asset('js/purchaseRequest.js') }}"></script>
@endpush