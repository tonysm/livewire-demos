<div class="container">
    <form action="">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Types">Types of boats</label>
                    <select wire:model="type" class="form-control">
                        <option value="">Any type</option>
                        @foreach($allTypes as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="mb-2">Prices</div>
                    <div class="btn-group" role="group" aria-label="Prices">
                        @foreach($allPrices as $priceOption)
                            <button
                                wire:click.prevent="togglePrice('{{ $priceOption }}')"
                                type="button"
                                class="btn {{ in_array($priceOption, $prices) ? 'btn-primary' : 'btn-secondary' }}"
                            >{{ $priceOption }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
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
