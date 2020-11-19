@extends('layouts.admin')

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#users-table').DataTable( {
                dom: '<Bf<t>ip>',
                responsive: true,
                order: [[ 1, "asc" ]],
                pageLength: 20,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis', 
                ]
            });
        });

        function verificarCorreo(){
            $correo = document.getElementById("email").value; 

            var route = "https://transformatepro.com/ajax/verificar-correo/"+$correo;
            //var route = "http://localhost:8000/ajax/verificar-correo/"+$correo;
                        
            $.ajax({
                url:route,
                type:'GET',
                success:function(ans){
                    console.log(ans);
                    if (ans == 1){
                        document.getElementById("div_error").innerHTML = 'El correo ingresado ya se encuentra registrado.';
                        document.getElementById("div_error").style.display = 'block';
                        document.getElementById("btn-crear").disabled = true;
                    }else{
                        document.getElementById("div_error").style.display = 'none';
                        document.getElementById("btn-crear").disabled = false;
                    }
                }
            });
        }

        function verificarClaves(){
            if (document.getElementById("password").value == document.getElementById("password2").value){
                document.getElementById("div_error").style.display = 'none';
                document.getElementById("btn-crear").disabled = false;
            }else{
                document.getElementById("div_error").innerHTML = 'Las contraseñas ingresadas no coinciden.';
                document.getElementById("div_error").style.display = 'block';
                document.getElementById("btn-crear").disabled = true;
            }
        }
    </script>
@endpush

@section('content')
    <div class="admin-content-inner"> 
        <div class="uk-flex-inline uk-flex-middle uk-margin-small-bottom"> 
            <i class="fas fa-users icon-large uk-margin-right"></i> 
            <h4 class="uk-margin-remove"> Administradores </h4> 
            @if (Auth::user()->profile->users == 2)
                <button class="uk-button uk-button-success uk-margin-medium-left admin-btn" href="#create-modal" uk-tooltip="title: Crear Alumno; delay: 500 ; pos: top ;animation: uk-animation-scale-up" uk-toggle> 
                    <i class="fas fa-user-plus"></i> Nuevo Administrador
                </button> 
            @endif                        
        </div>  

        @if (Session::has('msj-exitoso'))
            <div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <strong>{{ Session::get('msj-exitoso') }}</strong>
            </div>
        @endif               
        
        <div class="uk-background-default uk-margin-top uk-padding"> 
            <div class="uk-overflow-auto uk-margin-small-top"> 
                <table id="users-table"> 
                    <thead> 
                        <tr class="uk-text-small uk-text-bold"> 
                            <th class="uk-text-center">Avatar</th> 
                            <th class="uk-text-center">Nombres</th> 
                            <th class="uk-text-center">Correo</th> 
                            <th class="uk-text-center">Ubicación</th> 
                            <th class="uk-text-center">Miembro desde</th> 
                            <th class="uk-text-center">Acción</th> 
                        </tr>                             
                    </thead>                         
                    <tbody> 
                        @foreach ($administradores as $administrador)
                            <tr>                                 
                                <td class="uk-text-center">
                                    <img class="uk-preserve-width uk-border-circle user-profile-small" src="{{ asset('uploads/images/users/'.$administrador->avatar) }}" width="50" alt="">
                                </td>                                 
                                <td class="uk-text-center">{{ $administrador->names }} {{ $administrador->last_names }}</td> 
                                <td class="uk-text-center">{{ $administrador->email }}</td> 
                                <td class="uk-text-center">{{ $administrador->country }} ({{ $administrador->city }})</td> 
                                <td class="uk-text-center">{{ date('d-m-Y H:i A', strtotime("$administrador->created_at -5 Hours")) }}</td> 
                                <td class="uk-flex-inline uk-text-center"> 
                                    <a href="{{ route('admins.users.show', $administrador->id) }}" class="uk-icon-button uk-button-success btn-icon" uk-icon="icon: search;" uk-tooltip="Ver - Editar"></a> 
                                    @if (Auth::user()->profile->users == 2)
                                        <form action="{{ route('admins.users.change-status') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $administrador->id }}">
                                            @if ($administrador->status == 1)
                                                <input type="hidden" name="action" value="0">
                                                <button class="uk-icon-button uk-button-danger btn-icon" uk-icon="icon: trash;" uk-tooltip="Eliminar"></button>
                                            @else
                                                <input type="hidden" name="action" value="1">
                                                <button class="uk-icon-button uk-button-primary btn-icon" uk-icon="icon: refresh;" uk-tooltip="Restaurar"></button>
                                            @endif
                                        </form>      
                                    @endif                       
                                </td>                                 
                            </tr>   
                        @endforeach  
                    </tbody>                         
                </table>                     
            </div>                         
        </div>                 
    </div>

    <!-- Modal para Crear Alumno -->                     
    <div id="create-modal" uk-modal> 
        <div class="uk-modal-dialog"> 
            <button class="uk-modal-close-default uk-padding-small" type="button" uk-close></button>                   
            <div class="uk-modal-header"> 
                <h4> Crear Nuevo Administrador   </h4> 
            </div>                    
            <form action="{{ route('admins.users.store') }}" method="POST">  
                @csrf
                <input type="hidden" name="role_id" value="3">

                <div class="uk-modal-body">
                    <div class="uk-alert-danger" uk-alert id="div_error" style="display: none;"></div> 
                    <div class="uk-grid">
                        <div class="uk-width-1-2">
                            Nombres (*):
                            <input class="uk-input" type="text" name="names" placeholder="Nombres" required>
                        </div>
                        <div class="uk-width-1-2">
                            Apellidos (*):
                            <input class="uk-input" type="text" name="last_names" placeholder="Apellidos" required>
                        </div>
                        <div class="uk-width-1-2">
                            Correo Electrónico (*):
                            <input class="uk-input" type="email" name="email" id="email" placeholder="Correo Electrónico" onkeyup="verificarCorreo();" required>
                        </div>
                        <div class="uk-width-1-2">
                            Teléfono:
                            <input class="uk-input" type="text" name="phone" placeholder="Teléfono">
                        </div>
                        <div class="uk-width-1-2">
                            Contraseña (*):
                            <input class="uk-input" type="password" name="password" id="password" placeholder="Ingrese la contraseña..." onkeyup="verificarClaves();" required>
                        </div>
                        <div class="uk-width-1-2">
                            Confirmar Contraseña (*):
                            <input class="uk-input" type="password" id="password2" placeholder="Confirme la contraseña..." onkeyup="verificarClaves();" required>
                        </div>
                        <div class="uk-width-1-1">
                            Perfil Administrativo (*):
                            <select class="uk-select" name="profile_id" required>
                                <option value="" selected disabled>Seleccione una opción...</option>
                                @foreach ($perfiles as $perfil)
                                    <option value="{{ $perfil->id }}">{{ $perfil->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                              
                </div>                             
                <div class="uk-modal-footer uk-text-right"> 
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>                                 
                    <button class="uk-button uk-button-primary" type="submit" id="btn-crear">Crear Administrador</button>
                </div>     
            </form>                        
        </div>                         
    </div>
@endsection