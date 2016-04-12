MyApp.AlbumApp.ImagesList = function(){
    var ImagesList = {};

    var ImageDetailView = Backbone.Marionette.ItemView.extend({
        template: "#image-detail-template",
        className: "modal imageDetail"
    });

    var ImageView = Backbone.Marionette.ItemView.extend({
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
        id: "imagesList",
        itemView: ImageView,

        initialize: function(){
            _.bindAll(this, "showMessage");
            var self = this;
            MyApp.vent.on("search:error", function(){ self.showMessage("Error, please retry later :s") });
            MyApp.vent.on("search:noalbumNumber", function(){ self.showMessage("No album number") });
            MyApp.vent.on("search:noResults", function(){ self.showMessage("No images found") });
        },

        events: {
          //'scroll': 'loadMoreBooks'
        },

        appendHtml: function(collectionView, itemView){
            collectionView.$(".images").append(itemView.el);
        },

        showMessage: function(message){
          this.$('.images').html('<h1 class="notFound">' + message + '</h1>');
        }
    });

    var SearchView = Backbone.View.extend({
        el: "#searchBar",

        initialize: function(){
            var self = this;
            var $spinner = self.$('#spinner');
            MyApp.vent.on("search:start", function(){ $spinner.fadeIn(); });
            MyApp.vent.on("search:stop", function(){ $spinner.fadeOut(); });
            MyApp.vent.on("search:term", function(albumNumber, pageNumber){
                self.$('#albumNumber').val(albumNumber);
                self.$('#pageNumber').val(pageNumber);
            });
        },

        events: {
            'change #albumNumber': 'search',
            'change #pageNumber': 'search'
        },

        search: function() {
            var albumNumber = this.$('#albumNumber').val().trim();
            var pageNumber = this.$('#pageNumber').val().trim();

            if(albumNumber.length > 0){
              MyApp.vent.trigger("search:term", albumNumber, pageNumber);
            } else{
              MyApp.vent.trigger("search:noalbumNumber");
            }
        }
    });

    ImagesList.showImages = function(images){
          var imageListView = new ImageListView({ collection: images });
          MyApp.AlbumApp.layout.images.show(imageListView);
    };

    MyApp.vent.on("layout:rendered", function(){
          // render a view for the existing HTML in the template, and attach it to the layout (i.e. don't double render)
          var searchView = new SearchView();
          MyApp.AlbumApp.layout.search.attachView(searchView);
    });

    return ImagesList;
}();
