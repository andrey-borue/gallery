window.MyApp = new (Backbone.Marionette.Application)
ModalRegion = Backbone.Marionette.Region.extend(
  el: '#modal'
  constructor: ->
    _.bindAll this
    Backbone.Marionette.Region::constructor.apply this, arguments
    @on 'show', @showModal, this
    return
  getEl: (selector) ->
    $el = $(selector)
    $el.on 'hidden', @close
    $el
  showModal: (view) ->
    view.on 'close', @hideModal, this
    @$el.modal 'show'
    return
  hideModal: ->
    @$el.modal 'hide'
    return
)
MyApp.addRegions
  content: '#content'
  menu: '#menu'
  modal: ModalRegion
MyApp.vent.on 'routing:started', ->
  if !Backbone.History.started
    Backbone.history.start()
  return

