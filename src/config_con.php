   {% extends 'testes/base.html' %}
   {% block conteudo%}
   <form action="{% url 'config_conexao' %}" method="post">
        <div class="container">
            <h5>Paramêtros de Conexão</h5>
            <h5><input style = "border: 0px; outline: none;" name="no_dados_p" type="text" value="{{ data.no_dados }}" readonly></h5>
            <div class="row">
                <div class="col-2" >Host: <input name="host_p" class="form-control-sm" type="text" value="{{ data.host }}"></div>
                <div class="col-2" >Database: <input name="database_p" class="form-control-sm" type="text" value="{{ data.database }}"></div>
                <div class="col-2" >Port: <input name="port_p" class="form-control-sm" type="text" value="{{ data.port }}"></div>
                <div class="col-2" >User: <input name="user_p" class="form-control-sm" type="text" value="{{ data.user }}"></div>
                <div class="col-2" >Password: <input name="password_p" class="form-control-sm" type="text" value="{{ data.password }}"></div>
            </div>
            <div style="color:#00BFFF;" class="container p-2">{{ st_altera }}</div>
        </div>
    </form>
    {% endblock %}
   
