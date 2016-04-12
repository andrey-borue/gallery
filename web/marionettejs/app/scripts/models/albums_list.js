define(['backbone.marionette', './album'], function(App, Album) {

    return AlbumsList = Backbone.Collection.extend({
        model: Album,


        fetch: function() {

            console.log('album fetch');


        }
    });
});


