MyApp.AlbumApp = function(){
  var AlbumApp = {};
  
  var Layout = Backbone.Marionette.Layout.extend({
    template: "#library-layout",
    
    regions: {
      search: "#searchBar",
      images: "#imageContainer"
    }
  });
  
  var Image = Backbone.Model.extend();

  var Images = Backbone.Collection.extend({
    model: Image,
    
    initialize: function(){
      var self = this;
      _.bindAll(this, "search");
      MyApp.vent.on("search:term", function(albumNumber, pageNumber){ self.search(albumNumber, pageNumber); });

      this.loading = false;
      this.previousSearch = null;
    },

    search: function(albumNumber, pageNumber){
      this.page = 1;
      
      var self = this;
      this.fetchImages(albumNumber, pageNumber, function(images){
        if(images.length < 1){
          MyApp.vent.trigger("search:noResults");
        } else {
          self.reset(images);
        }
      });
      
      this.previousSearch = albumNumber;
    },

    fetchImages: function(albumNumber, pageNumber, callback){
      if(this.loading) return true;

      if (isNaN(pageNumber)) {pageNumber = 1}
      this.loading = true;
      var self = this;
      MyApp.vent.trigger("search:start");
      
      var query = 'id=' + albumNumber + '&page=' + pageNumber;

      $.get('http://127.0.0.1:8000/api/gallery/album', query, function (res) {
        MyApp.vent.trigger("search:stop");
        if(res.total_items == 0){
          callback([]);
          return [];
        }
        if(res.medias){
            var searchResults = [];
            _.each(res.medias, function(item){searchResults[searchResults.length] = new Image({thumbnail: item.url, id: item.id});});
            callback(searchResults);
            self.loading = false;
            return searchResults;
        } else if (res.error) {
          MyApp.vent.trigger("search:error");
          self.loading = false;
        }
      }, 'json')

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
  
  AlbumApp.search = function(albumNumber, pageNumber){
    AlbumApp.initializeLayout();
    MyApp.AlbumApp.ImagesList.showImages(AlbumApp.Images);
    
    MyApp.vent.trigger("search:term", albumNumber, pageNumber);
  };

  AlbumApp.searchFirst = function(albumNumber){
    AlbumApp.initializeLayout();
    MyApp.AlbumApp.ImagesList.showImages(AlbumApp.Images);

    MyApp.vent.trigger("search:term", albumNumber, 1);
  };
  
  AlbumApp.defaultSearch = function(){
    AlbumApp.search(AlbumApp.Images.previousSearch || "68");
  };
  
  return AlbumApp;
}();
