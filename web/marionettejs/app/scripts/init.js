//(function() {
//  window.App = new Backbone.Marionette.Application();
//
//  App.on('start', function() {
//    var edits;
//    App.addRegions({
//      'messages': '.messages'
//    });
//    edits = new App.Collections.Edits;
//    return App.reqres.setHandler('edits', function() {
//      return edits;
//    });
//  });
//
//  console.log('Wololo22');
//
//}).call(this);

define(
    [
       'backbone.marionette',
       'views/albums_list_view'
       //'controllers/album_app'
       //'routers/album_routers'
    ],
function(App, AlbumsListView) {

   MyApp = new Backbone.Marionette.Application({
    onStart: function(options) {
      //var router = new Router(options);
      /** Starts the URL handling framework */
      Backbone.history.start();
    }
  });

  MyApp.addRegions({
    listRegion: "#albums_list",
    contentRegion: "#album_content"
  });


  MyApp.addInitializer(function(options){
      //albumsCatalogView = new AlbumsListView({
      //  collection: options.albums
      //});
      ////console.log(albumsCatalogView);
      //MyApp.listRegion.show(albumsCatalogView);
  });


  //AlbumRoutes(MyApp);

  return MyApp;
});
