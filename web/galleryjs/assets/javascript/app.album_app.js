MyApp.AlbumApp = function(){
  var AlbumApp = {};
  
  var Layout = Backbone.Marionette.Layout.extend({
    template: "#album-layout",
    
    regions: {
      paginator: "#paginator",
      images: "#imagesContainer"
    }
  });


  var Image = Backbone.Model.extend();

  var Images = Backbone.Collection.extend({
    model: Image,

    initialize: function(){
      var self = this;
      //_.bindAll(this, "search", "moreBooks");
      //MyApp.vent.on("search:term", function(term){ self.search(term); });
      //MyApp.vent.on("search:more", function(){ self.moreBooks(); });

      // the number of images we fetch each time
      this.maxResults = 10;
      // the results "page" we last fetched
      this.page = 1;

      // flags whether the collection is currently in the process of fetching
      // more results from the API (to avoid multiple simultaneous calls
      this.loading = false;

      // remember the previous search
      this.previousSearch = null;
      // the maximum number of results for the previous search
      this.totalItems = null;
      this.totalPages = null;
    },

    search: function(albumId){
      this.page = 1;

      var self = this;
      this.fetchImages(albumId, function(images){
        console.log(images);
        if(images.length < 1){
          MyApp.vent.trigger("searchimages:noResults");
        }
        else{
          self.reset(images);
        }
      });

      this.previousSearch = albumId;
    },

    moreImages: function(){
      // if we've loaded all the images for this search, there are no more to load !
      if(this.length >= this.totalItems){
        return true;
      }

      var self = this;
      this.fetchImages(this.previousSearch, function(images){ self.add(images); });
    },

    fetchImages: function(albumId, callback){
      if(this.loading) return true;

      this.loading = true;

      var self = this;
      MyApp.vent.trigger("searchimages:start");

      var query = 'id=' + albumId + '&page=' + this.page + '&medias=' + this.maxResults;

      $.ajax({
        url: '/api/gallery/album',
        dataType: 'json',
        data: query,
        success: function (res) {
          MyApp.vent.trigger("searchimages:stop");
          //if(res.totalItems == 0){
          //  callback([]);
          //  return [];
          //}
          if(res.medias){
            self.page++;
            self.totalItems = res.totalItems;
            self.totalPages = res.page_count;
            var searchResults = [];
            _.each(res.medias, function(item){
              var thumbnail = null;
              searchResults[searchResults.length] = new Image({
                url: item.url
              });
            });
            callback(searchResults);
            self.loading = false;
            return searchResults;
          }
          else if (res.error) {
            MyApp.vent.trigger("searchimages:error");
            self.loading = false;
          }
        }
      });
    }
  });

  AlbumApp.Images = new Images();






  AlbumApp.initializeLayout = function(){
    AlbumApp.layout = new Layout();

    AlbumApp.layout.on("show", function(){
      MyApp.vent.trigger("layout:rendered");
    });
    MyApp.content.show(MyApp.AlbumApp.layout);
  };



  AlbumApp.search = function(term){
    AlbumApp.initializeLayout();
    MyApp.AlbumApp.AlbumList.showAlbums(AlbumApp.Books);

    MyApp.vent.trigger("searchimages:term", term);
  };

  AlbumApp.defaultSearch = function(){
    AlbumApp.search(AlbumApp.Albums.previousSearch || "61");
  };



  MyApp.addInitializer(function(){
    AlbumApp.Images.search("61");
  });


  return AlbumApp;
}();
