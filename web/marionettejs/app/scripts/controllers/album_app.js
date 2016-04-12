define([
    'backbone.marionette',
    '../views/albums_list_view',
    '../views/album_view',
    '../models/album',
    '../models/albums_list'
], function(App, AlbumsListView, AlbumView, AlbumModel, AlbumsListModel) {


    var AlbumApp = function(){
        var AlbumApp = {};

        return AlbumApp;
    }();

    
    AlbumApp.imageList = function(term){
        //LibraryApp.initializeLayout();
        //MyApp.LibraryApp.BookList.showBooks(LibraryApp.Books);

        //MyApp.vent.trigger("search:term", term);

        console.log(term);
    };

    AlbumApp.albumList = function(){
        $.get('http://127.0.0.1:8000/api/gallery/list?limit=20', function(data) {
            var options = [];
            data.forEach(function(item, i, arr) {
                options.push({name: item.name, url: item.url});
            });

            options = [
                new AlbumModel({ url: 'Test', name: 'name1' }),
                new AlbumModel({ url: 'Test1', name: 'name2' })
            ];

            //console.log(options);

            var albumsListModel = new AlbumsListModel(options);
            albumsListModel.fetch();

            // var model = new AlbumModel({ url: 'Test', name: 'name1' });
            // var view = new AlbumView({model: model});
            // MyApp.listRegion.show(view);
            // model.name =123;
            // view.renderCollection();


            // MyApp.listRegion.show(new AlbumsListView({model: new AlbumsListModel(options)}));
            // MyApp.listRegion.show(new AlbumsListView({model: albumsListModel}));
        
        }, 'json');


        //LibraryApp.search("Neuromarketing");
    };


    return AlbumApp;
});


