<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            <h3 class="text-center">
                {{session('success')}}
            </h3>
        </div>
    @endif
    <form class="bg-body-tertiary shadow rounded p-5 my-5" wire:submit.prevent="store">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titolo:</label>
            <input type="text" class="form-control" @error('title') is-invalid @enderror id="title" wire:model.blur="title">
            @error('title')
            <p class="text-danger">{{$message}}</p>
            @enderror   
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione:</label>
            <textarea id="description" cols="30" rows="10" class="form-control" @error('description') is-invalid @enderror wire:model.blur="description" ></textarea>  
            @error('description')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo:</label>
            <input type="text" class="form-control" id="price" @error('price') is-invalid @enderror wire:model.blur="price">   
            @error('price')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        
        <div class="mb-3">
            <select  id="category" @error('category') is-invalid @enderror  wire:model.blur="category" class="form-control">
                <option label disabled>Seleziona una categoria</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Crea</button>
        </div> 
    </form>
</div>
