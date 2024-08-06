<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-4">
                    Accedi
                </h1>
            </div>
        </div>
        <div class="row justify-content-center align-items-center height-custom">
            <div class="col-12 col-md-6">
                <form  action="{{route('login')}}"  method="POST" class="bg-body-tertiary shadow rounded p-5">
                    @csrf
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Indirizzo email</label>
                        <input type="email" class="form-control" id="loginEmail" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                   
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Accedi</button>
                    </div>

                </form>  
            </div>
        </div>
    </div>
</x-layout>