@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 100px;">

  <div class="container" >
    <div class="row" >
      <div class="col-sm-10">
        <h3>Meus Editais</h3> 
      </div>
    </div>
  </div>
  <hr>
  @if(session('mensagem'))
    <div class="row">
      <div class="col-md-12" style="margin-top: 30px;">
        <div class="alert alert-success">
            <p>{{session('mensagem')}}</p>
        </div>
      </div>
    </div>
  @endif
  <table class="table table-bordered">
    <thead>
      <tr>   
        <th scope="col">Nome do Edital</th>
        <th scope="col">Data de Criação</th>
        <th scope="col">Opção</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($eventos as $evento)
        <tr>
          <td>
            <a href="{{  route('evento.visualizar',['id'=>$evento->id])  }}" class="visualizarEvento">
                {{ $evento->nome }}
            </a>
          </td>
          <td>{{ date('d/m/Y \à\s H:i\h', strtotime($evento->created_at)) }}</td>
          <td>
            <div class="btn-group dropright dropdown-options">
                <a id="options" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img src="{{asset('img/icons/ellipsis-v-solid.svg')}}" style="width:8px"> 
                </a>
                <div class="dropdown-menu">
                  <a href="{{ route('evento.editar', ['id' => $evento->id]) }}" class="dropdown-item text-center">
                    Editar Edital
                  </a>
                  <hr class="dropdown-hr">
                  <a href="{{route('admin.analisar', ['evento_id' => $evento->id])}}" class="dropdown-item text-center">
                    Visualizar Projetos
                  </a>
                  <hr class="dropdown-hr">
                  <a href="{{route('admin.atribuir', ['evento_id' => $evento->id])}}" class="dropdown-item text-center">
                      Atribuir Avaliadores
                  </a>
                  <hr class="dropdown-hr">
                  <a href="{{route('admin.pareceres', ['evento_id' => $evento->id])}}" class="dropdown-item text-center">
                      Visualizar Pareceres
                  </a>
                  @php $hoje = date('Y-m-d'); @endphp
                  @if(($evento->inicio_recurso <= $hoje) && ($evento->resultado_final > $hoje))
                    <hr class="dropdown-hr">
                    <a href="{{route('admin.indexAvaliacao', ['evento_id' => $evento->id])}}" class="dropdown-item" style="text-align: center">
                        Recursos
                    </a>
                  @endif
                  @if($evento->tipoAvaliacao != "link")
                  <hr class="dropdown-hr">
                  <a href="{{route('admin.showResultados', ['evento_id' => $evento->id])}}" class="dropdown-item text-center">
                      Resultados
                  </a>
                  @endif
                  <hr class="dropdown-hr">
                    <!-- Button trigger modal -->
                    <button type="button" class="dropdown-item dropdown-item-delete text-center" data-toggle="modal" data-target="#exampleModal{{ $evento->id }}">
                      <img src="{{asset('img/icons/logo_lixeira.png')}}" alt=""> Deletar
                    </button>


              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection

@section('javascript')
<script>
  
</script>
@endsection
