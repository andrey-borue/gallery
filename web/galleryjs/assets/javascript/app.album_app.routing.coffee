MyApp.LibraryRouting = do ->
  LibraryRouting = {}
  LibraryRouting.Router = Backbone.Marionette.AppRouter.extend(appRoutes:
    'album/:albumNumber': 'searchFirst'
    'album/:albumNumber/page/:pageNumber': 'search')
  MyApp.vent.on 'search:term', (albumNumber, pageNumber) ->
    if pageNumber < 2 or isNaN(pageNumber)
      Backbone.history.navigate 'album/' + albumNumber
    else
      Backbone.history.navigate 'album/' + albumNumber + '/page/' + pageNumber
    return
  MyApp.addInitializer ->
    LibraryRouting.router = new (LibraryRouting.Router)(controller: MyApp.AlbumApp)
    MyApp.vent.trigger 'routing:started'
    return
  LibraryRouting
