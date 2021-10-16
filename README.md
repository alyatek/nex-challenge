### NEX - Challenge

Antes de mais aproveito para agradecer esta oportunidade.

Aproveito também para esclarecer partes gerais do código.

    * App\Http\Controllers - Utilizo apenas como um meio para validar e chamar as funções gerais de acordo com a funcionalidade
    * App\Classes - Criação de coerencia no estilo dos modelos
    * App\Repositories - Onde encaixo a lógica do business, tento praticar o máximo a abstração, apenas para expor a ação principal, e as secundárias reservadas ao próprio objeto
    * App\Traits - Implementação mais prática da validação para não ter os controllers com demasiada informaçao e funcionidades
    * App\Models - ORM para a base de dados

Outros pontos:

    - No endpoint atletas/{id} devolve a informação relativa ao atleta e junto com esta mesma as modalidades e os seus atributos nessa mesma. Para uma questão de legibilidade organizei a key pelo nome da modalidade e os seus values os atributos, mas diga-mos que "no mundo real", na minha opinião, deveria estar organizado por id da modalidade como key, e os id's dos atributos como valor, para no frontend ser mais prático dar o display destes atributos.
    - Relativamente à parte de guardar informação relevante do atleta:
                                            Por questões de demonstração será especificado o "user_id" de quem insere as notas/questões, mas na prática deveria estar implementado autenticação para obter qual o utilizador que está a inserir esta informação

Config do postman em NEX.postman_collection.json

###Instalação

1. cp .env.example .env && docker-compose up -d --build
2. make php-bash
3. cp .env.example .env && composer install
4. php artisan migrate
