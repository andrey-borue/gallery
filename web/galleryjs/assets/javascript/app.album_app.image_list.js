MyApp.AlbumApp.ImageList = function(){
  var ImageList = {};

  var ImageDetailView = Backbone.Marionette.ItemView.extend({
    template: "#image-detail-template",
    className: "modal bookDetail"
  });

  var BookView = Backbone.Marionette.ItemView.extend({
    template: "#image-template",
  
    events: {
      'click': 'showImageDetail'
    },
    
    showImageDetail: function(){
      var detailView = new ImageDetailView({model: this.model});
      MyApp.modal.show(detailView);
    }
  });

  var ImageListView = Backbone.Marionette.CompositeView.extend({
    template: "#image-list-template",
    id: "bookList",
    itemView: BookView,
  
    initialize: function(){
      _.bindAll(this, "showMessage", "loadMoreImages");
      var self = this;
      MyApp.vent.on("searchimages:error", function(){ self.showMessage("Error, please retry later :s") });
      MyApp.vent.on("searchimages:noSearchTerm", function(){ self.showMessage("Hummmm, can do better :)") });
      MyApp.vent.on("searchimages:noResults", function(){ self.showMessage("No images found") });
    },
    
    events: {
      'scroll': 'loadMoreImages'
    },
    
    appendHtml: function(collectionView, itemView){
      collectionView.$(".images").append(itemView.el);
    },
  
    showMessage: function(message){
      this.$('.images').html('<h1 class="notFound">' + message + '</h1>');
    },
    
    loadMoreImages: function(){
      var totalHeight = this.$('> div').height(),
          scrollTop = this.$el.scrollTop() + this.$el.height(),
          margin = 200;
          
      // if we are closer than 'margin' to the end of the content, load more books
      if (scrollTop + margin >= totalHeight) {
        MyApp.vent.trigger("searchimages:more");
      }
    }
  });
  
  var PaginatorView = Backbone.View.extend({
    el: "#paginator",

    initialize: function(){
      var self = this;
      var $spinner = self.$('#album-spinner');
      MyApp.vent.on("searchimages:start", function(){ $spinner.fadeIn(); });
      MyApp.vent.on("searchimages:stop", function(){ $spinner.fadeOut(); });
      MyApp.vent.on("searchimages:term", function(pageNumber){
        self.$('#pageNumber').val(pageNumber);
      });
    },

    events: {
      'change #pageNumber': 'search'
    },

    search: function() {
      var pageNumber = this.$('#pageNumber').val().trim();
      if(pageNumber.length > 0){
        MyApp.vent.trigger("searchimages:term", pageNumber);
      }
      else{
        MyApp.vent.trigger("searchimages:noSearchTerm");
      }
    }
  });
  
  ImageList.showImages = function(images){
    var imageListView = new ImageListView({ collection: images });
    MyApp.AlbumApp.layout.images.show(imageListView);
  };
  
  MyApp.vent.on("layout:rendered", function(){
    // render a view for the existing HTML in the template, and attach it to the layout (i.e. don't double render)
    var pagiantorView = new PaginatorView();
    MyApp.AlbumApp.layout.paginator.attachView(pagiantorView);
  });
  
  return ImageList;
}();
