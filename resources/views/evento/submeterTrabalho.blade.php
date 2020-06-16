@extends('layouts.app')

@section('content')
<div class="container content">

  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="card" style="margin-top:50px">
        <div class="card-body">
          <h5 class="card-title">Enviar Projeto</h5>
          <p class="card-text">
            <form method="POST" action="{{route('trabalho.store')}}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="editalId" value="{{$edital->id}}">

              {{-- Nome do Projeto  --}}
              <div class="row justify-content-center">
                <div class="col-sm-12">
                  <label for="nomeProjeto" class="col-form-label">{{ __('Nome do Projeto*:') }}</label>
                  <input id="nomeProjeto" type="text" class="form-control @error('nomeProjeto') is-invalid @enderror" name="nomeProjeto" value="{{ old('nomeProjeto') }}" required autocomplete="nomeProjeto" autofocus>

                  @error('nomeProjeto')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              {{-- Grande Area --}}
              <div class="row justify-content-center">
                <div class="col-sm-4">
                  <label for="grandeArea" class="col-form-label">{{ __('Grande Área*:') }}</label>
                  <select class="form-control @error('grandeArea') is-invalid @enderror" id="grandeArea" name="grandeArea" onchange="areas()">
                    <option value="" disabled selected hidden>-- Grande Área --</option>
                    @foreach($grandeAreas as $grandeArea)
                      <option @if(old('grandeArea')==$grandeArea->id ) selected @endif value="{{$grandeArea->id}}">{{$grandeArea->nome}}</option>
                    @endforeach
                  </select>

                  @error('grandeArea')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-sm-4">
                  <label for="area" class="col-form-label">{{ __('Área*:') }}</label>
                  <select class="form-control @error('area') is-invalid @enderror" id="area" name="area" onchange="subareas()">
                    <option value="" disabled selected hidden>-- Área --</option>
                    {{-- @foreach($areas as $area)
                      <option @if(old('area')==$area->id ) selected @endif value="{{$area->id}}">{{$area->nome}}</option>
                    @endforeach --}}
                  </select>

                  @error('area')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-sm-4">
                  <label for="subArea" class="col-form-label">{{ __('Sub Área*:') }}</label>
                  <select class="form-control @error('subArea') is-invalid @enderror" id="subArea" name="subArea">
                    <option value="" disabled selected hidden>-- Sub Área --</option>
                    {{-- @foreach($subAreas as $subArea)
                      <option @if(old('subArea')==$subArea->id ) selected @endif value="{{$subArea->id}}">{{$subArea->nome}}</option>
                    @endforeach --}}
                  </select>

                  @error('subArea')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>









              <hr>
              <h3>Coordenador</h3>

              {{-- Coordenador  --}}
              <div class="row justify-content-center">

                <div class="col-sm-6">
                  <label for="nomeCoordenador" class="col-form-label">{{ __('Coordenador:') }}</label>
                  <input class="form-control" type="text" id="nomeCoordenador" name="nomeCoordenador" disabled="disabled" value="{{ Auth()->user()->name }}">
                </div>
                <div class="col-sm-6">
                  <label for="linkLattesEstudante" class="col-form-label">Link Lattes do Proponente*</label>
                  <input class="form-control @error('linkLattesEstudante') is-invalid @enderror" type="text" name="linkLattesEstudante"
                  @if(Auth()->user()->proponentes != null && Auth()->user()->proponentes->linkLattes != null)
                    value="{{ Auth()->user()->proponentes->linkLattes }}"
                  @else
                    value=""
                  @endif >

                  @error('linkLattesEstudante')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label for="pontuacaoPlanilha" class="col-form-label">{{ __('Pontuação da Planilha de Pontuação*:') }}</label>
                  <input class="form-control @error('pontuacaoPlanilha') is-invalid @enderror" type="text" name="pontuacaoPlanilha" value="{{old('pontuacaoPlanilha')}}">

                  @error('pontuacaoPlanilha')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label for="linkGrupo" class="col-form-label">{{ __('Link do grupo de pesquisa*:') }}</label>
                  <input class="form-control @error('linkGrupo') is-invalid @enderror" type="text" name="linkGrupo" value="{{old('linkGrupo')}}">

                  @error('linkGrupo')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

              </div>

              <hr>
              <h3>Anexos</h3>

              {{-- Anexo do Projeto --}}
              <div class="row justify-content-center">
                {{-- Arquivo  --}}
                <div class="col-sm-6">
                  <label for="anexoProjeto" class="col-form-label">{{ __('Anexo Projeto*:') }}</label>
                  
                  <div class="input-group">

                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('anexoProjeto') is-invalid @enderror" id="anexoProjeto" aria-describedby="inputGroupFileAddon01" name="anexoProjeto">
                      <label class="custom-file-label" id="custom-file-label" for="anexoProjeto">O arquivo deve ser no formato PDF de até 2mb.</label>
                    </div>
                  </div>
                  @error('anexoProjeto')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-sm-6">
                  <label for="anexoLatterCoordenador" class="col-form-label">{{ __('Anexo do Lattes do Coordenador*:') }}</label>

                  <div class="input-group">

                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('anexoLatterCoordenador') is-invalid @enderror" id="inputGroupFile01" aria-describedby="anexoLatterCoordenador" name="anexoLatterCoordenador">
                      <label class="custom-file-label" id="custom-file-label" for="inputGroupFile01">O arquivo deve ser no formato PDF de até 2mb.</label>
                    </div>
                  </div>
                  @error('anexoLatterCoordenador')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>





                <div class="col-sm-6">
                  <label for="botao" class="col-form-label @error('botao') is-invalid @enderror">{{ __('Possui autorização do Comitê de Ética*:') }}</label>
                  <button id="buttonSim" class="btn btn-primary mt-2 mb-2">Sim</button>
                  <button id="buttonNao" class="btn btn-primary mt-2 mb-2">Não</button> 
                  <input type="hidden" id="botao" name="botao" value=""> 

                  @error('botao')
                  <span id="botao" class="invalid-feedback" role="alert" style="overflow: visible; display:inline">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  
                  <div class="input-group">

                    <div class="custom-file">
                      <input disabled type="file" class="custom-file-input @error('anexoComiteEtica') is-invalid @enderror" id="inputEtica" aria-describedby="inputGroupFileAddon01" name="anexoComiteEtica">
                      <label class="custom-file-label" id="custom-file-label" for="inputGroupFile01">O arquivo deve ser no formato PDF de até 2mb.</label>
                    </div>
                  </div>
                  @error('anexoComiteEtica')
                  <span id="comiteErro" class="invalid-feedback" role="alert" style="overflow: visible; display:none">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-sm-6 mt-3">
                  <label for="anexoPlanilha" class="col-form-label">{{ __('Anexo do Planilha de Pontuação*:') }}</label>

                  <div class="input-group">

                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('anexoPlanilha') is-invalid @enderror" id="anexoPlanilha" aria-describedby="anexoPlanilhaDescribe" name="anexoPlanilha">
                      <label class="custom-file-label" id="custom-file-label" for="anexoPlanilha">O arquivo deve ser no formato PDF de até 2mb.</label>
                    </div>
                  </div>
                  @error('anexoPlanilha')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-sm-6">
                  <label for="nomeTrabalho" class="col-form-label">{{ __('Justificativa*:') }}</label>

                  <div class="input-group">


                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('justificativaAutorizacaoEtica') is-invalid @enderror" id="inputJustificativa" aria-describedby="inputGroupFileAddon01" disabled name="justificativaAutorizacaoEtica">
                      <label class="custom-file-label" id="custom-file-label" for="inputGroupFile01">O arquivo deve ser no formato PDF de até 2mb.</label>
                    </div>
                  </div>
                  @error('justificativaAutorizacaoEtica')
                  <span id="justificativaErro" class="invalid-feedback" role="alert" style="overflow: visible; display:none">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                @if($edital->tipo == 'PIBIC' || $edital->tipo == 'PIBIC-EM')
                {{-- Decisão do CONSU --}}
                <div class="col-sm-6">
                  <label for="anexoCONSU" class="col-form-label">{{ __('Decisão do CONSU*:') }}</label>

                  <div class="input-group">

                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('anexoCONSU') is-invalid @enderror" id="anexoCONSU" aria-describedby="inputGroupFileAddon01" name="anexoCONSU">
                      <label class="custom-file-label" id="custom-file-label" for="inputGroupFile01">O arquivo deve ser no formato PDF de até 2mb.</label>
                    </div>
                  </div>
                  @error('anexoCONSU')
                  <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                @endif

              </div>

              <hr>
              <h4>Participantes</h4>

              {{-- Participantes  --}}
              <div class="row" style="margin-top:20px">
                <div class="col-sm-12">
                  <div id="participantes">
                    <div id="novoParticipante">
                      <br>
                      <h5>Dados do participante</h5>
                      @php
                        $i = 0;                        
                      @endphp
                      <div class="row">
                        <div class="col-sm-5">
                          <label>Nome Completo*</label>
                          <input type="text" style="margin-bottom:10px" class="form-control @error('nomeParticipante') is-invalid @enderror" name="nomeParticipante[]" placeholder="Nome" required value="{{old('nomeParticipante.'.$i)}}">
                          @error('nomeParticipante')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div class="col-sm-4">
                          <label>E-mail*</label>
                          <input type="email" style="margin-bottom:10px" class="form-control @error('emailParticipante') is-invalid @enderror" name="emailParticipante[]" placeholder="email" required value="{{old('emailParticipante.'.$i)}}">
                          @error('emailParticipante')
                          <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div class="col-sm-3">
                          <label>Função*:</label>
                          <select class="form-control @error('funcaoParticipante') is-invalid @enderror" name="funcaoParticipante[]" id="funcaoParticipante">
                            <option value="" disabled selected hidden>-- Função --</option>
                            @foreach($funcaoParticipantes as $funcaoParticipante)
                              <option @if(old('funcaoParticipante.'.$i)==$funcaoParticipante->id ) selected @endif value="{{$funcaoParticipante->id}}">{{$funcaoParticipante->nome}}</option>
                            @endforeach

                            @error('funcaoParticipante')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </select>
                        </div>
                      </div>
                      <h6 class="mb-1">Possui plano de trabalho?</h6>
                      <button  class="btn btn-primary mt-2 mb-2 simPlano">Sim</button>
                      <button  class="btn btn-primary mt-2 mb-2 naoPlano">Não</button>
                      <div id="planoHabilitado" >
                      <h5>Dados do plano de trabalho</h5>
                      <div class="row">
                        <div class="col-sm-12">
                          <div id="planoTrabalho">
                            <div class="row">
                              <div class="col-sm-4">
                                <label>Titulo* </label>
                                <input type="text" style="margin-bottom:10px" class="form-control @error('nomePlanoTrabalho') is-invalid @enderror" name="nomePlanoTrabalho[]" placeholder="Nome" value="{{old('nomePlanoTrabalho.'.$i)}}">
                                
                                @error('nomePlanoTrabalho')
                                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                              {{-- Arquivo  --}}
                              <div class="col-sm-7">
                                <label for="nomeTrabalho">Anexo*</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="anexoPlanoTrabalho">Selecione um arquivo:</span>
                                  </div>
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('anexoPlanoTrabalho') is-invalid @enderror" id="anexoPlanoTrabalho" aria-describedby="anexoPlanoTrabalho" name="anexoPlanoTrabalho[]">
                                    <label class="custom-file-label" id="custom-file-label" for="inputGroupFile01">O arquivo deve ser no formato PDF de até 2mb.</label>
                                  </div>
                                </div>
                                @error('anexoPlanoTrabalho')
                                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                              <div class="col-sm-1">
                                <a class="delete">
                                  <img src="{{ asset('/img/icons/user-times-solid.svg') }}" style="width:25px;margin-top:35px">
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div> 
                    </div>
                  </div>
                  <a href="#" class="btn btn-primary" id="addCoautor" style="width:100%;margin-top:10px">Participantes +</a>
                </div>
              </div>

          </p>
          <div class="row justify-content-center">
            <div class="col-md-6">
              <a href="{{route('evento.visualizar',['id'=>$edital->id])}}" class="btn btn-secondary" style="width:100%">Cancelar</a>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary" style="width:100%">
                {{ __('Enviar') }}
              </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('javascript')
