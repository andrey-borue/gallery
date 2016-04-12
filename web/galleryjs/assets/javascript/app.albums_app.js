MyApp.AlbumsApp = function(){
  var AlbumsApp = {};

  var Layout = Backbone.Marionette.Layout.extend({
    template: "#albums-layout",

    regions: {
      list: "#albumContainer"
    }
  });

  var Album = Backbone.Model.extend();

  var Albums = Backbone.Collection.extend({
    model: Album,

    initialize: function(){
      var self = this;
      _.bindAll(this, "loadall"); //, "moreBooks"
      MyApp.vent.on("loadall:term", function(){ self.loadall(); });
    },

    loadall: function(){
      var self = this;
      this.fetchAlbums(function(albums){
          self.reset(albums);
      });

    },

    fetchAlbums: function(callback){
      var self = this;
      MyApp.vent.trigger("loadall:start");

      var query = 'medias=1';

      $.get('http://127.0.0.1:8000/api/gallery/list', query, function (res) {
        MyApp.vent.trigger("loadall:stop");
            var searchResults = [];
            _.each(res.medias, function(item){
                searchResults[searchResults.length] = new Album({
                    name: item.name,
                    id: item.id
                });
            });
          callback(searchResults);
          return searchResults;
      }, 'json')

    }
  });

  AlbumsApp.Albums = new Albums();

  AlbumsApp.loadall = function(){
    AlbumsApp.initializeLayout();
    MyApp.AlbumsApp.AlbumsList.show(AlbumsApp.Albums);

    MyApp.vent.trigger("loadall:term");
  };


  AlbumsApp.initializeLayout = function(){
    AlbumsApp.layout = new Layout();
    MyApp.content.show(MyApp.AlbumsApp.layout);
  };

  return AlbumsApp;
}();
