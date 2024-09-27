<div class="modal fade" id="editPayroll{{$payrollInfo->id}}" tabindex="-1" role="dialog" aria-labelledby="editPayroll" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Edit Payroll</h5>
        </div>
        <form  method='POST' action='edit-payroll/{{$payrollInfo->id}}' onsubmit='show()' >
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class='col-md-12 form-group'>
                 Employee Name  : {{$payrollInfo->employee_name}}
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
               Daily Rate
              <input type="number" name='daily_rate' class="form-control form-control-sm" value='{{$payrollInfo->daily_rate}}' step='any' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
               Hourly Rate
              <input type="number" name='hour_rate' class="form-control form-control-sm" value='{{$payrollInfo->hour_rate}}' step='any' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
               Days Work (day)
              <input type="number" name='days_work' class="form-control form-control-sm" value='{{$payrollInfo->days_work}}' step='any' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
               Hours Work (hr)
              <input type="number" name='hours_work' class="form-control form-control-sm" value='{{$payrollInfo->hours_work}}' step='any' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
               Minutes Tardy (min)
              <input type="number" name='hours_tardy' class="form-control form-control-sm" value='{{$payrollInfo->hours_tardy}}' step='any' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
               Overtime (hr)
              <input type="number" name='overtime' class="form-control form-control-sm" value='{{$payrollInfo->overtime}}' step='any' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
               Special Holidays (day)
              <input type="number" name='special_holiday' class="form-control form-control-sm" step='any' value='{{$payrollInfo->special_holiday}}' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
               Legal Holidays (day)
              <input type="number" name='legal_holiday' class="form-control form-control-sm" value='{{$payrollInfo->legal_holiday}}' step='any' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
               Night Diff (hr)
              <input type="number" name='night_diff' class="form-control form-control-sm" value='{{$payrollInfo->night_diff}}' step='any' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
              Rest Day Hours (hr)
              <input type="number" name='rest_day_hours' class="form-control form-control-sm"
                value='{{ $payrollInfo->rest_day_hours ?? 0 }}' step='any' required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
              Other Income Non-Taxable
              <input type="number" name='other_income_non_taxable' class="form-control form-control-sm" value='{{$payrollInfo->other_income_non_taxable}}' step="any" required>
            </div>
          </div>
          <div class="row">
            <div class='col-md-12 form-group'>
              Other Deduction
              <input type="number" name='other_deduction' class="form-control form-control-sm" value='{{$payrollInfo->other_deductions}}' step="any" required>
            </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>