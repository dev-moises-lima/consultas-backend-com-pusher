# Instalação
`git clone https://github.com/dev-moises-lima/consultas-backend-aprimorado.git` => clona o repositório.<br>
`php composer install` => instala as dependências do projeto.<br>
`php artisan storage:link` => cria um link simbólico para a pasta storage/app/public que será usado para armazenar as fotos dos pacientes.<br>
Também é necessário criar um arquivo .env e configurar a conexâo com o banco de dados. Use o .env.example como base para o arquivo .env e coloque as informações da conexão do seu banco de dados nas variáveis de ambiente correspondentes. Além disso, é necessário colocar as informações do pusher nas suas respectivas variáveis de ambiente.<br>
`php artisan migrate` => executa as migrations.<br>
`php artisan serve` => inicia o servidor de desenvolvimento.<br>
Em outro terminal execute o comando `php artisan queue:work` para executar as filas de trabalho
