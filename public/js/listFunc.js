/**
 * the type of layer the user queries
 * @type {[string]}
 */
var type;
/**
 * the time range of the query submitted by the user
 * @type {[int]}
 */
var range;

/**
 * sets the layer type based on user selection, adjust css accordingly
 * @method setLayer
 * @param  {[string]}   type [the layer that has been selected by the user]
 * @author jamesr
 */
function setLayer(type) {
  this.type = type;
  $('.timeFilters').show();
  $('#' + type).addClass('btn-success');
  $('.get-checked-data:not(#' + type + ')').prop('disabled', true);
  $('.timeFilters > .btn-success:not(#' + range + ')').prop('disabled', false);
}

/**
 * sets the time range query variable, calls fx to query db w/ layer type and time range
 * @method timeQuery
 * @param  {[int]}  range [the range of time to be queried as seleced by the user]
 * @author jamesr
 */
function timeQuery(range) {
  this.range = range;
  initMap(type, range);
  $('.timeFilters > .btn-success:not(#' + range + ')').prop('disabled', true);
}

/**
 * clears the map by reloading the location, necessary b/c of non-asynchronous ajax call to API
 * @method clearMap
 * @author jamesr
 */
function clearMap() {
  location.reload();
}
