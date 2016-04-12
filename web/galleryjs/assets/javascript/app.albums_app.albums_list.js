MyApp.AlbumsApp.AlbumsList = function(){
    var AlbumsList = {};

    var AlbumView = Backbone.Marionette.ItemView.extend({
        template: "#album-template",
        events: {
            'click': 'showAlbumDetail'
        },

        showAlbumDetail: function(){
            console.log('click to album');
        }
    });

    var AlbumsListView = Backbone.Marionette.CompositeView.extend({
        template: "#album-list-template",
        id: "albumsList",
        itemView: AlbumView,

        initialize: function(){
            //_.bindAll(this);
            var self = this;
        },

        events: {
          //'scroll': 'loadMoreBooks'
        },

        appendHtml: function(collectionView, itemView){
            collectionView.$(".images").append(itemView.el);
        }

    });

    AlbumsList.show = function(images){
          var albumsListView = new AlbumsListView({ collection: images });
          MyApp.AlbumsApp.layout.list.show(albumsListView);
    };

    MyApp.vent.on("layout:rendered", function(){
          // render a view for the existing HTML in the template, and attach it to the layout (i.e. don't double render)
          //var searchView = new SearchView();
          //MyApp.AlbumApp.layout.search.attachView(searchView);
    });

    return AlbumsList;
}();
