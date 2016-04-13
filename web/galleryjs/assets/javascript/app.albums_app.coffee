MyApp.AlbumsApp = do ->
  AlbumsApp = {}
  Layout = Backbone.Marionette.Layout.extend(
    template: '#albums-layout'
    regions: list: '#albumContainer')
  Album = Backbone.Model.extend()
  Albums = Backbone.Collection.extend(
    model: Album
    initialize: ->
      self = this
      _.bindAll this, 'loadall'
      MyApp.vent.on 'loadall:term', ->
        self.loadall()
        return
      return
    loadall: ->
      self = this
      @fetchAlbums (albums) ->
        self.reset albums
        return
      return
    fetchAlbums: (callback) ->
      query = 'medias=1'
      $.get 'http://127.0.0.1:8000/api/gallery/list', query, ((res) ->
        searchResults = []
        _.each res, (item) ->
          searchResults[searchResults.length] = new Album(
            name: item.name
            id: item.id)
          return
        callback searchResults
        searchResults
      ), 'json'
      return
  )
  AlbumsApp.Albums = new Albums

  AlbumsApp.loadall = ->
    AlbumsApp.initializeLayout()
    MyApp.AlbumsApp.AlbumsList.show AlbumsApp.Albums
    MyApp.vent.trigger 'loadall:term'
    return

  AlbumsApp.initializeLayout = ->
    AlbumsApp.layout = new Layout
    MyApp.content.show MyApp.AlbumsApp.layout
    return

  AlbumsApp
