export default {
    target: 'server',
    head: {
        title: 'fazwaz-frontend',
        htmlAttrs: {
            lang: 'en',
        },
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: '' },
            { name: 'format-detection', content: 'telephone=no' },
        ],
        link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
    },

    css: [],

    plugins: [],

    components: true,

    buildModules: ['@nuxtjs/eslint-module', '@nuxtjs/tailwindcss'],

    modules: ['@nuxtjs/axios', '@nuxtjs/proxy'],

    axios: {
        proxy: true,
        baseURL: 'http://localhost',
    },

    proxy: {
        '/api': {
            target: `http://localhost/api`,
            pathRewrite: {
                '^/api': '/',
            },
        },
    },

    build: {},
};
