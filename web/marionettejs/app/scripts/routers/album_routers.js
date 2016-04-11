define(['backbone.marionette', '../controllers/album_app'], function(App, AlbumApp) {
        var AlbumRouting = {};

        AlbumRouting.Router = Backbone.Marionette.AppRouter.extend({
            appRoutes: {
                '': 'albumList',
                'album/:id': 'imageList',
                'album/:id/page/:page': 'imageList'
            }
        });

        AlbumRouting.router = new AlbumRouting.Router({
            controller: AlbumApp
        });

        return AlbumRouting;
});


