define(['backbone.marionette'], function() {

    return Backbone.Marionette.Layout.extend({
        template: "#albums_container-template",

        regions: {
            albums: "#album_collection"
        }
    });
});


