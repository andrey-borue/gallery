define(['backbone.marionette', '../models/album'], function(App, AlbumModel) {

    //return Backbone.Marionette.ItemView.extend({
    //    //template: "#album-template",
    //    tagName: 'div',
    //    className: 'album_list_row'
    //});


    return Backbone.Marionette.ItemView.extend({
        template: '#album-template',
        // model: new AlbumModel(),
        initialize: function () {
            console.log('init album_view' + this.render);
        }
        // ,
        // render: function () {
        //     //debugger;
        //     console.log(arguments);
        //     console.log(this.model.attributes);
        //     Marionette.ItemView.prototype.render.apply(this)
        // }
    });


});

