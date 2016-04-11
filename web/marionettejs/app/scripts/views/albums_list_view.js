define(['backbone.marionette', './album_view'], function(App, AlbumView) {

    return Backbone.Marionette.CompositeView.extend({
        tagName: "div",
        id: "album_collection_xx",
        className: "album_list_container",
        template: "#albums_list-template",
        itemView: AlbumView,
        childViewContainer: '#album_collection',

        initialize: function(test){
            console.log('initialize');
            console.log(test);
            // this.listenTo(this.collection, "click", this.renderCollection);
            // console.log(this.renderCollection);
        },

        // renderCollection: function(collectionView, itemView) {
        //     console.log(collectionView, itemView);
        // },

        // appendHtml: function(collectionView, itemView){
        //    collectionView.$("div").append(itemView.el);
        // }
    });
});

