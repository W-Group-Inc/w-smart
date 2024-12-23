<div class="modal fade" id="editPurchaseRequest{{$pr->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInventoryModalLabel">Edit purchase request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('procurement/update-purchase-request/'.$pr->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="puchaseNo" class="form-label">Purchase No.:</label>
                            <input type="text" class="form-control" id="puchaseNo" name="purchase_no" value="{{str_pad($pr->id, 6, '0', STR_PAD_LEFT)}}" readonly style="height: 50%;">
                        </div>
                        <div class="col-md-6">
                            {{-- <label for="newItemCode" class="form-label">Item Code</label>
                            <input type="text" class="form-control" id="newItemCode" readonly style="height: 50%;"> --}}
                        </div>
                        <div class="col-md-6">
                            <label for="requestorName" class="form-label" >Requestor Name:</label>
                            <input type="hidden" name="requestor_name" value="{{auth()->user()->id}}">
                            <input type="text" class="form-control" id="requestorName" required style="height: 50%;" value="{{auth()->user()->name}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="requestedDateTime" class="form-label">Requested Date/Time:</label>
                            <input type="datetime-local" class="form-control" style="height: 50%;" id="requestedDateTime" value="{{date('Y-m-d H:i:s')}}" readonly>
                        </div>
    
                        <div class="col-md-6">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" name="remarks" cols="30" rows="10" style="height: 50%;">{{$pr->remarks}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="requestDueDate" class="form-label">Request Due-Date:</label>
                            <input type="date" name="requestDueDate" name="request_due_date" id="requestDueDate" class="form-control form-control-sm" value="{{$pr->due_date}}">
                        </div>
                        <div class="col-md-6">
                            <label for="assignedTo" class="form-label">Assigned To:</label>
                            <!-- <input type="text" id="primaryUOMSearch" placeholder="Search Primary UOM" class="form-control"> -->
                            <select class="form-select" id="assignedTo" name="assigned_to" required>
                                <option value="">Assigned To</option>
                                @foreach ($users as $key=>$user)
                                    <option value="{{$key}}" @if($key == $pr->assigned_to) selected @endif>{{$user}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="col-md-6">
                        </div>
    
                        <div class="col-md-6">
                            <label for="subsidiary" class="form-label">Subsidiary:</label>
                            <input type="text" name="subsidiary" value="{{auth()->user()->subsidiary}}" class="form-control form-control-sm" readonly>
                        </div>
    
                        <div class="col-md-6">
                            <label for="class" class="form-label" >Class:</label>
                            <select class="form-select" id="class"></select>
                        </div>
    
                        <div class="col-md-6">
                            <label for="department" class="form-label">Department</label>
                            <input type="hidden" name="department" value="{{auth()->user()->department_id}}">
                            <input type="text"  value="{{auth()->user()->department->name}}" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Item Category</th>
                                            <th>Item Description</th>
                                            <th>Item Quantity</th>
                                            <th>Unit of Measurement</th>
                                        </tr>
                                    </thead>
                                    @if($pr->purchaseItems->isNotEmpty())
                                    <tbody id="tbodyAddRow{{$pr->id}}">
                                        @foreach ($pr->purchaseItems as $item)
                                            <tr>
                                                <td>
                                                    <input type="text" name="item_code[]" class="form-control form-control-sm" value="{{$item->item_code}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="item_category[]" class="form-control form-control-sm" value="{{$item->item_category}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="item_description[]" class="form-control form-control-sm" value="{{$item->item_description}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="item_quantity[]" class="form-control form-control-sm" value="{{$item->item_quantity}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="unit_of_measurement[]" class="form-control form-control-sm" value="{{$item->unit_of_measurement}}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @else 
                                    <tbody id="tbodyAddRow{{$pr->id}}">
                                        <tr>
                                            <td>
                                                <input type="text" name="item_code[]" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" name="item_category[]" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" name="item_description[]" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" name="item_quantity[]" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" name="unit_of_measurement[]" class="form-control form-control-sm">
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endif
                                </table>
                                <button type="button" class="btn btn-success " onclick="addRow({{$pr->id}})">
                                    Add Row
                                </button>
                                <button type="button" class="btn btn-danger " onclick="deleteRow({{$pr->id}})">
                                    Delete Row
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="attachments" class="form-label">Attachments:</label>
                            <input type="file" name="attachments[]" class="form-control" multiple>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="saveNewInventory">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>