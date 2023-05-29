<h5 class="titulo">Registro de Buenas Prácticas e Ideas Innovadoras</h5>
<form id="registro" method="POST" @if (isset($registro))
action="{{ route('registro.update', [ 'registro' => $registro->id]) }}"
@else
action="{{ route('registro.crear') }}"
@endif>
  @csrf
  <div class="row">
    <div class="col-sm-12">
      <div class="mt-4 flex items-center">
        <span class="font-medium text-sm text-gray-700">Buena Práctica</span>
        <x-switch-input id="tipo" class="ml-4 mr-4" name="tipo" :value="isset($registro)?$registro->tipo:false"></x-switch-input>
        <span class="font-medium text-sm text-gray-700">Idea Innovadora</span>
      </div>
    </div>
  </div>
  <div class="row">
    
    <!-- Pais -->
    <div class="col-sm-6">
      <div class="mt-4">
        <x-input-label for="pais" :value="__('Country')"/>
        <x-select id="pais" class="block w-full" name="pais" required>
            <option value="" selected disabled hidden>{{ __('Select country') }}</option>
            @foreach ( $paises as $pais )
                <option value="{{ $pais->code }}" @selected(isset($registro) && $registro->pais==$pais->code)>
                    {{$pais->name}}
                </option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('pais')" class="mt-2" />
      </div>
    </div>

    <!-- Ciudad -->
    <div class="col-sm-6">
      <div class="mt-4">
        <x-input-label for="ciudad" :value="__('City')" />
        @if ( isset($registro) ) 
          <x-select id="ciudad" class="block w-full" name="ciudad" required data-id="{{$registro->ciudad}}">
            <option value="" selected disabled hidden>{{ __('Seleccione ciudad') }}</option>
          </x-select>
        @else 
          <x-select id="ciudad" class="block w-full" name="ciudad" required>
            <option value="" selected disabled hidden>{{ __('Seleccione ciudad') }}</option>
          </x-select>
        @endif
        {{-- <x-text-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad" :value="old('ciudad', isset($registro)?$registro->ciudad: null)" required autofocus /> --}}
        <x-input-error :messages="$errors->get('ciudad')" class="mt-2" />
      </div>
    </div>

    <div class="col-sm-6">
      <!-- Titulo -->
      <div class="mt-4">
        <x-input-label for="titulo" :value="__('Title')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo', isset($registro)?$registro->titulo: null)" required autofocus placeholder="Título de la Buena Práctica"/>
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
      </div>

      <!-- Descripcion -->
      <div class="wrap-forms">
        <div class="mt-4 form-group">
            <x-input-label for="descripcion" :value="__('Description')" />
            <x-text-area id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" required autofocus placeholder="Descripción de la Buena Práctica">
              {{ old('descripcion', isset($registro)?$registro->descripcion: null )}}
            </x-text-area>
            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
        </div>
      </div>
    </div>


    <div class="col-sm-6">
      <!-- Poblacion -->
      <div class="mt-4">
        <x-input-label for="poblacion" :value="__('Benefited population')" />
        <x-text-input id="poblacion" class="block mt-1 w-full" type="text" name="poblacion" :value="old('poblacion', isset($registro)?$registro->poblacion: null)" required autofocus placeholder="Población Beneficiada"/>
        <x-input-error :messages="$errors->get('poblacion')" class="mt-2" />
      </div>

      <!-- Sector -->
      <div class="mt-4">
        <x-input-label for="sector" :value="__('Sector')"/>
        <x-select id="sector" class="block w-full" name="sector" required>
            <option value="" selected disabled hidden>{{ __('Selecciona ...') }}</option>
            @foreach ( $sectores as $sector )
                <option value="{{ $sector->id }}" @selected(isset($registro) && $registro->sector==$sector->id)>
                    {{$sector->name}}
                </option>
            @endforeach
          </x-select>
          <x-input-error :messages="$errors->get('pais')" class="mt-2" />
          </div>

      <!-- Entidad -->
      <div class="mt-4">
        <x-input-label for="entidad" :value="__('Entidad, Agrupación ciudadana o Persona')" />
        <x-text-input id="entidad" class="block mt-1 w-full" type="text" name="entidad" :value="old('entidad', isset($registro)?$registro->entidad: null)" autofocus placeholder="Entidad que la realiza"/>
        <x-input-error :messages="$errors->get('entidad')" class="mt-2" />
      </div>

      <!-- Presupuesto -->
      <div class="mt-4">
        <x-input-label for="presupuesto" :value="__('Presupuesto')" />
        <x-text-input id="presupuesto" class="block mt-1 w-full" type="text" name="presupuesto" :value="old('presupuesto', isset($registro)?$registro->presupuesto: null)" autofocus placeholder="Cantidad de presupuesto"/>
        <x-input-error :messages="$errors->get('presupuesto')" class="mt-2" />
      </div>

      <!-- Latitud -->
      <div class="mt-4 col-sm-6 p-0 pr-5">
        <x-input-label for="latitud" :value="__('Latitud del Proyecto')" />
        <x-text-input id="latitud" class="block mt-1 w-full" type="text" name="latitud" :value="old('latitud', isset($registro)?$registro->latitud: null)" autofocus placeholder="Coordenadas de latitud"/>
        <x-input-error :messages="$errors->get('latitud')" class="mt-2" />
      </div>

      <!-- Longitud -->
      <div class="mt-4 col-sm-6 p-0">
        <x-input-label for="longitud" :value="__('Longitud del Proyecto')" />
        <x-text-input id="longitud" class="block mt-1 w-full" type="text" name="longitud" :value="old('longitud', isset($registro)?$registro->longitud: null)" autofocus placeholder="Coordenadas de longitud"/>
        <x-input-error :messages="$errors->get('longitud')" class="mt-2" />
      </div>
    </div>  
  </div>
</form>

{{-- <form>
    <label for="myInput">Enter a word:</label><br>
    <input type="text" id="myInput" list="myOptions">
    <datalist id="myOptions">
      <option value="apple">
      <option value="banana">
      <option value="orange">
    </datalist>
  </form>
  
  <script>
    var input = document.getElementById("myInput");
    var options = document.getElementById("myOptions").options;
  
    input.addEventListener("input", function() {
      for (var i = 0; i < options.length; i++) {
        if (options[i].value.startsWith(this.value)) {
          options[i].style.display = "block";
        } else {
          options[i].style.display = "none";
        }
      }
    });
  </script> --}}
  