- [x] Create DB and operations sql.
- [x] Create function [get].
- [x] Create function [post].
- [x] Create function [put].
- [x] Create function [patch].
- [x] Create routers. 
- [ ] Check for possibles attacks.

# Estruct project 
projeto/
├── data/
│   └── data.json          # banco de dados (arquivo JSON)
├── src/
│   ├── config/
│   │   └── config.php     # variáveis de configuração
│   ├── public/
│   │   └── index.php      # ponto de entrada
│   └── src/
│       ├── api.php         # roteador de métodos HTTP
│       ├── controllers.php # recebem a requisição
│       ├── services.php    # regras de negócio
│       ├── data.php        # acesso ao arquivo JSON
│       └── validation.php  # validação dos campos