MyApp.AlbumApp = do ->
  AlbumApp = {}
  Layout = Backbone.Marionette.Layout.extend(
    template: '#library-layout'
    regions:
      search: '#searchBar'
      images: '#imageContainer')
  Image = Backbone.Model.extend()
  Images = Backbone.Collection.extend(
    model: Image
    initialize: ->
      self = this
      _.bindAll this, 'search'
      MyApp.vent.on 'search:term', (albumNumber, pageNumber) ->
        self.search albumNumber, pageNumber
        return
      @loading = false
      @previousSearch = null
      return
    search: (albumNumber, pageNumber) ->
      @page = 1
      self = this
      @fetchImages albumNumber, pageNumber, (images) ->
        if images.length < 1
          MyApp.vent.trigger 'search:noResults'
        else
          self.reset images
        return
      @previousSearch = albumNumber
      return
    fetchImages: (albumNumber, pageNumber, callback) ->
      if @loading
        return true
      if isNaN(pageNumber)
        pageNumber = 1
      @loading = true
      self = this
      MyApp.vent.trigger 'search:start'
      query = 'id=' + albumNumber + '&page=' + pageNumber
      $.get 'http://127.0.0.1:8000/api/gallery/album', query, ((res) ->
        MyApp.vent.trigger 'search:stop'
        if res.total_items == 0
          callback []
          return []
        if res.medias
          searchResults = []
          _.each res.medias, (item) ->
            searchResults[searchResults.length] = new Image(
              thumbnail: item.url
              id: item.id)
            return
          callback searchResults
          self.loading = false
          return searchResults
        else if res.error
          MyApp.vent.trigger 'search:error'
          self.loading = false
        return
      ), 'json'
      return
  )
  AlbumApp.Images = new Images

  AlbumApp.initializeLayout = ->
    AlbumApp.layout = new Layout
    AlbumApp.layout.on 'show', ->
      MyApp.vent.trigger 'layout:rendered'
      return
    MyApp.content.show MyApp.AlbumApp.layout
    return

  AlbumApp.search = (albumNumber, pageNumber) ->
    AlbumApp.initializeLayout()
    MyApp.AlbumApp.ImagesList.showImages AlbumApp.Images
    MyApp.vent.trigger 'search:term', albumNumber, pageNumber
    return

  AlbumApp.searchFirst = (albumNumber) ->
    AlbumApp.initializeLayout()
    MyApp.AlbumApp.ImagesList.showImages AlbumApp.Images
    MyApp.vent.trigger 'search:term', albumNumber, 1
    return

  AlbumApp.defaultSearch = ->
    AlbumApp.search AlbumApp.Images.previousSearch or '68'
    return

  AlbumApp
