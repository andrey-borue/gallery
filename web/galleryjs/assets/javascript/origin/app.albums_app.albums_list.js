MyApp.AlbumsApp.AlbumsList = function(){
    var AlbumsList = {};

    var AlbumView = Backbone.Marionette.ItemView.extend({
        template: "#album-template",
        events: {
            'click': 'showAlbumDetail'
        },

        showAlbumDetail: function(){

        }
    });

    var AlbumsListView = Backbone.Marionette.CompositeView.extend({
        template: "#album-list-template",
        id: "albumsList",
        itemView: AlbumView,

        initialize: function(){
            _.bindAll(this);
            var self = this;
        },

        events: {

        },

        appendHtml: function(collectionView, itemView){
            collectionView.$(".images").append(itemView.el);
        }

    });

    AlbumsList.show = function(images){
          var albumsListView = new AlbumsListView({ collection: images });
          MyApp.AlbumsApp.layout.list.show(albumsListView);
    };

    return AlbumsList;
}();
