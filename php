#!/bin/bash

# Função de ajuda
function exibir_ajuda {
    echo "Uso: $0 <comando>"
    echo "Comandos disponíveis:"
    echo "  run    - Inicializa o contêiner do PHP (se ainda não foi criado)"
    echo "  bash   - Abre o terminal do contêiner do PHP em modo interativo"
    echo "  stop   - Finaliza o contêiner do PHP em execução (sem remover)"
    echo "  remove - Finaliza e remove o contêiner do PHP"
    echo "  build  - Constrói a imagem customizada do PHP"
    echo "  start  - Inicia o contêiner do PHP previamente criado e parado"
}

# Verifica se foi fornecido ao menos 1 argumento
if [ "$#" -lt 1 ]; then
    echo "Erro: Nenhum comando fornecido."
    exibir_ajuda
    exit 1
fi

# Verifica o comando fornecido
case "$1" in
run)
    echo "Inicializando o contêiner do PHP..."
    if docker ps -a | grep -q php_container; then
        echo "O contêiner php_container já existe."
    else
        docker run -d --name php_container -p 8080:8080 -v "$(pwd)":/app php_custom
        echo "Contêiner php_container inicializado."
    fi
    ;;
bash)
    echo "Abrindo o terminal do contêiner do PHP em modo interativo."
    echo "Para sair, digite 'exit'."
    docker exec -it php_container /bin/bash
    ;;
stop)
    echo "Finalizando o contêiner do PHP..."
    docker stop php_container
    echo "Contêiner php_container finalizado."
    ;;
remove)
    echo "Finalizando e removendo o contêiner do PHP..."
    docker stop php_container
    docker rm php_container
    echo "Contêiner php_container removido."
    ;;
build)
    echo "Construindo a imagem customizada do PHP..."
    docker build -t php_custom .
    echo "Imagem php_custom construída."
    ;;
start)
    echo "Iniciando o contêiner do PHP previamente criado e parado..."
    docker start php_container
    echo "Contêiner php_container iniciado."
    ;;
*)
    echo "Erro: Comando inválido."
    exibir_ajuda
    exit 1
    ;;
esac

exit 0
