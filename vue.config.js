module.exports = {
  devServer: {
    proxy: {
      '^/banking': {
        target: 'https://devapi.klikbca.com:9443',
        changeOrigin: true,
        ws: true,
        pathRewrite: { '^/banking': '/banking' },
      },
    },
  }
}