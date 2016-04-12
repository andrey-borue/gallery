//MyApp.Albums = {};
//
//MyApp.Albums.DefaultView = Backbone.Marionette.ItemView.extend({
//  template: "#albums-template",
//  className: "close"
//});
//
//MyApp.Albums.Router = Backbone.Marionette.AppRouter.extend({
//    appRoutes: {
//      "albums": "show"
//    }
//});
//
//MyApp.Albums.show = function(){
//  var listView = new MyApp.Albums.DefaultView();
//  MyApp.content.show(listView);
//  Backbone.history.navigate("albums");
//}
//
//MyApp.addInitializer(function(){
//  MyApp.Albums.router = new MyApp.Albums.Router({
//    controller: MyApp.Albums
//  });
//
//  MyApp.vent.trigger("routing:started");
//});




// ------------------


MyApp.AlbumsApp = function(){
  var AlbumsApp = {};

  var Layout = Backbone.Marionette.Layout.extend({
    template: "#albums-template",

    regions: {
      list: "#list"
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

  AlbumsApp.initializeLayout = function(){
    AlbumsApp.layout = new Layout();
    MyApp.content.show(MyApp.AlbumsApp.layout);
  };

  return AlbumsApp;
}();
