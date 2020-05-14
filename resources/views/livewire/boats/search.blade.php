<div class="container">
    <form action="">
        <div class="form-group">
            <label for="Types">Types of boats</label>
            <select wire:model="type" class="form-control">
                <option value="">Any type</option>
                @foreach($allTypes as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Price</label>
            <select wire:model="prices" class="form-control" multiple>
                @foreach($allPrices as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
        </div>
    </form>
    <div>
        @foreach($boats->chunk(3) as $chunk)
            <div class="row mb-2">
                @foreach($chunk as $boat)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ $boat->image }}" class="card-img-top" alt="{{ $boat->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $boat->name }}</h5>
                                <p class="card-text">{{ $boat->type }} - {{ $boat->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

    </div>
</div>
