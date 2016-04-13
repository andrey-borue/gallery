MyApp.AlbumsApp.AlbumsList = do ->
    AlbumsList = {}
    AlbumView = Backbone.Marionette.ItemView.extend(
        template: '#album-template'
        events: 'click': 'showAlbumDetail'
        showAlbumDetail: ->
    )
    AlbumsListView = Backbone.Marionette.CompositeView.extend(
        template: '#album-list-template'
        id: 'albumsList'
        itemView: AlbumView
        initialize: ->
            _.bindAll this
            self = this
            return
        events: {}
        appendHtml: (collectionView, itemView) ->
            collectionView.$('.images').append itemView.el
            return
    )

    AlbumsList.show = (images) ->
        albumsListView = new AlbumsListView(collection: images)
        MyApp.AlbumsApp.layout.list.show albumsListView
        return

    AlbumsList
