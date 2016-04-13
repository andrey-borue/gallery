MyApp.AlbumApp.ImagesList = do ->
    ImagesList = {}
    ImageDetailView = Backbone.Marionette.ItemView.extend(
        template: '#image-detail-template'
        className: 'modal imageDetail')
    ImageView = Backbone.Marionette.ItemView.extend(
        template: '#image-template'
        events: 'click': 'showImageDetail'
        showImageDetail: ->
            detailView = new ImageDetailView(model: @model)
            MyApp.modal.show detailView
            return
    )
    ImageListView = Backbone.Marionette.CompositeView.extend(
        template: '#image-list-template'
        id: 'imagesList'
        itemView: ImageView
        initialize: ->
            _.bindAll this, 'showMessage'
            self = this
            MyApp.vent.on 'search:error', ->
                self.showMessage 'Error, please retry later :s'
                return
            MyApp.vent.on 'search:noalbumNumber', ->
                self.showMessage 'No album number'
                return
            MyApp.vent.on 'search:noResults', ->
                self.showMessage 'No images found'
                return
            return
        events: {}
        appendHtml: (collectionView, itemView) ->
            collectionView.$('.images').append itemView.el
            return
        showMessage: (message) ->
            @$('.images').html '<h1 class="notFound">' + message + '</h1>'
            return
    )
    SearchView = Backbone.View.extend(
        el: '#searchBar'
        initialize: ->
            self = this
            $spinner = self.$('#spinner')
            MyApp.vent.on 'search:start', ->
                $spinner.fadeIn()
                return
            MyApp.vent.on 'search:stop', ->
                $spinner.fadeOut()
                return
            MyApp.vent.on 'search:term', (albumNumber, pageNumber) ->
                self.$('#albumNumber').val albumNumber
                if isNaN(pageNumber) or pageNumber < 2
                    pageNumber = 1
                self.$('#pageNumber').val pageNumber
                return
            return
        events:
            'change #albumNumber': 'search'
            'change #pageNumber': 'search'
        search: ->
            albumNumber = @$('#albumNumber').val().trim()
            pageNumber = @$('#pageNumber').val().trim()
            if albumNumber.length > 0
                MyApp.vent.trigger 'search:term', albumNumber, pageNumber
            else
                MyApp.vent.trigger 'search:noalbumNumber'
            return
    )

    ImagesList.showImages = (images) ->
        imageListView = new ImageListView(collection: images)
        MyApp.AlbumApp.layout.images.show imageListView
        return

    MyApp.vent.on 'layout:rendered', ->
        searchView = new SearchView
        MyApp.AlbumApp.layout.search.attachView searchView
        return
    ImagesList
