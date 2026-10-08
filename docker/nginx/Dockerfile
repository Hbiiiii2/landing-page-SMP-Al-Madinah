# -------------------------------------------------------------
# Stage 1: Build Frontend Assets (Vite, Tailwind)
# -------------------------------------------------------------
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY vite.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm run build

# -------------------------------------------------------------
# Stage 2: Production Nginx Web Server
# -------------------------------------------------------------
FROM nginx:alpine

LABEL maintainer="SMP Islam Al-Madinah BSD"

# Copy Nginx server configuration
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy static public assets
COPY public /var/www/html/public

# Copy compiled Vite assets
COPY --from=frontend /app/public/build /var/www/html/public/build

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]
