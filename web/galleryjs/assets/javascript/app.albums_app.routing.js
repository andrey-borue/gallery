MyApp.AlbumsRouting = function(){
  var AlbumsRouting = {};

  AlbumsRouting.Router = Backbone.Marionette.AppRouter.extend({
    appRoutes: {
      "": "loadall"
    }
  });

  MyApp.vent.on("loadall:term", function(){
      Backbone.history.navigate("");
  });



  MyApp.addInitializer(function(){
    AlbumsRouting.router = new AlbumsRouting.Router({
      controller: MyApp.AlbumsApp
    });
    
    MyApp.vent.trigger("routing:started");
  });

  return AlbumsRouting;
}();
