<h3>CREDENCIAIS PARA ACESSAR SISTEMA</h3>
<p>
    Você foi cadastrado(a) para acessar o Sistema Aluguel Maria da Penha da Secretaria de Estado da Mulher / SEMU<br>
    <strong>Obs:</strong> Em seu primeiro acesso, por questão de segurança, será necessário redefinir a senha que lhe foi fornecida.<br><br>
    Suas credenciais:
</p>

<p>{{ $data['message'] }}</p>

<p>Acesse o Sistema, clicando <a href="{{ \Config::get('app.url'); }}"><strong> aqui! </strong></a></p>

<p>
    Se o link acima não funcionar, copie e cole o endereço abaixo em seu navegador preferido.<br>
    {{ \Config::get('app.url'); }}
</p>