<script type="text/javascript">
  $(function() {
    var qtdLinhas = 1;
    var qtdParticipantes = 2;
    // Coautores
    $('#addCoautor').click(function(e) {
      if (qtdParticipantes < 100) {
        e.preventDefault();
        linha = montarLinhaInput();
        $('#participantes').append(linha);
        qtdParticipantes++
      }

    });
    $('#addPlanoTrabalho').click(function(e) {
      e.preventDefault();
      if (qtdLinhas < 4) {
        linha = montarLinhaInputPlanoTrabalho();
        //$('#planoTrabalho').append(linha);
        qtdLinhas++;
      }

    });
    // // Exibir modalidade de acordo com a área
    // $("#area").change(function() {
    //   console.log($(this).val());
    //   addModalidade($(this).val());
    // });
    $(document).on('click', '.delete', function() {
      if (qtdParticipantes > 2) {
        qtdParticipantes--;
        $(this).closest('#novoParticipante').remove();
        return false;
      }
    });
    $(document).on('click', '.deletePlano', function() {
      if (qtdLinhas > 1) {
        qtdLinhas--;
        $("#planoTrabalho div.row:last").remove();
        return false;
      }
    });
    $('.custom-file-input').on('change', function() {
        var fieldVal = $(this).val();

        // Change the node's value by removing the fake path (Chrome)
        fieldVal = fieldVal.replace("C:\\fakepath\\", "");

        if (fieldVal != undefined || fieldVal != "") {
            $(this).next(".custom-file-label").attr('data-content', fieldVal);
            $(this).next(".custom-file-label").text(fieldVal);
        }
    })
    // F
    $('#buttonSim').on('click', function(e) {
      e.preventDefault();
      $('#inputEtica').prop('disabled', false);
      $('#inputJustificativa').prop('disabled', true);
      exibirErro('comite');
    });
    $('#buttonNao').on('click', function(e) {
      e.preventDefault();
      $('#inputEtica').prop('disabled', true);
      $('#inputJustificativa').prop('disabled', false);
      console.log('button nao');
      exibirErro('justificativa');
    });
    // document.getElementsByClassName('.simPlano .naoPlano').addEventListener("click", function(event){
    //   event.preventDefault()
    // });

    $(document).on('click', '.simPlano', function(e) {
        e.preventDefault();
        var plano = $(this).next().next()[0];
        plano.style.display = 'block';       
        console.log('button sim');
    });
    $(document).on('click', '.naoPlano', function(e) {
      e.preventDefault();
        var plano = $(this).next()[0];
        plano.style.display = 'none';
        console.log('button nao');
    });
   
  });

  function exibirErro(campo){
    console.log("o campo " + campo);
    var botao = document.getElementById('botao');
    botao.value = "sim";
    var comiteErro = document.getElementById('comiteErro');
    var justificativaErro = document.getElementById('justificativaErro');

    if(campo === 'comite'){
      comiteErro.style.display = "block";
      justificativaErro.style.display = "none";
    }else if(campo === 'justificativa'){
      comiteErro.style.display = "none";
      justificativaErro.style.display = "block";
    }
  }
  // Remover Coautor

  // function addModalidade(areaId) {
  //   console.log(modalidades)
  //   $("#modalidade").empty();
  //   for (let i = 0; i < modalidades.length; i++) {
  //     if (modalidades[i].areaId == areaId) {
  //       console.log(modalidades[i]);
  //       $("#modalidade").append("<option value=" + modalidades[i].modalidadeId + ">" + modalidades[i].modalidadeNome + "</option>")
  //     }
  //   }
  // }

  function montarLinhaInput() {

    return    "<div id="+"novoParticipante"+">" +
              "<br><h5>Dados do participante</h5>" +
              "<div class="+"row"+">"+
                "<div class="+"col-sm-5"+">"+
                    "<label>Nome Completo*</label>"+
                    "<input"+" type="+'text'+" style="+"margin-bottom:10px"+" class="+'form-control' + " @error('nomeParticipante') is-invalid @enderror" + "name=" +'nomeParticipante[]'+" placeholder="+"Nome"+" required>"+
                    "@error('nomeParticipante')" +
                    "<span class='invalid-feedback'" + "role='alert'" + "style='overflow: visible; display:block'>" +
                      "<strong>{{ $message }}</strong>" +
                    "</span>" +
                    "@enderror" +
                "</div>"+
                "<div class="+"col-sm-4"+">"+
                    "<label>E-mail*</label>"+
                    "<input type='email'" + "style='margin-bottom:10px'" + "class=" + "form-control @error('emailParticipante') is-invalid @enderror" + "name='emailParticipante[]'" + "placeholder='email' required>" +
                    "@error('emailParticipante')" +
                    "<span class='invalid-feedback'" + "role='alert'" + "style='overflow: visible; display:block'>" +
                      "<strong>{{ $message }}</strong>" +
                    "</span>" +
                    "@enderror" +
                "</div>"+
                "<div class='col-sm-3'>"+
                  "<label>Função*:</label>"+
                  "<select class=" + "form-control @error('funcaoParticipante') is-invalid @enderror" + "name='funcaoParticipante[]'" + "id='funcaoParticipante'> " +
                      "<option value='' disabled selected hidden> Função </option>"+
                      "@foreach($funcaoParticipantes as $funcaoParticipante)"+
                        "<option value='{{$funcaoParticipante->id}}'>{{$funcaoParticipante->nome}}</option>"+
                      "@endforeach"+
                      "@error('funcaoParticipante')" +
                      "<span class='invalid-feedback'" + "role='alert'" + "style='overflow: visible; display:block'>" +
                        "<strong>{{ $message }}</strong>" +
                      "</span>" +
                      "@enderror" +
                  "</select>"+
                "</div>"+
            "</div>" +
            "<h6 class='mb-1'>Possui plano de trabalho?</h6>"+
            "<button  class="+"'btn btn-primary mt-2 mb-2 mr-1 simPlano'"+">Sim</button>"+
            "<button  class="+"'btn btn-primary mt-2 mb-2 naoPlano'"+">Não</button>"+
            "<div id="+"planoHabilitado"+">" +
            "<h5>Dados do plano de trabalho</h5>" +
            "<div class="+"row"+">"+
                "<div class="+"col-sm-4"+">"+
                    "<label>Titulo*</label>"+
                    "<input"+" type="+'text'+" style="+"margin-bottom:10px"+" class="+"form-control @error('nomePlanoTrabalho') is-invalid @enderror"+" name="+'nomePlanoTrabalho[]'+" placeholder="+"Nome"+" required>"+
                    "@error('nomePlanoTrabalho')" +
                      "<span class='invalid-feedback'" + "role='alert'" + "style='overflow: visible; display:block'>" +
                        "<strong>{{ $message }}</strong>" +
                      "</span>" +
                    "@enderror" +
                "</div>"+
                "<div class="+"col-sm-7" +">"+
                  "<label for="+"nomeTrabalho"+">Anexo* </label>"+

                  "<div class="+"input-group"+">"+
                    "<div class='input-group-prepend'>"+
                      "<span class='input-group-text' id='inputGroupFileAddon01'>Selecione um arquivo:</span>"+
                    "</div>"+
                    "<div class='custom-file'>"+
                      "<input type='file' class='custom-file-input @error('anexoPlanoTrabalho') is-invalid @enderror" + "id='inputGroupFile01'"+
                        "aria-describedby='inputGroupFileAddon01' name='anexoPlanoTrabalho[]'>"+
                      "<label class='custom-file-label' id='custom-file-label' for='inputGroupFile01'>O arquivo deve ser no formato PDF de até 2mb.</label>"+
                    "</div>"+
                  "</div>"+
                  "@error('anexoPlanoTrabalho')"+
                  "<span class='invalid-feedback' role='alert' style='overflow: visible; display:block'>"+
                    "<strong>{{ $message }}</strong>"+
                  "</span>"+
                  "@enderror"+
                "</div>"+
                "<div class="+"col-sm-1"+">"+
                    "<a  class="+"delete"+">"+
                      "<img src="+"/img/icons/user-times-solid.svg"+" style="+"width:25px;margin-top:35px"+">"+
                    "</a>"+
                "</div>"+
              "</div>"+
              "</div>"+
            "</div>";
  }
  // function montarLinhaInputPlanoTrabalho(){

  //   return  "<div class="+"row"+">"+
  //               "<div class="+"col-sm-4"+">"+
  //                   "<label>Nome Completo</label>"+
  //                   "<input"+" type="+'text'+" style="+"margin-bottom:10px"+" class="+'form-control emailCoautor'+" name="+'nomePlanoTrabalho[]'+" placeholder="+"Nome"+" required>"+
  //               "</div>"+
  //               "<div class="+"col-sm-7" +">"+
  //                 "<label for="+"nomeTrabalho"+">Anexo </label>"+

  //                 "<div class="+"input-group"+">"+
  //                   "<div class='input-group-prepend'>"+
  //                     "<span class='input-group-text' id='inputGroupFileAddon01'>Selecione um arquivo:</span>"+
  //                   "</div>"+
  //                   "<div class='custom-file'>"+
  //                     "<input type='file' class='custom-file-input' id='inputGroupFile01'"+
  //                       "aria-describedby='inputGroupFileAddon01' name='anexoPlanoTrabalho[]'>"+
  //                     "<label class='custom-file-label' id='custom-file-label' for='inputGroupFile01'>O arquivo deve ser no formato PDF de até 2mb.</label>"+
  //                   "</div>"+
  //                 "</div>"+
  //                 "@error('arquivo')"+
  //                 "<span class='invalid-feedback' role='alert' style='overflow: visible; display:block'>"+
  //                   "<strong>{{ $message }}</strong>"+
  //                 "</span>"+
  //                 "@enderror"+
  //                 "</div>"+                 
  //                 "<div class="+"col-sm-1"+">"+
  //                     "<a class="+"deletePlano"+">"+
  //                       "<img src="+"/img/icons/user-times-solid.svg"+" style="+"width:25px;margin-top:35px"+">"+
  //                     "</a>"+
  //                 "</div>"+
  //           "</div>";
  // }

  function areas() {
        var grandeArea = $('#grandeArea').val();
        $.getJSON("http://submeta.test/naturezas/areas/" + grandeArea,
        function (dados){
          if (dados.length > 0){    
            var option = '<option>-- Área --</option>';
            $.each(dados, function(i, obj){
                option += '<option value="'+obj.id+'">'+obj.nome+'</option>';
            }) 
          } else {
            var option = "<option>-- Área --</option>";
          }
          $('#area').html(option).show(); 
        })
  }

  function subareas() {
        var area = $('#area').val();
        $.getJSON("http://submeta.test/naturezas/subarea/" + area,
        function (dados){
          if (dados.length > 0){    
            var option = '<option>-- Sub Área --</option>';
            $.each(dados, function(i, obj){
                option += '<option value="'+obj.id+'">'+obj.nome+'</option>';
            }) 
          } else {
            var option = "<option>-- Sub Área --</option>";
          }
          $('#subArea').html(option).show(); 
        })
  }

  window.onload = areas();
</script>
@endsection