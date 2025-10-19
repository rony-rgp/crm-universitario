# Usa una imagen base de Node.js con Alpine para reducir el tamaño
FROM node:20-alpine

# Establece el directorio de trabajo en el contenedor
WORKDIR /app

# Copia los archivos de dependencias
COPY package.json package-lock.json ./

# Instala las dependencias usando npm ci (ideal para producción)
RUN npm ci --only=production || npm install

# Copia el resto de los archivos del proyecto
COPY . .

# Expón el puerto en el que React correrá
EXPOSE 3000

# Comando para correr la aplicación en modo desarrollo
CMD ["npm", "start"]