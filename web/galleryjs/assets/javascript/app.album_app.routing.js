MyApp.LibraryRouting = function(){
  var LibraryRouting = {};

  LibraryRouting.Router = Backbone.Marionette.AppRouter.extend({
    appRoutes: {
      //"": "defaultSearch",
      "album/:albumNumber": "searchFirst",
      "album/:albumNumber/page/:pageNumber": "search"
    }
  });

  MyApp.vent.on("search:term", function(albumNumber, pageNumber){
    if (pageNumber < 2 || isNaN(pageNumber)) {
      Backbone.history.navigate("album/" + albumNumber);
    } else {
      Backbone.history.navigate("album/" + albumNumber + '/page/' + pageNumber);
    }

  });

  MyApp.addInitializer(function(){
    LibraryRouting.router = new LibraryRouting.Router({
      controller: MyApp.AlbumApp
    });
    
    MyApp.vent.trigger("routing:started");
  });

  return LibraryRouting;
}();
