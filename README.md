# sorteios-cli
CLI para gerar números aleatórios para os jogos Quina, Mega Sena e Loto Fácil.

### Instalação
Execute no terminal:
```
composer install
```

### Parâmetros
tipo do jogo (obrigatório): quina, mega-sena ou loto-facil.  
quantidade de números (opcional): um número qualquer nunca menor que o valor mínimo para o tipo de jogo.

### Exemplo
```
./sorteios generate mega-sena

./sorteios generate mega-sena 10
```

### Observações
O formato da resposta será sempre os números gerados separados por virgula (,).
