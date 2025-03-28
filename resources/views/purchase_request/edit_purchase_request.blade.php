{{-- <div class="modal fade" id="addPurchaseRequest">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInventoryModalLabel">Add new purchase request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addInventoryForm" action="{{url('procurement/store-purchase-request')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6 mb-2">
                            <label for="puchaseNo" class="form-label">Purchase No.:</label>
                            <input type="text" class="form-control" value="The PR No. is auto generated when submitting a form" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="requestorName" class="form-label">Requestor Name:</label>
                            <input type="hidden" name="requestor_name" value="{{auth()->user()->id}}">
                            <input type="text" class="form-control" id="requestorName" required value="{{auth()->user()->name}}" readonly>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" name="remarks" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="requestDueDate" class="form-label">Request Due-Date:</label>
                            <input type="date" name="requestDueDate" name="request_due_date" id="requestDueDate" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="subsidiary" class="form-label">Subsidiary:</label>
                            <input type="text" name="subsidiary" value="{{auth()->user()->subsidiary}}" class="form-control form-control-sm" readonly>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="class" class="form-label" >Class:</label>
                            <select data-placeholder="Select class" class="form-control js-example-basic-single" style="width: 100%; position: relative;" required>
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="department" class="form-label">Department</label>
                            <input type="hidden" name="department" value="{{auth()->user()->department_id}}">
                            <input type="text"  value="{{auth()->user()->department->name}}" class="form-control form-control-sm" readonly>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th style="padding: 5px 10px">Item Code</th>
                                            <th style="padding: 5px 10px">Item Category</th>
                                            <th style="padding: 5px 10px">Item Description</th>
                                            <th style="padding: 5px 10px">Item Quantity</th>
                                            <th style="padding: 5px 10px">Unit of Measurement</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyAddRow">
                                        <tr>
                                            <td style="padding: 5px 10px">
                                                <p class="item_code"></p>
                                            </td>
                                            <td style="padding: 5px 10px">
                                                <p class="item_category"></p>
                                            </td>
                                            <td style="padding: 5px 10px">
                                                <select data-placeholder="Select item description" name="inventory_id[]" class="form-control js-example-basic-single" style="width: 100%; position: relative;" onchange="itemDescription(this.value)">
                                                    <option value=""></option>
                                                    @foreach ($inventory_list as $inventory)
                                                        <option value="{{$inventory->inventory_id}}">{{$inventory->item_description}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style="padding: 5px 10px">
                                                <p class="item_quantity"></p>
                                            </td>
                                            <td style="padding: 5px 10px">
                                                <select data-placeholder="Select unit of measurement" name="unit_of_measurement[]" class="form-control js-example-basic-single" style="width: 100%; position: relative;" required>
                                                    <option value=""></option>
                                                    <option value="KG">KG</option>
                                                    <option value="G">Grams</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>    
                            <button type="button" class="btn btn-sm btn-success" id="addRowBtn">
                                <i class="ti-plus"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" id="deleteRowBtn">
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <label for="attachments" class="form-label">Attachments:</label>
                            <input type="file" name="attachments[]" class="form-control" multiple>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" id="saveNewInventory">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div> --}}

@extends('layouts.header')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Edit Purchase Request</h4>
                    <div>
                        <a href="{{url('procurement/purchase-request')}}" class="btn btn-outline-secondary">
                            <i class="ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
    
                <form method="POST" action="{{url('procurement/update-purchase-request/'.$purchase_request->id)}}" onsubmit="show()" enctype="multipart/form-data">
                    @csrf 
    
                    <div class="row g-3">
                        <div class="col-md-6 mb-2">
                            <label for="puchaseNo" class="form-label">Purchase No.:</label>
                            <input type="text" class="form-control" value="The PR No. is auto generated when submitting a form" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="requestorName" class="form-label">Requestor Name:</label>
                            <input type="hidden" name="requestor_name" value="{{auth()->user()->id}}">
                            <input type="text" class="form-control" id="requestorName" required value="{{auth()->user()->name}}" readonly>
                        </div>
        
                        <div class="col-md-6 mb-2">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" name="remarks" cols="30" rows="10">{{ $purchase_request->remarks }}</textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="requestDueDate" class="form-label">Request Due-Date:</label>
                            <input type="date" name="requestDueDate" name="request_due_date" id="requestDueDate" class="form-control form-control-sm" value="{{ $purchase_request->due_date }}" required>
                        </div>
                        
                        <div class="col-md-6 mb-2">
                            <label for="subsidiary" class="form-label">Subsidiary:</label>
                            <input type="text" name="subsidiary" value="{{auth()->user()->subsidiaryId->subsidiary_name}}" class="form-control form-control-sm" readonly>
                        </div>
        
                        <div class="col-md-6 mb-2">
                            <label for="class" class="form-label" >Class:</label>
                            <select data-placeholder="Select class" class="form-control js-example-basic-single" name="classification" style="width: 100%; position: relative;" >
                                <option value=""></option>
                                @foreach ($classifications as $class)
                                    <option value="{{$class->id}}" @if($purchase_request->classification_id == $class->id) selected @endif>{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="col-md-6 mb-2">
                            <label for="department" class="form-label">Department</label>
                            <input type="hidden" name="department" value="{{auth()->user()->department_id}}">
                            <input type="text"  value="{{auth()->user()->department->name}}" class="form-control form-control-sm" readonly>
                        </div>
        
                        <div class="col-md-12 mb-2">
                            <button type="button" class="btn btn-sm btn-success" id="addRowBtn">
                                <i class="ti-plus"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" id="deleteRowBtn">
                                <i class="ti-minus"></i>
                            </button>
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered" width="100%" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Item Category</th>
                                            <th>Item Description</th>
                                            <th>Item Quantity</th>
                                            <th>Unit of Measurement</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyAddRow">
                                        @foreach ($purchase_request->purchaseItems as $purchase_item)
                                            <tr>
                                                <td>
                                                    <p class="item_code">{{ $purchase_item->inventory->item_code }}</p>
                                                </td>
                                                <td>
                                                    <p class="item_category">{{ $purchase_item->inventory->category->name }}</p>
                                                </td>
                                                <td>
                                                    <select data-placeholder="Select item description" name="inventory_id[]" class="form-control js-example-basic-single" style="width: 100%; position: relative;" onchange="itemDescription(this)">
                                                        <option value=""></option>
                                                        @foreach ($inventory_list as $inventory)
                                                            <option value="{{$inventory->inventory_id}}" @if($inventory->inventory_id == $purchase_item->inventory->inventory_id) selected @endif>{{$inventory->item_description}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <p class="item_quantity">{{ $purchase_item->inventory->qty }}</p>
                                                </td>
                                                <td>
                                                    <select data-placeholder="Select unit of measurement" name="unit_of_measurement[]" class="form-control js-example-basic-single" style="width: 100%; position: relative;" required>
                                                        <option value=""></option>
                                                        <option value="KG">KG</option>
                                                        <option value="G">Grams</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>    
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="attachments" class="form-label">Attachments:</label>
                            <input type="file" name="attachments[]" class="form-control" multiple >
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="padding:5px 10px;">Attachments</th>
                                            <th style="padding:5px 10px;">Document Type</th>
                                            <th style="padding:5px 10px;">Remove</th>
                                            <th style="padding:5px 10px;">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($purchase_request->purchaseRequestFiles->isNotEmpty())
                                            @foreach ($purchase_request->purchaseRequestFiles as $file)
                                                <tr>
                                                    <td style="padding: 5px 10px;">
                                                        <a href="{{url($file->file)}}" target="_blank">
                                                            <i class="ti-files"></i>
                                                        </a>
                                                    </td>
                                                    <td style="padding: 5px 10px;">{{$file->document_type}}</td>
                                                    <td style="padding: 5px 10px;">
                                                        <form method="POST" action="{{url('procurement/delete-files/'.$file->id)}}" class="d-inline-block" id="deleteForm{{$file->id}}">
                                                            @csrf 
            
                                                            <button type="button" class="btn btn-sm btn-danger" title="Remove File" onclick="removeFiles({{$file->id}})">
                                                                <i class="ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td style="padding: 5px 10px;">
                                                        <button type="button" class="btn btn-sm btn-warning" title="Edit File" data-toggle="modal" data-target="#editFile{{$file->id}}">
                                                            <i class="ti-pencil-alt"></i>
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

                        <div class="col-lg-12 mt-3">
                            <div class="card border border-1 border-primary rounded-0">
                                <div class="card-header bg-primary rounded-0">
                                    <p class="m-0 text-white font-weight-bold">Approver</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 border border-1 border-top-bottom border-left-right font-weight-bold">Name</div>
                                        <div class="col-lg-3 border border-1 border-top-bottom border-left-right font-weight-bold">Status</div>
                                        <div class="col-lg-3 border border-1 border-top-bottom border-left-right font-weight-bold">Date</div>
                                        <div class="col-lg-3 border border-1 border-top-bottom border-left-right font-weight-bold">Remarks</div>
                                    </div>
                                    @foreach ($purchase_request->purchaseRequestApprovers as $pr_approver)
                                        <div class="row">
                                            <div class="col-lg-3 border border-1 border-top-bottom border-left-right">{{ $pr_approver->user->name }}</div>
                                            <div class="col-lg-3 border border-1 border-top-bottom border-left-right">{{ $pr_approver->status }}</div>
                                            <div class="col-lg-3 border border-1 border-top-bottom border-left-right">
                                                @if($pr_approver->status == 'Approved')
                                                    {{ date('Y-m-d', strtotime($pr_approver->updated_at)) }}
                                                @endif
                                            </div>
                                            <div class="col-lg-3 border border-1 border-top-bottom border-left-right">{!! nl2br(e($pr_approver->remarks)) !!}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success float-right mt-5">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
function removeFiles(id)
{
    // console.log('dasdad');
    var form = $("#deleteForm"+id)[0];

    Swal.fire({
        title: "Are you sure?",
        text: "The file will be deleted",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit()
        }
    });
    
}

function itemDescription(element)
{
    var itemCode = $(element).closest('tr').find('.item_code')
    var itemCategory = $(element).closest('tr').find('.item_category')
    var itemQuantity = $(element).closest('tr').find('.item_quantity')
    
    $.ajax({
        type: "POST",
        url: "{{route('refreshInventory')}}",
        data: {
            id: element.value
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            itemCode.text(data.item_code)
            itemCategory.text(data.category.name)
            itemQuantity.text(data.qty)
        }
    })
}

$(document).ready(function() {
    $("#addRowBtn").on('click', function() {
        var newRow = `
            <tr>
                <td>
                    <p class="item_code"></p>
                </td>
                <td>
                    <p class="item_category"></p>
                </td>
                <td>
                    <select data-placeholder="Select item description" name="inventory_id[]" class="form-control js-example-basic-single" style="width: 100%; position: relative;" onchange="itemDescription(this)">
                        <option value=""></option>
                        @foreach ($inventory_list as $inventory)
                            <option value="{{$inventory->inventory_id}}">{{$inventory->item_description}}</option>
                        @endforeach
                    </select>
                </td>
                <td >
                    <p class="item_quantity"></p>
                </td>
                <td>
                    <select data-placeholder="Select unit of measurement" name="unit_of_measurement[]" class="form-select js-example-basic-single" style="width: 100%; position: relative;" required>
                        <option value=""></option>
                        <option value="KG">KG</option>
                        <option value="G">Grams</option>
                    </select>
                </td>
            </tr>
        `;

        $('#tbodyAddRow').append(newRow)
        $('.js-example-basic-single').select2()
        // $('#tbodyAddRow .chosen-select').chosen();
    })

    $(document).on('change', '.item-description', function() {
        const selectedValue = $(this).val();
        
        itemDescription(selectedValue);
    });

    $("#deleteRowBtn").on('click', function() {
        
        var row = $('#tbodyAddRow').children();
        
        if (row.length > 1) {
            row.last().remove()
        }
        // $("#tbodyAddRow").children().last().remove()
        
    })

    // $("[name='inventory_id[]']").on('change', function() {
    //     var itemCode = $(this).closest('tr').find('.item_code')
    //     var itemCategory = $(this).closest('tr').find('.item_category')
    //     var itemQuantity = $(this).closest('tr').find('.item_quantity')
        
    //     // var hiddenItemCode = $('[name="item_code[]"]')
    //     // var hiddenItemCategory = $('[name="item_category[]"]')
    //     // var hiddenItemQuantity = $('[name="item_quantity[]"]')
    //     // var hiddenItemDescription = $('[name="item_description[]"]')
        
    //     $.ajax({
    //         type: "POST",
    //         url: "{{route('refreshInventory')}}",
    //         data: {
    //             id: value
    //         },
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(data) {
    //             console.log(data);
                
    //             itemCode.text(data.item_code)
    //             itemCategory.text(data.item_category)
    //             itemQuantity.text(data.qty)

    //             // hiddenItemCode.val(data.item_code)
    //             // hiddenItemCategory.val(data.item_category)
    //             // hiddenItemQuantity.val(data.qty)
    //             // hiddenItemDescription.val(data.item_description)
    //         }
    //     })
    // })
})

</script>
@endsection