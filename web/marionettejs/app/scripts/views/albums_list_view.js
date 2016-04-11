define(['backbone.marionette', './album_view'], function(App, AlbumView) {

    return Backbone.Marionette.CollectionView.extend({
        tagName: "div",
        //id: "albums_list",
        className: "album_list_container",
        template: "#album-template",
        childView: AlbumView

        //appendHtml: function(collectionView, itemView){
        //    collectionView.$("div").append(itemView.el);
        //}
    });
});

