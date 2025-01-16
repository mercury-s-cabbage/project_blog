import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

// https://vitejs.dev/config/
export default {
    root: 'resources', // Указывает на папку с исходными файлами
    build: {
        outDir: '../public/build', // Папка для выходных файлов
        manifest: true, // Генерация манифеста для подключения ресурсов
    },
};
