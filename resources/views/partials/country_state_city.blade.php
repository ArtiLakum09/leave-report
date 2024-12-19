<div class="mb-3">
    <label for="country" class="form-label">Country:</label>
    <select name="country" id="country" class="form-control">
        <option value="">Select Country</option>
        @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="state" class="form-label">State:</label>
    <select name="state" id="state" class="form-control">
        <option value="">Select State</option>
    </select>
</div>

<div class="mb-3">
    <label for="city" class="form-label">City:</label>
    <select name="city" id="city" class="form-control">
        <option value="">Select City</option>
    </select>
</div>

<script>
    $('#country').on('change', function() {
        const countryId = $(this).val();
        if (countryId) {
            $.ajax({
                url: '/get-states/' + countryId,
                method: 'GET',
                success: function(data) {
                    $('#state').html(data);
                    $('#city').html('<option value="">Select City</option>');
                }
            });
        }
    });

    $('#state').on('change', function() {
        const stateId = $(this).val();
        if (stateId) {
            $.ajax({
                url: '/get-cities/' + stateId,
                method: 'GET',
                success: function(data) {
                    $('#city').html(data);
                }
            });
        }
    });
</script>
