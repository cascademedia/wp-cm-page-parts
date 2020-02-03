FROM codercom/code-server:latest

RUN sudo ln -fs /usr/share/zoneinfo/America/Indiana/Indianapolis /etc/localtime \
    && sudo apt -y install php7.2 \
    && code-server --install-extension felixfbecker.php-intellisense
