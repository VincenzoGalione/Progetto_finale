<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-4">
                    Registrati
                </h1>
            </div>
        </div>
        <div class="row justify-content-center align-items-center height-custom">
            <div class="col-12 col-md-6">
                <form  action="{{route('register')}}"  method="POST" class="bg-body-tertiary shadow rounded p-5">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" class="form-control" id="name" >
                    </div>

                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Indirizzo email</label>
                        <input type="email" class="form-control" id="registerEmail" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confema la password:</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                    </div>

                   <div class="d-flex justify-content-center">
                       <button type="submit" class="btn btn-primary">Registrati</button>
                   </div>
                </form>  
            </div>
        </div>
    </div>
</x-layout>