<!DOCTYPE html>
<html>
<head>

</head>
<body>

<h3>Prezado(a) Avaliador(a), cordiais saudações!</h3>
<p>
	Agradecemos seu aceite para participar das avaliações da proposta {{$propostaTitulo}} de @if($natureza == '1') Ensino @elseif($natureza=='2') Pesquisa @elseif($natureza == '3') Extensão @endif
	do {{$eventoTitulo}} da Universidade de Pernambuco (UPE).
	<br><br>Solicitamos, gentilmente, que acesse o sistema Submeta através do <a href="{{ url('http://www.submeta.ufape.edu.br/') }}">LINK</a>, para realizar o seu login no sistema e dar seguimento na avaliação da proposta para aceite ou recusa da presente proposta.
	
	@if($acesso == '1' || $acesso == '3')
		<br><br>Aproveitamos para enviar, em anexo, o formulário de avaliação que deverá ser anexado ao sistema com o seu parecer.
	@endif

	@if($natureza == '3')
		<br><br>Qualquer dúvida, por favor, entre em contato pelo e-mail: editais.prec@ufape.edu.br 
		<br><br>Desde já, agradecemos a disponibilidade de participar do banco de avaliadores Ad hoc de propostas de Extensão e Cultura da UPE.
		<br><br>Atenciosamente,
		<br>Seção de Editais e Apoios a Projetos - PREC/UPE
		<br>Universidade de Pernambuco

	@elseif($natureza == '2')
		<br><br>Atenciosamente,
		<br>Coordenação de Iniciação Científica
		<br>Universidade de Pernambuco
	@else
		<br><br>Atenciosamente,
		<br>Universidade de Pernambuco
	@endif
</p>
</body>
</html>