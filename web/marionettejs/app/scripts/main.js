require.config({
    paths: {
        'jquery': 'vendor/jquery/dist/jquery',
        'bootstrap': 'vendor/bootstrap/dist/js/bootstrap',
        'underscore': 'vendor/underscore/underscore',
        'backbone': 'vendor/backbone/backbone',
        'backbone.babysitter': 'vendor/backbone.babysitter/lib/backbone.babysitter',
        'backbone.wreqr': 'vendor/backbone.wreqr/lib/backbone.wreqr',
        'backbone.marionette': 'vendor/backbone.marionette/lib/core/backbone.marionette',
        //'gallery.model.albumlist': 'models/albums_list'
        //'myapp': 'application'
    },
    shim: {
        underscore: {
            exports: '_'
        },
        backbone: {
            exports: 'Backbone',
            deps: ['jquery', 'underscore']
        },
        'backbone.marionette': {
            exports: 'Backbone.Marionette',
            deps: ['backbone']
        },
        bootstrap : {
            export: 'Bootstrap',
            deps: ['jquery']
        }
    },
    deps: ['jquery', 'underscore', 'bootstrap', 'backbone', 'backbone.marionette']
});

require(['init', 'models/albums_list', 'routers/album_routers'], function(MyApp, AlbumsList, AlbumRoutes) {

    albums = new AlbumsList([
        { url: 'Test', name: 'name1' },
        { url: 'Test1', name: 'name2' }
    ]);

    MyApp.start({albums: albums});


});
