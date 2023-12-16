<div class="row mb-60 d-flex justify-content-lg-between">
    <div class="col-lg-4 col-md-6 col-sm-10">
        <h2>Payouts</h2>
    </div>
    <div class="col-lg-8 col-md-6 col-sm-12">
        <form>
            <div class="row d-flex">
                <div class="col-md-4 col-lg-5">
                    <select name="status">
                        <option value=""> Show: All Payouts (Status)</option>
                        @foreach($statuses as $status)
                        <option value="{{ $status->value }}" @selected(isset(request()->status) && request()->status == $status->value)>Show: {{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-5">
                    <select name="gateway">
                        <option value=""> Show: All Payouts (Gateway)</option>
                        @foreach($gateways as $gateway)
                        <option value="{{ $gateway->value }}" @selected(isset(request()->gateway) && request()->gateway == $gateway->value)>Show: {{ $gateway->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-2">
                    <button type="submit" class="filter-btn btn--primary btn--md">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>