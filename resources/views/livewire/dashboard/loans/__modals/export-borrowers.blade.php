<div class="modal fade" id="export_borrowers_panel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
      <div class="modal-content">
        <div class="modal-body py-2">
          <h5 class="text-secondary fw-bold font-bold">Export | Customer Loans</h5>
  
          <form action="{{ route('export-users') }}" method="POST" class="gap-4">
            @csrf
  
            <div class="flex gap-4">
              <div>
                <label for="from_date">From</label>
                <input type="date" id="from_date" name="from_date" class="form-control">
              </div>
              <div>
                <label for="to_date">To</label>
                <input type="date" id="to_date" name="to_date" class="form-control">
              </div>
            </div>
  
            <button type="submit" class="btn btn-primary my-4">Export Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
