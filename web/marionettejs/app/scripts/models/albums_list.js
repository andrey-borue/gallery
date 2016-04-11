define(['backbone.marionette', './album'], function(App, Album) {

    return AlbumsList = Backbone.Collection.extend({
        model: Album
    });
});


