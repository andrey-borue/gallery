MyApp.AlbumsRouting = do ->
  AlbumsRouting = {}
  AlbumsRouting.Router = Backbone.Marionette.AppRouter.extend(appRoutes: '': 'loadall')
  MyApp.vent.on 'loadall:term', ->
    Backbone.history.navigate ''
    return
  MyApp.addInitializer ->
    AlbumsRouting.router = new (AlbumsRouting.Router)(controller: MyApp.AlbumsApp)
    return
  AlbumsRouting
