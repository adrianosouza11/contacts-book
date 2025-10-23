FROM node:20-alpine AS build

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm install --only=production

COPY . .

RUN npm run build

FROM nginx:stable-alpine AS production

COPY ./nginx/nginx.conf /etc/nginx/conf.d/default.conf

RUN rm -rf /usr/share/nginx/html/*

COPY --from=build /app/dist /usr/share/nginx/html

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]