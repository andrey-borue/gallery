define(
    ['backbone.marionette', '../views/albums_list_view', '../views/album_view', '../models/album'],
function(App, AlbumsListView, AlbumView, AlbumModel) {


    var AlbumApp = function(){
        var AlbumApp = {};

        AlbumApp.alert = function(message){
            alert(message);
        };

        AlbumApp.privateAlert = function(message){
            privateMessage(message);
        };

        var privateMessage = function(message){
            alert('private: ' + message);
        };

        return AlbumApp;
    }();


    AlbumApp.search = function(term){
        //LibraryApp.initializeLayout();
        //MyApp.LibraryApp.BookList.showBooks(LibraryApp.Books);

        //MyApp.vent.trigger("search:term", term);

        console.log(term);
    };

    AlbumApp.albumList = function(){
        console.log(2);

        $.get('http://127.0.0.1:8000/api/gallery/list?limit=20', function(data) {

            var options = [];
            data.forEach(function(item, i, arr) {

                //console.log(item);
                var option = {
                   name: item.name,
                   url: 'sss'
                };
                options.push(option);

                //alert( i + ": " + item + " (массив:" + arr + ")" );
            });

            //console.log(options);
            //
            //var albums = new AlbumsList(options);

            //MyApp.start({albums: albums});


            options = [
                { url: 'Test', name: 'name1' },
                { url: 'Test1', name: 'name2' }
            ];

            //console.log(options);


            //MyApp.listRegion.show(new AlbumsListView({collection: new AlbumsList(options)}));
            //MyApp.listRegion.show(new AlbumView({model: new AlbumModel({ url: 'Test', name: 'name1' })}));
            MyApp.listRegion.show(new AlbumView({model: new AlbumModel({ url: 'Test', name: 'name1' })}));

        }, 'json');


        //LibraryApp.search("Neuromarketing");
    };


    return AlbumApp;
});


