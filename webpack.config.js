const path= require("path");

module.exports={
    resolve:{
        alias:{
            '@':path.resolve('resources/js'),
            //  '@assets': path.resolve(__dirname, 'public')
        },
         extensions: ['.js', '.jsx', '.scss','.jpg','png']
    },
        module: {
            rules: [
            {
                test: /\.(png|jpg|gif)$/i,
                use: [
                {
                    loader: 'url-loader',
                    options: {
                    limit: 8192,
                    },
                },
                ],
            },
            ],
        },
}
