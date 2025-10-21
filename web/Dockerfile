# Etapa base: imagem Node oficial
FROM node:20-alpine

# Define o diretório de trabalho
WORKDIR /app

# Copia os arquivos de dependência
COPY package.json ./
COPY package-lock.json ./

# Instala as dependências
RUN npm install

# Copia todo o restante do projeto
COPY . .

# Expõe a porta padrão do Vite
EXPOSE 5173

# Inicia o Vite em modo desenvolvimento
CMD ["npm", "run", "dev", "--", "--host"]